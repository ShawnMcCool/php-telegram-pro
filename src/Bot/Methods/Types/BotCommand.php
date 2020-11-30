<?php namespace TelegramPro\Bot\Methods\Types;

final class BotCommand implements ApiWriteType, ApiReadType
{
    private string $command;
    private string $description;

    private function __construct(
        string $command,
        string $description
    ) {
        $this->command = $command;
        $this->description = $description;
    }

    function toApi()
    {
        return [
            'command' => $this->command,
            'description' => $this->description,
        ];
    }

    public static function fromString(string $command, string $description)
    {
        if (strlen($command) < 1 || strlen($command) > 32) {
            throw BotCommandIsInvalid::commandIsAnInvalidLength($command);
        }

        if (\TelegramPro\regex\has_unmatched_characters('a-zA-Z0-9_', $command)) {
            throw BotCommandIsInvalid::commandContainsInvalidCharacters($command);
        }

        if (strlen($description) < 3 || strlen($description) > 256) {
            throw BotCommandIsInvalid::descriptionIsAnInvalidLength($command);
        }

        return new static($command, $description);
    }

    public static function fromApi($botCommand): ?static
    {
        return new static(
            $botCommand->command,
            $botCommand->description
        );
    }
}