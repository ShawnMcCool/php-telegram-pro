# PHP Telegram Pro

This is a decently written PHP Telegram client library. It's not 100% complete, but it's complete enough for most use-cases. The library keeps you from doing dumb stuff like sending invalid files, messages that are too long, etc. The Telegram API specifications are built into the value-objects.

Perhaps most importantly, all methods have carefully typed method signatures, preventing ant ambiguity over how to use the code, and all API methods return unique response objects.

That's right, no more magic method / string oriented garbage fire.

Look at Usage Examples:
- [SendMessage](tests/Bot/Methods/SendMessageTest.php)
- [All Methods](tests/Bot/Methods)

Requires php8.1-dom and php8.1-curl.

## Usage

Usage is straight-forward.

```php
$telegram = TelegramHttpRequest::botToken('botToken');

SendMessage::parameters(
    ChatId::fromInt(-1293813),
    MessageText::fromString('Hey everyone!')
)->send($telegram);
```

Want to use a rate-limiter so that you can send messages as fast as you'd like and know that they'll be delivered?

```php
$telegram = TelegramHttpRequest::botToken('botToken');

$rateLimitedTelegram = new BlockingRateLimiter($telegram);

SendMessage::parameters(
    ChatId::fromInt(-1293813),
    MessageText::fromString('Hey everyone!')
)->send($rateLimitedTelegram);
```

## Tests

To run the tests, run `composer install`, create a `.bot-test-config` in the main repository directory, and fill in the necessary details:

```json
{
    "token": "numbers:otherstuff",
    "groupChatIds": [-12312312331, -234234234],
    "supergroupChatIds": [-1567657657567657],
    "wrongChatId": -456456456
}
```

- token is your bot token
- groupChatIds is an array of group chats that your bot is in, use one or more
- supergroupChatIds is an array of supergroup chats that your bot is in, use one or more
- wrongChatId is a valid chat id, that your bot is NOT in

run: `bin/phpunit` to run the test suite
