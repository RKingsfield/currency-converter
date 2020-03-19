<?php

namespace App\Command;

use App\Connector\ConnectorInterface;
use App\Converter\CurrencyConverter;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\{InputInterface, InputOption};
use Symfony\Component\Console\Output\OutputInterface;

class ConvertCommand extends Command
{
    protected static $defaultName = 'convert';

    private $logger;

    public function __construct(
        LoggerInterface $logger
    )
    {
        parent::__construct();
        $this->logger = $logger;
    }

    protected function configure()
    {
        $this->setDescription('converts a value from one currency to another')
            ->addOption(
                'baseCurrency',
                'b',
                InputOption::VALUE_REQUIRED,
                'Currency to convert from'
            )->addOption(
                'targetCurrency',
                't',
                InputOption::VALUE_REQUIRED,
                'Currency to convert to'
            )->addOption(
                'value',
                'c',
                InputOption::VALUE_REQUIRED,
                'value to convert'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $loadedRates = json_decode(file_get_contents('rates.json'), true);
        $currencyConverter = new CurrencyConverter($loadedRates);
        $base = $input->getOption('baseCurrency');
        $value = $input->getOption('value');
        $target = $input->getOption('targetCurrency');
        $convertedValue = $currencyConverter->convert(
            $base, $value, $target
        );

        $this->logger->info("$value $base converts to $convertedValue $target");

        return 1;
    }

}
