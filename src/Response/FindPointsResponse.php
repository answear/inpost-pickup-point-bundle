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

    public function __construct(ItemCollection $offices, int $totalPages)
    {
        $this->items = $offices;
        $this->totalPages = $totalPages;
    }

    public function getItems(): ItemCollection
    {
        return $this->items;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    public static function fromArray(array $arrayResponse): self
    {
        Assert::keyExists($arrayResponse, 'items');
        Assert::keyExists($arrayResponse, 'total_pages');

        return new self(
            new ItemCollection(
                array_map(
                    fn ($pointData) => Item::fromArray($pointData),
                    $arrayResponse['items']
                )
            ),
            (int) $arrayResponse['total_pages']
        );
    }
}
