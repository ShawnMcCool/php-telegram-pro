<?php namespace Tests\Unit\Types;

use Tests\TelegramTestCase;
use TelegramPro\Types\Currency;
use TelegramPro\Types\CurrencyIsNotSupported;

class CurrencyTest extends TelegramTestCase
{
    function testCanMakeValidCurrency()
    {
        $currency = Currency::fromApi('EUR');
        
        self::assertInstanceOf(Currency::class, $currency);
        self::assertSame('EUR', $currency->toString());
    }

    function testCanThrowOnBadCurrency()
    {
        $this->expectException(CurrencyIsNotSupported::class);
        Currency::fromApi('SMORF');
    }
}
