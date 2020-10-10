<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;

/**
 * Use this method to generate a new invite link for a chat; any previously generated link is revoked. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns the new invite link as String on success.
 */
final class ExportChatInviteLink implements Method
{
    private ChatId $chatId;

    private function __construct(ChatId $chatId)
    {
        $this->chatId = $chatId;
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'exportChatInviteLink'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
            ]
        );
    }

    public function send(Telegram $telegramApi): ExportChatInviteLinkResponse
    {
        return ExportChatInviteLinkResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId
    ): ExportChatInviteLink {
        return new static(
            $chatId
        );
    }
}