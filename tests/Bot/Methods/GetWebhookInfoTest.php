<?php

namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\GetWebhookInfo;
use TelegramPro\Bot\Methods\Types\WebhookInfo;

class GetWebhookInfoTest extends TelegramTestCase
{
    function testCanWebhookInfo()
    {
        $response = GetWebhookInfo::parameters()
                                  ->send($this->telegram);

        $this->isOk($response);

        self::assertInstanceOf(WebhookInfo::class, $response->webhookInfo());
    }
}