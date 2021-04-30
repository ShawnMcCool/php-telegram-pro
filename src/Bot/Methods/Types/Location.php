<?php namespace TelegramPro\Bot\Methods\Types;

/**
 * This object represents a point on the map.
 */
final class Location implements ApiReadType
{

    public function __construct(
        private float $longitude,
        private float $latitude
    ) {
    }

    /**
     * @inheritDoc
     */
    public static function fromApi($location): ?static
    {
        if ( ! $location) return null;

        return new static(
            $location->longitude,
            $location->latitude
        );
    }

    /**
     * Longitude as defined by sender
     */
    public function longitude(): float
    {
        return $this->longitude;
    }

    /**
     * Latitude as defined by sender
     */
    public function latitude(): float
    {
        return $this->latitude;
    }
}