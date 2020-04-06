<?php namespace TelegramPro\Types;

/**
 * This object represents one special entity in a text message. For example, hashtags, usernames, URLs, etc.
 */
final class MessageEntity implements ApiReadType
{
    private int $offset;
    private int $length;
    private MessageEntityType $type;
    private ?Url $url;
    private ?User $user;
    private ?ProgrammingLanguage $language;

    private function __construct(
        MessageEntityType $type,
        int $offset,
        int $length,
        ?Url $url,
        ?User $user,
        ?ProgrammingLanguage $language
    ) {
        $this->offset = $offset;
        $this->length = $length;
        $this->type = $type;
        $this->url = $url;
        $this->user = $user;
        $this->language = $language;
    }

    /**
     * Offset in UTF-16 code units to the start of the entity
     */
    public function offset(): int
    {
        return $this->offset;
    }

    /**
     * Length of the entity in UTF-16 code units
     */
    public function length(): int
    {
        return $this->length;
    }

    /**
     * Type of the entity. Can be “mention” (@username), “hashtag” (#hashtag), “cashtag” ($USD), “bot_command” (/start@jobs_bot), “url” (https://telegram.org), “email” (do-not-reply@telegram.org), “phone_number” (+1-212-555-0123), “bold” (bold text), “italic” (italic text), “underline” (underlined text), “strikethrough” (strikethrough text), “code” (monowidth string), “pre” (monowidth block), “text_link” (for clickable text URLs), “text_mention” (for users without usernames)
     */
    public function type(): MessageEntityType
    {
        return $this->type;
    }

    /**
     * Optional. For “text_link” only, url that will be opened after user taps on the text
     */
    public function url(): ?Url
    {
        return $this->url;
    }

    /**
     * Optional. For “text_mention” only, the mentioned user
     */
    public function user(): ?User
    {
        return $this->user;
    }

    /**
     * Optional. For “pre” only, the programming language of the entity text
     */
    public function language(): ?ProgrammingLanguage
    {
        return $this->language;
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($entity): MessageEntity
    {
        return new static(
            MessageEntityType::fromApi($entity->type),
            $entity->offset,
            $entity->length,
            Url::fromString($entity->url ?? null),
            User::fromApi($entity->user ?? null),
            ProgrammingLanguage::fromApi($entity->language ?? null)
        );
    }
}