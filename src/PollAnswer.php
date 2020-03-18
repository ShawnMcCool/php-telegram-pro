<?php namespace TelegramPro;

final class PollAnswer
***REMOVED***
    private string $pollId;
    private User $user;
    private array $optionIds;

    public function __construct(
        string $pollId,
        User $user,
        array $optionIds // array of integers
    )
    ***REMOVED***
        $this->pollId = $pollId;
        $this->user = $user;
        $this->optionIds = $optionIds;
    ***REMOVED***

    public static function fromRequest($pollAnswer): ?PollAnswer
    ***REMOVED***
        if ( ! $pollAnswer) return null;

        return new static(
            $pollAnswer->poll_id,
            User::fromRequest($pollAnswer->user),
            $pollAnswer->option_ids
        );
    ***REMOVED***
***REMOVED***