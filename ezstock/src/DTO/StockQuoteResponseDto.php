<?php

namespace App\DTO;

use App\Entity\Stock;
use DateTime;

class StockQuoteResponseDto extends Stock
{
    public function __construct(
        private string $symbol,
        private float $open,
        private float $high,
        private float $low,
        private float $close,
        private \DateTime $createdAt
    ) {
    }

    /**
     * Get the value of symbol
     */
    public function getSymbol(): null|string
    {
        return $this->symbol;
    }

    /**
     * Get the value of open
     */
    public function getOpen(): ?float
    {
        return $this->open;
    }

    /**
     * Get the value of high
     */
    public function getHigh(): null|float
    {
        return $this->high;
    }

    /**
     * Get the value of low
     */
    public function getLow(): null|float
    {
        return $this->low;
    }

    /**
     * Get the value of close
     */
    public function getClose(): null|float
    {
        return $this->close;
    }

    /**
     * Get the value of createdAt
     */
    public function getCreatedAt(): null|DateTime
    {
        return $this->createdAt;
    }
}
