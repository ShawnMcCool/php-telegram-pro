<?php namespace TelegramPro\Types;

final class Location
{
    private float $longitude;
    private float $latitude;

    public function __construct(
        float $longitude,
        float $latitude
    ) {
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }

    public static function fromApi($location): ?Location
    {
        if ( ! $location) return null;

        return new static(
            $location->longitude,
            $location->latitude
        );
    }
}