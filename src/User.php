<?php namespace TelegramPro;

final class User
***REMOVED***
    private int $userId;
    private bool $isBot;
    private string $firstName;
    private ?string $lastName;
    private ?string $username;
    private ?string $languageCode;
    private ?bool $canJoinGroups;
    private ?bool $canReadAllGroupMessages;
    private ?bool $supportsInlineQueries;

    private function __construct(
        int $userId,
        bool $isBot,
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

    public static function fromRequest($user): ?User
    ***REMOVED***
        if ( ! $user) return null;

        return new static(
            $user->id,
            $user->is_bot,
            $user->first_name,
            $user->last_name,
            $user->username,
            $user->language_code,
            $user->can_join_groups,
            $user->can_read_all_group_messages,
            $user->supports_inline_queries
        );
    ***REMOVED***

    public static function arrayFromRequest(?array $newChatMembers): ?array
    ***REMOVED***
        if ( ! $newChatMembers) return null;

        $newChatMemberArray = [];

        foreach ($newChatMembers as $newChatMember) ***REMOVED***
            $newChatMemberArray[] = User::fromRequest($newChatMember);
        ***REMOVED***

        return $newChatMemberArray;
    ***REMOVED***
***REMOVED***