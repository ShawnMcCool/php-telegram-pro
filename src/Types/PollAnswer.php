<?php namespace TelegramPro\Types;

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

    public static function fromApi($pollAnswer): ?PollAnswer
    {
        if ( ! $pollAnswer) return null;

        return new static(
            PollId::fromString($pollAnswer->poll_id),
            User::fromApi($pollAnswer->user),
            ArrayOfPollOptionIds::fromApi($pollAnswer->option_ids)
        );
    }
}