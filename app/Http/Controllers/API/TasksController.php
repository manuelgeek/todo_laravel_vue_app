<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use App\Services\Helper;
use App\Transformers\TaskTransformer;
use Illuminate\Http\Request;

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

        $task = auth()->user()->tasks()->create($data);

        return response()->json(['task' => fractal($task, new TaskTransformer())]);
    }

    public function update(TaskRequest $request, Task $task): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $data['slug'] = Helper::getSlug($request->title);

        $task->update($data);

        return response()->json(['task' => fractal($task, new TaskTransformer())]);
    }

    public function destroy(Task $task): \Illuminate\Http\JsonResponse
    {
        $task->delete();

        return response()->json(['message' => 'Task deleted!'], 201);
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
