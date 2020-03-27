<?php namespace TelegramPro\Types;

final class InlineQuery
{
    private InlineQueryId $id;
    private User $from;
    private ?Location $location;
    private string $query;
    private string $offset;

    public function __construct(
        InlineQueryId $id,
        User $from,
        ?Location $location,
        string $query,
        string $offset
    ) {
        $this->id = $id;
        $this->from = $from;
        $this->location = $location;
        $this->query = $query;
        $this->offset = $offset;
    }

    public static function fromApi($inlineQuery): ?InlineQuery
    {
        if ( ! $inlineQuery) return null;

        return new static(
            InlineQueryId::fromString($inlineQuery->id),
            User::fromApi($inlineQuery->from),
            Location::fromApi($inlineQuery->location ?? null),
            $inlineQuery->query,
            $inlineQuery->offset
        );
    }

    public function id(): InlineQueryId
    {
        return $this->id;
    }

    public function from(): User
    {
        return $this->from;
    }

    public function location(): ?Location
    {
        return $this->location;
    }

    public function query(): string
    {
        return $this->query;
    }

    public function offset(): string
    {
        return $this->offset;
    }
}