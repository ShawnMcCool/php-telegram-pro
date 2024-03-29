<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\Poll;
use TelegramPro\Bot\Methods\Types\Chat;
use TelegramPro\Bot\Methods\Types\User;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\ApiReadType;

/**
 * This object represents an incoming update. This is the "read" side of the Telegram API. The write side is represented by "Methods".
 * At most one of the optional parameters can be present in any given update.
 */
final class Update implements ApiReadType
{
    private function __construct(
        private UpdateId $updateId,
        private ?Message $message,
        private ?Message $editedMessage,
        private ?Message $channelPost,
        private ?Message $editedChannelPost,
        private ?InlineQuery $inlineQuery,
        private ?ChosenInlineResult $chosenInlineResult,
        private ?CallbackQuery $callbackQuery,
        private ?ShippingQuery $shippingQuery,
        private ?PreCheckoutQuery $preCheckoutQuery,
        private ?Poll $poll,
        private ?PollAnswer $pollAnswer
    ) {
    }

    /** Return the update regardless of type */
    public function result()
    {
        return $this->message
            ?? $this->editedMessage
            ?? $this->channelPost
            ?? $this->editedChannelPost
            ?? $this->inlineQuery
            ?? $this->chosenInlineResult
            ?? $this->callbackQuery
            ?? $this->shippingQuery
            ?? $this->preCheckoutQuery
            ?? $this->poll
            ?? $this->pollAnswer;
    }

    /**
     * If a Message object exists in this update, resolvedMessage() returns it.
     */
    public function resolvedMessage(): ?Message
    {
        return $this->message
            ?? $this->editedMessage
            ?? $this->callbackQuery->message()
            ?? $this->channelPost
            ?? $this->editedChannelPost;
    }

    /**
     * If a Chat object exists in this update, resolvedChat() returns it.
     */
    public function resolvedChat(): ?Chat
    {
        return $this->message->chat()
            ?? $this->editedMessage->chat()
            ?? $this->callbackQuery->message()->chat()
            ?? $this->channelPost->chat()
            ?? $this->editedChannelPost->chat();
    }

    /**
     * If a User object exists in this update, resolvedUser() returns it.
     */
    public function resolvedUser(): ?User
    {
        return $this->message->from()
            ?? $this->editedMessage->from()
            ?? $this->callbackQuery->message()->from()
            ?? $this->channelPost->from()
            ?? $this->editedChannelPost->from()
            ?? $this->inlineQuery->from()
            ?? $this->chosenInlineResult->from()
            ?? $this->shippingQuery->from()
            ?? $this->preCheckoutQuery->from()
            ?? $this->pollAnswer()->user();
    }

    /**
     * The update‘s unique identifier. Update identifiers start from a certain positive number and increase sequentially. This ID becomes especially handy if you’re using Webhooks, since it allows you to ignore repeated updates or to restore the correct update sequence, should they get out of order. If there are no new updates for at least a week, then identifier of the next update will be chosen randomly instead of sequentially.
     */
    public function updateId(): UpdateId
    {
        return $this->updateId;
    }

    /**
     * Optional. New incoming message of any kind — text, photo, sticker, etc.
     */
    public function message(): ?Message
    {
        return $this->message;
    }

    /**
     * Optional. New version of a message that is known to the bot and was edited
     */
    public function editedMessage(): ?Message
    {
        return $this->editedMessage;
    }

    /**
     *    Optional. New incoming channel post of any kind — text, photo, sticker, etc.
     */
    public function channelPost(): ?Message
    {
        return $this->channelPost;
    }

    /**
     * Optional. New version of a channel post that is known to the bot and was edited
     */
    public function editedChannelPost(): ?Message
    {
        return $this->editedChannelPost;
    }

    /**
     * Optional. New incoming inline query
     */
    public function inlineQuery(): ?InlineQuery
    {
        return $this->inlineQuery;
    }

    /**
     * Optional. The result of an inline query that was chosen by a user and sent to their chat partner. Please see our documentation on the feedback collecting for details on how to enable these updates for your bot.
     */
    public function chosenInlineResult(): ?ChosenInlineResult
    {
        return $this->chosenInlineResult;
    }

    /**
     * Optional. New incoming callback query
     */
    public function callbackQuery(): ?CallbackQuery
    {
        return $this->callbackQuery;
    }

    /**
     * Optional. New incoming shipping query. Only for invoices with flexible price
     */
    public function shippingQuery(): ?ShippingQuery
    {
        return $this->shippingQuery;
    }

    /**
     * Optional. New incoming pre-checkout query. Contains full information about checkout
     */
    public function preCheckoutQuery(): ?PreCheckoutQuery
    {
        return $this->preCheckoutQuery;
    }

    /**
     * Optional. New poll state. Bots receive only updates about stopped polls and polls, which are sent by the bot
     */
    public function poll(): ?Poll
    {
        return $this->poll;
    }

    /**
     * Optional. A user changed their answer in a non-anonymous poll. Bots receive new votes only in polls that were sent by the bot itself.
     */
    public function pollAnswer(): ?PollAnswer
    {
        return $this->pollAnswer;
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($update): static
    {
        return new static(
            UpdateId::fromInt($update->update_id),
            Message::fromApi($update->message ?? null),
            Message::fromApi($update->edited_message ?? null),
            Message::fromApi($update->channel_post ?? null),
            Message::fromApi($update->edited_channel_post ?? null),
            InlineQuery::fromApi($update->inline_query ?? null),
            ChosenInlineResult::fromApi($update->chosen_inline_result ?? null),
            CallbackQuery::fromApi($update->callback_query ?? null),
            ShippingQuery::fromApi($update->shipping_query ?? null),
            PreCheckoutQuery::fromApi($update->pre_checkout_query ?? null),
            Poll::fromApi($update->poll ?? null),
            PollAnswer::fromApi($update->poll_answer ?? null)
        );
    }
}