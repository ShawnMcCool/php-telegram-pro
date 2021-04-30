<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\User;
use TelegramPro\Bot\Methods\Types\Location;
use TelegramPro\Bot\Methods\Types\ApiReadType;

/**
 * Optional. If set, pressing the button will prompt the user to select one of their chats, open that chat and insert the bot‘s username and the specified inline query in the input field. Can be empty, in which case just the bot’s username will be inserted.
 * Note: This offers an easy way for users to start using your bot in inline mode when they are currently in a private chat with it. Especially useful when combined with switch_pm… actions – in this case the user will be automatically returned to the chat they switched from, skipping the chat selection screen.
 */
final class InlineQuery implements ApiReadType
{
    private function __construct(
        private InlineQueryId $id,
        private User $from,
        private ?Location $location,
        private string $query,
        private string $offset
    ) {
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($inlineQuery): ?static
    {
        if ( ! $inlineQuery) return null;

        return new static(
            InlineQueryId::fromApi($inlineQuery->id),
            User::fromApi($inlineQuery->from),
            Location::fromApi($inlineQuery->location ?? null),
            $inlineQuery->query,
            $inlineQuery->offset
        );
    }

    /**
     * Unique identifier for this query
     */
    public function id(): InlineQueryId
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
     * Optional. Sender location, only for bots that request user location
     */
    public function location(): ?Location
    {
        return $this->location;
    }

    /**
     * Text of the query (up to 256 characters)
     */
    public function query(): string
    {
        return $this->query;
    }

    /**
     * Offset of the results to be returned, can be controlled by the bot
     */
    public function offset(): string
    {
        return $this->offset;
    }
}