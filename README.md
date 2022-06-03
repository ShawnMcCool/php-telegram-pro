# PHP Telegram Pro

This is a decently written PHP Telegram client library. It's not 100% complete, but it's complete enough for most use-cases.

[Look at Real Usage Examples](https://github.com/ShawnMcCool/php-telegram-pro/tree/master/tests/Bot/Methods)

Requires php8.1-dom and php8.1-curl.

## Virtual Machine

Install vagrant and virtualbox, then `vagrant up`.  

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