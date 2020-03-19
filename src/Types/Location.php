<?php namespace TelegramPro\Types;

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

    public static function fromApi($location): ?Location
    ***REMOVED***
        if ( ! $location) return null;

        return new static(
            $location->longitude,
            $location->latitude
        );
    ***REMOVED***
***REMOVED***