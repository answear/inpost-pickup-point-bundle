<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Response;

use Answear\InpostBundle\Response\Struct\Item;
use Answear\InpostBundle\Response\Struct\ItemCollection;
use Webmozart\Assert\Assert;

class FindPointsResponse
{
    public ItemCollection $items;
    public int $totalPages;
    public int $totalItemsCount;

    public function __construct(ItemCollection $offices, int $totalPages, int $totalItemsCount)
    {
        $this->items = $offices;
        $this->totalPages = $totalPages;
        $this->totalItemsCount = $totalItemsCount;
    }

    public function getItems(): ItemCollection
    {
        return $this->items;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    public function getTotalItemsCount(): int
    {
        return $this->totalItemsCount;
    }

    public static function fromArray(array $arrayResponse): self
    {
        Assert::keyExists($arrayResponse, 'items');
        Assert::keyExists($arrayResponse, 'total_pages');
        Assert::keyExists($arrayResponse, 'count');
        Assert::integer($arrayResponse['total_pages']);
        Assert::integer($arrayResponse['count']);

        return new self(
            new ItemCollection(
                array_map(
                    fn ($pointData) => Item::fromArray($pointData),
                    $arrayResponse['items']
                )
            ),
            $arrayResponse['total_pages'],
            $arrayResponse['count']
        );
    }
}
