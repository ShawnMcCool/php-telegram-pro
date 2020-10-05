<?php namespace Tests\Bot;

use Exception;
use TelegramPro\Bot\Types\ChatId;
use TelegramPro\Bot\Types\Latitude;
use TelegramPro\Bot\Types\Longitude;

final class BotTestConfig
{
    private string $token;
    private ChatId $chatId;
    private ChatId $wrongGroupId;
    private ?Latitude $latitude;
    private ?Longitude $longitude;

    private function __construct(
        string $token,
        ChatId $chatId,
        ChatId $wrongGroupId
    ) {
        $this->token = $token;
        $this->chatId = $chatId;
        $this->wrongGroupId = $wrongGroupId;
        $this->latitude = Latitude::fromFloat(50.010083);
        $this->longitude = Longitude::fromFloat(-110.113006);
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

    public function latitude(): ?Latitude
    {
        return $this->latitude;
    }

    public function longitude(): ?Longitude
    {
        return $this->longitude;
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