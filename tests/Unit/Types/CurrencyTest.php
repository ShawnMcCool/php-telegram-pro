<?php namespace Tests\Unit\Types;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\Types\Currency;
use TelegramPro\Bot\Methods\Types\CurrencyIsNotSupported;

class CurrencyTest extends TelegramTestCase
{
    function testCanMakeValidCurrency()
    {
        $currency = Currency::fromString('EUR');
        
        self::assertInstanceOf(Currency::class, $currency);
        self::assertSame('EUR', $currency->toString());
    }

    function testCanThrowOnBadCurrency()
    {
        $this->expectException(CurrencyIsNotSupported::class);
        Currency::fromString('SMORF');
    }
}
