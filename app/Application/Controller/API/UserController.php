<?php

namespace App\Application\Controller\API;

use App\Core\User\User;
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
            ];
        }, $users);
    }

    public function getById(String $id)
    {
        return $this->service->getById($id);
    }

    public function create(Request $request)
    {
        $entity = new User([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'plain_password' => $request->input('password'),
            'role' => $request->input('role'),
        ]);

        return $this->service->create($entity);
    }

    // public function update(Request $request, String $id)
    // {
    //     $entity = new User([
    //         'email' => $request->input('email'),
    //         'username' => $request->input('username'),
    //         'password' => password_hash($request->input('password'), PASSWORD_BCRYPT),
    //         'role' => $request->input('role'),
    //     ]);

    //     return $this->service->update($id, $entity);
    // }

    // public function remove(String $id)
    // {
    //     return $this->service->remove($id);
    // }
}
