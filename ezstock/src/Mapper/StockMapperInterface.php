<?php

namespace App\Mapper;

use App\Entity\Stock;

interface StockMapperInterface
{
    public function map(array $data): Stock;
}
