<?php namespace TelegramPro\Types;

/**
 * Optional. The result of an inline query that was chosen by a user and sent to their chat partner. Please see our documentation on the feedback collecting for details on how to enable these updates for your bot.
 */
final class ChosenInlineResult
{
    private ResultId $resultId;
    private User $from;
    private ?Location $location;
    private MessageId $inlineMessageId;
    private string $query;

    public function __construct(
        ResultId $resultId,
        User $from,
        ?Location $location,
        MessageId $inlineMessageId,
        string $query
    ) {
        $this->resultId = $resultId;
        $this->from = $from;
        $this->location = $location;
        $this->inlineMessageId = $inlineMessageId;
        $this->query = $query;
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($chosenInlineResult): ?ChosenInlineResult
    {
        if ( ! $chosenInlineResult) return null;

        return new static(
            ResultId::fromString($chosenInlineResult->result_id),
            User::fromApi($chosenInlineResult->from),
            Location::fromApi($chosenInlineResult->location ?? null),
            MessageId::fromString($chosenInlineResult->inline_message_id),
            $chosenInlineResult->query,
        );
    }

    /**
     * The unique identifier for the result that was chosen
     */
    public function resultId(): ResultId
    {
        return $this->resultId;
    }

    /**
     * The user that chose the result
     */
    public function from(): User
    {
        return $this->from;
    }

    /**
     * Optional. Sender location, only for bots that require user location
     */
    public function location(): ?Location
    {
        return $this->location;
    }

    /**
     * Optional. Identifier of the sent inline message. Available only if there is an inline keyboard attached to the message. Will be also received in callback queries and can be used to edit the message.
     */
    public function inlineMessageId(): MessageId
    {
        return $this->inlineMessageId;
    }

    /**
     * The query that was used to obtain the result
     */
    public function query(): string
    {
        return $this->query;
    }
}