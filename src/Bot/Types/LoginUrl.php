<?php namespace TelegramPro\Bot\Types;

/**
 * This object represents a parameter of the inline keyboard button used to automatically authorize a user. Serves as a great replacement for the Telegram Login Widget when the user is coming from Telegram. All the user needs to do is tap/click a button and confirm that they want to log in:
 * Telegram apps support these buttons as of version 5.7.
 * Sample bot: @discussbot
 */
final class LoginUrl implements ApiReadType
{
    private Url $url;
    private ?string $forwardText;
    private ?string $botUsername;
    private ?bool $requestWriteAccess;

    private function __construct(
        Url $url,
        ?string $forwardText,
        ?string $botUsername,
        ?bool $requestWriteAccess
    ) {
        $this->url = $url;
        $this->forwardText = $forwardText;
        $this->botUsername = $botUsername;
        $this->requestWriteAccess = $requestWriteAccess;
    }

    /**
     * @inheritDoc
     */
    public static function fromApi($loginUrl): ?LoginUrl
    {
        if ( ! $loginUrl) return null;

        return new static(
            Url::fromString($loginUrl->url),
            $loginUrl->forward_text,
            $loginUrl->bot_username,
            $loginUrl->request_write_access,
        );
    }

    /**
     * An HTTP URL to be opened with user authorization data added to the query string when the button is pressed. If the user refuses to provide authorization data, the original URL without information about the user will be opened. The data added is the same as described in Receiving authorization data.
     * NOTE: You must always check the hash of the received data to verify the authentication and the integrity of the data as described in Checking authorization.
     */
    public function url(): Url
    {
        return $this->url;
    }

    /**
     * Optional. New text of the button in forwarded messages.
     */
    public function forwardText(): ?string
    {
        return $this->forwardText;
    }

    /**
     * Optional. Username of a bot, which will be used for user authorization. See Setting up a bot for more details. If not specified, the current bot's username will be assumed. The url's domain must be the same as the domain linked with the bot. See Linking your domain to the bot for more details.
     */
    public function botUsername(): ?string
    {
        return $this->botUsername;
    }

    /**
     * Optional. Pass True to request the permission for your bot to send messages to the user.
     */
    public function requestWriteAccess(): ?bool
    {
        return $this->requestWriteAccess;
    }
}