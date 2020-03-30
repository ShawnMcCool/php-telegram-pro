<?php namespace TelegramPro\Types;

/**
 * Optional. Data associated with the callback button. Be aware that a bad client can send arbitrary data in this field.
 */
final class CallbackData
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

    public static function fromApi(?string $data): ?self
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