<?php

use App\Core\Auth\Exception\InvalidCredentialsException;

return [
    InvalidCredentialsException::class => [ 'http_status' => 401 ]
];