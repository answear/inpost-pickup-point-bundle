<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Tests\Integration\Command;

use Answear\InpostBundle\Client\Client;
use Answear\InpostBundle\Client\Serializer;
use Answear\InpostBundle\Command\FindPoints;
use Answear\InpostBundle\ConfigProvider;
use Answear\InpostBundle\Enum\PointFunctionsType;
use Answear\InpostBundle\Enum\PointType;
use Answear\InpostBundle\Request\FindPointsRequest;
use Answear\InpostBundle\Response\Struct\Item;
use Answear\InpostBundle\Response\Struct\ItemAddress;
use Answear\InpostBundle\Response\Struct\ItemAddressDetails;
use Answear\InpostBundle\Response\Struct\ItemLocation;
use Answear\InpostBundle\Response\Struct\ItemOperatingHours;
use Answear\InpostBundle\Response\Struct\ItemOperatingHoursDay;
use Answear\InpostBundle\Tests\MockGuzzleTrait;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class FindPointsTest extends TestCase
{
    use MockGuzzleTrait;

    private Client $client;
    private ConfigProvider $configProvider;

    private const POLAND = 'Poland';
    private const ITALY = 'Italy';

    public function setUp(): void
    {
        parent::setUp();

        $this->configProvider = new ConfigProvider();
        $this->client = new Client($this->configProvider, $this->setupGuzzleClient());
    }

    /**
     * @test
     */
    public function successfulFindPointsPoland(): void
    {
        $this->mockGuzzleResponse(new Response(200, [], $this->getSuccessfulBody(self::POLAND)));

        $response = $this->getCommand()->findPoints(new FindPointsRequest());

        $this->assertCount(1, $response->getItems());
        $this->assertSame(1, $response->getTotalItemsCount());
        /** @var Item $point */
        $point = $response->getItems()->get(0);

        $this->assertNotNull($point);
        $this->assertSame($point->id, 'ADA01M');
        $this->assertSame($point->name, 'ADA01M');
        $this->assertSame($point->type, [PointType::ParcelLocker]);
        $this->assertSame($point->status, 'Operating');
        $this->assertInstanceOf(ItemLocation::class, $point->location);
        $this->assertSame($point->location->longitude, 22.264049625);
        $this->assertSame($point->location->latitude, 51.73834066);
        $this->assertSame($point->locationType, 'Outdoor');
        $this->assertSame($point->locationDescription, 'Przy sklepie Lewiatan');
        $this->assertNull($point->locationDescription1);
        $this->assertNull($point->locationDescription2);
        $this->assertNull($point->distance);
        $this->assertSame($point->openingHours, '24/7');
        $this->assertInstanceOf(ItemOperatingHours::class, $point->operatingHoursExtended);
        $this->assertInstanceOf(ItemAddress::class, $point->address);
        $this->assertSame($point->address->line1, 'Kościuszki 27');
        $this->assertSame($point->address->line2, '21-412 Adamów');
        $this->assertInstanceOf(ItemAddressDetails::class, $point->addressDetails);
        $this->assertSame($point->addressDetails->city, 'Adamów');
        $this->assertSame($point->addressDetails->province, 'lubelskie');
        $this->assertSame($point->addressDetails->postCode, '21-412');
        $this->assertSame($point->addressDetails->street, 'Kościuszki');
        $this->assertSame($point->addressDetails->buildingNumber, '27');
        $this->assertNull($point->addressDetails->flatNumber);
        $this->assertNull($point->phoneNumber);
        $this->assertSame($point->paymentPointDescr, 'Płatność internetowa PayByLink oraz Blik');
        $this->assertSame($point->functions, [PointFunctionsType::ParcelCollect, PointFunctionsType::ParcelSend]);
        $this->assertSame($point->partnerId, 0);
        $this->assertFalse($point->isNext);
        $this->assertTrue($point->paymentAvailable);
        $this->assertSame($point->paymentType, ['0' => 'Payments are not supported']);
        $this->assertSame($point->virtual, '0');
        $this->assertNull($point->recommendedLowInterestBoxMachinesList);
        $this->assertTrue($point->location247);
    }

    /**
     * @test
     */
    public function successfulFindPointsItaly(): void
    {
        $this->mockGuzzleResponse(new Response(200, [], $this->getSuccessfulBody(self::ITALY)));

        $response = $this->getCommand()->findPoints(new FindPointsRequest());

        $this->assertCount(1, $response->getItems());
        $this->assertSame(1, $response->getTotalItemsCount());
        /** @var Item $point */
        $point = $response->getItems()->get(0);

        $this->assertNotNull($point);
        $this->assertSame($point->id, 'ITAAQ01570P');
        $this->assertSame($point->name, 'ITAAQ01570P');
        $this->assertSame($point->type, [PointType::Pok, PointType::Pop]);
        $this->assertSame($point->status, 'Operating');
        $this->assertInstanceOf(ItemLocation::class, $point->location);
        $this->assertSame($point->location->longitude, 13.47289);
        $this->assertSame($point->location->latitude, 42.35751);
        $this->assertSame($point->locationType, 'Indoor');
        $this->assertSame($point->locationDescription, 'presso Dottor Tech');
        $this->assertNull($point->locationDescription1);
        $this->assertNull($point->locationDescription2);
        $this->assertNull($point->distance);
        $this->assertSame($point->openingHours, 'Lun-Ven: 10:00 - 13:00 - 16:00 - 19:00 ');

        $this->assertInstanceOf(ItemOperatingHours::class, $point->operatingHoursExtended);

        $this->assertIsArray($point->operatingHoursExtended->sunday);
        $this->assertIsArray($point->operatingHoursExtended->monday);

        $this->assertContainsOnlyInstancesOf(ItemOperatingHoursDay::class, $point->operatingHoursExtended->sunday);
        $this->assertContainsOnlyInstancesOf(ItemOperatingHoursDay::class, $point->operatingHoursExtended->monday);

        $this->assertEmpty($point->operatingHoursExtended->sunday);

        $this->assertSame($point->operatingHoursExtended->monday[0]->start, 600);
        $this->assertSame($point->operatingHoursExtended->monday[0]->end, 780);
        $this->assertSame($point->operatingHoursExtended->monday[1]->start, 960);
        $this->assertSame($point->operatingHoursExtended->monday[1]->end, 1140);

        $this->assertSame($point->operatingHoursExtended->monday[0]->startParsed, '10:00');
        $this->assertSame($point->operatingHoursExtended->monday[0]->endParsed, '13:00');
        $this->assertSame($point->operatingHoursExtended->monday[1]->startParsed, '16:00');
        $this->assertSame($point->operatingHoursExtended->monday[1]->endParsed, '19:00');

        $this->assertInstanceOf(ItemAddress::class, $point->address);
        $this->assertSame($point->address->line1, 'Via Ten. Antonio Rossi Tascione in Str. Vicinale di Paganica 7');
        $this->assertSame($point->address->line2, '67100 L\'Aquila');
        $this->assertInstanceOf(ItemAddressDetails::class, $point->addressDetails);
        $this->assertSame($point->addressDetails->city, 'L\'Aquila');
        $this->assertSame($point->addressDetails->province, 'AQ');
        $this->assertSame($point->addressDetails->postCode, '67100');
        $this->assertSame($point->addressDetails->street, 'Via Ten. Antonio Rossi Tascione in Str. Vicinale di Paganica');
        $this->assertSame($point->addressDetails->buildingNumber, '7');
        $this->assertNull($point->addressDetails->flatNumber);
        $this->assertNull($point->phoneNumber);
        $this->assertSame($point->paymentPointDescr, '');
        $this->assertSame($point->functions, [
            PointFunctionsType::Parcel,
            PointFunctionsType::ParcelCollect,
            PointFunctionsType::ParcelReverseReturnSend,
            PointFunctionsType::ParcelSend,
            PointFunctionsType::StandardCourierSend,
        ]);
        $this->assertSame($point->partnerId, 1);
        $this->assertFalse($point->isNext);
        $this->assertTrue($point->paymentAvailable);
        $this->assertSame($point->paymentType, ['3' => 'Payment by cash and card']);
        $this->assertSame($point->virtual, '3');
        $this->assertNull($point->recommendedLowInterestBoxMachinesList);
        $this->assertFalse($point->location247);
    }

    private function getCommand(): FindPoints
    {
        return new FindPoints($this->configProvider, $this->client, new Serializer());
    }

    private function getSuccessfulBody(string $country): string
    {
        $response = file_get_contents(__DIR__ . sprintf('/data/exampleResponse_%s.json', $country));
        if (false === $response) {
            throw new \RuntimeException('Cannot read example response file');
        }

        return $response;
    }
}
