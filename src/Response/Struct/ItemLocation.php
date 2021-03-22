<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Response\Struct;

use Webmozart\Assert\Assert;

class ItemLocation
{
    public float $latitude;
    public float $longitude;

    public static function fromArray(array $location): self
    {
        Assert::keyExists($location, 'longitude');
        Assert::keyExists($location, 'latitude');

        $itemLocation = new self();
        $itemLocation->latitude = $location['latitude'];
        $itemLocation->longitude = $location['longitude'];

        return $itemLocation;
    }
}
