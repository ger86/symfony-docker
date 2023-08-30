<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailService
{
    public function sendMail(string $to, string $subject, string $text, MailerInterface $mailer): void
    {
        $email = (new Email())
            ->from('notifier@example.com')
            ->to($to)
            ->subject($subject)
            ->text($text);

        $mailer->send($email);
    }
}
