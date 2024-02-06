<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Response\Struct;

use Webmozart\Assert\Assert;

/**
 * @url https://docs.inpost24.com/pages/viewpage.action?pageId=18513923
 */
class ItemCollection implements \Countable, \IteratorAggregate
{
    /**
     * @var Item[]
     */
    private array $offices;

    public function __construct(array $offices)
    {
        Assert::allIsInstanceOf($offices, Item::class);

        $this->offices = $offices;
    }

    /**
     * @return Item[]
     */
    #[\ReturnTypeWillChange]
    public function getIterator(): iterable
    {
        foreach ($this->offices as $key => $office) {
            yield $key => $office;
        }
    }

    public function get($key): ?Item
    {
        return $this->offices[$key] ?? null;
    }

    public function count(): int
    {
        return \count($this->offices);
    }
}
