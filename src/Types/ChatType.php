<?php namespace TelegramPro\Types;

/**
 * Type of chat, can be either “private”, “group”, “supergroup” or “channel”
 */
final class ChatType extends ApiReadString
{
    public function isPrivate(): bool
    {
        return $this->string == 'private';
    }

    public function isGroup(): bool
    {
        return $this->string == 'group';
    }

    public function isSupergroup(): bool
    {
        return $this->string == 'supergroup';
    }

    public function isChannel(): bool
    {
        return $this->string == 'channel';
    }
}