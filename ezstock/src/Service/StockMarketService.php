<?php

namespace App\Service;

use App\Entity\Stock;
use App\Mapper\StockMapperInterface;
use GuzzleHttp\Client;

class StockMarketService
{

    private $client;
    private $apiKey;
    private $stockMapper;
    private $userService;

    public function __construct(
        Client $client,
        string $apiKey,
        StockMapperInterface $stockMapper,
        UserService $userService
    ) {
        $this->client = $client;
        $this->apiKey = $apiKey;
        $this->stockMapper = $stockMapper;
        $this->userService = $userService;
    }

    public function getQuote(string $symbol): Stock
    {
        // $url = 'https://www.alphavantage.co/query';
        // $response = $this->client->request('GET', $url, [
        //     'query' => [
        //         'function' => 'GLOBAL_QUOTE',
        //         'symbol' => $symbol,
        //         'apikey' => $this->apiKey,
        //     ]
        // ]);

        dd($this->userService->getCurrentUser());
        $url = 'http://alphavantage:3000/quotes';
        $response = $this->client->request('GET', $url);

        $data = json_decode($response->getBody()->getContents(), true);


        return $this->stockMapper->map($data);
    }
}
