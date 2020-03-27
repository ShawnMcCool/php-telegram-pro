<?php

function bytesToMegabytes(int $bytes): int
{
    return $bytes / 1000000;
}

function collect(?array $items): TelegramPro\Collections\Collection {
    return new TelegramPro\Collections\Collection($items ?? []);
}