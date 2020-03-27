<?php namespace TelegramPro\Types;

use IteratorAggregate;

final class MessageEntity
{
    private int $offset;
    private int $length;
    private string $type;
    private ?string $url;
    private ?User $user;
    private ?string $language;

    public function __construct(
        string $type,
        int $offset,
        int $length,
        ?string $url,
        ?User $user,
        ?string $language
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

    public function type(): string
    {
        return $this->type;
    }

    public function url(): ?string
    {
        return $this->url;
    }

    public function user(): ?User
    {
        return $this->user;
    }

    public function language(): ?string
    {
        return $this->language;
    }
    
    public static function arrayFromApi(?IteratorAggregate $entities): ArrayOfMessageEntities
    {
        return ArrayOfMessageEntities::fromApi($entities);
    }

    public static function fromApi($entity): MessageEntity
    {
        return new static(
            $entity->type,
            $entity->offset,
            $entity->length,
            $entity->url ?? null,
            User::fromApi($entity->user ?? null),
            $entity->language ?? null
        );
    }
}