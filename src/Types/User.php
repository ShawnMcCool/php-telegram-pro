<?php namespace TelegramPro\Types;

final class User
***REMOVED***
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
    ) ***REMOVED***
        $this->userId = $userId;
        $this->isBot = $isBot;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->languageCode = $languageCode;
        $this->canJoinGroups = $canJoinGroups;
        $this->canReadAllGroupMessages = $canReadAllGroupMessages;
        $this->supportsInlineQueries = $supportsInlineQueries;
    ***REMOVED***

    public static function fromApi($user): ?User
    ***REMOVED***
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
    ***REMOVED***

    public static function arrayfromApi(?array $newChatMembers): ?array
    ***REMOVED***
        if ( ! $newChatMembers) return null;

        $newChatMemberArray = [];

        foreach ($newChatMembers as $newChatMember) ***REMOVED***
            $newChatMemberArray[] = User::fromApi($newChatMember);
        ***REMOVED***

        return $newChatMemberArray;
    ***REMOVED***

    public function userId(): int
    ***REMOVED***
        return $this->userId;
    ***REMOVED***

    public function isBot(): ?bool
    ***REMOVED***
        return $this->isBot;
    ***REMOVED***

    public function firstName(): string
    ***REMOVED***
        return $this->firstName;
    ***REMOVED***

    public function lastName(): ?string
    ***REMOVED***
        return $this->lastName;
    ***REMOVED***

    public function username(): ?string
    ***REMOVED***
        return $this->username;
    ***REMOVED***

    public function languageCode(): ?string
    ***REMOVED***
        return $this->languageCode;
    ***REMOVED***

    public function canJoinGroups(): ?bool
    ***REMOVED***
        return $this->canJoinGroups;
    ***REMOVED***

    public function canReadAllGroupMessages(): ?bool
    ***REMOVED***
        return $this->canReadAllGroupMessages;
    ***REMOVED***

    public function supportsInlineQueries(): ?bool
    ***REMOVED***
        return $this->supportsInlineQueries;
    ***REMOVED***
***REMOVED***