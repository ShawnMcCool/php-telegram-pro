<?php namespace TelegramPro\Bot\Types;

/**
 * Type of the entity. Can be “mention” (@username), “hashtag” (#hashtag), “cashtag” ($USD), “bot_command” (/start@jobs_bot), “url” (https://telegram.org), “email” (do-not-reply@telegram.org), “phone_number” (+1-212-555-0123), “bold” (bold text), “italic” (italic text), “underline” (underlined text), “strikethrough” (strikethrough text), “code” (monowidth string), “pre” (monowidth block), “text_link” (for clickable text URLs), “text_mention” (for users without usernames)
 */
final class MessageEntityType extends \TelegramPro\PrimitiveTypes\StringObject
{
    public function isMention(): bool
    {
        return $this->string == 'mention';
    }

    public function isHashtag(): bool
    {
        return $this->string == 'hashtag';
    }

    public function isCashtag(): bool
    {
        return $this->string == 'cashtag';
    }

    public function isBotCommand(): bool
    {
        return $this->string == 'bot_command';
    }

    public function isurl(): bool
    {
        return $this->string == 'url';
    }

    public function isEmail(): bool
    {
        return $this->string == 'email';
    }

    public function isPhoneNumber(): bool
    {
        return $this->string == 'phone_number';
    }

    public function isBold(): bool
    {
        return $this->string == 'bold';
    }

    public function isItalic(): bool
    {
        return $this->string == 'italic';
    }

    public function isUnderline(): bool
    {
        return $this->string == 'underline';
    }

    public function isStrikethrough(): bool
    {
        return $this->string == 'strikethrough';
    }

    public function isCode(): bool
    {
        return $this->string == 'code';
    }

    public function isPre(): bool
    {
        return $this->string == 'pre';
    }

    public function isTextLink(): bool
    {
        return $this->string == 'text_link';
    }

    public function isTextMention(): bool
    {
        return $this->string == 'text_mention';
    }

    public static function fromApi($type): ?static
    {
        return new static($type);
    }

}