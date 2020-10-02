<?php namespace TelegramPro\Bot\Methods\Keyboards;

use TelegramPro\Bot\Types\ArrayOfInlineKeyboardRows;

/**
 * This object represents a custom keyboard with reply options (see Introduction to bots for details and examples).
 */
final class ReplyKeyboardMarkup implements ReplyMarkup
{
    private ArrayOfInlineKeyboardRows $keyboard;
    private ?bool $resizeKeyboard;
    private ?bool $oneTimeKeyboard;
    private ?bool $selective;

    public function __construct(
        ArrayOfInlineKeyboardRows $keyboard,
        ?bool $resizeKeyboard,
        ?bool $oneTimeKeyboard,
        ?bool $selective
    ) {
        $this->keyboard = $keyboard;
        $this->resizeKeyboard = $resizeKeyboard;
        $this->oneTimeKeyboard = $oneTimeKeyboard;
        $this->selective = $selective;
    }

    /**
     * Array of button rows, each represented by an Array of KeyboardButton objects
     */
    public function keyboard(): ArrayOfInlineKeyboardRows
    {
        return $this->keyboard;
    }

    /**
     * Optional. Requests clients to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if there are just two rows of buttons). Defaults to false, in which case the custom keyboard is always of the same height as the app's standard keyboard.
     */
    public function resizeKeyboard(): ?bool
    {
        return $this->resizeKeyboard;
    }

    /**
     * Optional. Requests clients to hide the keyboard as soon as it's been used. The keyboard will still be available, but clients will automatically display the usual letter-keyboard in the chat – the user can press a special button in the input field to see the custom keyboard again. Defaults to false.
     */
    public function oneTimeKeyboard(): ?bool
    {
        return $this->oneTimeKeyboard;
    }

    /**
     * Optional. Use this parameter if you want to show the keyboard to specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     * Example: A user requests to change the bot‘s language, bot replies to the request with a keyboard to select the new language. Other users in the group don’t see the keyboard.
     */
    public function selective(): ?bool
    {
        return $this->selective;
    }
    
    function toParameter(): ArrayOfInlineKeyboardRows
    {
        return $this->keyboard;
    }
}