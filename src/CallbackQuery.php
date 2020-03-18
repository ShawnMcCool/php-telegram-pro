<?php namespace TelegramPro;

final class CallbackQuery
***REMOVED***
    private string $id;
    private User $from;
    private ?Message $message;
    private ?string $inlineMessageId;
    private string $chatInstance;
    private ?string $data;
    private ?string $gameShortName;

    public function __construct(
        string $id,
        User $from,
        ?Message $message,
        ?string $inlineMessageId,
        string $chatInstance,
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
            Message::fromRequest($callbackQuery->message),
            $callbackQuery->inline_message_id,
            $callbackQuery->chat_instance,
            $callbackQuery->data,
            $callbackQuery->game_short_name,
        );
    ***REMOVED***
***REMOVED***