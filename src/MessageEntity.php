<?php namespace TelegramPro;

final class MessageEntity
***REMOVED***
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
    ) ***REMOVED***
        $this->offset = $offset;
        $this->length = $length;
        $this->type = $type;
        $this->url = $url;
        $this->user = $user;
        $this->language = $language;
    ***REMOVED***

    public function offset(): int
    ***REMOVED***
        return $this->offset;
    ***REMOVED***

    public function length(): int
    ***REMOVED***
        return $this->length;
    ***REMOVED***

    public function type(): string
    ***REMOVED***
        return $this->type;
    ***REMOVED***

    public function url(): ?string
    ***REMOVED***
        return $this->url;
    ***REMOVED***

    public function user(): ?User
    ***REMOVED***
        return $this->user;
    ***REMOVED***

    public function language(): ?string
    ***REMOVED***
        return $this->language;
    ***REMOVED***
    
    public static function arrayFromRequest(?array $entities): ?array
    ***REMOVED***
        if ( ! $entities) return null;

        $entityArray = [];

        foreach ($entities as $entity) ***REMOVED***
            $entityArray[] = MessageEntity::fromRequest($entity);
        ***REMOVED***

        return $entityArray;
    ***REMOVED***

    private static function fromRequest($entity): MessageEntity
    ***REMOVED***
        return new static(
            $entity->type,
            $entity->offset,
            $entity->length,
            $entity->url ?? null,
            User::fromRequest($entity->user ?? null),
            $entity->language ?? null
        );
    ***REMOVED***
***REMOVED***