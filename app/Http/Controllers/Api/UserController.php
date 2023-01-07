<?php

namespace App\Http\Controllers\Api;

use App\Models\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * @param int $id
     * @return UserResource
     */
    public function show(int $id): UserResource
    {
        $user = User::findOrFail($id);
        return UserResource::make($user);
    }

    /**
     * @param UserUpdateRequest $request
     * @param integer $id
     * @return UserResource
     */
    public function update(UserUpdateRequest $request, int $id): UserResource
    {
        $user = User::findOrFail($id);

        $user->update($request->toArray());

        return UserResource::make($user);
    }


    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $user = User::find($id);

        $user->delete($user);
    }
}
