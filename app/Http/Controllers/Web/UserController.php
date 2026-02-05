<?php

namespace App\Http\Controllers\Web;

use App\Enums\UserRole;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Exceptions\User\DuplicatedEmailException;
use App\Exceptions\User\DuplicatedUsernameException;
use App\Exceptions\User\ForbiddenAdminRemovalException;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    public function list(Request $request): View
    {
        $service = new UserService();

        return view('user.list', [
            'title' => 'List User',
            'users' => $service->getAll(),
        ]);
    }

    public function createForm(Request $request): View
    {
        $roles = [
            ['key' => UserRole::ADMIN->value, 'label' => UserRole::ADMIN->label()],
            ['key' => UserRole::MANAGER->value, 'label' => UserRole::MANAGER->label()],
            ['key' => UserRole::MEMBER->value, 'label' => UserRole::MEMBER->label()],
        ];

        return view('user.form-create', [
            'title' => 'Create User',
            'roles' => $roles
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'username' => ['required'],
            'password' => ['required'],
            'role' => ['required']
        ]);

        try {
            $service = new UserService();
            $user = new User();
            $user->email = $data['email'];
            $user->username = $data['username'];
            $user->password = $data['password'] ?? "jesus";
            $user->role = $data['role'] ?? UserRole::MEMBER->value;

            $service->create($user);

            return redirect()
                ->action([UserController::class, 'list']);
        } catch (DuplicatedUsernameException $exception) {
            return back()
                ->withErrors([
                    'username' => $exception->getErrorMessage(),
                ])
                ->withInput();
        } catch (DuplicatedEmailException $exception) {
            return back()
                ->withErrors([
                    'email' => $exception->getErrorMessage(),
                ])
                ->withInput();
        }
    }

    public function updateForm(Request $request, String $id): View
    {
        $service = new UserService();

        $user = $service->getById($id);

        $roles = [
            ['key' => UserRole::ADMIN->value, 'label' => UserRole::ADMIN->label()],
            ['key' => UserRole::MANAGER->value, 'label' => UserRole::MANAGER->label()],
            ['key' => UserRole::MEMBER->value, 'label' => UserRole::MEMBER->label()],
        ];

        return view('user.form-update', [
            'title' => 'Update User',
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(Request $request, String $id): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'username' => ['required'],
            'role' => ['required']
        ]);

        try {
            $service = new UserService();
            $user = new User();

            $user->email = $data['email'];
            $user->username = $data['username'];
            $user->role = $data['role'] ?? UserRole::MEMBER->value;

            $service->update($id, $user);

            return redirect()
                ->action([UserController::class, 'list']);
        } catch (DuplicatedUsernameException $exception) {
            return back()
                ->withErrors([
                    'username' => $exception->getErrorMessage(),
                ])
                ->withInput();
        } catch (DuplicatedEmailException $exception) {
            return back()
                ->withErrors([
                    'email' => $exception->getErrorMessage(),
                ])
                ->withInput();
        }
    }

    public function removeConfirm(Request $request, String $id): View
    {
        $service = new UserService();

        $user = $service->getById($id);

        return view('user.confirm-remove', [
            'title' => 'Remove User',
            'user' => $user
        ]);
    }

    public function remove(Request $request, String $id): RedirectResponse
    {
        $service = new UserService();

        try {
            $service->remove($id);

            return redirect()
                ->action([UserController::class, 'list']);
        } catch (ForbiddenAdminRemovalException $exception) {
            return back()
                ->withErrors([
                    'user' => $exception->getErrorMessage(),
                ]);
        }
    }
}
