<?php

namespace App\Transformers;

use App\Models\User;
use App\Services\Helper;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
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
    public function transform(User $user): array
    {
        return [
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => Helper::getTimestampFromDateString($user->created_at),
        ];
    }
}
