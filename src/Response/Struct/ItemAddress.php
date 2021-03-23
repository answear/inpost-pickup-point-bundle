<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Response\Struct;

use Webmozart\Assert\Assert;

class ItemAddress
{
    public ?string $line1;
    public ?string $line2;

    public static function fromArray(array $address): self
    {
        Assert::keyExists($address, 'line1');
        Assert::keyExists($address, 'line2');

        $itemAddress = new self();
        $itemAddress->line1 = $address['line1'];
        $itemAddress->line2 = $address['line2'];

        return $itemAddress;
    }
}
