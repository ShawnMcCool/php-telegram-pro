<?php namespace TelegramPro;

final class Update
***REMOVED***
    private UpdateId $updateId;
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
        UpdateId $updateId,
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
            Message::fromRequest($update->message),
            Message::fromRequest($update->edited_message),
            Message::fromRequest($update->channel_post),
            Message::fromRequest($update->edited_channel_post),
            InlineQuery::fromRequest($update->inline_query),
            ChosenInlineResult::fromRequest($update->chosen_inline_result),
            CallbackQuery::fromRequest($update->callback_query),
            ShippingQuery::fromRequest($update->shipping_query),
            PreCheckoutQuery::fromRequest($update->pre_checkout_query),
            Poll::fromRequest($update->poll),
            PollAnswer::fromRequest($update->poll_answer)
        );
    ***REMOVED***
***REMOVED***