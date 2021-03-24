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
    public ?array $type;
    public ?string $status;
    public ?ItemLocation $location;
    public ?string $locationType;
    public ?string $locationDescription;
    public ?string $locationDescription1;
    public ?string $locationDescription2;
    public ?int $distance;
    public ?string $openingHours;
    public ?ItemAddress $address;
    public ?ItemAddressDetails $addressDetails;
    public ?string $phoneNumber;
    public ?string $paymentPointDescr;
    /** @var PointFunctionsType[] */
    public ?array $functions;
    public ?int $partnerId;
    public ?bool $isNext;
    public ?bool $paymentAvailable;
    public ?array $paymentType;
    public ?string $virtual;
    /** @var string[] */
    public ?array $recommendedLowInterestBoxMachinesList;
    public ?bool $location247;

    public static function fromArray(array $pointData): self
    {
        Assert::stringNotEmpty($pointData['name']);

        $point = new self();
        $point->id = $pointData['name'];
        $point->name = $pointData['name'];
        $point->type = !empty($pointData['type']) ? self::getType($pointData['type']) : null;
        $point->status = $pointData['status'] ?? null;
        $point->location = !empty($pointData['location']) ? ItemLocation::fromArray($pointData['location']) : null;
        $point->locationType = $pointData['location_type'] ?? null;
        $point->locationDescription = $pointData['location_description'] ?? null;
        $point->locationDescription1 = $pointData['location_description_1'] ?? null;
        $point->locationDescription2 = $pointData['location_description_2'] ?? null;
        $point->distance = $pointData['distance'] ?? null;
        $point->openingHours = $pointData['opening_hours'] ?? null;
        $point->address = !empty($pointData['address']) ? ItemAddress::fromArray($pointData['address']) : null;
        $point->addressDetails = !empty($pointData['address_details']) ? ItemAddressDetails::fromArray($pointData['address_details']) : null;
        $point->phoneNumber = $pointData['phone_number'] ?? null;
        $point->paymentPointDescr = $pointData['payment_point_descr'] ?? null;
        $point->functions = !empty($pointData['functions']) ? self::getFunctionsTypes($pointData['functions']) : null;
        $point->partnerId = $pointData['partner_id'] ?? null;
        $point->isNext = $pointData['is_next'] ?? null;
        $point->paymentAvailable = $pointData['payment_available'] ?? null;
        $point->paymentType = $pointData['payment_type'] ?? null;
        $point->virtual = $pointData['virtual'] ?? null;
        $point->recommendedLowInterestBoxMachinesList = $pointData['recommended_low_interest_box_machines_list'] ?? null;
        $point->location247 = $pointData['location_247'] ?? null;

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
