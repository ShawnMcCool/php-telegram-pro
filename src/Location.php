<?php namespace TelegramPro;

final class Location
***REMOVED***
    private float $longitude;
    private float $latitude;

    public function __construct(
        float $longitude,
        float $latitude
    ) ***REMOVED***
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    ***REMOVED***

    public static function fromRequest($location): ?Location
    ***REMOVED***
        if ( ! $location) return null;

        return new static(
            $location->longitude,
            $location->latitude
        );
    ***REMOVED***
***REMOVED***