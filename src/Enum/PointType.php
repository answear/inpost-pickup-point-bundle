<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Enum;

enum PointType: string
{
    case ParcelLocker = 'parcel_locker';
    case Pop = 'pop';
    case ParcelLockerOnly = 'parcel_locker_only';
    case ParcelLockerSuperpop = 'parcel_locker_superpop';
}
