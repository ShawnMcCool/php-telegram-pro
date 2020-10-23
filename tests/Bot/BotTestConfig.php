<?php namespace Tests\Bot;

use Exception;
use TelegramPro\Bot\Types\Latitude;
use TelegramPro\Bot\Types\Longitude;
use TelegramPro\Bot\Methods\Types\ChatId;

final class BotTestConfig
{
    private string $token;
    private ChatId $supergroupChatId;
    private ChatId $groupChatId;
    private ChatId $wrongGroupId;
    private ?Latitude $latitude;
    private ?Longitude $longitude;
    private RangeCycle $validGroupCycle;

    private function __construct(
        string $token,
        ChatId $supergroupChatId,
        ChatId $groupChatId,
        ChatId $wrongGroupId
    ) {
        $this->token = $token;
        $this->supergroupChatId = $supergroupChatId;
        $this->groupChatId = $groupChatId;
        $this->wrongGroupId = $wrongGroupId;
        $this->latitude = Latitude::fromFloat(50.010083);
        $this->longitude = Longitude::fromFloat(-110.113006);
        $this->validGroupCycle = new RangeCycle([$supergroupChatId, $groupChatId]);
    }

    public function token(): string
    {
        return $this->token;
    }

    public function supergroupChatId(): ChatId
    {
        return $this->supergroupChatId;
    }

    public function groupChatId(): ChatId
    {
        return $this->groupChatId;
    }

    public function wrongGroupId(): ChatId
    {
        return $this->wrongGroupId;
    }

    public function validGroup(): ChatId
    {
        return $this->validGroupCycle->next();
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
            ChatId::fromInt($config->supergroupChatId),
            ChatId::fromInt($config->groupChatId),
            ChatId::fromInt($config->wrongChatId)
        );
    }
}