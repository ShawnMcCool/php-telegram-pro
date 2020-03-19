<?php namespace TelegramPro\Types;

final class Venue
{
    private Location $location;
    private string $title;
    private string $address;
    private ?string $foursquareId;
    private ?string $foursquareType;

    public function __construct(
        Location $location,
        string $title,
        string $address,
        ?string $foursquareId,
        ?string $foursquareType
    ) {
        $this->location = $location;
        $this->title = $title;
        $this->address = $address;
        $this->foursquareId = $foursquareId;
        $this->foursquareType = $foursquareType;
    }

    public static function fromApi($venue): ?Venue
    {
        if ( ! $venue) return null;

        return new static(
            Location::fromApi($venue->location),
            $venue->title,
            $venue->address,
            $venue->foursquare_id,
            $venue->foursquare_type
        );
    }
}