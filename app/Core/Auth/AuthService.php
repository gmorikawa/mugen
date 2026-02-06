<?php

namespace App\Core\Auth;

use App\Core\Auth\Exceptions\InvalidCredentialsException;
use App\Core\Auth\Exceptions\InvalidTokenException;
use App\Core\Auth\Interfaces\TokenGenerator;
use App\Core\User\LoggedUser;
use App\Core\User\User;
use App\Core\User\UserRole;
use App\Core\User\UserService;
use InvalidArgumentException;

class AuthService
{
    public function __construct(
        protected UserService $userService,
        protected TokenGenerator $tokenGenerator
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
            'id' => $foundUser->id,
            'username' => $foundUser->username,
            'email' => $foundUser->email,
            'role' => $foundUser->role,
            'profile' => $foundUser->profile,
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

    public function confirmEmail(string $token): bool
    {
        $payload = $this->tokenGenerator->validate('email_confirmation', $token);

        if (!isset($payload->email)) {
            throw new InvalidTokenException();
        }

        $email = $payload->email;

        $user = $this->userService->confirmEmail($email);

        $this->tokenGenerator->revoke($token);

        return ($user?->emailConfirmedAt !== null);
    }
}
