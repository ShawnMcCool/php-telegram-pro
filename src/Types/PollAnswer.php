<?php namespace TelegramPro\Types;

/**
 * This object represents an answer of a user in a non-anonymous poll.
 */
final class PollAnswer
{
    private PollId $pollId;
    private User $user;
    private ArrayOfPollOptionIds $optionIds;

    public function __construct(
        PollId $pollId,
        User $user,
        ArrayOfPollOptionIds $optionIds
    ) {
        $this->pollId = $pollId;
        $this->user = $user;
        $this->optionIds = $optionIds;
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($pollAnswer): ?PollAnswer
    {
        if ( ! $pollAnswer) return null;

        return new static(
            PollId::fromString($pollAnswer->poll_id),
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