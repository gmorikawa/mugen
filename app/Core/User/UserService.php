<?php

namespace App\Core\User;

use App\Core\User\Exceptions\DuplicatedEmailException;
use App\Core\User\Exceptions\DuplicatedUsernameException;
use App\Core\User\Exceptions\ForbiddenAdminRemovalException;
use App\Core\User\Exceptions\UserNotFoundException;

class UserService
{
    public function __construct(
        private UserRepository $repository
    ) {}

    function getAll(): array
    {
        return $this->repository->findAll();
    }

    function getById(String $id): User
    {
        $user = $this->repository->findById($id);

        if ($user === null) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    function getByUsername(String $username): User
    {
        $user = $this->repository->findByUsername($username);

        if ($user === null) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    function getByEmail(String $email): User
    {
        $user = $this->repository->findByEmail($email);

        if ($user === null) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    function create(User $entity): User
    {
        if (!$this->isUsernameUnique($entity->username)) {
            throw new DuplicatedUsernameException();
        }

        if (!$this->isEmailUnique($entity->email)) {
            throw new DuplicatedEmailException();
        }

        return $this->repository->create($entity);
    }

    function update(String $id, User $entity): User
    {
        if (!$this->isUsernameUnique($entity->username, $id)) {
            throw new DuplicatedUsernameException();
        }

        if (!$this->isEmailUnique($entity->email, $id)) {
            throw new DuplicatedEmailException();
        }

        $user = $this->repository->findById($id);

        if ($user === null) {
            throw new UserNotFoundException();
        }

        $modifiedUser = new User([
            'id' => $user->id,
            'username' => $entity->username,
            'email' => $entity->email,
            'hashed_password' => $user->password,
            'role' => $entity->role,
            'profile' => $entity->profile,
        ]);

        return $this->repository->update($id, $modifiedUser);
    }

    function remove(String $id): bool
    {
        $user = $this->getById($id);

        if ($user->role === UserRole::ADMIN) {
            throw new ForbiddenAdminRemovalException();
        }

        return $this->repository->remove($id);
    }

    function isUsernameUnique(String $username, String $ignoreId = ''): bool
    {
        $user = $this->repository->findByUsername($username);

        return is_null($user) || $user->id == $ignoreId;
    }

    function isEmailUnique(String $email, String $ignoreId = ''): bool
    {
        $user = $this->repository->findByEmail($email);

        return is_null($user) || $user->id == $ignoreId;
    }

    function generateToken(User $user): string
    {
        return $this->repository->generateToken($user->id);
    }
}
