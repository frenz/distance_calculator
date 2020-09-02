<?php
declare(strict_types=1);

namespace App\Domain\Distance;

use JsonSerializable;

class Distance implements JsonSerializable
{
    const YARDS_LABEL = 'yards';
    const METERS_LABEL = "meters";
    const YARD_SIZE = 0.9144;

    /**
     * @var string
     */
    private $type;

    /**
     * @var float
     */
    private $value;

    /**
     * @param string $type
     * @param float $value
     * @throws DistanceInvalidException
     */
    public function __construct(string $type, float $value)
    {
        $type = strtolower($type);
        $this->value = $value;
        if (!$this->isYardsType($type) && !$this->isMetersType($type)) {
            throw new DistanceInvalidException();
        }
        if ($this->isYardsType($type)) {
            $this->value = $this->yardsToMeters($value);
            $type = self::METERS_LABEL;
        }
        $this->type = $type;
    }

    /**
     * @param string $distanceType
     * @return bool
     */
    private function isYardsType(string $distanceType): bool
    {
        return $distanceType === self::YARDS_LABEL;
    }

    /**
     * @param string $distanceType
     * @return bool
     */
    private function isMetersType(string $distanceType): bool
    {
        return $distanceType === self::METERS_LABEL;
    }

    /**
     * @param float $distanceValue
     * @return float
     */
    private function yardsToMeters(float $distanceValue): float
    {
        return $distanceValue * self::YARD_SIZE;
    }

    public function sum(Distance $distance): void
    {
        $this->value += $distance->getValueInMeters();
    }

    /**
     * @return float
     */
    private function getValueInMeters(): float
    {
        $distanceValue = $this->getValue();
        if ($this->isYardsType($this->getType())) {
            $distanceValue = $this->yardsToMeters($distanceValue);
        }
        return $distanceValue;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'type' => $this->type,
            'value' => $this->value,
        ];
    }

    /**
     * @return array
     */
    public function jsonSerializeInYards()
    {
        return [
            'type' => $this::YARDS_LABEL,
            'value' => $this->getValueInYards(),
        ];
    }

    /**
     * @return float
     */
    private function getValueInYards(): float
    {
        $distanceValue = $this->getValue();
        if ($this->isMetersType($this->getType())) {
            $distanceValue = $this->metersToYards($distanceValue);
        }
        return $distanceValue;
    }

    /**
     * @param float $distanceValue
     * @return float
     */
    private function metersToYards(float $distanceValue): float
    {
        return $distanceValue / self::YARD_SIZE;
    }
}
