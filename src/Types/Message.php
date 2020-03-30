<?php namespace TelegramPro\Types;

/**
 * This object represents a message.
 * https://core.telegram.org/bots/api#message
 */
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
    private ?MediaCaption $caption;
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
        ?MediaCaption $caption,
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

    /**
     * Unique message identifier inside this chat
     */
    public function messageId(): MessageId
    {
        return $this->messageId;
    }

    /**
     * Optional. Sender, empty for messages sent to channels
     */
    public function from(): User
    {
        return $this->from;
    }

    /**
     * Date the message was sent in Unix time
     */
    public function date(): Date
    {
        return $this->date;
    }

    /**
     * Conversation the message belongs to
     */
    public function chat(): Chat
    {
        return $this->chat;
    }

    /**
     * Optional. For forwarded messages, sender of the original message
     */
    public function forwardFrom(): ?User
    {
        return $this->forwardFrom;
    }

    /**
     * Optional. For messages forwarded from channels, information about the original channel
     */
    public function forwardFromChat(): ?Chat
    {
        return $this->forwardFromChat;
    }

    /**
     * Optional. For messages forwarded from channels, identifier of the original message in the channel
     */
    public function forwardFromMessageId(): ?MessageId
    {
        return $this->forwardFromMessageId;
    }

    /**
     * Optional. For messages forwarded from channels, signature of the post author if present
     */
    public function forwardSignature(): ?string
    {
        return $this->forwardSignature;
    }

    /**
     * Optional. Sender's name for messages forwarded from users who disallow adding a link to their account in forwarded messages
     */
    public function forwardSenderName(): ?string
    {
        return $this->forwardSenderName;
    }

    /**
     * Optional. For forwarded messages, date the original message was sent in Unix time
     */
    public function forwardDate(): ?Date
    {
        return $this->forwardDate;
    }

    /**
     * Optional. For replies, the original message. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply.
     */
    public function replyToMessage(): ?Message
    {
        return $this->replyToMessage;
    }

    /**
     * Optional. Date the message was last edited in Unix time
     */
    public function editDate(): ?Date
    {
        return $this->editDate;
    }

    /**
     * Optional. The unique identifier of a media message group this message belongs to
     */
    public function mediaGroupId(): ?string
    {
        return $this->mediaGroupId;
    }

    /**
     * Optional. Signature of the post author for messages in channels
     */
    public function authorSignature(): ?string
    {
        return $this->authorSignature;
    }

    /**
     * Optional. For text messages, the actual UTF-8 text of the message, 0-4096 characters
     */
    public function text(): ?string
    {
        return $this->text;
    }

    /**
     * Optional. For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text
     */
    public function entities(): ArrayOfMessageEntities
    {
        return $this->entities;
    }

    /**
     * Optional. For messages with a caption, special entities like usernames, URLs, bot commands, etc. that appear in the caption
     */
    public function captionEntities(): ArrayOfMessageEntities
    {
        return $this->captionEntities;
    }

    /**
     * Optional. Message is an audio file, information about the file
     */
    public function audio(): ?Audio
    {
        return $this->audio;
    }

    /**
     * 	Optional. Message is a general file, information about the file
     */
    public function document(): ?Document
    {
        return $this->document;
    }

    /**
     * 	Optional. Message is an animation, information about the animation. For backward compatibility, when this field is set, the document field will also be set
     */
    public function animation(): ?Animation
    {
        return $this->animation;
    }

    /**
     * Optional. Message is a game, information about the game.
     * More about games » https://core.telegram.org/bots/api#games
     */
    public function game(): ?Game
    {
        return $this->game;
    }

    /**
     * Optional. Message is a photo, available sizes of the photo
     */
    public function photo(): ArrayOfPhotoSizes
    {
        return $this->photo;
    }

    /**
     * Optional. Message is a sticker, information about the sticker
     */
    public function sticker(): ?Sticker
    {
        return $this->sticker;
    }

    /**
     * Optional. Message is a video, information about the video
     */
    public function video(): ?Video
    {
        return $this->video;
    }

    /**
     * Optional. Message is a voice message, information about the file
     */
    public function voice(): ?Voice
    {
        return $this->voice;
    }

    /**
     * Optional. Message is a video note, information about the video message
     */
    public function videoNote(): ?VideoNote
    {
        return $this->videoNote;
    }

    /**
     * Optional. Caption for the animation, audio, document, photo, video or voice, 0-1024 characters
     */
    public function caption(): ?MediaCaption
    {
        return $this->caption;
    }

    /**
     * Optional. Message is a shared contact, information about the contact
     */
    public function contact(): ?Contact
    {
        return $this->contact;
    }

    /**
     * Optional. Message is a shared location, information about the location
     */
    public function location(): ?Location
    {
        return $this->location;
    }

    /**
     * Optional. Message is a venue, information about the venue
     */
    public function venue(): ?Venue
    {
        return $this->venue;
    }

    /**
     * Optional. Message is a native poll, information about the poll
     */
    public function poll(): ?Poll
    {
        return $this->poll;
    }

    /**
     * Optional. New members that were added to the group or supergroup and information about them (the bot itself may be one of these members)
     */
    public function newChatMembers(): ArrayOfUsers
    {
        return $this->newChatMembers;
    }

    /**
     * Optional. A member was removed from the group, information about them (this member may be the bot itself)
     */
    public function leftChatMember(): ?User
    {
        return $this->leftChatMember;
    }

    /**
     * Optional. A chat title was changed to this value
     */
    public function newChatTitle(): ?string
    {
        return $this->newChatTitle;
    }

    /**
     * 	Optional. A chat photo was change to this value
     */
    public function newChatPhoto(): ArrayOfPhotoSizes
    {
        return $this->newChatPhoto;
    }

    /**
     * Optional. Service message: the chat photo was deleted
     */
    public function deleteChatPhoto(): ?bool
    {
        return $this->deleteChatPhoto;
    }

    /**
     * Optional. Service message: the group has been created
     */
    public function groupChatCreated(): ?bool
    {
        return $this->groupChatCreated;
    }

    /**
     * Optional. Service message: the supergroup has been created. This field can‘t be received in a message coming through updates, because bot can’t be a member of a supergroup when it is created. It can only be found in reply_to_message if someone replies to a very first message in a directly created supergroup.
     */
    public function supergroupChatCreated(): ?bool
    {
        return $this->supergroupChatCreated;
    }

    /**
     * Optional. Service message: the channel has been created. This field can‘t be received in a message coming through updates, because bot can’t be a member of a channel when it is created. It can only be found in reply_to_message if someone replies to a very first message in a channel.
     */
    public function channelChatCreated(): ?bool
    {
        return $this->channelChatCreated;
    }

    /**
     * Optional. The group has been migrated to a supergroup with the specified identifier. This number may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
     */
    public function migrateToChatId(): ?ChatId
    {
        return $this->migrateToChatId;
    }

    /**
     * Optional. The supergroup has been migrated from a group with the specified identifier. This number may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
     */
    public function migrateFromChatId(): ?ChatId
    {
        return $this->migrateFromChatId;
    }

    /**
     * Optional. Specified message was pinned. Note that the Message object in this field will not contain further reply_to_message fields even if it is itself a reply.
     */
    public function pinnedMessage(): ?Message
    {
        return $this->pinnedMessage;
    }

    /**
     * Optional. Message is an invoice for a payment, information about the invoice.
     * More about payments » https://core.telegram.org/bots/api#payments
     */
    public function invoice(): ?Invoice
    {
        return $this->invoice;
    }

    /**
     * Optional. Message is a service message about a successful payment, information about the payment.
     * More about payments » https://core.telegram.org/bots/api#payments
     */
    public function successfulPayment(): ?SuccessfulPayment
    {
        return $this->successfulPayment;
    }

    /**
     * Optional. The domain name of the website on which the user has logged in.
     * More about Telegram Login » https://core.telegram.org/widgets/login
     */
    public function connectedWebsite(): ?string
    {
        return $this->connectedWebsite;
    }

    /**
     * Optional. Telegram Passport data
     */
    public function passportData(): ?PassportData
    {
        return $this->passportData;
    }

    /**
     * Optional. Inline keyboard attached to the message. login_url buttons are represented as ordinary url buttons.
     */
    public function replyMarkup(): ?InlineKeyboardMarkup
    {
        return $this->replyMarkup;
    }

    public static function fromApi($message): ?Message
    {
        if ( ! $message) return null;

        return new static(
            MessageId::fromString($message->message_id),
            User::fromApi($message->from ?? null),
            Date::fromApi($message->date),
            Chat::fromApi($message->chat),
            User::fromApi($message->forward_from ?? null),
            Chat::fromApi($message->forward_from_chat ?? null),
            MessageId::fromString($message->forward_from_message_id ?? null),
            $message->forward_signature ?? null,
            $message->forward_sender_name ?? null,
            Date::fromApi($message->forward_date ?? null),
            Message::fromApi($message->reply_to_message ?? null),
            Date::fromApi($message->edit_date ?? null),
            $message->media_group_id ?? null,
            $message->author_signature ?? null,
            MessageText::fromApi($message->text ?? null),
            ArrayOfMessageEntities::fromApi($message->entities ?? null),
            ArrayOfMessageEntities::fromApi($message->caption_entities ?? null),
            Audio::fromApi($message->audio ?? null),
            Document::fromApi($message->document ?? null),
            Animation::fromApi($message->animation ?? null),
            Game::fromApi($message->game ?? null),
            ArrayOfPhotoSizes::fromApi($message->photo ?? null),
            Sticker::fromApi($message->sticker ?? null),
            Video::fromApi($message->video ?? null),
            Voice::fromApi($message->voice ?? null),
            VideoNote::fromApi($message->video_note ?? null),
            MediaCaption::fromApi($message->caption ?? null),
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