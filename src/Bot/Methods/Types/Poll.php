<?php namespace TelegramPro\Bot\Methods\Types;

/**
 * This object contains information about a poll.
 */
final class Poll
{
    private PollId $id;
    private PollQuestion $question;
    private ArrayOfPollOptions $options;
    private int $totalVoterCount;
    private bool $isClosed;
    private bool $isAnonymous;
    private PollType $type;
    private bool $allowsMultipleAnswers;
    private ?PollOptionId $correctOptionId;

    private function __construct(
        PollId $id,
        PollQuestion $question,
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

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($poll): ?Poll
    {
        if ( ! $poll) return null;

        return new static(
            PollId::fromApi($poll->id),
            PollQuestion::fromApi($poll->question),
            ArrayOfPollOptions::fromApi($poll->options),
            $poll->total_voter_count,
            $poll->is_closed,
            $poll->is_anonymous,
            PollType::fromApi($poll->type),
            $poll->allows_multiple_answers,
            PollOptionId::fromInt($poll->correct_option_id ?? null)
        );
    }

    /**
     *    Unique poll identifier
     */
    public function id(): PollId
    {
        return $this->id;
    }

    /**
     * Poll question, 1-255 characters
     */
    public function question(): PollQuestion
    {
        return $this->question;
    }

    /**
     * List of poll options
     */
    public function options(): ArrayOfPollOptions
    {
        return $this->options;
    }

    /**
     * Total number of users that voted in the poll
     */
    public function totalVoterCount(): int
    {
        return $this->totalVoterCount;
    }

    /**
     * True, if the poll is closed
     */
    public function isClosed(): bool
    {
        return $this->isClosed;
    }

    /**
     * True, if the poll is anonymous
     */
    public function isAnonymous(): bool
    {
        return $this->isAnonymous;
    }

    /**
     * Poll type, currently can be “regular” or “quiz”
     */
    public function type(): PollType
    {
        return $this->type;
    }

    /**
     *    True, if the poll allows multiple answers
     */
    public function allowsMultipleAnswers(): bool
    {
        return $this->allowsMultipleAnswers;
    }

    /**
     * Optional. 0-based identifier of the correct answer option. Available only for polls in the quiz mode, which are closed, or was sent (not forwarded) by the bot or to the private chat with the bot.
     */
    public function correctOptionId(): ?PollOptionId
    {
        return $this->correctOptionId;
    }
}