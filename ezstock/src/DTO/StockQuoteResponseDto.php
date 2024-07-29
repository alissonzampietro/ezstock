<?php

namespace App\DTO;

class StockQuoteResponseDto
{
    private $symbol;
    private $open;
    private $high;
    private $low;
    private $close;
    private $createdAt;

    public function __construct(string $symbol, float $open, float $high, float $low, float $close, \DateTime $createdAt)
    {
        $this->symbol = $symbol;
        $this->open = $open;
        $this->high = $high;
        $this->low = $low;
        $this->close = $close;
        $this->createdAt = $createdAt;
    }

    /**
     * Get the value of symbol
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * Get the value of open
     */
    public function getOpen()
    {
        return $this->open;
    }

    /**
     * Get the value of high
     */
    public function getHigh()
    {
        return $this->high;
    }

    /**
     * Get the value of low
     */
    public function getLow()
    {
        return $this->low;
    }

    /**
     * Get the value of close
     */
    public function getClose()
    {
        return $this->close;
    }

    /**
     * Get the value of createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
