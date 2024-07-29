<?php

namespace App\Controller;

use App\Service\StockMarketService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/api/stock', name: 'app_stock_market')]
class StockMarketController extends AbstractController
{
    private $entityManager;
    private $stockService;
    public function __construct(StockMarketService $stockService, EntityManagerInterface $entityManager,)
    {
        $this->stockService = $stockService;
        $this->entityManager = $entityManager;
    }
    #[Route('/{symbol}', methods: ['GET'])]
    public function getQuote(string $symbol): JsonResponse
    {
        $result = $this->stockService->getQuote($symbol);

        $this->entityManager->persist($result);
        $this->entityManager->flush();

        if (!$result) {
            return $this->json(['data' => []]);
        }

        return $this->json(['data' => $result]);
    }
}
