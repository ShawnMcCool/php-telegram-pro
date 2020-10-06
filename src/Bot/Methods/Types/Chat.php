<?php namespace TelegramPro\Bot\Methods\Types;
use TelegramPro\Bot\Types\ChatType;
use TelegramPro\Bot\Types\ChatPhoto;
use TelegramPro\Bot\Types\ChatPermissions;

/**
 * This object represents a chat.
 * https://core.telegram.org/bots/api#chat
 */
final class Chat implements ApiReadType
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

    private function __construct(
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

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($chat): ?Chat
    {
        if ( ! $chat) return null;
        
        return new static(
            ChatId::fromInt($chat->id),
            ChatType::fromApi($chat->type),
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

    /**
     * Unique identifier for this chat. This number may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
     */
    public function chatId(): ChatId
    {
        return $this->chatId;
    }

    /**
     * Type of chat, can be either “private”, “group”, “supergroup” or “channel”
     */
    public function type(): ChatType
    {
        return $this->type;
    }

    /**
     * Optional. Title, for supergroups, channels and group chats
     */
    public function title(): ?string
    {
        return $this->title;
    }

    /**
     * Optional. Username, for private chats, supergroups and channels if available
     */
    public function username(): ?string
    {
        return $this->username;
    }

    /**
     * Optional. First name of the other party in a private chat
     */
    public function firstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * Optional. Last name of the other party in a private chat
     */
    public function lastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * Optional. Chat photo. Returned only in getChat.
     */
    public function photo(): ?ChatPhoto
    {
        return $this->photo;
    }

    /**
     * Optional. Description, for groups, supergroups and channel chats. Returned only in getChat.
     */
    public function description(): ?string
    {
        return $this->description;
    }

    /**
     * Optional. Chat invite link, for groups, supergroups and channel chats. Each administrator in a chat generates their own invite links, so the bot must first generate the link using exportChatInviteLink. Returned only in getChat.
     */
    public function inviteLink(): ?Url
    {
        return $this->inviteLink;
    }

    /**
     * Optional. Pinned message, for groups, supergroups and channels. Returned only in getChat.
     */
    public function pinnedMessage(): ?Message
    {
        return $this->pinnedMessage;
    }

    /**
     * Optional. Default chat member permissions, for groups and supergroups. Returned only in getChat.
     */
    public function permissions(): ?ChatPermissions
    {
        return $this->permissions;
    }

    /**
     * Optional. For supergroups, the minimum allowed delay between consecutive messages sent by each unpriviledged user. Returned only in getChat.
     */
    public function slowModeDelay(): ?int
    {
        return $this->slowModeDelay;
    }

    /**
     * Optional. For supergroups, name of group sticker set. Returned only in getChat.
     */
    public function stickerSetName(): ?string
    {
        return $this->stickerSetName;
    }

    /**
     * Optional. True, if the bot can change the group sticker set. Returned only in getChat.
     */
    public function canSetStickerSet(): ?bool
    {
        return $this->canSetStickerSet;
    }
}