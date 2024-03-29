<?php namespace TelegramPro\Bot\Methods\Types;

/**
 * This object represents a venue.
 */
final class Venue implements ApiReadType
{
    private function __construct(
        private Location $location,
        private string $title,
        private string $address,
        private ?string $foursquareId,
        private ?string $foursquareType
    ) {
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($venue): ?static
    {
        if ( ! $venue) return null;

        return new static(
            Location::fromApi($venue->location),
            $venue->title,
            $venue->address,
            $venue->foursquare_id ?? null,
            $venue->foursquare_type ?? null
        );
    }

    /**
     * Venue location
     */
    public function location(): Location
    {
        return $this->location;
    }

    /**
     * Name of the venue
     */
    public function title(): string
    {
        return $this->title;
    }

    /**
     * Address of the venue
     */
    public function address(): string
    {
        return $this->address;
    }

    /**
     * Optional. Foursquare identifier of the venue
     */
    public function foursquareId(): ?string
    {
        return $this->foursquareId;
    }

    /**
     * Optional. Foursquare type of the venue. (For example, “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.)
     */
    public function foursquareType(): ?string
    {
        return $this->foursquareType;
    }
}