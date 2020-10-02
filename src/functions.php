<?php

use TelegramPro\Collections\Collection;
use TelegramPro\Bot\Methods\Types\ApiWriteType;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;

function bytesToMegabytes(int $bytes): int
{
    return $bytes / 1000000;
}

function bytesToKilobytes(int $bytes): int
{
    return $bytes / 1000;
}

function collect($items): Collection
{
    if (is_null($items)) {
        return Collection::empty();
    }

    if ( ! is_array($items)) {
        $items = [$items];
    }
    return new Collection($items);
}

function optional($type)
{
    if (is_null($type)) {
        return null;
    }
    
    if ($type instanceof ApiWriteType) {
        return $type->toApi();
    } elseif($type instanceof ReplyMarkup) {
        return $type->toParameter();
    }
    
    return $type;
}