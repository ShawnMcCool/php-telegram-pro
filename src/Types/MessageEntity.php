<?php namespace TelegramPro\Types;

final class MessageEntity
{
    private int $offset;
    private int $length;
    private MessageEntityType $type;
    private ?Url $url;
    private ?User $user;
    private ?ProgrammingLanguage $language;

    public function __construct(
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

    public function offset(): int
    {
        return $this->offset;
    }

    public function length(): int
    {
        return $this->length;
    }

    public function type(): MessageEntityType
    {
        return $this->type;
    }

    public function url(): ?Url
    {
        return $this->url;
    }

    public function user(): ?User
    {
        return $this->user;
    }

    public function language(): ?ProgrammingLanguage
    {
        return $this->language;
    }
    
    public static function arrayFromApi($entities): ArrayOfMessageEntities
    {
        return ArrayOfMessageEntities::fromApi($entities);
    }

    public static function fromApi($entity): MessageEntity
    {
        return new static(
            MessageEntityType::fromString($entity->type),
            $entity->offset,
            $entity->length,
            Url::fromString($entity->url ?? null),
            User::fromApi($entity->user ?? null),
            ProgrammingLanguage::fromString($entity->language ?? null)
        );
    }
}