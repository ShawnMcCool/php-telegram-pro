<?php namespace TelegramPro\Types;

/**
 * Optional. Data associated with the callback button. Be aware that a bad client can send arbitrary data in this field.
 */
final class CallbackData implements ApiReadType
{
    private string $data;

    private function __construct(string $data)
    {
        $this->data = $data;
    }

    public function toString(): string
    {
        return $this->data;
    }

    public function __toString()
    {
        return $this->toString();
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($data): ?self
    {
        if (is_null($data)) {
            return null;
        }

        if (strlen($data) > 4096) {
            throw new CallbackDataIsTooLarge("Callback data '{$data}' can not be longer than 64 bytes.");
        }

        return new static($data);
    }
}