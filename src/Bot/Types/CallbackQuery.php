<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\User;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\ApiReadType;

/**
 * This object represents an incoming callback query from a callback button in an inline keyboard. If the button that originated the query was attached to a message sent by the bot, the field message will be present. If the button was attached to a message sent via the bot (in inline mode), the field inline_message_id will be present. Exactly one of the fields data or game_short_name will be present.
 *
 * NOTE: After the user presses a callback button, Telegram clients will display a progress bar until you call answerCallbackQuery. It is, therefore, necessary to react by calling answerCallbackQuery even if no notification to the user is needed (e.g., without specifying any of the optional parameters).
 */
final class CallbackQuery implements ApiReadType
{
    private function __construct(
        private CallbackQueryId $id,
        private User $from,
        private ?Message $message,
        private ?InlineMessageId $inlineMessageId,
        private ?ChatId $chatInstance,
        private ?string $data,
        private ?GameShortName $gameShortName
    ) {
    }

    /**
     * @inheritDoc
     */
    public static function fromApi($callbackQuery): ?static
    {
        if ( ! $callbackQuery) return null;

        return new static(
            CallbackQueryId::fromApi($callbackQuery->id),
            User::fromApi($callbackQuery->from),
            Message::fromApi($callbackQuery->message ?? null),
            InlineMessageId::fromApi($callbackQuery->inline_message_id ?? null),
            ChatId::fromInt($callbackQuery->chat_instance ?? null),
            $callbackQuery->data ?? null,
            $callbackQuery->game_short_name ?? null
        );
    }

    /**
     * Unique identifier for this query
     */
    public function id(): CallbackQueryId
    {
        return $this->id;
    }

    /**
     * Sender
     */
    public function from(): User
    {
        return $this->from;
    }

    /**
     * Optional. Message with the callback button that originated the query. Note that message content and message date will not be available if the message is too old
     */
    public function message(): ?Message
    {
        return $this->message;
    }

    /**
     * Optional. Identifier of the message sent via the bot in inline mode, that originated the query.
     */
    public function inlineMessageId(): ?InlineMessageId
    {
        return $this->inlineMessageId;
    }

    /**
     * Global identifier, uniquely corresponding to the chat to which the message with the callback button was sent. Useful for high scores in games.
     */
    public function chatInstance(): ?ChatId
    {
        return $this->chatInstance;
    }

    /**
     *    Optional. Data associated with the callback button. Be aware that a bad client can send arbitrary data in this field.
     */
    public function data(): ?string
    {
        return $this->data;
    }

    /**
     * Optional. Short name of a Game to be returned, serves as the unique identifier for the game
     */
    public function gameShortName(): ?GameShortName
    {
        return $this->gameShortName;
    }
}