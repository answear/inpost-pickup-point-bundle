<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Tests\Integration\Command;

use Answear\InpostBundle\Client\Client;
use Answear\InpostBundle\Client\Serializer;
use Answear\InpostBundle\Command\FindPoints;
use Answear\InpostBundle\Enum\PointFunctionsType;
use Answear\InpostBundle\Enum\PointType;
use Answear\InpostBundle\Request\FindPointsRequest;
use Answear\InpostBundle\Response\FindPointsResponse;
use Answear\InpostBundle\Response\Struct\Item;
use Answear\InpostBundle\Response\Struct\ItemAddress;
use Answear\InpostBundle\Response\Struct\ItemAddressDetails;
use Answear\InpostBundle\Response\Struct\ItemLocation;
use Answear\InpostBundle\Tests\MockGuzzleTrait;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class FindPointsTest extends TestCase
{
    use MockGuzzleTrait;

    private Client $client;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = new Client($this->setupGuzzleClient());
    }

    /**
     * @test
     */
    public function successfulFindPoints(): void
    {
        $command = $this->getCommand();
        $this->mockGuzzleResponse(new Response(200, [], $this->getSuccessfulBody()));

        $response = $command->findPoints(new FindPointsRequest());

        $this->assertCount(1, $response->getItems());
        $this->assertPoint($response);
    }

    private function assertPoint(FindPointsResponse $response): void
    {
        /** @var Item $point */
        $point = $response->getItems()->get(0);

        $this->assertNotNull($point);
        $this->assertSame($point->id, 'ADA01M');
        $this->assertSame($point->name, 'ADA01M');
        $this->assertSame($point->type, [PointType::parcelLocker()]);
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
        $this->assertSame($point->openingHours, '24/7');
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
        $this->assertSame($point->functions, [PointFunctionsType::parcelCollect(), PointFunctionsType::parcelSend()]);
        $this->assertSame($point->partnerId, 0);
        $this->assertFalse($point->isNext);
        $this->assertTrue($point->paymentAvailable);
        $this->assertSame($point->paymentType, ['0' => 'Payments are not supported']);
        $this->assertSame($point->virtual, '0');
        $this->assertNull($point->recommendedLowInterestBoxMachinesList);
        $this->assertTrue($point->location247);
    }

    private function getCommand(): FindPoints
    {
        return new FindPoints($this->client, new Serializer());
    }

    private function getSuccessfulBody(): string
    {
        return file_get_contents(__DIR__ . '/data/exampleResponse.json');
    }
}
