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
            Location::fromRequest($chosenInlineResult->location),
            $chosenInlineResult->inline_message_id,
            $chosenInlineResult->query,
        );
    ***REMOVED***
***REMOVED***