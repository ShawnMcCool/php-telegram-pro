<?php namespace TelegramPro\Types;

final class ChosenInlineResult
{
    private string $resultId;
    private User $from;
    private ?Location $location;
    private string $inlineMessageId;
    private string $query;

    public function __construct(
        string $resultId,
        User $from,
        ?Location $location,
        string $inlineMessageId,
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
            $chosenInlineResult->result_id,
            User::fromApi($chosenInlineResult->from),
            Location::fromApi($chosenInlineResult->location ?? null),
            $chosenInlineResult->inline_message_id,
            $chosenInlineResult->query,
        );
    }

    public function resultId(): string
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

    public function inlineMessageId(): string
    {
        return $this->inlineMessageId;
    }

    public function query(): string
    {
        return $this->query;
    }
}