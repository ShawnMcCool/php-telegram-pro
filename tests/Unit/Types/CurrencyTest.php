<?php namespace Tests\Unit\Types;

use Tests\TelegramTestCase;
use TelegramPro\Methods\Types\Currency;
use TelegramPro\Methods\Types\CurrencyIsNotSupported;

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
