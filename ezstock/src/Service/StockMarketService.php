<?php

namespace App\Service;

use App\Entity\Stock;
use App\Mapper\StockMapperInterface;
use App\Message\StockEmailMessage;
use App\Repository\StockRepository;
use GuzzleHttp\Client;
use Symfony\Component\Messenger\MessageBusInterface;

class StockMarketService
{

    private $client;
    private $apiKey;
    private $stockMapper;
    private $messageBus;

    public function __construct(
        Client $client,
        string $apiKey,
        StockMapperInterface $stockMapper,
    ) {
        $this->client = $client;
        $this->apiKey = $apiKey;
        $this->stockMapper = $stockMapper;
    }

    private function getRealQuote(string $symbol)
    {
        $url = 'https://www.alphavantage.co/query';
        $response = $this->client->request('GET', $url, [
            'query' => [
                'function' => 'GLOBAL_QUOTE',
                'symbol' => $symbol,
                'apikey' => $this->apiKey,
            ]
        ]);
        return $response;
    }

    private function getFakeQuote(string $symbol)
    {
        $url = 'http://alphavantage:3000/quotes';
        $response = $this->client->request('GET', $url);
        return $response;
    }

    public function getQuote(string $symbol): Stock
    {
        // $response = $this->getRealQuote($symbol);
        $response = $this->getFakeQuote($symbol);

        $data = json_decode($response->getBody()->getContents(), true);


        $mappedData = $this->stockMapper->map($data);

        return $mappedData;
    }
}
