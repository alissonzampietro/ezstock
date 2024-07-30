<?php

namespace App\Message;

use App\DTO\StockQuoteResponseDto;
use App\Entity\User;

class StockEmailMessage
{

    private $user;
    private $stockDetails;

    public function __construct(
        User $user,
        StockQuoteResponseDto $stockDetails
    ) {
        $this->user = $user;
        $this->stockDetails = $stockDetails;
    }

    public function getUserName(): string
    {
        return $this->user->getName();
    }

    public function getUserEmail(): string
    {
        return $this->user->getEmail();
    }

    public function getStockDetails(): StockQuoteResponseDto
    {
        return $this->stockDetails;
    }
}
