<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Enum;

use MabeEnum\Enum;

class PointType extends Enum
{
    public const PARCEL_LOCKER = 'parcel_locker';
    public const POP = 'pop';
    public const PARCEL_LOCKER_ONLY = 'parcel_locker_only';
    public const PARCEL_LOCKER_SUPERPOP = 'parcel_locker_superpop';

    public static function parcelLocker(): self
    {
        return static::get(static::PARCEL_LOCKER);
    }

    public static function pop(): self
    {
        return static::get(static::POP);
    }

    public static function parcelLockerOnly(): self
    {
        return static::get(static::PARCEL_LOCKER_ONLY);
    }

    public static function parcelLockerSuperPop(): self
    {
        return static::get(static::PARCEL_LOCKER_SUPERPOP);
    }
}
