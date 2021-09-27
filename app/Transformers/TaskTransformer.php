<?php

namespace App\Transformers;

use App\Models\Category;
use App\Models\Task;
use App\Services\Helper;
use League\Fractal\TransformerAbstract;

class TaskTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Task $task): array
    {
        return [
            'title' => $task->title,
            'slug' => $task->slug,
            'description' => $task->description,
            'category' => $task->category instanceof Category ? fractal($task->category, new CategoryTransformer()) : $task->category,
            'status' => $task->status,
            'visibility' => $task->is_public ? 'public' : 'private',
            'created_at' => Helper::getTimestampFromDateString($task->created_at)
        ];
    }
}
