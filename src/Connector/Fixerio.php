<?php

namespace App\Connector;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientInterface;
use Psr\Log\LoggerInterface;
use function GuzzleHttp\Psr7\build_query;

class Fixerio implements ConnectorInterface
{
    const URL = 'http://data.fixer.io/api/latest';

    private $apiKey;
    private $client;
    private $logger;

    public function __construct(
        string $apiKey,
        ClientInterface $client,
        LoggerInterface $logger
    ) {
        $this->apiKey = $apiKey;
        $this->client = $client;
        $this->logger = $logger;
    }

    public function getRates()
    {
        try {
            $response = $this->client->sendRequest(
                new Request(
                    'GET',
                    self::URL . build_query(['access_key' => $this->apiKey])
                )
            );
        } catch (\Exception $e){
            $this->logger->error('Failed to fetch rates for Fixer.io', [
                'exception' => $e->getMessage(),
            ]);
            throw $e;
        }

        $fixerData = json_decode($response->getBody()->getContents());
        var_dump($fixerData);
        die;
    }

}