<?php namespace Tests\Bot\Methods\Types;

use TelegramPro\Bot\Methods\Types\ParseMode;
use PHPUnit\Framework\TestCase;

class ParseModeTest extends TestCase
{
    function testCanEscapeMarkdownV2Strings() {
        $markdownV2 = ParseMode::markdown();
        
        self::assertSame(
            'This\-is\-text\.',
            $markdownV2->escapeText('This-is-text.')
        );
    }
}
