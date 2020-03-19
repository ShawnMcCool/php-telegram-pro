<?php namespace TelegramPro\Types;

final class User
{
    private int $userId;
    private ?bool $isBot;
    private string $firstName;
    private ?string $lastName;
    private ?string $username;
    private ?string $languageCode;
    private ?bool $canJoinGroups;
    private ?bool $canReadAllGroupMessages;
    private ?bool $supportsInlineQueries;

    private function __construct(
        int $userId,
        ?bool $isBot,
        string $firstName,
        ?string $lastName,
        ?string $username,
        ?string $languageCode,
        ?bool $canJoinGroups,
        ?bool $canReadAllGroupMessages,
        ?bool $supportsInlineQueries
    ) {
        $this->userId = $userId;
        $this->isBot = $isBot;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->languageCode = $languageCode;
        $this->canJoinGroups = $canJoinGroups;
        $this->canReadAllGroupMessages = $canReadAllGroupMessages;
        $this->supportsInlineQueries = $supportsInlineQueries;
    }

    public static function fromApi($user): ?User
    {
        if ( ! $user) return null;

        return new static(
            $user->id,
            $user->is_bot ?? null,
            $user->first_name,
            $user->last_name ?? null,
            $user->username ?? null,
            $user->language_code ?? null,
            $user->can_join_groups ?? null,
            $user->can_read_all_group_messages ?? null,
            $user->supports_inline_queries ?? null
        );
    }

    public static function arrayfromApi(?array $newChatMembers): ?array
    {
        if ( ! $newChatMembers) return null;

        $newChatMemberArray = [];

        foreach ($newChatMembers as $newChatMember) {
            $newChatMemberArray[] = User::fromApi($newChatMember);
        }

        return $newChatMemberArray;
    }

    public function userId(): int
    {
        return $this->userId;
    }

    public function isBot(): ?bool
    {
        return $this->isBot;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): ?string
    {
        return $this->lastName;
    }

    public function username(): ?string
    {
        return $this->username;
    }

    public function languageCode(): ?string
    {
        return $this->languageCode;
    }

    public function canJoinGroups(): ?bool
    {
        return $this->canJoinGroups;
    }

    public function canReadAllGroupMessages(): ?bool
    {
        return $this->canReadAllGroupMessages;
    }

    public function supportsInlineQueries(): ?bool
    {
        return $this->supportsInlineQueries;
    }
}