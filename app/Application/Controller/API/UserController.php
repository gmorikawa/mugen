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
            return [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'username' => $user->getUsername(),
                'role' => $user->getRole()->value,
                'profile' => [
                    'fullname' => $user->getProfile()?->getFullname(),
                    'biography' => $user->getProfile()?->getBiography(),
                    'avatar' => $user->getProfile()?->getAvatar(),
                ],
            ];
        }, $users);
    }

    public function getById(String $id)
    {
        $user = $this->service->getById($id);

        if ($user === null) {
            return null;
        }

        return [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'username' => $user->getUsername(),
            'role' => $user->getRole()->value,
            'profile' => [
                'fullname' => $user->getProfile()?->getFullname(),
                'biography' => $user->getProfile()?->getBiography(),
                'avatar' => $user->getProfile()?->getAvatar(),
            ],
        ];
    }

    public function create(Request $request)
    {
        $entity = new User([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'plain_password' => $request->input('password'),
            'role' => UserRole::from($request->input('role')),
        ]);

        return $this->service->create($entity);
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

        return [
            'id' => $updated->getId(),
            'email' => $updated->getEmail(),
            'username' => $updated->getUsername(),
            'role' => $updated->getRole()->value,
            'profile' => [
                'fullname' => $updated->getProfile()?->getFullname(),
                'biography' => $updated->getProfile()?->getBiography(),
                'avatar' => $updated->getProfile()?->getAvatar(),
            ],
        ];
    }

    public function remove(String $id)
    {
        return $this->service->remove($id);
    }
}
