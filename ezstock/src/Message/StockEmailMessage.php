<?php

namespace App\Message;

use App\DTO\StockQuoteResponseDto;

class StockEmailMessage
{

    public function __construct(
        private string $recipient,
        private StockQuoteResponseDto $stockDetails
    ) {
    }

    public function getRecipient(): string
    {
        return $this->recipient;
    }

    public function getStockDetails(): StockQuoteResponseDto
    {
        return $this->stockDetails;
    }
}
