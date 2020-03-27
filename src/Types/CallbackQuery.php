<?php namespace TelegramPro\Types;

final class CallbackQuery
{
    private CallbackQueryId $id;
    private User $from;
    private ?Message $message;
    private ?InlineMessageId $inlineMessageId;
    private ?string $chatInstance;
    private ?string $data;
    private ?string $gameShortName;

    public function __construct(
        CallbackQueryId $id,
        User $from,
        ?Message $message,
        ?InlineMessageId $inlineMessageId,
        ?string $chatInstance,
        ?string $data,
        ?string $gameShortName
    ) {
        $this->id = $id;
        $this->from = $from;
        $this->message = $message;
        $this->inlineMessageId = $inlineMessageId;
        $this->chatInstance = $chatInstance;
        $this->data = $data;
        $this->gameShortName = $gameShortName;
    }

    public static function fromApi($callbackQuery): ?CallbackQuery
    {
        if ( ! $callbackQuery) return null;

        return new static(
            CallbackQueryId::fromString($callbackQuery->id),
            User::fromApi($callbackQuery->from),
            Message::fromApi($callbackQuery->message ?? null),
            InlineMessageId::fromString($callbackQuery->inline_message_id ?? null),
            $callbackQuery->chat_instance ?? null,
            $callbackQuery->data ?? null,
            $callbackQuery->game_short_name ?? null
        );
    }

    public function id(): CallbackQueryId
    {
        return $this->id;
    }

    public function from(): User
    {
        return $this->from;
    }

    public function message(): ?Message
    {
        return $this->message;
    }

    public function inlineMessageId(): ?InlineMessageId
    {
        return $this->inlineMessageId;
    }

    public function chatInstance(): ?string
    {
        return $this->chatInstance;
    }

    public function data(): ?string
    {
        return $this->data;
    }

    public function gameShortName(): ?string
    {
        return $this->gameShortName;
    }
}