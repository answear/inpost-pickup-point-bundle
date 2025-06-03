<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Response\Struct;

class ItemOperatingHoursDay
{
    public function __construct(
        public ?int $start = null,
        public ?int $end = null,
        public ?string $startParsed = null,
        public ?string $endParsed = null,
    ) {
    }

    public static function fromArray(array $day): self
    {
        $self = new self();

        if (isset($day['start'])) {
            $self->start = $day['start'];
            $self->startParsed = self::parseTime($day['start']);
        }

        if (isset($day['end'])) {
            $self->end = $day['end'];
            $self->endParsed = self::parseTime($day['end']);
        }

        return $self;
    }

    private static function parseTime(int $timestamp): string
    {
        return new \DateTimeImmutable()->setTimestamp($timestamp * 60)->format('H:i');
    }
}
