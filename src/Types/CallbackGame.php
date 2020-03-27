<?php namespace TelegramPro\Types;

final class CallbackGame
{
    private UserId $userId;
    private int $score;
    private ?bool $force;
    private ?bool $disableEditMessage;
    private ?ChatId $chatId;
    private ?int $messageId;
    private ?InlineMessageId $inlineMessageId;

    public function __construct(
        UserId $userId,
        int $score,
        ?bool $force,
        ?bool $disableEditMessage,
        ?ChatId $chatId,
        ?int $messageId,
        ?InlineMessageId $inlineMessageId
    ) {
        $this->userId = $userId;
        $this->score = $score;
        $this->force = $force;
        $this->disableEditMessage = $disableEditMessage;
        $this->chatId = $chatId;
        $this->messageId = $messageId;
        $this->inlineMessageId = $inlineMessageId;
    }

    public static function fromApi($callbackGame): ?CallbackGame
    {
        if ( ! $callbackGame) return null;

        return new static(
            UserId::fromInt($callbackGame->user_id),
            $callbackGame->score,
            $callbackGame->force ?? null,
            $callbackGame->disable_edit_message ?? null,
            ChatId::fromInt($callbackGame->chat_id ?? null),
            $callbackGame->message_id ?? null,
            InlineMessageId::fromString($callbackGame->inline_message_id ?? null)
        );
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function score(): int
    {
        return $this->score;
    }

    public function force(): ?bool
    {
        return $this->force;
    }

    public function disableEditMessage(): ?bool
    {
        return $this->disableEditMessage;
    }

    public function chatId(): ?ChatId
    {
        return $this->chatId;
    }

    public function messageId(): ?int
    {
        return $this->messageId;
    }

    public function inlineMessageId(): ?InlineMessageId
    {
        return $this->inlineMessageId;
    }
}