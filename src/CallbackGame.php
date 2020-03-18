<?php namespace TelegramPro;

final class CallbackGame
***REMOVED***
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
    ) ***REMOVED***
        $this->userId = $userId;
        $this->score = $score;
        $this->force = $force;
        $this->disableEditMessage = $disableEditMessage;
        $this->chatId = $chatId;
        $this->messageId = $messageId;
        $this->inlineMessageId = $inlineMessageId;
    ***REMOVED***

    public static function fromRequest($callbackGame): ?CallbackGame
    ***REMOVED***
        if ( ! $callbackGame) return null;

        return new static(
            $callbackGame->user_id,
            $callbackGame->score,
            $callbackGame->force,
            $callbackGame->disable_edit_message,
            $callbackGame->chat_id,
            $callbackGame->message_id,
            $callbackGame->inline_message_id,
        );
    ***REMOVED***
***REMOVED***