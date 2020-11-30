<?php namespace TelegramPro\Bot\Methods\Types;

/**
 * Type of the entity. Can be “mention” (@username), “hashtag” (#hashtag), “cashtag” ($USD), “bot_command” (/start@jobs_bot), “url” (https://telegram.org), “email” (do-not-reply@telegram.org), “phone_number” (+1-212-555-0123), “bold” (bold text), “italic” (italic text), “underline” (underlined text), “strikethrough” (strikethrough text), “code” (monowidth string), “pre” (monowidth block), “text_link” (for clickable text URLs), “text_mention” (for users without usernames)
 */
final class MessageEntityType implements ApiReadType
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

    public static function fromApi($type): ?static
    {
        $validTypes = [
            'mention', 'hashtag', 'cashtag', 'bot_command', 'url', 'email', 'phone_number', 'bold',
            'italic', 'underline', 'strikethrough', 'code', 'pre', 'text_link', 'text_mention',
        ];

        if ( ! is_string($type) || ! in_array($type, $validTypes)) {
            throw new MessageEntityTypeNotSupported($type);
        }

        return new static($type);
    }
}