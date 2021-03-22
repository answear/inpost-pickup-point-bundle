<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Response\Struct;

use Answear\InpostBundle\Enum\PointFunctionsType;
use Answear\InpostBundle\Enum\PointType;
use Webmozart\Assert\Assert;

class Item
{
    public string $id;
    public string $name;
    /** @var PointType[] */
    public array $type;
    public string $status;
    public ItemLocation $location;
    public ?string $locationType;
    public ?string $locationDescription;
    public ?string $locationDescription1;
    public ?string $locationDescription2;
    public ?int $distance;
    public ?string $openingHours;
    public ItemAddress $address;
    public ItemAddressDetails $addressDetails;
    public ?string $phoneNumber;
    public ?string $paymentPointDescr;
    /** @var PointFunctionsType[] */
    public array $functions;
    public int $partnerId;
    public bool $isNext;
    public bool $paymentAvailable;
    public array $paymentType;
    public string $virtual;
    /** @var string[] */
    public ?array $recommendedLowInterestBoxMachinesList;
    public bool $location247;

    public static function fromArray(array $pointData): self
    {
        Assert::stringNotEmpty($pointData['name']);
        Assert::isArray($pointData['type']);
        Assert::stringNotEmpty($pointData['status']);
        Assert::isArray($pointData['location']);
        Assert::keyExists($pointData, 'location_type');
        Assert::keyExists($pointData, 'location_description');
        Assert::keyExists($pointData, 'location_description_1');
        Assert::keyExists($pointData, 'location_description_2');
        Assert::keyExists($pointData, 'distance');
        Assert::keyExists($pointData, 'opening_hours');
        Assert::isArray($pointData['address']);
        Assert::isArray($pointData['address_details']);
        Assert::keyExists($pointData, 'phone_number');
        Assert::keyExists($pointData, 'payment_point_descr');
        Assert::isArray($pointData['functions']);
        Assert::keyExists($pointData, 'partner_id');
        Assert::keyExists($pointData, 'is_next');
        Assert::keyExists($pointData, 'payment_available');
        Assert::isArray($pointData['payment_type']);
        Assert::keyExists($pointData, 'virtual');
        Assert::keyExists($pointData, 'recommended_low_interest_box_machines_list');
        Assert::keyExists($pointData, 'location_247');

        $point = new self();
        $point->id = $pointData['name'];
        $point->name = $pointData['name'];
        $point->type = self::getType($pointData['type']);
        $point->status = $pointData['status'];
        $point->location = ItemLocation::fromArray($pointData['location']);
        $point->locationType = $pointData['location_type'];
        $point->locationDescription = $pointData['location_description'];
        $point->locationDescription1 = $pointData['location_description_1'];
        $point->locationDescription2 = $pointData['location_description_2'];
        $point->distance = $pointData['distance'];
        $point->openingHours = $pointData['opening_hours'];
        $point->address = ItemAddress::fromArray($pointData['address']);
        $point->addressDetails = ItemAddressDetails::fromArray($pointData['address_details']);
        $point->phoneNumber = $pointData['phone_number'];
        $point->paymentPointDescr = $pointData['payment_point_descr'];
        $point->functions = self::getFunctionsTypes($pointData['functions']);
        $point->partnerId = $pointData['partner_id'];
        $point->isNext = $pointData['is_next'];
        $point->paymentAvailable = $pointData['payment_available'];
        $point->paymentType = $pointData['payment_type'];
        $point->virtual = $pointData['virtual'];
        $point->recommendedLowInterestBoxMachinesList = $pointData['recommended_low_interest_box_machines_list'];
        $point->location247 = $pointData['location_247'];

        return $point;
    }

    /**
     * @param string[] $types
     *
     * @return PointType[]
     */
    private static function getType(array $types): array
    {
        $pointType = [];
        foreach ($types as $type) {
            $pointType[] = PointType::get($type);
        }

        return $pointType;
    }

    /**
     * @param string[] $functions
     *
     * @return PointFunctionsType[]
     */
    private static function getFunctionsTypes(array $functions): array
    {
        $pointFunctionsTypes = [];
        foreach ($functions as $function) {
            $pointFunctionsTypes[] = PointFunctionsType::get($function);
        }

        return $pointFunctionsTypes;
    }
}
