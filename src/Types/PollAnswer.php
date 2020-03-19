<?php namespace TelegramPro\Types;

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

    public static function fromApi($pollAnswer): ?PollAnswer
    ***REMOVED***
        if ( ! $pollAnswer) return null;

        return new static(
            $pollAnswer->poll_id,
            User::fromApi($pollAnswer->user),
            $pollAnswer->option_ids
        );
    ***REMOVED***
***REMOVED***