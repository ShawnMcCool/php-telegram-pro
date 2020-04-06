<?php namespace TelegramPro\Types;

/**
 * This object represents a game. Use BotFather to create and edit games, their short names will act as unique identifiers.
 */
final class Game implements ApiReadType
{
    private string $title;
    private string $description;
    private ArrayOfPhotoSizes $photos;
    private ?string $text;
    private ArrayOfMessageEntities $textEntities;
    private ?Animation $animation;

    private function __construct(
        string $title,
        string $description,
        ArrayOfPhotoSizes $photos,
        ?string $text,
        ArrayOfMessageEntities $textEntities,
        ?Animation $animation
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->photos = $photos;
        $this->text = $text;
        $this->textEntities = $textEntities;
        $this->animation = $animation;
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($game): ?Game
    {
        if ( ! $game) return null;

        return new static(
            $game->title,
            $game->description,
            ArrayOfPhotoSizes::fromApi($game->photos),
            $game->text,
            ArrayOfMessageEntities::fromApi($game->text_entities),
            Animation::fromApi($game->animation)
        );
    }

    /**
     * Title of the game
     */
    public function title(): string
    {
        return $this->title;
    }

    /**
     * 	Description of the game
     */
    public function description(): string
    {
        return $this->description;
    }

    /**
     * Photo that will be displayed in the game message in chats.
     */
    public function photos(): ArrayOfPhotoSizes
    {
        return $this->photos;
    }

    /**
     * Optional. Brief description of the game or high scores included in the game message. Can be automatically edited to include current high scores for the game when the bot calls setGameScore, or manually edited using editMessageText. 0-4096 characters.
     */
    public function text(): ?string
    {
        return $this->text;
    }

    /**
     * Optional. Special entities that appear in text, such as usernames, URLs, bot commands, etc.
     */
    public function textEntities(): ArrayOfMessageEntities
    {
        return $this->textEntities;
    }

    /**
     *	Optional. Animation that will be displayed in the game message in chats. Upload via BotFather
     */
    public function animation(): ?Animation
    {
        return $this->animation;
    }
}