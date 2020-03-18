<?php namespace TelegramPro;

final class Update
***REMOVED***
    private int $updateId;
    private ?Message $message;
    private ?Message $editedMessage;
    private ?Message $channelPost;
    private ?Message $editedChannelPost;
    private ?InlineQuery $inlineQuery;
    private ?ChosenInlineResult $chosenInlineResult;
    private ?CallbackQuery $callbackQuery;
    private ?ShippingQuery $shippingQuery;
    private ?PreCheckoutQuery $preCheckoutQuery;
    private ?Poll $poll;
    private ?PollAnswer $pollAnswer;

    private function __construct(
        int $updateId,
        ?Message $message,
        ?Message $editedMessage,
        ?Message $channelPost,
        ?Message $editedChannelPost,
        ?InlineQuery $inlineQuery,
        ?ChosenInlineResult $chosenInlineResult,
        ?CallbackQuery $callbackQuery,
        ?ShippingQuery $shippingQuery,
        ?PreCheckoutQuery $preCheckoutQuery,
        ?Poll $poll,
        ?PollAnswer $pollAnswer
    ) ***REMOVED***
        $this->updateId = $updateId;
        $this->message = $message;
        $this->editedMessage = $editedMessage;
        $this->channelPost = $channelPost;
        $this->editedChannelPost = $editedChannelPost;
        $this->inlineQuery = $inlineQuery;
        $this->chosenInlineResult = $chosenInlineResult;
        $this->callbackQuery = $callbackQuery;
        $this->shippingQuery = $shippingQuery;
        $this->preCheckoutQuery = $preCheckoutQuery;
        $this->poll = $poll;
        $this->pollAnswer = $pollAnswer;
    ***REMOVED***

    public static function fromRequest(string $json): Update
    ***REMOVED***
        $update = json_decode($json);
        
        return new static(
            $update->update_id,
            Message::fromRequest($update->message ?? null),
            Message::fromRequest($update->edited_message ?? null),
            Message::fromRequest($update->channel_post ?? null),
            Message::fromRequest($update->edited_channel_post ?? null),
            InlineQuery::fromRequest($update->inline_query ?? null),
            ChosenInlineResult::fromRequest($update->chosen_inline_result ?? null),
            CallbackQuery::fromRequest($update->callback_query ?? null),
            ShippingQuery::fromRequest($update->shipping_query ?? null),
            PreCheckoutQuery::fromRequest($update->pre_checkout_query ?? null),
            Poll::fromRequest($update->poll ?? null),
            PollAnswer::fromRequest($update->poll_answer ?? null)
        );
    ***REMOVED***

    public function updateId(): int
    ***REMOVED***
        return $this->updateId;
    ***REMOVED***

    public function message(): ?Message
    ***REMOVED***
        return $this->message;
    ***REMOVED***

    public function editedMessage(): ?Message
    ***REMOVED***
        return $this->editedMessage;
    ***REMOVED***

    public function channelPost(): ?Message
    ***REMOVED***
        return $this->channelPost;
    ***REMOVED***

    public function editedChannelPost(): ?Message
    ***REMOVED***
        return $this->editedChannelPost;
    ***REMOVED***

    public function inlineQuery(): ?InlineQuery
    ***REMOVED***
        return $this->inlineQuery;
    ***REMOVED***

    public function chosenInlineResult(): ?ChosenInlineResult
    ***REMOVED***
        return $this->chosenInlineResult;
    ***REMOVED***

    public function callbackQuery(): ?CallbackQuery
    ***REMOVED***
        return $this->callbackQuery;
    ***REMOVED***

    public function shippingQuery(): ?ShippingQuery
    ***REMOVED***
        return $this->shippingQuery;
    ***REMOVED***

    public function preCheckoutQuery(): ?PreCheckoutQuery
    ***REMOVED***
        return $this->preCheckoutQuery;
    ***REMOVED***

    public function poll(): ?Poll
    ***REMOVED***
        return $this->poll;
    ***REMOVED***

    public function pollAnswer(): ?PollAnswer
    ***REMOVED***
        return $this->pollAnswer;
    ***REMOVED***
***REMOVED***