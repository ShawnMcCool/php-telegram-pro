<?php namespace TelegramPro;

final class Chat
***REMOVED***
    private int $chatId;
    private ChatType $type;
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
        ChatType $type,
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

    public static function fromRequest($chat): ?Chat
    ***REMOVED***
        if ( ! $chat) return null;
        
        return new static(
            $chat->id,
            $chat->type,
            $chat->title,
            $chat->username,
            $chat->first_name,
            $chat->last_name,
            ChatPhoto::fromRequest($chat->photo),
            $chat->description,
            $chat->invite_link,
            Message::fromRequest($chat->pinned_message),
            ChatPermissions::fromRequest($chat->permissions),
            $chat->slow_mode_delay,
            $chat->sticker_set_name,
            $chat->can_set_sticker_set
        );
    ***REMOVED***
***REMOVED***