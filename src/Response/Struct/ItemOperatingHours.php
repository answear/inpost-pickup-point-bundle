<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Response\Struct;

class ItemOperatingHours
{
    /**
     * @var ItemOperatingHoursDay[] $sunday
     */
    public array $sunday = [];
    /**
     * @var ItemOperatingHoursDay[] $monday
     */
    public array $monday = [];
    /**
     * @var ItemOperatingHoursDay[] $tuesday
     */
    public array $tuesday = [];
    /**
     * @var ItemOperatingHoursDay[] $wednesday
     */
    public array $wednesday = [];
    /**
     * @var ItemOperatingHoursDay[] $thursday
     */
    public array $thursday = [];
    /**
     * @var ItemOperatingHoursDay[] $friday
     */
    public array $friday = [];
    /**
     * @var ItemOperatingHoursDay[] $saturday
     */
    public array $saturday = [];

    public static function fromArray(array $operatingHours): self
    {
        $self = new self();

        if (!isset($operatingHours['customer'])) {
            return $self;
        }

        if (!is_array($operatingHours['customer'])) {
            return $self;
        }

        foreach ($operatingHours['customer'] as $day => $hours) {
            if (!isset($self->{strtolower($day)})) {
                continue;
            }
            foreach ($hours as $periodHours) {
                $self->{strtolower($day)}[] = ItemOperatingHoursDay::fromArray($periodHours);
            }
        }

        return $self;
    }
}
