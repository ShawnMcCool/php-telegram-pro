<?php namespace TelegramPro\Bot\RateLimiting;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Types\ChatId;
use TelegramPro\Bot\Methods\Request;
use TelegramPro\Collections\Dictionary;

/**
 * @todo this class was spiked and forgotten so that the full test suite could
 * run without failing because of throttling
 */
final class BlockingRateLimiter implements Telegram
{
    const MESSAGES_PER_SECOND_LIMIT = 1;
    // what does this even mean
    //const MULTIPLE_USER_BULK_MESSAGES_PER_SECOND_LIMIT = 30;
    const MESSAGES_TO_SAME_GROUP_PER_MINUTE_LIMIT = 20;

    private Telegram $telegram;
    private Dictionary $chatTimeframes;
    private float $lastSendTimestamp = 0;

    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
        $this->chatTimeframes = Dictionary::empty();
    }

    public function sendToChat(ChatId $chatId, Request $request)
    {
        $current = microtime(true);

        if ($this->lastSendTimestamp == 0) {
            $this->lastSendTimestamp = $current - 1;
        }

        if ( ! $this->chatTimeframes->has($chatId)) {
            $this->chatTimeframes = $this->chatTimeframes->add($chatId, new Timeframe());
        }

        /** @var Timeframe $timeframe */
        $timeframe = $this->chatTimeframes->get($chatId);

        $secondsUntilNextChatSend = $timeframe->secondsUntilRateLimitClears($current, 20);

        ##
        $secondsUntilNextMessageSend = $this->secondsToWaitForNextMessage($current);

        if ($secondsUntilNextChatSend > $secondsUntilNextMessageSend) {
            usleep($secondsUntilNextChatSend * 1_000_000);
        } else {
            usleep($secondsUntilNextMessageSend);
        }

        $timeframe->add();

        $this->lastSendTimestamp = $current;
        $responseJson = $this->telegram->send($request);
        $response = RateLimitedResponse::fromApi(
            $responseJson
        );

        # repeat until it goes through
        if ( ! $response->ok() && $response->error()->code() == '429') {
            $waitTime = \regex\first('Too Many Requests: retry after (\d+)', $response->error()->description());
            usleep($waitTime * 1_000_000);
            return $this->sendToChat($chatId, $request);
        }
        return $responseJson;
    }

    public function send(Request $request)
    {
        $parameters = json_decode($request->toJson());

        if (isset($parameters->chat_id) && ! is_null($parameters->chat_id)) {
            return $this->sendToChat(
                ChatId::fromInt($parameters->chat_id),
                $request
            );
        } else {
            return $this->sendWithoutChat(microtime(true), $request);
        }
    }

    private function sendWithoutChat($current, Request $request)
    {
        usleep($this->secondsToWaitForNextMessage($current));

        $this->lastSendTimestamp = $current;

        $responseJson = $this->telegram->send($request);

        $response = RateLimitedResponse::fromApi(
            $responseJson
        );

        # repeat until it goes through
        if ( ! $response->ok() && $response->error()->code() == '429') {
            $waitTime = \regex\first('Too Many Requests: retry after (\d+)', $response->error()->description());
            usleep($waitTime * 1_000_000);
            return $this->sendWithoutChat(microtime(true), $request);
        }

        return $responseJson;
    }

    /**
     * @param float $current
     * @return float|int
     */
    private function secondsToWaitForNextMessage(float $current)
    {
        $timeSinceLastSend = $current - $this->lastSendTimestamp;
        return $timeSinceLastSend > 1 ? 1 : 1 - $timeSinceLastSend;
    }

}