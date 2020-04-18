<?php

namespace Gietos\Dadata\Model\Factory;

class DateTimeImmutableFactory
{
    public static function create(string $value): \DateTimeImmutable
    {
        return new \DateTimeImmutable($value);
    }
}
