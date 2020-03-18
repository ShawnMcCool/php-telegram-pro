<?php namespace TelegramPro;

final class CallbackQuery
***REMOVED***
    private string $id;
    private User $from;
    private ?Message $message;
    private ?string $inlineMessageId;
    private ?string $chatInstance;
    private ?string $data;
    private ?string $gameShortName;

    public function __construct(
        string $id,
        User $from,
        ?Message $message,
        ?string $inlineMessageId,
        ?string $chatInstance,
        ?string $data,
        ?string $gameShortName
    ) ***REMOVED***
        $this->id = $id;
        $this->from = $from;
        $this->message = $message;
        $this->inlineMessageId = $inlineMessageId;
        $this->chatInstance = $chatInstance;
        $this->data = $data;
        $this->gameShortName = $gameShortName;
    ***REMOVED***

    public static function fromRequest($callbackQuery): ?CallbackQuery
    ***REMOVED***
        if ( ! $callbackQuery) return null;

        return new static(
            $callbackQuery->id,
            User::fromRequest($callbackQuery->from),
            Message::fromRequest($callbackQuery->message ?? null),
            $callbackQuery->inline_message_id ?? null,
            $callbackQuery->chat_instance ?? null,
            $callbackQuery->data ?? null,
            $callbackQuery->game_short_name ?? null
        );
    ***REMOVED***

    public function id(): string
    ***REMOVED***
        return $this->id;
    ***REMOVED***

    public function from(): User
    ***REMOVED***
        return $this->from;
    ***REMOVED***

    public function message(): ?Message
    ***REMOVED***
        return $this->message;
    ***REMOVED***

    public function inlineMessageId(): ?string
    ***REMOVED***
        return $this->inlineMessageId;
    ***REMOVED***

    public function chatInstance(): ?string
    ***REMOVED***
        return $this->chatInstance;
    ***REMOVED***

    public function data(): ?string
    ***REMOVED***
        return $this->data;
    ***REMOVED***

    public function gameShortName(): ?string
    ***REMOVED***
        return $this->gameShortName;
    ***REMOVED***
***REMOVED***