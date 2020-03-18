<?php namespace TelegramPro;

final class Game
***REMOVED***
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
    ) ***REMOVED***
        $this->title = $title;
        $this->description = $description;
        $this->photos = $photos;
        $this->text = $text;
        $this->textEntities = $textEntities;
        $this->animation = $animation;
    ***REMOVED***

    public static function fromRequest($game): ?Game
    ***REMOVED***
        if ( ! $game) return null;

        return new static(
            $game->title,
            $game->description,
            PhotoSize::arrayFromRequest($game->photos),
            $game->text,
            MessageEntity::arrayFromRequest($game->text_entities),
            Animation::fromRequest($game->animation)
        );
    ***REMOVED***
***REMOVED***