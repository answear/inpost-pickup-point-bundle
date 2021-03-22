<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Response;

use Answear\InpostBundle\Response\Struct\Item;
use Answear\InpostBundle\Response\Struct\ItemCollection;
use Webmozart\Assert\Assert;

class FindPointsResponse
{
    public ItemCollection $items;

    public function __construct(ItemCollection $offices)
    {
        $this->items = $offices;
    }

    public function getItems(): ItemCollection
    {
        return $this->items;
    }

    public static function fromArray(array $arrayResponse): self
    {
        Assert::keyExists($arrayResponse, 'items');

        return new self(
            new ItemCollection(
                array_map(
                    fn ($pointData) => Item::fromArray($pointData),
                    $arrayResponse['items']
                )
            )
        );
    }
}
