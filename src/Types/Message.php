<?php namespace TelegramPro\Types;

class Message
{
    private int $messageId;
    private ?User $from;
    private int $date;
    private Chat $chat;
    private ?User $forwardFrom;
    private ?Chat $forwardFromChat;
    private ?int $forwardFromMessageId;
    private ?string $forwardSignature;
    private ?string $forwardSenderName;
    private ?int $forwardDate;
    private ?Message $replyToMessage;
    private ?int $editDate;
    private ?string $mediaGroupId;
    private ?string $authorSignature;
    private ?string $text;
    private ?array $entities;
    private ?array $captionEntities;
    private ?Audio $audio;
    private ?Document $document;
    private ?Animation $animation;
    private ?Game $game;
    private ?array $photo;
    private ?Sticker $sticker;
    private ?Video $video;
    private ?Voice $voice;
    private ?VideoNote $videoNote;
    private ?string $caption;
    private ?Contact $contact;
    private ?Location $location;
    private ?Venue $venue;
    private ?Poll $poll;
    private ?array $newChatMembers;
    private ?User $leftChatMember;
    private ?string $newChatTitle;
    private ?array $newChatPhoto;
    private ?bool $deleteChatPhoto;
    private ?bool $groupChatCreated;
    private ?bool $supergroupChatCreated;
    private ?bool $channelChatCreated;
    private ?int $migrateToChatId;
    private ?int $migrateFromChatId;
    private ?Message $pinnedMessage;
    private ?Invoice $invoice;
    private ?SuccessfulPayment $successfulPayment;
    private ?string $connectedWebsite;
    private ?PassportData $passportData;
    private ?InlineKeyboardMarkup $replyMarkup;

    public function __construct(
        int $messageId,
        ?User $from,
        int $date,
        Chat $chat,
        ?User $forwardFrom,
        ?Chat $forwardFromChat,
        ?int $forwardFromMessageId,
        ?string $forwardSignature,
        ?string $forwardSenderName,
        ?int $forwardDate,
        ?Message $replyToMessage,
        ?int $editDate,
        ?string $mediaGroupId,
        ?string $authorSignature,
        ?string $text,
        ?array $entities,
        ?array $captionEntities,
        ?Audio $audio,
        ?Document $document,
        ?Animation $animation,
        ?Game $game,
        ?array $photo, // of PhotoSize
        ?Sticker $sticker,
        ?Video $video,
        ?Voice $voice,
        ?VideoNote $videoNote,
        ?string $caption,
        ?Contact $contact,
        ?Location $location,
        ?Venue $venue,
        ?Poll $poll,
        ?array $newChatMembers, // array of User
        ?User $leftChatMember,
        ?string $newChatTitle,
        ?array $newChatPhoto, // array of PhotoSize
        ?bool $deleteChatPhoto,
        ?bool $groupChatCreated,
        ?bool $supergroupChatCreated,
        ?bool $channelChatCreated,
        ?int $migrateToChatId,
        ?int $migrateFromChatId,
        ?Message $pinnedMessage,
        ?Invoice $invoice,
        ?SuccessfulPayment $successfulPayment,
        ?string $connectedWebsite,
        ?PassportData $passportData,
        ?InlineKeyboardMarkup $replyMarkup
    ) {
        $this->messageId = $messageId;
        $this->from = $from;
        $this->date = $date;
        $this->chat = $chat;
        $this->forwardFrom = $forwardFrom;
        $this->forwardFromChat = $forwardFromChat;
        $this->forwardFromMessageId = $forwardFromMessageId;
        $this->forwardSignature = $forwardSignature;
        $this->forwardSenderName = $forwardSenderName;
        $this->forwardDate = $forwardDate;
        $this->replyToMessage = $replyToMessage;
        $this->editDate = $editDate;
        $this->mediaGroupId = $mediaGroupId;
        $this->authorSignature = $authorSignature;
        $this->text = $text;
        $this->entities = $entities;
        $this->captionEntities = $captionEntities;
        $this->audio = $audio;
        $this->document = $document;
        $this->animation = $animation;
        $this->game = $game;
        $this->photo = $photo;
        $this->sticker = $sticker;
        $this->video = $video;
        $this->voice = $voice;
        $this->videoNote = $videoNote;
        $this->caption = $caption;
        $this->contact = $contact;
        $this->location = $location;
        $this->venue = $venue;
        $this->poll = $poll;
        $this->newChatMembers = $newChatMembers;
        $this->leftChatMember = $leftChatMember;
        $this->newChatTitle = $newChatTitle;
        $this->newChatPhoto = $newChatPhoto;
        $this->deleteChatPhoto = $deleteChatPhoto;
        $this->groupChatCreated = $groupChatCreated;
        $this->supergroupChatCreated = $supergroupChatCreated;
        $this->channelChatCreated = $channelChatCreated;
        $this->migrateToChatId = $migrateToChatId;
        $this->migrateFromChatId = $migrateFromChatId;
        $this->pinnedMessage = $pinnedMessage;
        $this->invoice = $invoice;
        $this->successfulPayment = $successfulPayment;
        $this->connectedWebsite = $connectedWebsite;
        $this->passportData = $passportData;
        $this->replyMarkup = $replyMarkup;
    }

    public static function fromApi($message): ?Message
    {
        if ( ! $message) return null;
        
        return new static(
            $message->message_id,
            User::fromApi($message->from ?? null),
            $message->date,
            Chat::fromApi($message->chat),
            User::fromApi($message->forward_from ?? null),
            Chat::fromApi($message->forward_from_chat ?? null),
            $message->forward_from_message_id ?? null,
            $message->forward_signature ?? null,
            $message->forward_sender_name ?? null,
            $message->forward_date ?? null,
            Message::fromApi($message->reply_to_message ?? null),
            $message->edit_date ?? null,
            $message->media_group_id ?? null,
            $message->author_signature ?? null,
            $message->text ?? null,
            MessageEntity::arrayfromApi($message->entities ?? null),
            MessageEntity::arrayfromApi($message->caption_entities ?? null),
            Audio::fromApi($message->audio ?? null),
            Document::fromApi($message->document ?? null),
            Animation::fromApi($message->animation ?? null),
            Game::fromApi($message->game ?? null),
            PhotoSize::arrayfromApi($message->photo ?? null),
            Sticker::fromApi($message->sticker ?? null),
            Video::fromApi($message->video ?? null),
            Voice::fromApi($message->voice ?? null),
            VideoNote::fromApi($message->video_note ?? null),
            $message->caption ?? null,
            Contact::fromApi($message->contact ?? null),
            Location::fromApi($message->location ?? null),
            Venue::fromApi($message->venue ?? null),
            Poll::fromApi($message->poll ?? null),
            User::arrayfromApi($message->new_chat_members ?? null),
            User::fromApi($message->left_chat_member ?? null),
            $message->new_chat_title ?? null,
            PhotoSize::arrayfromApi($message->new_chat_photo ?? null),
            $message->delete_chat_photo ?? null,
            $message->group_chat_created ?? null,
            $message->supergroup_chat_created ?? null,
            $message->channel_chat_created ?? null,
            $message->migrate_to_chat_id ?? null,
            $message->migrate_from_chat_id ?? null,
            Message::fromApi($message->pinned_message ?? null),
            Invoice::fromApi($message->invoice ?? null),
            SuccessfulPayment::fromApi($message->successful_payment ?? null),
            $message->connected_website ?? null,
            PassportData::fromString($message->passport_data ?? null),
            InlineKeyboardMarkup::fromApi($message->reply_markup ?? null)
        );
    }

    public function messageId(): int
    {
        return $this->messageId;
    }

    public function from(): User
    {
        return $this->from;
    }

    public function date(): int
    {
        return $this->date;
    }

    public function chat(): Chat
    {
        return $this->chat;
    }

    public function forwardFrom(): ?User
    {
        return $this->forwardFrom;
    }

    public function forwardFromChat(): ?Chat
    {
        return $this->forwardFromChat;
    }

    public function forwardFromMessageId(): ?int
    {
        return $this->forwardFromMessageId;
    }

    public function forwardSignature(): ?string
    {
        return $this->forwardSignature;
    }

    public function forwardSenderName(): ?string
    {
        return $this->forwardSenderName;
    }

    public function forwardDate(): ?int
    {
        return $this->forwardDate;
    }

    public function replyToMessage(): ?Message
    {
        return $this->replyToMessage;
    }

    public function editDate(): ?int
    {
        return $this->editDate;
    }

    public function mediaGroupId(): ?string
    {
        return $this->mediaGroupId;
    }

    public function authorSignature(): ?string
    {
        return $this->authorSignature;
    }

    public function text(): ?string
    {
        return $this->text;
    }

    public function entities(): ?array
    {
        return $this->entities;
    }

    public function captionEntities(): ?array
    {
        return $this->captionEntities;
    }

    public function audio(): ?Audio
    {
        return $this->audio;
    }

    public function document(): ?Document
    {
        return $this->document;
    }

    public function animation(): ?Animation
    {
        return $this->animation;
    }

    public function game(): ?Game
    {
        return $this->game;
    }

    public function photo(): ?array
    {
        return $this->photo;
    }

    public function sticker(): ?Sticker
    {
        return $this->sticker;
    }

    public function video(): ?Video
    {
        return $this->video;
    }

    public function voice(): ?Voice
    {
        return $this->voice;
    }

    public function videoNote(): ?VideoNote
    {
        return $this->videoNote;
    }

    public function caption(): ?string
    {
        return $this->caption;
    }

    public function contact(): ?Contact
    {
        return $this->contact;
    }

    public function location(): ?Location
    {
        return $this->location;
    }

    public function venue(): ?Venue
    {
        return $this->venue;
    }

    public function poll(): ?Poll
    {
        return $this->poll;
    }

    public function newChatMembers(): ?array
    {
        return $this->newChatMembers;
    }

    public function leftChatMember(): ?User
    {
        return $this->leftChatMember;
    }

    public function newChatTitle(): ?string
    {
        return $this->newChatTitle;
    }

    public function newChatPhoto(): ?array
    {
        return $this->newChatPhoto;
    }

    public function deleteChatPhoto(): ?bool
    {
        return $this->deleteChatPhoto;
    }

    public function groupChatCreated(): ?bool
    {
        return $this->groupChatCreated;
    }

    public function supergroupChatCreated(): ?bool
    {
        return $this->supergroupChatCreated;
    }

    public function channelChatCreated(): ?bool
    {
        return $this->channelChatCreated;
    }

    public function migrateToChatId(): ?int
    {
        return $this->migrateToChatId;
    }

    public function migrateFromChatId(): ?int
    {
        return $this->migrateFromChatId;
    }

    public function pinnedMessage(): ?Message
    {
        return $this->pinnedMessage;
    }

    public function invoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function successfulPayment(): ?SuccessfulPayment
    {
        return $this->successfulPayment;
    }

    public function connectedWebsite(): ?string
    {
        return $this->connectedWebsite;
    }

    public function passportData(): ?PassportData
    {
        return $this->passportData;
    }

    public function replyMarkup(): ?InlineKeyboardMarkup
    {
        return $this->replyMarkup;
    }
}