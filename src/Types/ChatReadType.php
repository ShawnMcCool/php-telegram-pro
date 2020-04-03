<?php namespace TelegramPro\Types;

/**
 * Type of chat, can be either “private”, “group”, “supergroup” or “channel”
 */
final class ChatReadType implements ApiReadType
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

    /**
     * @inheritDoc
     */
    public static function fromApi($type): ?self
    {
        if ( ! in_array($type, ['private', 'group', 'supergroup', 'channel'])) {
            throw new ChatTypeNotSupported($type);
        }

        return new static ($type);
    }

    public static function private(): ChatReadType
    {
        return new static('private');
    }

    public static function group(): ChatReadType
    {
        return new static('group');
    }

    public static function supergroup(): ChatReadType
    {
        return new static('supergroup');
    }

    public static function channel(): ChatReadType
    {
        return new static('channel');
    }
}