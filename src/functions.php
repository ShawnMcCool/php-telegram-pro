<?php

use TelegramPro\Collections\Collection;

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