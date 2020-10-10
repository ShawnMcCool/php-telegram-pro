<?php namespace TelegramPro\Bot\RateLimiting;

use TelegramPro\Api\Telegram;
use TelegramPro\Collections\Dictionary;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Requests\Request;

/**
 * @todo this class was spiked and forgotten so that the full test suite could
 * run without failing because of throttling
 */
final class BlockingRateLimiter implements Telegram
{
    const MESSAGES_PER_SECOND_LIMIT = 1;
    /**
     * @todo look into this
     * const MULTIPLE_USER_BULK_MESSAGES_PER_SECOND_LIMIT = 30;
     **/
    const MESSAGES_TO_SAME_GROUP_PER_MINUTE_LIMIT = 20;

    private Telegram $telegram;
    private Dictionary $chatTimeframes;
    private float $lastSendTimestamp = 0;

    private int $numberOfTelegramForcedThrottleDelays = 0;
    private float $totalSecondsOfRateLimitedThrottleDelay = 0.0;
    private float $totalSecondsOfTelegramForcedThrottleDelay = 0.0;

    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
        $this->chatTimeframes = Dictionary::empty();
    }

    public function limiterReport(): RateLimiterReport
    {
        return new RateLimiterReport(
            $this->numberOfTelegramForcedThrottleDelays,
            $this->totalSecondsOfRateLimitedThrottleDelay,
            $this->totalSecondsOfTelegramForcedThrottleDelay
        );
    }

    public function sendToChat(float $current, ChatId $chatId, Request $request)
    {
        if ( ! $this->chatTimeframes->has($chatId)) {
            $this->chatTimeframes = $this->chatTimeframes->add($chatId, new FrameCounter());
        }

        /** @var FrameCounter $timeframe */
        $timeframe = $this->chatTimeframes->get($chatId);

        $secondsUntilNextChatSend = $timeframe->secondsUntilRateLimitClears($current, 20);

        ##
        $secondsUntilNextMessageSend = $this->secondsToWaitForNextMessage($current);

        $secondsUntilNextChatSend > $secondsUntilNextMessageSend
            ? $this->waitSecondsRateLimited($secondsUntilNextChatSend)
            : $this->waitSecondsRateLimited($secondsUntilNextMessageSend);

        $timeframe->add($current);

        $response = $this->sendRequest($request, $current);

        # repeat until it goes through
        if ( ! $response->ok() && $response->error()->code() == '429') {
            $this->waitSecondsForceThrottled(
                \regex\first('Too Many Requests: retry after (\d+)', $response->error()->description())
            );
            return $this->retry($request);
        }

        return $response->json();
    }

    public function send(Request $request)
    {
        $parameters = json_decode($request->toJson());

        if (isset($parameters->chat_id) && ! is_null($parameters->chat_id)) {
            return $this->sendToChat(microtime(true), ChatId::fromInt($parameters->chat_id), $request);
        } else {
            return $this->sendWithoutChat(microtime(true), $request);
        }
    }

    private function retry(Request $request)
    {
        return $this->send($request);
    }

    private function sendWithoutChat($current, Request $request)
    {
        $this->waitSecondsRateLimited($this->secondsToWaitForNextMessage($current));

        $response = $this->sendRequest($request, $current);

        # repeat until it goes through
        if ( ! $response->ok() && $response->error()->code() == '429') {
            $this->waitSecondsForceThrottled(
                \regex\first('Too Many Requests: retry after (\d+)', $response->error()->description())
            );
            return $this->retry($request);
        }

        return $response->json();
    }

    private function secondsToWaitForNextMessage(float $current): float
    {
        $timeSinceLastSend = $current - $this->lastSendTimestamp;
        return $timeSinceLastSend > 1 ? 1 : 1 - $timeSinceLastSend;
    }

    private function waitSecondsRateLimited(float $seconds)
    {
        $this->totalSecondsOfRateLimitedThrottleDelay += $seconds;
        usleep($seconds * 1_000_000);
    }

    private function waitSecondsForceThrottled(float $seconds)
    {
        $this->numberOfTelegramForcedThrottleDelays += 1;
        $this->totalSecondsOfRateLimitedThrottleDelay += $seconds;
        usleep($seconds * 1_000_000);
    }

    private function sendRequest(Request $request, float $current): RateLimitedResponse
    {
        $this->lastSendTimestamp = $current;
        
        return RateLimitedResponse::fromApi(
            $this->telegram->send($request)
        );
    }

    public function bulkToUsers(Request ...$requests)
    {
        throw new \Exception('this feature not implemented');
    }
}