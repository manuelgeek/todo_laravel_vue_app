<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\TaskComment;
use App\Models\User;
use App\Services\Helper;
use App\Transformers\TaskTransformer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TasksController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $query = $this->queryTasks(auth()->id());

        $tasks = $query->orderByDesc('created_at')->get();
        return response()->json(['tasks' => fractal($tasks, new TaskTransformer())]);
    }

    public function userTasks(User $user): \Illuminate\Http\JsonResponse
    {
        $query = $this->queryTasks($user->id);
        $query = $query->where('is_public', true);

        $tasks = $query->orderByDesc('created_at')->get();
        return response()->json(['tasks' => fractal($tasks, new TaskTransformer())]);
    }

    public function show(Task $task): \Illuminate\Http\JsonResponse
    {
        return response()->json(['task' => fractal($task, new TaskTransformer())]);
    }

    public function store(TaskRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $data['slug'] = Helper::getSlug($request->title);
        $data['status'] = Task::TODO;

        $task = auth()->user()->tasks()->create($data);

        return response()->json(['task' => fractal($task, new TaskTransformer())]);
    }

    public function update(TaskRequest $request, Task $task): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
//        * we're not going to change the slug'
//        $data['slug'] = Helper::getSlug($request->title);

        $task->update($data);

        return response()->json(['task' => fractal($task, new TaskTransformer())]);
    }

    public function updateStatus(Request $request, Task $task): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'status' => ['required', Rule::in([$task::TODO, $task::DOING, $task::DONE])],
        ]);

        $task->update(['status' => $request->status]);
        return response()->json(['task' => fractal($task, new TaskTransformer())]);
    }

    public function updateVisibility(Task $task): \Illuminate\Http\JsonResponse
    {
        $task->update(['is_public' => !$task->is_public]);
        return response()->json(['task' => fractal($task, new TaskTransformer())]);
    }

    public function destroy(Task $task): \Illuminate\Http\JsonResponse
    {
        $task->comments()->delete();
        $task->delete();

        return response()->json(['message' => 'Task deleted!']);
    }

    public function indexComment(Task $task): \Illuminate\Http\JsonResponse
    {
        return response()->json(['comment' => $task->comments]);
    }

    public function storeComment(Request $request, Task $task): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'body' => 'required|string|max:300',
        ]);

        $comment = $task->comments()->create($request->all());
        return response()->json(['comment' => $comment]);
    }

    public function destroyComment(Task $task, $id): \Illuminate\Http\JsonResponse
    {
        $comment = $task->comments()->findOrFail($id);
        $comment->delete();

        return response()->json(['message' => 'Task comment deleted!']);
    }

    private function queryTasks($user_id)
    {
        $query = Task::query();
        $query = $query->when(\request()->has('status') && \request()->status !== null, function ($q) {
            $q->whereStatus(\request()->status);
        });
        return $query->where('user_id', $user_id);
    }
}
