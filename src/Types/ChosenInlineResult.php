<?php namespace TelegramPro\Types;

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

    public function resultId(): ResultId
    {
        return $this->resultId;
    }

    public function from(): User
    {
        return $this->from;
    }

    public function location(): ?Location
    {
        return $this->location;
    }

    public function inlineMessageId(): MessageId
    {
        return $this->inlineMessageId;
    }

    public function query(): string
    {
        return $this->query;
    }
}