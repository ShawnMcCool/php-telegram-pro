<?php namespace TelegramPro;

final class ChosenInlineResult
***REMOVED***
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
    ) ***REMOVED***
        $this->resultId = $resultId;
        $this->from = $from;
        $this->location = $location;
        $this->inlineMessageId = $inlineMessageId;
        $this->query = $query;
    ***REMOVED***

    public static function fromRequest($chosenInlineResult): ?ChosenInlineResult
    ***REMOVED***
        if ( ! $chosenInlineResult) return null;

        return new static(
            $chosenInlineResult->result_id,
            User::fromRequest($chosenInlineResult->from),
            Location::fromRequest($chosenInlineResult->location ?? null),
            $chosenInlineResult->inline_message_id,
            $chosenInlineResult->query,
        );
    ***REMOVED***

    public function resultId(): string
    ***REMOVED***
        return $this->resultId;
    ***REMOVED***

    public function from(): User
    ***REMOVED***
        return $this->from;
    ***REMOVED***

    public function location(): ?Location
    ***REMOVED***
        return $this->location;
    ***REMOVED***

    public function inlineMessageId(): string
    ***REMOVED***
        return $this->inlineMessageId;
    ***REMOVED***

    public function query(): string
    ***REMOVED***
        return $this->query;
    ***REMOVED***
***REMOVED***