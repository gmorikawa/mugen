<?php

use App\Core\Auth\Exceptions\InvalidCredentialsException;

use App\Core\User\Exceptions\DuplicatedEmailException;
use App\Core\User\Exceptions\DuplicatedUsernameException;
use App\Core\User\Exceptions\ForbiddenAdminRemovalException;
use App\Core\User\Exceptions\UserNotFoundException;

return [
    InvalidCredentialsException::class => [ 'http_status' => 401 ],

    DuplicatedUsernameException::class => [ 'http_status' => 409 ],
    DuplicatedEmailException::class => [ 'http_status' => 409 ],
    ForbiddenAdminRemovalException::class => [ 'http_status' => 403 ],
    UserNotFoundException::class => [ 'http_status' => 404 ],
];
