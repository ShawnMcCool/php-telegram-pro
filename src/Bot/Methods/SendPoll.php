<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Types\PollType;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Types\ParseMode;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Types\PollOptionId;
use TelegramPro\Bot\Methods\Types\PollCloseDate;
use TelegramPro\Bot\Methods\Types\PollOpenPeriod;
use TelegramPro\Bot\Methods\Requests\JsonRequest;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;
use TelegramPro\Bot\Methods\Types\ArrayOfPollOptions;
use function TelegramPro\optional;

/**
 * Use this method to send a native poll.
 */
final class SendPoll implements Method
{

    public function __construct(
        private ChatId $chatId,
        private string $question,
        private ArrayOfPollOptions $options,
        private ?bool $isAnonymous,
        private ?PollType $type,
        private ?bool $allowsMultipleAnswers,
        private ?PollOptionId $correctOptionId,
        private ?string $explanation,
        private ?ParseMode $explanationParseMode,
        private ?PollOpenPeriod $openPeriod,
        private ?PollCloseDate $closeDate,
        private ?bool $isClosed,
        private ?bool $disableNotification,
        private ?MessageId $replyToMessageId,
        private ?ReplyMarkup $replyMarkup

    ) {
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'sendPoll'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'question' => $this->question,
                'options' => $this->options->toApi(),
                'is_anonymous' => $this->isAnonymous,
                'type' => optional($this->type),
                'allows_multiple_answers' => $this->allowsMultipleAnswers,
                'correct_option_id' => optional($this->correctOptionId),
                'explanation' => $this->explanation,
                'explanation_parse_mode' => $this->explanationParseMode->toApi(),
                'open_period' => optional($this->openPeriod),
                'close_date' => optional($this->closeDate),
                'is_closed' => $this->isClosed,
                'disable_web_page_preview' => $this->disableNotification,
                'reply_to_message_id' => optional($this->replyToMessageId),
                'reply_markup' => optional($this->replyMarkup),
            ]
        );
    }

    function send(Telegram $telegramApi): SendPollResponse
    {
        return SendPollResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId,
        string $question,
        ArrayOfPollOptions $options,
        ?bool $isAnonymous = null,
        ?PollType $type = null,
        ?bool $allowsMultipleAnswers = null,
        ?PollOptionId $correctOptionId = null,
        ?string $explanation = null,
        ?ParseMode $explanationParseMode = null,
        ?PollOpenPeriod $openPeriod = null,
        ?PollCloseDate $closeDate = null,
        ?bool $isClosed = null,
        ?bool $disableNotification = null,
        ?MessageId $replyToMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): static {
        return new static(
            $chatId,
            $question,
            $options,
            $isAnonymous,
            $type,
            $allowsMultipleAnswers,
            $correctOptionId,
            $explanation,
            $explanationParseMode ?? ParseMode::none(),
            $openPeriod,
            $closeDate,
            $isClosed,
            $disableNotification,
            $replyToMessageId,
            $replyMarkup,
        );
    }
}