<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\Bot\Types\UserId;
use TelegramPro\Bot\Types\SpokenLanguage;

/**
 * This object represents a Telegram user or bot.
 * https://core.telegram.org/bots/api#user
 */
final class User implements ApiReadType
{
    private function __construct(
        private UserId $userId,
        private ?bool $isBot,
        private string $firstName,
        private ?string $lastName,
        private ?string $username,
        private ?SpokenLanguage $languageCode,
        private ?bool $canJoinGroups,
        private ?bool $canReadAllGroupMessages,
        private ?bool $supportsInlineQueries
    ) {
    }

    /**
     * Unique identifier for this user or bot
     */
    public function userId(): UserId
    {
        return $this->userId;
    }

    /**
     * True, if this user is a bot
     */
    public function isBot(): ?bool
    {
        return $this->isBot;
    }

    /**
     * User‘s or bot’s first name
     */
    public function firstName(): string
    {
        return $this->firstName;
    }

    /**
     * Optional. User‘s or bot’s last name
     */
    public function lastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * Optional. User‘s or bot’s username
     */
    public function username(): ?string
    {
        return $this->username;
    }

    /**
     * Optional. IETF language tag of the user's language
     */
    public function languageCode(): ?SpokenLanguage
    {
        return $this->languageCode;
    }

    /**
     * Optional. True, if the bot can be invited to groups. Returned only in getMe.
     */
    public function canJoinGroups(): ?bool
    {
        return $this->canJoinGroups;
    }

    /**
     * Optional. True, if privacy mode is disabled for the bot. Returned only in getMe.
     */
    public function canReadAllGroupMessages(): ?bool
    {
        return $this->canReadAllGroupMessages;
    }

    /**
     * Optional. True, if the bot supports inline queries. Returned only in getMe.
     */
    public function supportsInlineQueries(): ?bool
    {
        return $this->supportsInlineQueries;
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($user): ?static
    {
        if ( ! $user) return null;

        return new static(
            UserId::fromInt($user->id),
            $user->is_bot ?? null,
            $user->first_name,
            $user->last_name ?? null,
            $user->username ?? null,
            SpokenLanguage::fromApi($user->language_code ?? null),
            $user->can_join_groups ?? null,
            $user->can_read_all_group_messages ?? null,
            $user->supports_inline_queries ?? null
        );
    }
}