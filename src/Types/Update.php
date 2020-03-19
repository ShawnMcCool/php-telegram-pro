<?php namespace TelegramPro\Types;

final class Update
{
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
    ) {
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
    }

    public static function fromApi(string $json): Update
    {
        $update = json_decode($json);
        
        return new static(
            $update->update_id,
            Message::fromApi($update->message ?? null),
            Message::fromApi($update->edited_message ?? null),
            Message::fromApi($update->channel_post ?? null),
            Message::fromApi($update->edited_channel_post ?? null),
            InlineQuery::fromApi($update->inline_query ?? null),
            ChosenInlineResult::fromApi($update->chosen_inline_result ?? null),
            CallbackQuery::fromApi($update->callback_query ?? null),
            ShippingQuery::fromApi($update->shipping_query ?? null),
            PreCheckoutQuery::fromApi($update->pre_checkout_query ?? null),
            Poll::fromApi($update->poll ?? null),
            PollAnswer::fromApi($update->poll_answer ?? null)
        );
    }

    public function updateId(): int
    {
        return $this->updateId;
    }

    public function message(): ?Message
    {
        return $this->message;
    }

    public function editedMessage(): ?Message
    {
        return $this->editedMessage;
    }

    public function channelPost(): ?Message
    {
        return $this->channelPost;
    }

    public function editedChannelPost(): ?Message
    {
        return $this->editedChannelPost;
    }

    public function inlineQuery(): ?InlineQuery
    {
        return $this->inlineQuery;
    }

    public function chosenInlineResult(): ?ChosenInlineResult
    {
        return $this->chosenInlineResult;
    }

    public function callbackQuery(): ?CallbackQuery
    {
        return $this->callbackQuery;
    }

    public function shippingQuery(): ?ShippingQuery
    {
        return $this->shippingQuery;
    }

    public function preCheckoutQuery(): ?PreCheckoutQuery
    {
        return $this->preCheckoutQuery;
    }

    public function poll(): ?Poll
    {
        return $this->poll;
    }

    public function pollAnswer(): ?PollAnswer
    {
        return $this->pollAnswer;
    }
}