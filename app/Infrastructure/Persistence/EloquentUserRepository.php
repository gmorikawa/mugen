<?php

namespace App\Infrastructure\Persistence;

use App\Core\User\UserRepository;
use App\Core\User\User;
use App\Core\User\UserProfile;
use App\Core\User\UserRole;
use App\Models\UserModel;
use App\Models\UserProfileModel;
use Exception;

class EloquentUserRepository implements UserRepository
{
    public function findAll(): array
    {
        $found = UserModel::all();

        return $found->map(function ($item) {
            return new User([
                'id' => $item->id,
                'email' => $item->email,
                'username' => $item->username,
                'hashed_password' => $item->password,
                'role' => UserRole::from($item->role),
            ]);
        })->toArray();
    }

    public function findById(String $id): User | null
    {
        $found = UserModel::find($id);
        $foundProfile = UserProfileModel::find($id);

        return $found
            ? new User([
                'id' => $found->id,
                'email' => $found->email,
                'username' => $found->username,
                'hashed_password' => $found->password,
                'role' => UserRole::from($found->role),
                'profile' => $foundProfile
                    ? new UserProfile([
                        'fullname' => $foundProfile->fullname,
                        'biography' => $foundProfile->biography,
                        'avatar' => $foundProfile->avatar_id
                    ])
                    : null
            ])
            : null;
    }

    public function findByUsername(String $username): User | null
    {
        $found = UserModel::where('username', $username)->first();

        return $found
            ? new User([
                'id' => $found->id,
                'email' => $found->email,
                'username' => $found->username,
                'hashed_password' => $found->password,
                'role' => UserRole::from($found->role),
            ])
            : null;
    }

    public function findByEmail(String $email): User | null
    {
        $found = UserModel::where('email', $email)->first();

        return $found
            ? new User([
                'id' => $found->id,
                'email' => $found->email,
                'username' => $found->username,
                'hashed_password' => $found->password,
                'role' => UserRole::from($found->role),
            ])
            : null;
    }

    public function create(User $entity): User
    {
        $model = new UserModel([
            'email' => $entity->getEmail(),
            'username' => $entity->getUsername(),
            'password' => $entity->getPassword(),
            'role' => $entity->getRole()->value,
        ]);

        $model->save();

        error_log('Creating profile for user ID: ' . $model->id);

        $profileModel = new UserProfileModel([
            'user_id' => $model->id,
        ]);

        $profileModel->save();

        return new User([
            'id' => $model->id,
            'email' => $model->email,
            'username' => $model->username,
            'hashed_password' => $model->password,
            'role' => UserRole::from($model->role),
        ]);
    }

    public function update(String $id, User $entity): User
    {
        $model = UserModel::find($id);
        $profileModel = UserProfileModel::find($id);

        if (!$model) {
            throw new Exception('User not found');
        }

        $model->update([
            'email' => $entity->getEmail(),
            'username' => $entity->getUsername(),
            'password' => $entity->getPassword(),
            'role' => $entity->getRole()->value,
        ]);

        if (!$profileModel) {
            $profileModel = new UserProfileModel([
                'user_id' => $id,
            ]);
            $profileModel->save();
        }

        $profileModel->update([
            'fullname' => $entity->getProfile()?->getFullname(),
            'biography' => $entity->getProfile()?->getBiography(),
            'avatar' => $entity->getProfile()?->getAvatar(),
        ]);

        return new User([
            'id' => $model->id,
            'email' => $model->email,
            'username' => $model->username,
            'hashed_password' => $model->password,
            'role' => UserRole::from($model->role),
            'profile' => new UserProfile([
                'fullname' => $profileModel->fullname,
                'biography' => $profileModel->biography,
                'avatar' => $profileModel->avatar,
            ]),
        ]);
    }

    public function remove(String $id): bool
    {
        $model = UserModel::find($id);
        if (!$model) {
            return false;
        }

        return $model->delete();
    }

    public function generateToken(String $id): string
    {
        $model = UserModel::find($id);
        if (!$model) {
            throw new Exception('User not found');
        }

        return $model->createToken('auth_token')->plainTextToken;
    }
}
