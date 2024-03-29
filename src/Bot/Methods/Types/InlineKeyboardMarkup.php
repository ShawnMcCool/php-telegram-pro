<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\Bot\Types\ArrayOfInlineKeyboardRows;

/**
 * This object represents an inline keyboard that appears right next to the message it belongs to.
 * Note: This will only work in Telegram versions released after 9 April, 2016. Older clients will display unsupported message.
 */
final class InlineKeyboardMarkup implements ApiReadType
{

    public function __construct(
        private ArrayOfInlineKeyboardRows $inlineKeyboard
    ) {
    }

    /**
     * Array of button rows, each represented by an Array of InlineKeyboardButton objects
     */
    public function inlineKeyboard(): ArrayOfInlineKeyboardRows
    {
        return $this->inlineKeyboard;
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($replyMarkup): ?static
    {
        if ( ! $replyMarkup) return null;

        return new static(
            ArrayOfInlineKeyboardRows::fromApi($replyMarkup->inline_keyboard ?? null)
        );
    }
}