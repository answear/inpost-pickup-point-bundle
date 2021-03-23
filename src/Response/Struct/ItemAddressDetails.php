<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Response\Struct;

use Webmozart\Assert\Assert;

class ItemAddressDetails
{
    public ?string $city;
    public ?string $province;
    public ?string $postCode;
    public ?string $street;
    public ?string $buildingNumber;
    public ?string $flatNumber;

    public static function fromArray(array $addressDetails): self
    {
        Assert::keyExists($addressDetails, 'city');
        Assert::keyExists($addressDetails, 'province');
        Assert::keyExists($addressDetails, 'post_code');
        Assert::keyExists($addressDetails, 'street');
        Assert::keyExists($addressDetails, 'building_number');
        Assert::keyExists($addressDetails, 'flat_number');

        $itemAddress = new self();
        $itemAddress->city = $addressDetails['city'];
        $itemAddress->province = $addressDetails['province'];
        $itemAddress->postCode = $addressDetails['post_code'];
        $itemAddress->street = $addressDetails['street'];
        $itemAddress->buildingNumber = $addressDetails['building_number'];
        $itemAddress->flatNumber = $addressDetails['flat_number'];

        return $itemAddress;
    }
}
