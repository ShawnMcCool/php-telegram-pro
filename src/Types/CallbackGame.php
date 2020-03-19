<?php namespace TelegramPro\Types;

final class CallbackGame
{
    private int $userId;
    private int $score;
    private ?bool $force;
    private ?bool $disableEditMessage;
    private ?int $chatId;
    private ?int $messageId;
    private ?string $inlineMessageId;

    public function __construct(
        int $userId,
        int $score,
        ?bool $force,
        ?bool $disableEditMessage,
        ?int $chatId,
        ?int $messageId,
        ?string $inlineMessageId
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
            $callbackGame->user_id,
            $callbackGame->score,
            $callbackGame->force ?? null,
            $callbackGame->disable_edit_message ?? null,
            $callbackGame->chat_id ?? null,
            $callbackGame->message_id ?? null,
            $callbackGame->inline_message_id ?? null
        );
    }

    public function userId(): int
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

    public function chatId(): ?int
    {
        return $this->chatId;
    }

    public function messageId(): ?int
    {
        return $this->messageId;
    }

    public function inlineMessageId(): ?string
    {
        return $this->inlineMessageId;
    }
}