<?php

namespace App\Connector;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use Psr\Log\LoggerInterface;
use function GuzzleHttp\Psr7\build_query;

class Fixerio implements ConnectorInterface
{
    const URL = 'http://data.fixer.io/api/latest';

    private $config;
    private $client;
    private $logger;

    public function __construct(
        Client $client,
        LoggerInterface $logger,
        array $config
    ) {
        $this->config = $config;
        $this->client = $client;
        $this->logger = $logger;
    }

    public function getRates()
    {
        try {
            $response = $this->client->get(self::URL . '?' . build_query(['access_key' => $this->config['apiKey']]));
        } catch (\Exception $e) {
            $this->logger->error('Failed to fetch rates for Fixer.io', [
                'exception' => $e->getMessage(),
            ]);
            return null;
        }
        $fixerData = json_decode($response->getBody()->getContents(), true);

        return [
            $fixerData['base'] => $fixerData['rates']
        ];
    }

}