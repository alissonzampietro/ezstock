<?php

namespace App\Mapper;

use App\DTO\StockQuoteResponseDto;
use App\Entity\Stock;

interface StockMapperInterface
{
    public function map(array $data): Stock;
    public function mapToResponseQuoteDto(Stock $data): StockQuoteResponseDto;
}
