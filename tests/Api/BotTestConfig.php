<?php namespace Tests\Api;

use Exception;

final class BotTestConfig
{
    private string $token;
    private int $groupId;
    private int $wrongGroupId;

    private function __construct(
        string $token,
        int $groupId,
    int $wrongGroupId
    ) {
        $this->token = $token;
        $this->groupId = $groupId;
        $this->wrongGroupId = $wrongGroupId;
    }

    public static function fromConfigFile($filePath): BotTestConfig
    {
        if ( ! file_exists($filePath)) {
            throw new Exception('Can not perform api tests without a valid .bot-test-config file');
        }

        $config = json_decode(trim(file_get_contents($filePath)));

        return new static(
            $config->token,
            $config->groupId,
            $config->wrongGroupId
        );
    }

    public function token(): string
    {
        return $this->token;
    }

    public function groupId(): int
    {
        return $this->groupId;
    }

    public function wrongGroupId(): int
    {
        return $this->wrongGroupId;
    }
}