<?php namespace TelegramPro\Types;

final class Chat
{
    private ChatId $chatId;
    private ChatType $type;
    private ?string $title;
    private ?string $username;
    private ?string $firstName;
    private ?string $lastName;
    private ?ChatPhoto $photo;
    private ?string $description;
    private ?Url $inviteLink;
    private ?Message $pinnedMessage;
    private ?ChatPermissions $permissions;
    private ?int $slowModeDelay;
    private ?string $stickerSetName;
    private ?bool $canSetStickerSet;

    public function __construct(
        ChatId $chatId,
        ChatType $type,
        ?string $title,
        ?string $username,
        ?string $firstName,
        ?string $lastName,
        ?ChatPhoto $photo,
        ?string $description,
        ?Url $inviteLink,
        ?Message $pinnedMessage,
        ?ChatPermissions $permissions,
        ?int $slowModeDelay,
        ?string $stickerSetName,
        ?bool $canSetStickerSet
    ) {
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
    }

    public static function fromApi($chat): ?Chat
    {
        if ( ! $chat) return null;
        
        return new static(
            ChatId::fromInt($chat->id),
            ChatType::fromString($chat->type),
            $chat->title ?? null,
            $chat->username ?? null,
            $chat->first_name ?? null,
            $chat->last_name ?? null,
            ChatPhoto::fromApi($chat->photo ?? null),
            $chat->description ?? null,
            Url::fromString($chat->invite_link ?? null),
            Message::fromApi($chat->pinned_message ?? null),
            ChatPermissions::fromApi($chat->permissions ?? null),
            $chat->slow_mode_delay ?? null,
            $chat->sticker_set_name ?? null,
            $chat->can_set_sticker_set ?? null
        );
    }

    public function chatId(): ChatId
    {
        return $this->chatId;
    }

    public function type(): ChatType
    {
        return $this->type;
    }

    public function title(): ?string
    {
        return $this->title;
    }

    public function username(): ?string
    {
        return $this->username;
    }

    public function firstName(): ?string
    {
        return $this->firstName;
    }

    public function lastName(): ?string
    {
        return $this->lastName;
    }

    public function photo(): ?ChatPhoto
    {
        return $this->photo;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function inviteLink(): ?Url
    {
        return $this->inviteLink;
    }

    public function pinnedMessage(): ?Message
    {
        return $this->pinnedMessage;
    }

    public function permissions(): ?ChatPermissions
    {
        return $this->permissions;
    }

    public function slowModeDelay(): ?int
    {
        return $this->slowModeDelay;
    }

    public function stickerSetName(): ?string
    {
        return $this->stickerSetName;
    }

    public function canSetStickerSet(): ?bool
    {
        return $this->canSetStickerSet;
    }
}