<?php namespace TelegramPro\Types;

/**
 * The member's status in the chat. Can be “creator”, “administrator”, “member”, “restricted”, “left” or “kicked”
 */
final class ChatMemberStatus implements ApiReadType
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
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($type): ?self
    {
        if (is_null($type)) {
            return null;
        }
        
        if ( ! in_array($type, ['creator', 'administrator', 'member', 'restricted', 'left', 'kicked'])) {
            throw new ChatTypeNotSupported($type);
        }

        return new static ($type);
    }
}