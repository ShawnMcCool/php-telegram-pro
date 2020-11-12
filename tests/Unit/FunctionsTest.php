<?php namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

final class FunctionsTest extends TestCase
{
    function testRegexHasUnmatchingCharacters()
    {
        self::assertFalse(
            \TelegramPro\regex\has_unmatched_characters('a-zA-Z0-9_\s', 'aoe')
        );
        
        self::assertTrue(
            \TelegramPro\regex\has_unmatched_characters('a-zA-Z0-9_\s', '!')
        );
    }
}