<?php namespace TelegramPro\Types;

final class Game
{
    private string $title;
    private string $description;
    private array $photos;
    private ?string $text;
    private array $textEntities;
    private ?Animation $animation;

    public function __construct(
        string $title,
        string $description,
        array $photos, // of PhotoSize objects
        ?string $text,
        array $textEntities, // of MessageEntity
        ?Animation $animation
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->photos = $photos;
        $this->text = $text;
        $this->textEntities = $textEntities;
        $this->animation = $animation;
    }

    public static function fromApi($game): ?Game
    {
        if ( ! $game) return null;

        return new static(
            $game->title,
            $game->description,
            PhotoSize::arrayfromApi($game->photos),
            $game->text,
            MessageEntity::arrayfromApi($game->text_entities),
            Animation::fromApi($game->animation)
        );
    }
}