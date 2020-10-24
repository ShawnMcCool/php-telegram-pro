<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\Collections\Collection;
use TelegramPro\Bot\Types\ArrayOfApiTypes;

/**
 * Contains a list of bot commands.
 */
final class ArrayOfBotCommands extends ArrayOfApiTypes implements ApiWriteType
{
    public function toApi()
    {
        return $this->items
            ->map(
                fn(BotCommand $command) => $command->toApi()
            )->toArray();
    }

    public static function fromList(BotCommand ...$botCommands)
    {
        return new static(
            Collection::of($botCommands)
        );
    }
}