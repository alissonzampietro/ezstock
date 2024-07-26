<?php

namespace App\Message;

class EmailMessaging
{
    private $subject;
    private $body;
    private $recipient;

    public function __construct(string $subject, string $body, string $recipient)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->recipient = $recipient;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getRecipient(): string
    {
        return $this->recipient;
    }
}
