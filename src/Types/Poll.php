<?php namespace TelegramPro\Types;

final class Poll
{
    private PollId $id;
    private string $question;
    private ArrayOfPollOptions $options;
    private int $totalVoterCount;
    private bool $isClosed;
    private bool $isAnonymous;
    private PollType $type;
    private bool $allowsMultipleAnswers;
    private ?PollOptionId $correctOptionId;

    public function __construct(
        PollId $id,
        string $question,
        ArrayOfPollOptions $options,
        int $totalVoterCount,
        bool $isClosed,
        bool $isAnonymous,
        PollType $type,
        bool $allowsMultipleAnswers,
        ?PollOptionId $correctOptionId
    ) {
        $this->id = $id;
        $this->question = $question;
        $this->options = $options;
        $this->totalVoterCount = $totalVoterCount;
        $this->isClosed = $isClosed;
        $this->isAnonymous = $isAnonymous;
        $this->type = $type;
        $this->allowsMultipleAnswers = $allowsMultipleAnswers;
        $this->correctOptionId = $correctOptionId;
    }

    public static function fromApi($poll): ?Poll
    {
        if ( ! $poll) return null;

        return new static(
            PollId::fromString($poll->id),
            $poll->question,
            ArrayOfPollOptions::fromApi($poll->options),
            $poll->total_voter_count,
            $poll->is_closed,
            $poll->is_anonymous,
            PollType::fromString($poll->type),
            $poll->allows_multiple_answers,
            PollOptionId::fromInt($poll->correct_option_id)
        );
    }
}