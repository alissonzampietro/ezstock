<?php

namespace App\Service;

use App\Entity\Stock;
use App\Mapper\StockMapperInterface;
use App\Repository\StockRepository;
use GuzzleHttp\Client;

class StockMarketService
{

    private $client;
    private $apiKey;
    private $stockMapper;
    private $stockRepository;

    public function __construct(
        Client $client,
        string $apiKey,
        StockRepository $stockRepository,
        StockMapperInterface $stockMapper,
    ) {
        $this->client = $client;
        $this->apiKey = $apiKey;
        $this->stockMapper = $stockMapper;
        $this->stockRepository = $stockRepository;
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

        $url = 'http://alphavantage:3000/quotes';
        $response = $this->client->request('GET', $url);

        $data = json_decode($response->getBody()->getContents(), true);
        $mappedData = $this->stockMapper->map($data);

        $this->stockRepository->save($mappedData);

        return $mappedData;
    }
}
