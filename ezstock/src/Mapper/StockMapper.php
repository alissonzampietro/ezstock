<?php

namespace App\Mapper;

use App\DTO\StockQuoteResponseDto;
use App\Entity\Stock;
use App\Service\UserService;
use DateTime;

class StockMapper implements StockMapperInterface
{
    public function __construct(
        private UserService $userService
    ) {
    }


    public function map(array $data): Stock
    {
        if (!isset($data['Global Quote'])) {
            throw new \InvalidArgumentException('Invalid data structure');
        }

        $stock = new Stock();
        $stock->setSymbol($data['Global Quote']['01. symbol'] ?? null);
        $stock->setOpen($data['Global Quote']['02. open'] ?? null);
        $stock->setHigh($data['Global Quote']['03. high'] ?? null);
        $stock->setLow($data['Global Quote']['04. low'] ?? null);
        $stock->setClose($data['Global Quote']['08. previous close']  ?? null);
        $stock->setUserId($this->userService->getCurrentUser());
        $stock->setCreatedAt(new DateTime());

        return $stock;
    }

    public function mapToResponseQuoteDto(Stock $stock): StockQuoteResponseDto
    {
        return new StockQuoteResponseDto(
            $stock->getSymbol(),
            $stock->getOpen(),
            $stock->getHigh(),
            $stock->getLow(),
            $stock->getClose(),
            $stock->getCreatedAt(),
        );
    }
}
