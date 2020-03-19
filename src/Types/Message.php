<?php namespace TelegramPro\Types;

class Message
***REMOVED***
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
    ) ***REMOVED***
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
    ***REMOVED***

    public static function fromApi($message): ?Message
    ***REMOVED***
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
    ***REMOVED***

    public function messageId(): int
    ***REMOVED***
        return $this->messageId;
    ***REMOVED***

    public function from(): User
    ***REMOVED***
        return $this->from;
    ***REMOVED***

    public function date(): int
    ***REMOVED***
        return $this->date;
    ***REMOVED***

    public function chat(): Chat
    ***REMOVED***
        return $this->chat;
    ***REMOVED***

    public function forwardFrom(): ?User
    ***REMOVED***
        return $this->forwardFrom;
    ***REMOVED***

    public function forwardFromChat(): ?Chat
    ***REMOVED***
        return $this->forwardFromChat;
    ***REMOVED***

    public function forwardFromMessageId(): ?int
    ***REMOVED***
        return $this->forwardFromMessageId;
    ***REMOVED***

    public function forwardSignature(): ?string
    ***REMOVED***
        return $this->forwardSignature;
    ***REMOVED***

    public function forwardSenderName(): ?string
    ***REMOVED***
        return $this->forwardSenderName;
    ***REMOVED***

    public function forwardDate(): ?int
    ***REMOVED***
        return $this->forwardDate;
    ***REMOVED***

    public function replyToMessage(): ?Message
    ***REMOVED***
        return $this->replyToMessage;
    ***REMOVED***

    public function editDate(): ?int
    ***REMOVED***
        return $this->editDate;
    ***REMOVED***

    public function mediaGroupId(): ?string
    ***REMOVED***
        return $this->mediaGroupId;
    ***REMOVED***

    public function authorSignature(): ?string
    ***REMOVED***
        return $this->authorSignature;
    ***REMOVED***

    public function text(): ?string
    ***REMOVED***
        return $this->text;
    ***REMOVED***

    public function entities(): ?array
    ***REMOVED***
        return $this->entities;
    ***REMOVED***

    public function captionEntities(): ?array
    ***REMOVED***
        return $this->captionEntities;
    ***REMOVED***

    public function audio(): ?Audio
    ***REMOVED***
        return $this->audio;
    ***REMOVED***

    public function document(): ?Document
    ***REMOVED***
        return $this->document;
    ***REMOVED***

    public function animation(): ?Animation
    ***REMOVED***
        return $this->animation;
    ***REMOVED***

    public function game(): ?Game
    ***REMOVED***
        return $this->game;
    ***REMOVED***

    public function photo(): ?array
    ***REMOVED***
        return $this->photo;
    ***REMOVED***

    public function sticker(): ?Sticker
    ***REMOVED***
        return $this->sticker;
    ***REMOVED***

    public function video(): ?Video
    ***REMOVED***
        return $this->video;
    ***REMOVED***

    public function voice(): ?Voice
    ***REMOVED***
        return $this->voice;
    ***REMOVED***

    public function videoNote(): ?VideoNote
    ***REMOVED***
        return $this->videoNote;
    ***REMOVED***

    public function caption(): ?string
    ***REMOVED***
        return $this->caption;
    ***REMOVED***

    public function contact(): ?Contact
    ***REMOVED***
        return $this->contact;
    ***REMOVED***

    public function location(): ?Location
    ***REMOVED***
        return $this->location;
    ***REMOVED***

    public function venue(): ?Venue
    ***REMOVED***
        return $this->venue;
    ***REMOVED***

    public function poll(): ?Poll
    ***REMOVED***
        return $this->poll;
    ***REMOVED***

    public function newChatMembers(): ?array
    ***REMOVED***
        return $this->newChatMembers;
    ***REMOVED***

    public function leftChatMember(): ?User
    ***REMOVED***
        return $this->leftChatMember;
    ***REMOVED***

    public function newChatTitle(): ?string
    ***REMOVED***
        return $this->newChatTitle;
    ***REMOVED***

    public function newChatPhoto(): ?array
    ***REMOVED***
        return $this->newChatPhoto;
    ***REMOVED***

    public function deleteChatPhoto(): ?bool
    ***REMOVED***
        return $this->deleteChatPhoto;
    ***REMOVED***

    public function groupChatCreated(): ?bool
    ***REMOVED***
        return $this->groupChatCreated;
    ***REMOVED***

    public function supergroupChatCreated(): ?bool
    ***REMOVED***
        return $this->supergroupChatCreated;
    ***REMOVED***

    public function channelChatCreated(): ?bool
    ***REMOVED***
        return $this->channelChatCreated;
    ***REMOVED***

    public function migrateToChatId(): ?int
    ***REMOVED***
        return $this->migrateToChatId;
    ***REMOVED***

    public function migrateFromChatId(): ?int
    ***REMOVED***
        return $this->migrateFromChatId;
    ***REMOVED***

    public function pinnedMessage(): ?Message
    ***REMOVED***
        return $this->pinnedMessage;
    ***REMOVED***

    public function invoice(): ?Invoice
    ***REMOVED***
        return $this->invoice;
    ***REMOVED***

    public function successfulPayment(): ?SuccessfulPayment
    ***REMOVED***
        return $this->successfulPayment;
    ***REMOVED***

    public function connectedWebsite(): ?string
    ***REMOVED***
        return $this->connectedWebsite;
    ***REMOVED***

    public function passportData(): ?PassportData
    ***REMOVED***
        return $this->passportData;
    ***REMOVED***

    public function replyMarkup(): ?InlineKeyboardMarkup
    ***REMOVED***
        return $this->replyMarkup;
    ***REMOVED***
***REMOVED***