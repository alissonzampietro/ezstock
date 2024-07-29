<?php

namespace App\Mapper;

use App\Entity\Stock;

class StockMapper implements StockMapperInterface
{
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

        return $stock;
    }
}
