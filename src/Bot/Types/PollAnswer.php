<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\User;
use TelegramPro\Bot\Methods\Types\PollId;
use TelegramPro\Bot\Methods\Types\ApiReadType;

/**
 * This object represents an answer of a user in a non-anonymous poll.
 */
final class PollAnswer implements ApiReadType
{
    private function __construct(
        private PollId $pollId,
        private User $user,
        private ArrayOfPollOptionIds $optionIds
    ) {
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($pollAnswer): ?static
    {
        if ( ! $pollAnswer) return null;

        return new static(
            PollId::fromApi($pollAnswer->poll_id),
            User::fromApi($pollAnswer->user),
            ArrayOfPollOptionIds::fromApi($pollAnswer->option_ids)
        );
    }

    /**
     * Unique poll identifier
     */
    public function pollId(): PollId
    {
        return $this->pollId;
    }

    /**
     * The user, who changed the answer to the poll
     */
    public function user(): User
    {
        return $this->user;
    }

    /**
     * 0-based identifiers of answer options, chosen by the user. May be empty if the user retracted their vote.
     */
    public function optionIds(): ArrayOfPollOptionIds
    {
        return $this->optionIds;
    }
}