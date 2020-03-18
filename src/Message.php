<?php namespace TelegramPro;

class Message
***REMOVED***
    private int $messageId;
    private User $from;
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
        User $from,
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

    public static function fromRequest($message): ?Message
    ***REMOVED***
        if ( ! $message) return null;
        
        return new static(
            $message->message_id,
            User::fromRequest($message->from),
            $message->date,
            Chat::fromRequest($message->chat),
            User::fromRequest($message->forward_from),
            Chat::fromRequest($message->forward_from_chat),
            $message->forward_from_message_id,
            $message->forward_signature,
            $message->forward_sender_name,
            $message->forward_date,
            Message::fromRequest($message->reply_to_message),
            $message->edit_date,
            $message->media_group_id,
            $message->author_signature,
            $message->text,
            MessageEntity::arrayFromRequest($message->entities),
            MessageEntity::arrayFromRequest($message->caption_entities),
            Audio::fromRequest($message->audio),
            Document::fromRequest($message->document),
            Animation::fromRequest($message->animation),
            Game::fromRequest($message->game),
            PhotoSize::arrayFromRequest($message->photo),
            Sticker::fromRequest($message->sticker),
            Video::fromRequest($message->video),
            Voice::fromRequest($message->voice),
            VideoNote::fromRequest($message->video_note),
            $message->caption,
            Contact::fromRequest($message->contact),
            Location::fromRequest($message->location),
            Venue::fromRequest($message->venue),
            Poll::fromRequest($message->poll),
            User::arrayFromRequest($message->new_chat_members),
            User::fromRequest($message->left_chat_member),
            $message->new_chat_title,
            PhotoSize::arrayFromRequest($message->new_chat_photo),
            $message->delete_chat_photo,
            $message->group_chat_created,
            $message->supergroup_chat_created,
            $message->channel_chat_created,
            $message->migrate_to_chat_id,
            $message->migrate_from_chat_id,
            Message::fromRequest($message->pinned_message),
            Invoice::fromRequest($message->invoice),
            SuccessfulPayment::fromRequest($message->successful_payment),
            $message->connected_website,
            PassportData::fromString($message->passport_data),
            InlineKeyboardMarkup::fromRequest($message->reply_markup)
        );
    ***REMOVED***
***REMOVED***