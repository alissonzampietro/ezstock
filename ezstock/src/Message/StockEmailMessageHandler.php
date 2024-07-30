<?php

namespace App\Message;

use App\DTO\StockQuoteResponseDto;
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
            ->to($message->getUserEmail())
            ->subject('Stock Update')
            ->html($this->renderStockDetails($message->getUserName(), $message->getStockDetails()));

        $this->mailer->send($email);
    }

    private function renderStockDetails(string $name, StockQuoteResponseDto $stockDetails): string
    {
        $html = <<<HTML
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Stock Update</title>
            </head>
            <body>
                <h1>{$name}, here is your Stock Update for {$stockDetails->getSymbol()}</h1>
                <table border="1" cellpadding="10" cellspacing="0">
                    <tr>
                        <th>Symbol</th>
                        <td>{$stockDetails->getSymbol()}</td>
                    </tr>
                    <tr>
                        <th>Open</th>
                        <td>{$stockDetails->getOpen()}</td>
                    </tr>
                    <tr>
                        <th>High</th>
                        <td>{$stockDetails->getHigh()}</td>
                    </tr>
                    <tr>
                        <th>Low</th>
                        <td>{$stockDetails->getLow()}</td>
                    </tr>
                    <tr>
                        <th>Close</th>
                        <td>{$stockDetails->getClose()}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{$stockDetails->getCreatedAt()}</td>
                    </tr>
                </table>
            </body>
            </html>
            HTML;
        return $html;
    }
}
