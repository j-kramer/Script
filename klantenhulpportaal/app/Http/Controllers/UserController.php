<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', User::class);
        $users = User::all();

        return UserResource::collection($users);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        Gate::authorize('view', $user);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        Gate::authorize('update', $user);

        $validated = $request->validated();
        $user->fill($validated);

        if ($request->user()->is_admin) {
            $is_admin = $request->boolean('is_admin');
            $user->is_admin = $is_admin;

            // check if we are removing our admin rights
            if ($request->user()->is($user) && ! $is_admin) {
                // check if we are not the last admin
                if (User::where('is_admin', true)->count() == 1) {
                    return throw ValidationException::withMessages([
                        'is_admin' => 'Cannot remove the last admin',
                    ],
                    );
                }
            }

        }

        $user->save();

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Gate::authorize('delete', $user);

        // make sure we don't delete the last admin
        if ($user->is_admin && User::where('is_admin', true)->count() == 1) {
            return throw ValidationException::withMessages([
                'is_admin' => 'Cannot remove the last admin',
            ],
            );
        }

        $user->delete();

        return response()->json(null, 204);
    }
}
