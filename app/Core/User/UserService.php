<?php

namespace App\Core\User;

use App\Core\User\Exceptions\DuplicatedEmailException;
use App\Core\User\Exceptions\DuplicatedUsernameException;
use App\Core\User\Exceptions\ForbiddenAdminRemovalException;

class UserService
{
    public function __construct(
        private UserRepository $repository
    ) { }

    function getAll(): array
    {
        return $this->repository->findAll();
    }

    function getById(String $id)
    {
        return $this->repository->findById($id);
    }

    function getByUsername(String $username)
    {
        return $this->repository->findByUsername($username);
    }

    function getByEmail(String $email)
    {
        return $this->repository->findByEmail($email);
    }

    function create(User $entity)
    {
        if (!$this->isUsernameUnique($entity->getUsername())) {
            throw new DuplicatedUsernameException();
        }

        if (!$this->isEmailUnique($entity->getEmail())) {
            throw new DuplicatedEmailException();
        }

        return $this->repository->create($entity);
    }

    function update(String $id, User $entity): User | null
    {
        if (!$this->isUsernameUnique($entity->getUsername(), $id)) {
            throw new DuplicatedUsernameException();
        }

        if (!$this->isEmailUnique($entity->getEmail(), $id)) {
            throw new DuplicatedEmailException();
        }

        $user = $this->getById($id);

        if ($user) {
            return $this->repository->update($id, new User([
                'email' => $entity->getEmail() ?? $user->getEmail(),
                'username' => $entity->getUsername() ?? $user->getUsername(),
                'password' => $user->getPassword(),
                'role' => $entity->getRole() ?? $user->getRole(),
                'profile' => $entity->getProfile() ?? $user->getProfile(),
            ]));
        }

        return $user;
    }

    function remove(String $id): bool
    {
        $user = $this->getById($id);

        if ($user->getRole() === UserRole::ADMIN) {
            throw new ForbiddenAdminRemovalException();
        }

        return $this->repository->remove($id);
    }

    function isUsernameUnique(String $username, String $ignoreId = '')
    {
        $user = $this->getByUsername($username);

        return is_null($user) || $user->getId() == $ignoreId;
    }

    function isEmailUnique(String $email, String $ignoreId = '')
    {
        $user = $this->getByEmail($email);

        return is_null($user) || $user->getId() == $ignoreId;
    }

    function generateToken(User $user)
    {
        return $this->repository->generateToken($user->getId());
    }
}
