<?php namespace TelegramPro\Bot\Methods\Keyboards;

use TelegramPro\Bot\Types\LoginUrl;
use TelegramPro\Bot\Methods\Types\Url;
use TelegramPro\Bot\Types\CallbackGame;
use TelegramPro\Bot\Methods\Types\ApiReadType;
use TelegramPro\Bot\Methods\Types\CallbackData;
use TelegramPro\Bot\Methods\Types\ApiWriteType;

/**
 * This object represents one button of an inline keyboard. You must use exactly one of the optional fields.
 */
final class InlineKeyboardButton implements ApiReadType, ApiWriteType
{

    public function __construct(
        private string $text,
        private ?Url $url = null,
        private ?LoginUrl $loginUrl = null,
        private ?CallbackData $callbackData = null,
        private ?string $switchInlineQuery = null,
        private ?string $switchInlineQueryCurrentChat = null,
        private ?CallbackGame $callbackGame = null,
        private ?bool $pay = null
    ) {
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($inlineKeyboardButton): static
    {
        return new static(
            $inlineKeyboardButton->text,
            Url::fromString($inlineKeyboardButton->url ?? null),
            LoginUrl::fromApi($inlineKeyboardButton->login_url ?? null),
            CallbackData::fromApi($inlineKeyboardButton->callback_data ?? null),
            $inlineKeyboardButton->switch_inline_queries,
            $inlineKeyboardButton->switch_inline_query_current_chat,
            CallbackGame::fromApi($inlineKeyboardButton->callback_game ?? null),
            $inlineKeyboardButton->pay
        );
    }

    /**
     *    Label text on the button
     */
    public function text(): string
    {
        return $this->text;
    }

    /**
     *    Optional. HTTP or tg:// url to be opened when button is pressed
     */
    public function url(): ?Url
    {
        return $this->url;
    }

    /**
     * Optional. An HTTP URL used to automatically authorize the user. Can be used as a replacement for the Telegram Login Widget.
     */
    public function loginUrl(): ?LoginUrl
    {
        return $this->loginUrl;
    }

    /**
     *    Optional. Data to be sent in a callback query to the bot when button is pressed, 1-64 bytes
     */
    public function callbackData(): ?string
    {
        return $this->callbackData;
    }

    /**
     * Optional. If set, pressing the button will prompt the user to select one of their chats, open that chat and insert the bot‘s username and the specified inline query in the input field. Can be empty, in which case just the bot’s username will be inserted.
     * Note: This offers an easy way for users to start using your bot in inline mode when they are currently in a private chat with it. Especially useful when combined with switch_pm… actions – in this case the user will be automatically returned to the chat they switched from, skipping the chat selection screen.
     */
    public function switchInlineQuery(): ?string
    {
        return $this->switchInlineQuery;
    }

    /**
     * Optional. If set, pressing the button will insert the bot‘s username and the specified inline query in the current chat's input field. Can be empty, in which case only the bot’s username will be inserted.
     * This offers a quick way for the user to open your bot in inline mode in the same chat – good for selecting something from multiple options.
     */
    public function switchInlineQueryCurrentChat(): ?string
    {
        return $this->switchInlineQueryCurrentChat;
    }

    /**
     * Optional. Description of the game that will be launched when the user presses the button.
     * NOTE: This type of button must always be the first button in the first row.
     */
    public function callbackGame(): ?CallbackGame
    {
        return $this->callbackGame;
    }

    /**
     * Optional. Specify True, to send a Pay button.
     * NOTE: This type of button must always be the first button in the first row.
     */
    public function pay(): ?bool
    {
        return $this->pay;
    }

    function toApi()
    {
        return [
            'text' => $this->text,
            'url' => $this->url,
            'login_url' => $this->loginUrl,
            'callback_data' => $this->callbackData,
            'switch_inline_query' => $this->switchInlineQuery,
            'switch_inline_query_current_chat' => $this->switchInlineQueryCurrentChat,
            'callback_game' => $this->callbackGame,
            'pay' => $this->pay,
        ];
    }
}