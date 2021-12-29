<?php

namespace App\Repositories;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Str;

class UserRepository
{
    /**
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        $user = User::make($data);
        $user->role_id = data_get($data, 'role_id');
        $user->password = data_get($data, 'password', Str::random());
        $user->token = uniqid();
        $user->save();

        return $user;
    }

    /**
     * @param User $user
     * @param array $data
     * @return User
     */
    public function update(User $user, array $data): User
    {
        $user->update($data);

        return $user;
    }

    /**
     * @param User $user
     * @return User
     */
    public function loadRelations(User $user): User
    {
        $user->load(['role']);

        return $user;
    }
}
