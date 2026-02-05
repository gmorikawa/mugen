<?php

namespace App\Core\Auth;

use App\Core\Auth\Exceptions\InvalidCredentialsException;
use App\Core\User\LoggedUser;
use App\Core\User\User;
use App\Core\User\UserRole;
use App\Core\User\UserService;

class AuthService
{
    public function __construct(
        protected UserService $userService
    ) {}

    public function login(string $username, string $password): Session
    {
        $foundUser = $this->userService->getByUsername($username);

        if (!$foundUser) {
            throw new InvalidCredentialsException();
        }

        if (!$foundUser->verifyPassword($password)) {
            throw new InvalidCredentialsException();
        }

        $loggedUser = new LoggedUser([
            'id' => $foundUser->getId(),
            'username' => $foundUser->getUsername(),
            'email' => $foundUser->getEmail(),
            'role' => $foundUser->getRole(),
            'profile' => $foundUser->getProfile(),
        ]);
        $token = $this->userService->generateToken($foundUser);

        return new Session($token, $loggedUser);
    }

    public function setupFirstAdmin(AdminSignup $adminSignup): bool
    {
        $entity = new User([
            'email' => $adminSignup->getEmail(),
            'username' => $adminSignup->getUsername(),
            'plain_password' => $adminSignup->getPassword(),
            'role' => UserRole::ADMIN,
        ]);

        $this->userService->create($entity);

        return true;
    }
}
