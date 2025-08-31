<?php

namespace App\Services;

use App\Exceptions\User\DuplicatedEmailException;
use App\Exceptions\User\DuplicatedUsernameException;
use App\Models\User;

class UserService
{
    function getAll()
    {
        return User::all();
    }

    function getById(String $id)
    {
        return User::find($id);
    }

    function getByUsername(String $username)
    {
        return User::where('username', $username)->first();
    }

    function getByEmail(String $email)
    {
        return User::where('email', $email)->first();
    }

    function create(User $entity)
    {
        if (!$this->isUsernameUnique($entity->username)) {
            throw new DuplicatedUsernameException();
        }

        if (!$this->isEmailUnique($entity->email)) {
            throw new DuplicatedEmailException();
        }

        $entity->save();

        return $entity;
    }

    function update(String $id, User $entity)
    {
        if (!$this->isUsernameUnique($entity->username, $id)) {
            throw new DuplicatedUsernameException();
        }

        if (!$this->isEmailUnique($entity->email, $id)) {
            throw new DuplicatedEmailException();
        }

        $user = $this->getById($id);

        if ($user) {
            $user->username = $entity->username;
            $user->email = $entity->email;

            $user->save();
        }

        return $user;
    }

    function remove(String $id)
    {
        return User::destroy($id);
    }

    function isUsernameUnique(String $username, String $ignoreId = '')
    {
        $user = $this->getByUsername($username);

        return is_null($user) || $user->id == $ignoreId;
    }

    function isEmailUnique(String $email, String $ignoreId = '')
    {
        $user = $this->getByEmail($email);

        return is_null($user) || $user->id == $ignoreId;
    }
}
