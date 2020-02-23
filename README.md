Dadata API client
=================

Non-official PHP library for the DaData.ru REST API

[![Latest Stable Version](https://poser.pugx.org/kstkn/dadata/version)](https://packagist.org/packages/kstkn/dadata)
[![Total Downloads](https://poser.pugx.org/kstkn/dadata/downloads)](https://packagist.org/packages/kstkn/dadata)
[![License](https://poser.pugx.org/kstkn/dadata/license)](https://packagist.org/packages/kstkn/dadata)

[API documentation](https://dadata.ru/api/clean/)

## Installation

The suggested installation method is via [composer](https://getcomposer.org/):

```sh
composer require kstkn/dadata
```

## Usage

``` php
$client = new Dadata\Client(new \GuzzleHttp\Client(), [
    'token' => '...',
    'secret' => '...',
]);
```

### Clean

``` php
$response = $client->cleanAddress('мск сухонска 11/-89');
$response = $client->cleanPhone('тел 7165219 доб139');
$response = $client->cleanPassport('4509 235857');
$response = $client->cleanName('Срегей владимерович иванов');
$response = $client->cleanEmail('serega@yandex/ru');
$response = $client->cleanDate('24/3/12');
$response = $client->cleanVehicle('форд фокус')
```
