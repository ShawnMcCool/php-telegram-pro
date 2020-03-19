<?php namespace TelegramPro\Types;

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

    public static function fromApi($callbackGame): ?CallbackGame
    ***REMOVED***
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
    ***REMOVED***

    public function userId(): int
    ***REMOVED***
        return $this->userId;
    ***REMOVED***

    public function score(): int
    ***REMOVED***
        return $this->score;
    ***REMOVED***

    public function force(): ?bool
    ***REMOVED***
        return $this->force;
    ***REMOVED***

    public function disableEditMessage(): ?bool
    ***REMOVED***
        return $this->disableEditMessage;
    ***REMOVED***

    public function chatId(): ?int
    ***REMOVED***
        return $this->chatId;
    ***REMOVED***

    public function messageId(): ?int
    ***REMOVED***
        return $this->messageId;
    ***REMOVED***

    public function inlineMessageId(): ?string
    ***REMOVED***
        return $this->inlineMessageId;
    ***REMOVED***
***REMOVED***