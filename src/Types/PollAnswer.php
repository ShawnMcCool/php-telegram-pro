<?php namespace TelegramPro\Types;

final class PollAnswer
{
    private string $pollId;
    private User $user;
    private array $optionIds;

    public function __construct(
        string $pollId,
        User $user,
        array $optionIds // array of integers
    )
    {
        $this->pollId = $pollId;
        $this->user = $user;
        $this->optionIds = $optionIds;
    }

    public static function fromApi($pollAnswer): ?PollAnswer
    {
        if ( ! $pollAnswer) return null;

        return new static(
            $pollAnswer->poll_id,
            User::fromApi($pollAnswer->user),
            $pollAnswer->option_ids
        );
    }
}