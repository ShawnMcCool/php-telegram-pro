<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\Types\ArrayOfBotCommands;

/**
 * Returns Array of BotCommand on success.
 */
final class GetMyCommandsResponse implements Response
{
    private bool $ok;
    private ?ArrayOfBotCommands $commands;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        ?ArrayOfBotCommands $commands,
        ?MethodError $error
    ) {
        $this->ok = $ok;
        $this->commands = $commands;
        $this->error = $error;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function commands(): ?ArrayOfBotCommands
    {
        return $this->commands;
    }

    public function error(): ?MethodError
    {
        return $this->error;
    }

    public static function fromApi(string $jsonResponse): GetMyCommandsResponse
    {
        $response = json_decode($jsonResponse);

        return new static(
            $response->ok,
            ArrayOfBotCommands::fromApi($response->result ?? null),
            MethodError::fromApi($response)
        );
    }
}