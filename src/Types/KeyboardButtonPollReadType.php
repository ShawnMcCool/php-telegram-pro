<?php namespace TelegramPro\Types;

use Exception;

/**
 * This object represents type of a poll, which is allowed to be created and sent when the corresponding button is pressed.
 */
final class KeyboardButtonPollReadType implements ApiReadType
{
    private string $type;

    public function __construct(
        string $type
    ) {
        $this->type = $type;
    }

    /**
     * Optional. If quiz is passed, the user will be allowed to create only polls in the quiz mode. If regular is passed, only regular polls will be allowed. Otherwise, the user will be allowed to create a poll of any type.
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * @inheritDoc
     */
    public static function fromApi($data): ?self
    {
        throw new Exception('not implemented');
    }
}