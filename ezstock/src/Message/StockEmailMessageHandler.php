<?php

namespace App\Message;

use App\Message\StockEmailMessage;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class StockEmailMessageHandler
{
    public function __construct(
        private MailerInterface $mailer
    ) {
    }

    public function __invoke(StockEmailMessage $message)
    {
        $email = (new Email())
            ->from('no-reply@example.com')
            ->to($message->getRecipient())
            ->subject('Stock Update')
            ->html($this->renderStockDetails(['name' => 'Alisson']));

        var_dump($email);

        $this->mailer->send($email);
    }

    private function renderStockDetails(array $stockDetails): string
    {
        $html = '<h1>Stock Update</h1>';
        foreach ($stockDetails as $detail) {
            $html .= "<p>{$detail}</p>";
        }
        return $html;
    }
}
