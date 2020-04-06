<?php namespace TelegramPro\Types;

/**
 * Type of chat, can be either “private”, “group”, “supergroup” or “channel”
 */
final class ChatType implements ApiReadType
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
        return new static ($type);
    }

    public function isPrivate(): bool
    {
        return $this->type == 'private';
    }

    public function isGroup(): bool
    {
        return $this->type == 'group';
    }

    public function isSupergroup(): bool
    {
        return $this->type == 'supergroup';
    }

    public function isChannel(): bool
    {
        return $this->type == 'channel';
    }
}