<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\Types\ArrayOfChatMembers;

/**
 * On success, returns an Array of ChatMember objects that contains information about all chat administrators except other bots. If the chat is a group or a supergroup and no administrators were appointed, only the creator will be returned.
 */
final class GetChatAdministratorsResponse implements Response
{

    public function __construct(
        private bool $ok,
        private ?ArrayOfChatMembers $chatMembers,
        private ?MethodError $error
    ) {
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function chatMembers(): ?ArrayOfChatMembers
    {
        return $this->chatMembers;
    }

    public function error(): ?MethodError
    {
        return $this->error;
    }

    public static function fromApi(string $jsonResponse): static
    {
        $response = json_decode($jsonResponse);
        return new static(
            $response->ok,
            ArrayOfChatMembers::fromApi($response->result ?? null),
            MethodError::fromApi($response)
        );
    }
}