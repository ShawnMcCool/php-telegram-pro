<?php namespace Tests\Api;

use Exception;
use TelegramPro\Types\ChatId;

final class BotTestConfig
{
    private string $token;
    private ChatId $chatId;
    private ChatId $wrongGroupId;

    private function __construct(
        string $token,
        ChatId $chatId,
        ChatId $wrongGroupId
    ) {
        $this->token = $token;
        $this->chatId = $chatId;
        $this->wrongGroupId = $wrongGroupId;
    }

    public function token(): string
    {
        return $this->token;
    }

    public function chatId(): ChatId
    {
        return $this->chatId;
    }

    public function wrongGroupId(): ChatId
    {
        return $this->wrongGroupId;
    }

    public static function fromConfigFile($filePath): BotTestConfig
    {
        if ( ! file_exists($filePath)) {
            throw new Exception('Can not perform api tests without a valid .bot-test-config file');
        }

        $config = json_decode(trim(file_get_contents($filePath)));

        return new static(
            $config->token,
            ChatId::fromInt($config->chatId),
            ChatId::fromInt($config->wrongChatId)
        );
    }
}