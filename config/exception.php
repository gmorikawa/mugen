<?php

return [
    \App\Core\Auth\Exceptions\InvalidCredentialsException::class => [ 'http_status' => 401 ],
    \App\Core\Auth\Exceptions\InvalidTokenException::class => [ 'http_status' => 401 ],

    \App\Core\User\Exceptions\DuplicatedUsernameException::class => [ 'http_status' => 409 ],
    \App\Core\User\Exceptions\DuplicatedEmailException::class => [ 'http_status' => 409 ],
    \App\Core\User\Exceptions\ForbiddenAdminRemovalException::class => [ 'http_status' => 403 ],
    \App\Core\User\Exceptions\UserNotFoundException::class => [ 'http_status' => 404 ],
];
