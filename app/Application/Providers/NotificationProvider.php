<?php

namespace App\Application\Providers;

use App\Core\Notification\Email\Interfaces\EmailSender;
use App\Infrastructure\Notification\Email\LaravelEmailSender;
use Illuminate\Support\ServiceProvider;

class NotificationProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(EmailSender::class, LaravelEmailSender::class);
    }

    public function boot(): void {}
}
