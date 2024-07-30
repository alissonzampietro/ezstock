<?php

namespace App\Controller;

use App\Mapper\StockMapper;
use App\Message\StockEmailMessage;
use App\Repository\StockRepository;
use App\Service\StockMarketService;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

#[Route('/api/stock', name: 'app_stock_market')]
class StockController extends AbstractController
{
    public function __construct(
        private StockMarketService $stockService,
        private UserService $userService,
        private StockRepository $stockRepository,
        private StockMapper $stockMapper,
        private MessageBusInterface $messageBus,
    ) {
    }
    #[Route('/')]
    public function getQuote(#[MapQueryParameter] string $symbol): JsonResponse
    {

        $result = $this->stockService->getQuote($symbol);

        if (!$result) {
            return $this->json(['data' => []]);
        }

        $this->stockRepository->save($result);

        $mappedData = $this->stockMapper->mapToResponseQuoteDto($result);

        //TODO: automatically run the dispatcher (since today we have to run it manually)
        $this->messageBus->dispatch(new StockEmailMessage($this->userService->getCurrentUser(), $mappedData));

        return $this->json(['data' => $mappedData]);
    }

    #[Route('/history')]
    public function getHistory(
        #[MapQueryParameter] ?string $order = 'DESC',
        #[MapQueryParameter] ?string $field = 'created_at'
    ) {
        $result = array_map(
            fn ($item) => $this->stockMapper->mapToResponseQuoteDto($item),
            $this->stockRepository->findBy(['user_id' => $this->userService->getCurrentUser()->getId()], [$field => $order])
        );
        return $this->json(['data' => $result]);
    }
}
