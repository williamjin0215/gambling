<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Affiliate;

class AffiliateTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $data = [
            'affiliate_id' => 1,
            'name' => "Test",
            'latitude' => 53.2451022,
            'longitude' => -6.238335
        ];
        $office_latitude = 53.3340285;
        $office_longitude = -6.2535495;

        $affiliate = new Affiliate($data['affiliate_id'], $data['name'], $data['latitude'], $data['longitude']);
        $this->expectOutputString('9.9397330376509');
        print $affiliate->calculateDistance($office_latitude, $office_longitude);
    }
}
