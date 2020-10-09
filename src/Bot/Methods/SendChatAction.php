<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Types\ActionType;
use TelegramPro\Bot\Methods\Requests\JsonRequest;

/**
 * Use this method when you need to tell the user that something is happening on the bot's side. The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status). Returns True on success.
 *
 * Example: The ImageBot needs some time to process a request and upload the image. Instead of sending a text message along the lines of “Retrieving image, please wait…”, the bot may use sendChatAction with action = upload_photo. The user will see a “sending photo” status for the bot.
 *
 * We only recommend using this method when a response from the bot will take a noticeable amount of time to arrive.
 */
final class SendChatAction implements Method
{
    private ChatId $chatId;
    private ActionType $action;

    private function __construct(
        ChatId $chatId,
        ActionType $action
    ) {
        $this->chatId = $chatId;
        $this->action = $action;
    }

    public function send(Telegram $telegramApi): SendChatActionResponse
    {
        return SendChatActionResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    /**
     * Generates a Request object which has all of the information necessary to send a message to the Telegram API.
     * @return Request
     */
    private function request(): Request
    {
        return JsonRequest::forMethod(
            'sendChatAction'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'action' => $this->action->toApi(),
            ]
        );
    }

    public static function parameters(
        ChatId $chatId,
        ActionType $action
    ): SendChatAction {
        return new static($chatId, $action);
    }
}