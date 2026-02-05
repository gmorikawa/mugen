<?php

namespace App\Core\User;

use App\Exceptions\User\DuplicatedEmailException;
use App\Exceptions\User\DuplicatedUsernameException;
use App\Exceptions\User\ForbiddenAdminRemovalException;

class UserService
{
    public function __construct(
        private UserRepository $repository
    ) { }

    function getAll()
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

    // function update(String $id, User $entity)
    // {
    //     if (!$this->isUsernameUnique($entity->username, $id)) {
    //         throw new DuplicatedUsernameException();
    //     }

    //     if (!$this->isEmailUnique($entity->email, $id)) {
    //         throw new DuplicatedEmailException();
    //     }

    //     $user = $this->getById($id);

    //     if ($user) {
    //         $user->username = $entity->username;
    //         $user->email = $entity->email;

    //         $user->save();
    //     }

    //     return $user;
    // }

    // function remove(String $id)
    // {
    //     $user = $this->getById($id);

    //     if ($user->role === UserRole::ADMIN->value) {
    //         throw new ForbiddenAdminRemovalException();
    //     }

    //     return User::destroy($id);
    // }

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
