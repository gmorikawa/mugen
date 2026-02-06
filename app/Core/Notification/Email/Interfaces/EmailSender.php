<?php

namespace App\Core\Notification\Email\Interfaces;

use App\Core\Notification\Email\Email;

interface EmailSender
{
    function send(Email $email): bool;
}