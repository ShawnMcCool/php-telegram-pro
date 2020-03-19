<?php namespace TelegramPro\Types;

final class Chat
***REMOVED***
    private int $chatId;
    private string $type;
    private ?string $title;
    private ?string $username;
    private ?string $firstName;
    private ?string $lastName;
    private ?ChatPhoto $photo;
    private ?string $description;
    private ?string $inviteLink;
    private ?Message $pinnedMessage;
    private ?ChatPermissions $permissions;
    private ?int $slowModeDelay;
    private ?string $stickerSetName;
    private ?bool $canSetStickerSet;

    public function __construct(
        int $chatId,
        string $type,
        ?string $title,
        ?string $username,
        ?string $firstName,
        ?string $lastName,
        ?ChatPhoto $photo,
        ?string $description,
        ?string $inviteLink,
        ?Message $pinnedMessage,
        ?ChatPermissions $permissions,
        ?int $slowModeDelay,
        ?string $stickerSetName,
        ?bool $canSetStickerSet
    ) ***REMOVED***
        $this->chatId = $chatId;
        $this->type = $type;
        $this->title = $title;
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->photo = $photo;
        $this->description = $description;
        $this->inviteLink = $inviteLink;
        $this->pinnedMessage = $pinnedMessage;
        $this->permissions = $permissions;
        $this->slowModeDelay = $slowModeDelay;
        $this->stickerSetName = $stickerSetName;
        $this->canSetStickerSet = $canSetStickerSet;
    ***REMOVED***

    public static function fromApi($chat): ?Chat
    ***REMOVED***
        if ( ! $chat) return null;
        
        return new static(
            $chat->id,
            $chat->type,
            $chat->title ?? null,
            $chat->username ?? null,
            $chat->first_name ?? null,
            $chat->last_name ?? null,
            ChatPhoto::fromApi($chat->photo ?? null),
            $chat->description ?? null,
            $chat->invite_link ?? null,
            Message::fromApi($chat->pinned_message ?? null),
            ChatPermissions::fromApi($chat->permissions ?? null),
            $chat->slow_mode_delay ?? null,
            $chat->sticker_set_name ?? null,
            $chat->can_set_sticker_set ?? null
        );
    ***REMOVED***

    public function chatId(): int
    ***REMOVED***
        return $this->chatId;
    ***REMOVED***

    public function type(): string
    ***REMOVED***
        return $this->type;
    ***REMOVED***

    public function title(): ?string
    ***REMOVED***
        return $this->title;
    ***REMOVED***

    public function username(): ?string
    ***REMOVED***
        return $this->username;
    ***REMOVED***

    public function firstName(): ?string
    ***REMOVED***
        return $this->firstName;
    ***REMOVED***

    public function lastName(): ?string
    ***REMOVED***
        return $this->lastName;
    ***REMOVED***

    public function photo(): ?ChatPhoto
    ***REMOVED***
        return $this->photo;
    ***REMOVED***

    public function description(): ?string
    ***REMOVED***
        return $this->description;
    ***REMOVED***

    public function inviteLink(): ?string
    ***REMOVED***
        return $this->inviteLink;
    ***REMOVED***

    public function pinnedMessage(): ?Message
    ***REMOVED***
        return $this->pinnedMessage;
    ***REMOVED***

    public function permissions(): ?ChatPermissions
    ***REMOVED***
        return $this->permissions;
    ***REMOVED***

    public function slowModeDelay(): ?int
    ***REMOVED***
        return $this->slowModeDelay;
    ***REMOVED***

    public function stickerSetName(): ?string
    ***REMOVED***
        return $this->stickerSetName;
    ***REMOVED***

    public function canSetStickerSet(): ?bool
    ***REMOVED***
        return $this->canSetStickerSet;
    ***REMOVED***
***REMOVED***