<?php namespace TelegramPro\Bot\Types;

/**
 * This object represents a point on the map.
 */
final class Location implements ApiReadType
{
    private float $longitude;
    private float $latitude;

    private function __construct(
        float $longitude,
        float $latitude
    ) {
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }

    /**
     * @inheritDoc
     */
    public static function fromApi($location): ?Location
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