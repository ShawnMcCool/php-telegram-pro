<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Types\ChatId;
use TelegramPro\Bot\Types\PollType;
use TelegramPro\Bot\Types\MessageId;
use TelegramPro\Bot\Types\PollOptionId;
use TelegramPro\Bot\Methods\Types\ParseMode;
use TelegramPro\Bot\Types\ArrayOfPollOptions;
use TelegramPro\Bot\Methods\Types\PollCloseDate;
use TelegramPro\Bot\Methods\Types\PollOpenPeriod;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;

/**
 * Use this method to send a native poll.
 */
final class SendPoll implements Method
{
    private ChatId $chatId;
    private string $question;
    private ArrayOfPollOptions $options;
    private ?bool $isAnonymous;
    private ?PollType $type;
    private ?bool $allowsMultipleAnswers;
    private ?PollOptionId $correctOptionId;
    private ?string $explanation;
    private ?ParseMode $explanationParseMode;
    private ?PollOpenPeriod $openPeriod;
    private ?PollCloseDate $closeDate;
    private ?bool $isClosed;
    private ?bool $disableNotification;
    private ?MessageId $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    public function __construct(
        ChatId $chatId,
        string $question,
        ArrayOfPollOptions $options,
        ?bool $isAnonymous,
        ?PollType $type,
        ?bool $allowsMultipleAnswers,
        ?PollOptionId $correctOptionId,
        ?string $explanation,
        ?ParseMode $explanationParseMode,
        ?PollOpenPeriod $openPeriod,
        ?PollCloseDate $closeDate,
        ?bool $isClosed,
        ?bool $disableNotification,
        ?MessageId $replyToMessageId,
        ?ReplyMarkup $replyMarkup

    ) {
        $this->chatId = $chatId;
        $this->question = $question;
        $this->options = $options;
        $this->isAnonymous = $isAnonymous;
        $this->type = $type;
        $this->allowsMultipleAnswers = $allowsMultipleAnswers;
        $this->correctOptionId = $correctOptionId;
        $this->explanation = $explanation;
        $this->explanationParseMode = $explanationParseMode;
        $this->openPeriod = $openPeriod;
        $this->closeDate = $closeDate;
        $this->isClosed = $isClosed;
        $this->disableNotification = $disableNotification;
        $this->replyToMessageId = $replyToMessageId;
        $this->replyMarkup = $replyMarkup;
    }

    function request(): Request
    {
        return Request::multipartFormData(
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
    ): self {
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