<?php namespace TelegramPro\Types;

final class Poll
{
    private string $id;
    private string $question;
    private array $options;
    private int $totalVoterCount;
    private bool $isClosed;
    private bool $isAnonymous;
    private string $type;
    private bool $allowsMultipleAnswers;
    private ?int $correctOptionId;

    public function __construct(
        string $id,
        string $question,
        array $options,
        int $totalVoterCount,
        bool $isClosed,
        bool $isAnonymous,
        string $type, // regular or quiz
        bool $allowsMultipleAnswers,
        ?int $correctOptionId
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
            $poll->id,
            $poll->question,
            PollOption::arrayfromApi($poll->options),
            $poll->total_voter_count,
            $poll->is_closed,
            $poll->is_anonymous,
            $poll->type,
            $poll->allows_multiple_answers,
            $poll->correct_option_id
        );
    }
}