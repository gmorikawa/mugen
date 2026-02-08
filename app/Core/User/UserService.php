<?php

namespace App\Core\User;

use App\Core\Auth\Interfaces\TokenGenerator;
use App\Core\File\File;
use App\Core\File\FileService;
use App\Core\Notification\Email\Email;
use App\Core\Notification\Email\Interfaces\EmailSender;
use App\Core\User\Exceptions\DuplicatedEmailException;
use App\Core\User\Exceptions\DuplicatedUsernameException;
use App\Core\User\Exceptions\ForbiddenAdminRemovalException;
use App\Core\User\Exceptions\UserNotFoundException;
use DateTime;

class UserService
{
    public function __construct(
        private EmailSender $emailSender,
        private TokenGenerator $tokenGenerator,
        private FileService $fileService,
        private UserRepository $repository,
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

        $token = $this->tokenGenerator->generate(
            domain: 'email_confirmation',
            payload: ['email' => $entity->email],
            validUntil: new DateTime('+7 day')
        );

        $this->emailSender->send(
            new Email(
                to: $entity->email,
                subject: 'Mugen - Confirm Email',
                template: 'emails.confirm_email',
                templateData: [
                    'username' => $entity->username,
                    'confirmation_link' => env('EMAIL_VERIFICATION_URL') . '?token=' . $token,
                ],
            )
        );

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

    function retrieveProfileAvatar(String $id)
    {
        $user = $this->getById($id);

        if ($user->profile === null || $user->profile->avatar === null) {
            throw new UserNotFoundException();
        }

        return $this->fileService->download($user->profile->avatar->id);
    }

    function storeProfileAvatar(String $id, $avatarStream): User
    {
        $user = $this->getById($id);
        $fileExtension = $avatarStream->getClientOriginalExtension();

        $avatarFile = $this->fileService->create(
            File::fromArray([
                'name' => $user->id . '_' . $user->username . '.' . $fileExtension,
                'path' => 'avatars/',
            ])
        );

        $this->fileService->upload($avatarFile->id, $avatarStream);

        $updatedUser = new User([
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'hashed_password' => $user->password,
            'role' => $user->role,
            'profile' => new UserProfile([
                'fullname' => $user->profile?->fullname,
                'biography' => $user->profile?->biography,
                'avatar' => $avatarFile,
            ]),
        ]);

        return $this->repository->update($id, $updatedUser);
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

    function confirmEmail(string $email): User
    {
        return $this->repository->confirmEmail($email);
    }
}
