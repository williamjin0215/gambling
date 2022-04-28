<?php

namespace App\Models;

class Affiliate 
{
    private int $affiliate_id;
    private string $name;
    private float $latitude;
    private float $longitude;

    public function __construct(
        int $affiliate_id,
        string $name,
        float $latitude,
        float $longitude
    ) {
        $this->affiliate_id = $affiliate_id;
        $this->name = $name;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function calculateDistance(float $office_latitude, float $office_longitude)
    {
        $R = 6371;
        $dLat = deg2rad($this->latitude - $office_latitude);
        $dLon = deg2rad($this->longitude - $office_longitude);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($office_latitude)) * cos(deg2rad($this->latitude)) *
            sin($dLon / 2) * sin($dLon / 2);

        $d = $R * 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $d;
    }
}
