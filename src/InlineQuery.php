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
            Location::fromRequest($inlineQuery->location),
            $inlineQuery->query,
            $inlineQuery->offset
        );
    ***REMOVED***
***REMOVED***