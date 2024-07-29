<?php

namespace App\Controller;

use App\Mapper\StockMapper;
use App\Service\StockMarketService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/api/stock', name: 'app_stock_market')]
class StockMarketController extends AbstractController
{
    private $stockService;
    private $stockMapper;
    public function __construct(
        StockMarketService $stockService,
        StockMapper $stockMapper
    ) {
        $this->stockService = $stockService;
        $this->stockMapper = $stockMapper;
    }
    #[Route('/{symbol}', methods: ['GET'])]
    public function getQuote(string $symbol): JsonResponse
    {
        $result = $this->stockService->getQuote($symbol);

        if (!$result) {
            return $this->json(['data' => []]);
        }

        return $this->json(['data' => $this->stockMapper->mapToResponseQuoteDto($result)]);
    }
}
