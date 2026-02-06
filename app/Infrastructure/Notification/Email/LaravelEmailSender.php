<?php

namespace App\Infrastructure\Notification\Email;

use App\Core\Notification\Email\Email;
use App\Core\Notification\Email\Interfaces\EmailSender;
use Illuminate\Support\Facades\Mail;

class LaravelEmailSender implements EmailSender
{
    public function send(Email $email): bool
    {
        try {
            Mail::send(
                $email->template,
                $email->templateData,
                function ($message) use ($email) {
                    $message
                        ->to($email->to)
                        ->subject($email->subject);

                    foreach ($email->attachments as $attachment) {
                        $message->attach($attachment);
                    }
                }
            );
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
