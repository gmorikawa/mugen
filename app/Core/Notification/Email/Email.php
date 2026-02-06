<?php

namespace App\Core\Notification\Email;

class Email
{
    public readonly string $to;
    public readonly string $subject;
    public readonly string $template;
    public readonly array $templateData;
    public readonly array $attachments;

    public function __construct(
        string $to,
        string $subject,
        string $template,
        array $templateData = [],
        array $attachments = []
    ) {
        $this->to = $to;
        $this->subject = $subject;
        $this->template = $template;
        $this->templateData = $templateData;
        $this->attachments = $attachments;
    }
}