<?php namespace TelegramPro;

final class InlineQuery
***REMOVED***
    private string $id;
    private User $from;
    private ?Location $location;
    private string $query;
    private string $offset;

    public function __construct(
        string $id,
        User $from,
        ?Location $location,
        string $query,
        string $offset
    ) ***REMOVED***
        $this->id = $id;
        $this->from = $from;
        $this->location = $location;
        $this->query = $query;
        $this->offset = $offset;
    ***REMOVED***

    public static function fromRequest($inlineQuery): ?InlineQuery
    ***REMOVED***
        if ( ! $inlineQuery) return null;

        return new static(
            $inlineQuery->id,
            User::fromRequest($inlineQuery->from),
            Location::fromRequest($inlineQuery->location ?? null),
            $inlineQuery->query,
            $inlineQuery->offset
        );
    ***REMOVED***

    public function id(): string
    ***REMOVED***
        return $this->id;
    ***REMOVED***

    public function from(): User
    ***REMOVED***
        return $this->from;
    ***REMOVED***

    public function location(): ?Location
    ***REMOVED***
        return $this->location;
    ***REMOVED***

    public function query(): string
    ***REMOVED***
        return $this->query;
    ***REMOVED***

    public function offset(): string
    ***REMOVED***
        return $this->offset;
    ***REMOVED***
***REMOVED***