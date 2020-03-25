<?php namespace TelegramPro\Types;

use CURLFile;

interface InputMedia
{
    public function toApi(string $mediaKey): array;
    public function toFile(): ?CURLFile;
}