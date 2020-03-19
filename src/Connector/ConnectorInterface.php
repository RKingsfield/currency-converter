<?php

namespace App\Connector;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;

interface ConnectorInterface
{
    public function __construct(
        Client $client,
        LoggerInterface $logger,
        array $config
    );
    public function getRates();
}