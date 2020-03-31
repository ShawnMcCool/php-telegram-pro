<?php namespace TelegramPro\Types;

/**
 * Type of chat, can be either “private”, “group”, “supergroup” or “channel”
 */
final class ChatType
{
    private string $type;

    private function __construct(string $type)
    {
        $this->type = $type;
    }

    public function __toString()
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return $this->type;
    }

    public static function fromString(string $type)
    {
        if ( ! in_array($type, ['private', 'group', 'supergroup', 'channel'])) {
            throw new ChatTypeNotSupported($type);
        }

        return new static ($type);
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