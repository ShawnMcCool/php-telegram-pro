<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\VCard;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Types\PhoneNumber;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;
use TelegramPro\Bot\Methods\Requests\MultipartFormRequest;
use function TelegramPro\optional;

/**
 * Use this method to send phone contacts. On success, the sent Message is returned.
 */
final class SendContact implements Method
{

    public function __construct(
        private ChatId $chatId,
        private PhoneNumber $phoneNumber,
        private string $firstName,
        private ?string $lastName,
        private ?VCard $vcard,
        private ?bool $disableNotification,
        private ?MessageId $replyToMessageId,
        private ?ReplyMarkup $replyMarkup
    ) {
    }

    function request(): Request
    {
        return MultipartFormRequest::forMethod(
            'sendContact'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'phone_number' => $this->phoneNumber->toApi(),
                'first_name' => $this->firstName,
                'last_name' => $this->lastName,
                'vcard' => optional($this->vcard),
                'disable_notification' => $this->disableNotification,
                'reply_to_message_id' => optional($this->replyToMessageId),
                'reply_markup' => optional($this->replyMarkup),
            ]
        );
    }

    function send(Telegram $telegramApi): SendContactResponse
    {
        return SendContactResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId,
        PhoneNumber $phoneNumber,
        string $firstName,
        ?string $lastName = null,
        ?VCard $vcard = null,
        ?bool $disableNotification = null,
        ?MessageId $replyToMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): static {
        return new static(
            $chatId,
            $phoneNumber,
            $firstName,
            $lastName,
            $vcard,
            $disableNotification,
            $replyToMessageId,
            $replyMarkup,
        );
    }
}