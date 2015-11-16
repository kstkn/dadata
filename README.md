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

$address = $client->cleanAddress('msk, tverskaya, 1');
echo 'Result: ' . $address->result . PHP_EOL;
```
