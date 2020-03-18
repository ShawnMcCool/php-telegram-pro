<?php namespace TelegramPro;

final class InlineKeyboardButton
***REMOVED***
    private string $text;
    private ?string $url;
    private ?LoginUrl $loginUrl;
    private ?string $callbackData;
    private ?string $switchInlineQuery;
    private ?string $switchInlineQueryCurrentChat;
    private ?CallbackGame $callbackGame;
    private ?bool $pay;

    public function __construct(
        string $text,
        ?string $url,
        ?LoginUrl $loginUrl,
        ?string $callbackData,
        ?string $switchInlineQuery,
        ?string $switchInlineQueryCurrentChat,
        ?CallbackGame $callbackGame,
        ?bool $pay
    ) ***REMOVED***
        $this->text = $text;
        $this->url = $url;
        $this->loginUrl = $loginUrl;
        $this->callbackData = $callbackData;
        $this->switchInlineQuery = $switchInlineQuery;
        $this->switchInlineQueryCurrentChat = $switchInlineQueryCurrentChat;
        $this->callbackGame = $callbackGame;
        $this->pay = $pay;
    ***REMOVED***

    public static function arrayOfArraysFromRequest(?array $inlineKeyboard): ?array
    ***REMOVED***
        if ( ! $inlineKeyboard) return null;

        $keyboardRowArray = [];

        foreach ($inlineKeyboard as $inlineKeyboardRows) ***REMOVED***
            $keyboardRowArray[] = static::arrayFromRequest($inlineKeyboardRows);
        ***REMOVED***

        return $keyboardRowArray;
    ***REMOVED***

    private static function arrayFromRequest(?array $inlineKeyboardButtons): ?array
    ***REMOVED***
        if ( ! $inlineKeyboardButtons) return null;

        $buttonArray = [];

        foreach ($inlineKeyboardButtons as $inlineKeyboardButton) ***REMOVED***
            $buttonArray[] = InlineKeyboardButton::fromRequest($inlineKeyboardButton);
        ***REMOVED***

        return $buttonArray;
    ***REMOVED***

    private static function fromRequest($inlineKeyboardButton): InlineKeyboardButton
    ***REMOVED***
        return new static(
            $inlineKeyboardButton->text,
            $inlineKeyboardButton->url,
            LoginUrl::fromRequest($inlineKeyboardButton->login_url),
            $inlineKeyboardButton->callback_data,
            $inlineKeyboardButton->switch_inline_queries,
            $inlineKeyboardButton->switch_inline_query_current_chat,
            CallbackGame::fromRequest($inlineKeyboardButton->callback_game),
            $inlineKeyboardButton->pay
        );
    ***REMOVED***
***REMOVED***