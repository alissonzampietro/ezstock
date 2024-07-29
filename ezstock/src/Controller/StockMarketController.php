<?php

namespace App\Controller;

use App\Mapper\StockMapper;
use App\Message\StockEmailMessage;
use App\Repository\StockRepository;
use App\Service\StockMarketService;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

#[Route('/api/stock', name: 'app_stock_market')]
class StockMarketController extends AbstractController
{
    public function __construct(
        private StockMarketService $stockService,
        private UserService $userService,
        private StockRepository $stockRepository,
        private StockMapper $stockMapper,
        private MessageBusInterface $messageBus,
    ) {
    }
    #[Route('/{symbol}', methods: ['GET'])]
    public function getQuote(string $symbol): JsonResponse
    {
        $result = $this->stockService->getQuote($symbol);

        if (!$result) {
            return $this->json(['data' => []]);
        }

        $this->stockRepository->save($result);

        $mappedData = $this->stockMapper->mapToResponseQuoteDto($result);

        $this->messageBus->dispatch(new StockEmailMessage($this->userService->getTokenEmail(), $mappedData));

        return $this->json(['data' => $mappedData]);
    }
}
