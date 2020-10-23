<?php namespace Tests\Bot;

use Exception;
use TelegramPro\Bot\Types\Latitude;
use TelegramPro\Bot\Types\Longitude;
use TelegramPro\Bot\Methods\Types\ChatId;

final class BotTestConfig
{
    private string $token;
    private array $groupChatIds;
    private array $supergroupChatIds;
    private ChatId $wrongGroupId;
    private ?Latitude $latitude;
    private ?Longitude $longitude;
    private RangeCycle $validGroupCycle;

    private function __construct(
        string $token,
        array $groupChatIds,
        array $supergroupChatIds,
        ChatId $wrongGroupId
    ) {
        $this->token = $token;
        $this->groupChatIds = $groupChatIds;
        $this->supergroupChatIds = $supergroupChatIds;
        $this->wrongGroupId = $wrongGroupId;
        $this->latitude = Latitude::fromFloat(50.010083);
        $this->longitude = Longitude::fromFloat(-110.113006);
        $this->validGroupCycle = new RangeCycle(array_merge($this->groupChatIds, $this->supergroupChatIds));
    }

    public function token(): string
    {
        return $this->token;
    }

    public function supergroupChatIds(): array
    {
        return $this->supergroupChatIds;
    }

    public function groupChatIds(): array
    {
        return $this->groupChatIds;
    }

    public function wrongGroupId(): ChatId
    {
        return $this->wrongGroupId;
    }

    public function latitude(): ?Latitude
    {
        return $this->latitude;
    }

    public function cyclingChatId(): ChatId
    {
        return $this->validGroupCycle->next();
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
            array_map(
                fn($chatId) => ChatId::fromInt($chatId),
                $config->groupChatIds
            ),
            array_map(
                fn($chatId) => ChatId::fromInt($chatId),
                $config->supergroupChatIds
            ),
            ChatId::fromInt($config->wrongChatId)
        );
    }
}