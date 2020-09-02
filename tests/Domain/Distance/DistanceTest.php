<?php
declare(strict_types=1);

namespace Tests\Domain\Distance;

use App\Domain\Distance\Distance;
use App\Domain\Distance\DistanceInvalidException;
use Tests\TestCase;

class DistanceTest extends TestCase
{
    public function distanceProvider()
    {
        return [
            ['meters', 1.00],
            ['yards', 1.00],
            ['meters', 0.9144],
            ['yards', 1.09361],
        ];
    }

    /**
     * @dataProvider distanceProvider
     * @param $type
     * @param $value
     * @throws DistanceInvalidException
     */
    public function testJsonSerialize($type, $value)
    {
        $distance = new Distance($type, $value);

        $expectedPayload = json_encode([
            'type' => $type,
            'value' => $value,
        ]);
        if ($type === Distance::YARDS_LABEL) {
            $this->assertEquals($expectedPayload, json_encode($distance->jsonSerializeInYards()));
        } else {
            $this->assertEquals($expectedPayload, json_encode($distance->jsonSerialize()));
        }
    }
}