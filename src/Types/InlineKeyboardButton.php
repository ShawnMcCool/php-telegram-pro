<?php namespace TelegramPro\Types;

final class InlineKeyboardButton
{
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
    ) {
        $this->text = $text;
        $this->url = $url;
        $this->loginUrl = $loginUrl;
        $this->callbackData = $callbackData;
        $this->switchInlineQuery = $switchInlineQuery;
        $this->switchInlineQueryCurrentChat = $switchInlineQueryCurrentChat;
        $this->callbackGame = $callbackGame;
        $this->pay = $pay;
    }

    public static function arrayOfArraysfromApi(?array $inlineKeyboard): ?array
    {
        if ( ! $inlineKeyboard) return null;

        $keyboardRowArray = [];

        foreach ($inlineKeyboard as $inlineKeyboardRows) {
            $keyboardRowArray[] = static::arrayfromApi($inlineKeyboardRows);
        }

        return $keyboardRowArray;
    }

    private static function arrayfromApi(?array $inlineKeyboardButtons): ?array
    {
        if ( ! $inlineKeyboardButtons) return null;

        $buttonArray = [];

        foreach ($inlineKeyboardButtons as $inlineKeyboardButton) {
            $buttonArray[] = InlineKeyboardButton::fromApi($inlineKeyboardButton);
        }

        return $buttonArray;
    }

    private static function fromApi($inlineKeyboardButton): InlineKeyboardButton
    {
        return new static(
            $inlineKeyboardButton->text,
            $inlineKeyboardButton->url,
            LoginUrl::fromApi($inlineKeyboardButton->login_url),
            $inlineKeyboardButton->callback_data,
            $inlineKeyboardButton->switch_inline_queries,
            $inlineKeyboardButton->switch_inline_query_current_chat,
            CallbackGame::fromApi($inlineKeyboardButton->callback_game),
            $inlineKeyboardButton->pay
        );
    }
}