Dadata API client
=================

A PHP library for the DaData.ru REST API

[![Latest Stable Version](https://poser.pugx.org/gietos/dadata/version)](https://packagist.org/packages/gietos/dadata)
[![Total Downloads](https://poser.pugx.org/gietos/dadata/downloads)](https://packagist.org/packages/gietos/dadata)
[![License](https://poser.pugx.org/gietos/dadata/license)](https://packagist.org/packages/gietos/dadata)

[API documentation](https://dadata.ru/api/clean/)

## Installation

The suggested installation method is via [composer](https://getcomposer.org/):

```sh
composer require gietos/dadata
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
```
