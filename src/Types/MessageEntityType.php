<?php namespace TelegramPro\Types;

final class MessageEntityType
{
    private string $type;

    private function __construct(string $type)
    {
        $this->type = $type;
    }

    public function toString(): string
    {
        return $this->type;
    }

    public function __toString()
    {
        return $this->toString();
    }

    public static function fromString(string $type): ?self
    {
        $validTypes = [
            'mention', 'hashtag', 'cashtag', 'bot_command', 'url', 'email', 'phone_number', 'bold',
            'italic', 'underline', 'strikethrough', 'code', 'pre', 'text_link', 'text_mention',
        ];

        if ( ! in_array($type, $validTypes)) {
            throw new MessageEntityTypeNotSupported($type);
        }

        return new static($type);
    }
}