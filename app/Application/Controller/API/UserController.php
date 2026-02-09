<?php

namespace App\Application\Controller\API;

use App\Core\User\User;
use App\Core\User\UserProfile;
use App\Core\User\UserRole;
use App\Core\User\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        protected UserService $service
    ) {}

    public function getAll()
    {
        $users = $this->service->getAll();

        return array_map(function (User $user) {
            return $user->toObject();
        }, $users);
    }

    public function getById(String $id)
    {
        $user = $this->service->getById($id);

        return $user->toObject();
    }

    public function create(Request $request)
    {
        $entity = new User([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'plain_password' => $request->input('password'),
            'role' => UserRole::from($request->input('role')),
        ]);

        $created = $this->service->create($entity);

        return $created->toObject();
    }

    public function update(Request $request, String $id)
    {
        $entity = new User([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'role' => UserRole::from($request->input('role')),
            'profile' => new UserProfile([
                'fullname' => $request->input('profile.fullname'),
                'biography' => $request->input('profile.biography'),
                'avatar' => $request->input('profile.avatar'),
            ]),
        ]);

        $updated = $this->service->update($id, $entity);

        return $updated->toObject();
    }

    public function remove(String $id)
    {
        return $this->service->remove($id);
    }

    public function updateProfileAvatar(Request $request, String $id)
    {
        $avatar = $request->file('avatar');

        $this->service->storeProfileAvatar($id, $avatar);

        return [
            'success' => true
        ];
    }

    public function downloadProfileAvatar(String $id)
    {
        return $this->service->retrieveProfileAvatar($id);
    }
}
