<?php namespace TelegramPro;

final class Venue
***REMOVED***
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
    ) ***REMOVED***
        $this->location = $location;
        $this->title = $title;
        $this->address = $address;
        $this->foursquareId = $foursquareId;
        $this->foursquareType = $foursquareType;
    ***REMOVED***

    public static function fromRequest($venue): ?Venue
    ***REMOVED***
        if ( ! $venue) return null;

        return new static(
            Location::fromRequest($venue->location),
            $venue->title,
            $venue->address,
            $venue->foursquare_id,
            $venue->foursquare_type
        );
    ***REMOVED***
***REMOVED***