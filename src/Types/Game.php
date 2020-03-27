<?php namespace TelegramPro\Types;

final class Game
{
    private string $title;
    private string $description;
    private ArrayOfPhotoSizes $photos;
    private ?string $text;
    private ArrayOfMessageEntities $textEntities;
    private ?Animation $animation;

    public function __construct(
        string $title,
        string $description,
        ArrayOfPhotoSizes $photos,
        ?string $text,
        ArrayOfMessageEntities $textEntities, // of MessageEntity
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
            ArrayOfPhotoSizes::fromApi($game->photos),
            $game->text,
            MessageEntity::arrayFromApi($game->text_entities),
            Animation::fromApi($game->animation)
        );
    }
}