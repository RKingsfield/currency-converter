# Currency Converter

A basic currency converter.

## Getting Started

To get started, simply pull this repo and run `composer install` to get it up and running. Then you can run commands to get things up and running.

You'll also need to ensure that you have a valid API key for Fixer.io and add that to the `.env` file with the key `FIXER_IO_KEY`.

## Running the tests

To run the unit tests for this, simple run `./bin/phpunit` from the console.

## Usage

To convert a currency, first ensure that you have the latest conversion rates by running the command `./bin/console update:rates` in the console. By default, this queries Fixer.io for the latest rates, but additional connectors could be created to connect to any service to provide these rates.

Once you have rates, to perform a conversion, simple run the following command in the console:
 
`./bin/console convert -b <BaseCurrency> -c <Value> -t <TargetCurrency> -vvv`

and you'll receive a response like this:

`INFO      [app] 5 EUR converts to 5.335185 USD`


## Todo

- Find a better way to display result from conversion
- Auto-update the rates if not already found / out of date
- More comprehensive code coverage
- Containerise project
- Create an endpoint so that conversion can be called from the browser
