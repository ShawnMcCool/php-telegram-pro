<?php namespace TelegramPro\Types;

final class InlineKeyboardButton
{
    private string $text;
    private ?Url $url;
    private ?LoginUrl $loginUrl;
    private ?string $callbackData;
    private ?string $switchInlineQuery;
    private ?string $switchInlineQueryCurrentChat;
    private ?CallbackGame $callbackGame;
    private ?bool $pay;

    public function __construct(
        string $text,
        ?Url $url,
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

    public static function fromApi($inlineKeyboardButton): InlineKeyboardButton
    {
        return new static(
            $inlineKeyboardButton->text,
            Url::fromString($inlineKeyboardButton->url ?? null),
            LoginUrl::fromApi($inlineKeyboardButton->login_url ?? null),
            $inlineKeyboardButton->callback_data,
            $inlineKeyboardButton->switch_inline_queries,
            $inlineKeyboardButton->switch_inline_query_current_chat,
            CallbackGame::fromApi($inlineKeyboardButton->callback_game ?? null),
            $inlineKeyboardButton->pay
        );
    }
}