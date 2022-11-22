<?php

namespace App\Repositories\Auth;

use App\Enums\CmnEnum;
use App\Models\User;

class RegisterRepository
{
    /**
     * @var User
     */
    protected $user;

    /**
     * RegisterRepository constructor.
     *
     * @param User $post
     */

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create($request)
    {
        $user = $this->user->create($request->all());
        if (method_exists($user, 'roles')) {
            $user->roles()->attach([CmnEnum::ROLE_USER_ID]);
        }
        return $user->fresh();
    }
}
