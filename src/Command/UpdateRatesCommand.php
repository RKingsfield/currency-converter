<?php

namespace App\Command;

use App\Connector\ConnectorInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateRatesCommand extends Command
{
    protected static $defaultName = 'update:rates';

    private $connector;
    private $logger;

    public function __construct(
        ConnectorInterface $connector,
        LoggerInterface $logger
    ) {
        parent::__construct();
        $this->connector = $connector;
        $this->logger = $logger;
    }

    protected function configure()
    {
        $this->setDescription('Get most recent exchanges rates and update the local storage');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $newRates = $this->connector->getRates();

        if ($newRates) {
            $this->logger->info('Updates Rates', [
                'rates' => $newRates
            ]);
            file_put_contents('rates.json', json_encode($newRates));
        }

        return 1;
    }

}