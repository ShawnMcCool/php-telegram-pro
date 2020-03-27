<?php namespace TelegramPro\Types;

class Message
{
    private MessageId $messageId;
    private ?User $from;
    private Date $date;
    private Chat $chat;
    private ?User $forwardFrom;
    private ?Chat $forwardFromChat;
    private ?MessageId $forwardFromMessageId;
    private ?string $forwardSignature;
    private ?string $forwardSenderName;
    private ?Date $forwardDate;
    private ?Message $replyToMessage;
    private ?Date $editDate;
    private ?string $mediaGroupId;
    private ?string $authorSignature;
    private ?string $text;
    private ArrayOfMessageEntities $entities;
    private ArrayOfMessageEntities $captionEntities;
    private ?Audio $audio;
    private ?Document $document;
    private ?Animation $animation;
    private ?Game $game;
    private ArrayOfPhotoSizes $photo;
    private ?Sticker $sticker;
    private ?Video $video;
    private ?Voice $voice;
    private ?VideoNote $videoNote;
    private ?string $caption;
    private ?Contact $contact;
    private ?Location $location;
    private ?Venue $venue;
    private ?Poll $poll;
    private ArrayOfUsers $newChatMembers;
    private ?User $leftChatMember;
    private ?string $newChatTitle;
    private ArrayOfPhotoSizes $newChatPhoto;
    private ?bool $deleteChatPhoto;
    private ?bool $groupChatCreated;
    private ?bool $supergroupChatCreated;
    private ?bool $channelChatCreated;
    private ?ChatId $migrateToChatId;
    private ?ChatId $migrateFromChatId;
    private ?Message $pinnedMessage;
    private ?Invoice $invoice;
    private ?SuccessfulPayment $successfulPayment;
    private ?string $connectedWebsite;
    private ?PassportData $passportData;
    private ?InlineKeyboardMarkup $replyMarkup;

    public function __construct(
        MessageId $messageId,
        ?User $from,
        Date $date,
        Chat $chat,
        ?User $forwardFrom,
        ?Chat $forwardFromChat,
        ?MessageId $forwardFromMessageId,
        ?string $forwardSignature,
        ?string $forwardSenderName,
        ?Date $forwardDate,
        ?Message $replyToMessage,
        ?Date $editDate,
        ?string $mediaGroupId,
        ?string $authorSignature,
        ?string $text,
        ArrayOfMessageEntities $entities,
        ArrayOfMessageEntities $captionEntities,
        ?Audio $audio,
        ?Document $document,
        ?Animation $animation,
        ?Game $game,
        ArrayOfPhotoSizes $photo,
        ?Sticker $sticker,
        ?Video $video,
        ?Voice $voice,
        ?VideoNote $videoNote,
        ?string $caption,
        ?Contact $contact,
        ?Location $location,
        ?Venue $venue,
        ?Poll $poll,
        ArrayOfUsers $newChatMembers,
        ?User $leftChatMember,
        ?string $newChatTitle,
        ArrayOfPhotoSizes $newChatPhoto,
        ?bool $deleteChatPhoto,
        ?bool $groupChatCreated,
        ?bool $supergroupChatCreated,
        ?bool $channelChatCreated,
        ?ChatId $migrateToChatId,
        ?ChatId $migrateFromChatId,
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

    public function messageId(): MessageId
    {
        return $this->messageId;
    }

    public function from(): User
    {
        return $this->from;
    }

    public function date(): Date
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

    public function forwardFromMessageId(): ?MessageId
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

    public function forwardDate(): ?Date
    {
        return $this->forwardDate;
    }

    public function replyToMessage(): ?Message
    {
        return $this->replyToMessage;
    }

    public function editDate(): ?Date
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

    public function entities(): ArrayOfMessageEntities
    {
        return $this->entities;
    }

    public function captionEntities(): ArrayOfMessageEntities
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

    public function photo(): ArrayOfPhotoSizes
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

    public function newChatMembers(): ArrayOfUsers
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

    public function newChatPhoto(): ArrayOfPhotoSizes
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

    public function migrateToChatId(): ?ChatId
    {
        return $this->migrateToChatId;
    }

    public function migrateFromChatId(): ?ChatId
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

    public static function fromApi($message): ?Message
    {
        if ( ! $message) return null;

        return new static(
            MessageId::fromInt($message->message_id),
            User::fromApi($message->from ?? null),
            Date::fromApi($message->date),
            Chat::fromApi($message->chat),
            User::fromApi($message->forward_from ?? null),
            Chat::fromApi($message->forward_from_chat ?? null),
            MessageId::fromInt($message->forward_from_message_id ?? null),
            $message->forward_signature ?? null,
            $message->forward_sender_name ?? null,
            Date::fromApi($message->forward_date ?? null),
            Message::fromApi($message->reply_to_message ?? null),
            Date::fromApi($message->edit_date ?? null),
            $message->media_group_id ?? null,
            $message->author_signature ?? null,
            $message->text ?? null,
            ArrayOfMessageEntities::fromApi($message->entities ?? null),
            MessageEntity::arrayFromApi($message->caption_entities ?? null),
            Audio::fromApi($message->audio ?? null),
            Document::fromApi($message->document ?? null),
            Animation::fromApi($message->animation ?? null),
            Game::fromApi($message->game ?? null),
            ArrayOfPhotoSizes::fromApi($message->photo ?? null),
            Sticker::fromApi($message->sticker ?? null),
            Video::fromApi($message->video ?? null),
            Voice::fromApi($message->voice ?? null),
            VideoNote::fromApi($message->video_note ?? null),
            $message->caption ?? null,
            Contact::fromApi($message->contact ?? null),
            Location::fromApi($message->location ?? null),
            Venue::fromApi($message->venue ?? null),
            Poll::fromApi($message->poll ?? null),
            ArrayOfUsers::fromApi($message->new_chat_members ?? null),
            User::fromApi($message->left_chat_member ?? null),
            $message->new_chat_title ?? null,
            ArrayOfPhotoSizes::fromApi($message->new_chat_photo ?? null),
            $message->delete_chat_photo ?? null,
            $message->group_chat_created ?? null,
            $message->supergroup_chat_created ?? null,
            $message->channel_chat_created ?? null,
            ChatId::fromInt($message->migrate_to_chat_id ?? null),
            ChatId::fromInt($message->migrate_from_chat_id ?? null),
            Message::fromApi($message->pinned_message ?? null),
            Invoice::fromApi($message->invoice ?? null),
            SuccessfulPayment::fromApi($message->successful_payment ?? null),
            $message->connected_website ?? null,
            PassportData::fromString($message->passport_data ?? null),
            InlineKeyboardMarkup::fromApi($message->reply_markup ?? null)
        );
    }
}