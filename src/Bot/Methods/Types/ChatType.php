<?php namespace TelegramPro\Bot\Methods\Types;

/**
 * Type of chat, can be either “private”, “group”, “supergroup” or “channel”
 */
final class ChatType implements ApiWriteType
{
    private string $type;

    private function __construct(string $type)
    {
        $this->type = $type;
    }

    public function toApi(): string
    {
        return $this->type;
    }

    public static function private(): ChatType
    {
        return new static('private');
    }

    public static function group(): ChatType
    {
        return new static('group');
    }

    public static function supergroup(): ChatType
    {
        return new static('supergroup');
    }

    public static function channel(): ChatType
    {
        return new static('channel');
    }
}