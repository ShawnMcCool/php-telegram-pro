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

    public function isCreator(): bool
    {
        return $this->type == 'creator';
    }

    public function isAdministrator(): bool
    {
        return $this->type == 'administrator';
    }

    public function isMember(): bool
    {
        return $this->type == 'member';
    }

    public function isRestricted(): bool
    {
        return $this->type == 'restricted';
    }

    public function isLeft(): bool
    {
        return $this->type == 'left';
    }

    public function isKicked(): bool
    {
        return $this->type == 'kicked';
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($type): ?self
    {
        if (is_null($type)) {
            return null;
        }

        return new static ($type);
    }

}