<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Request;

use Answear\InpostBundle\Enum\PointFunctionsType;
use Answear\InpostBundle\Enum\PointType;
use Answear\InpostBundle\Exception\FindPointsRequestBuilderException;

class FindPointsRequestBuilder
{
    private array $criteria;
    private const SEPARATOR = ',';

    public function setName(string $name): self
    {
        $this->criteria['name'] = $name;

        return $this;
    }

    /**
     * @param string[] $names
     */
    public function setNames(array $names): self
    {
        $this->criteria['name'] = implode(self::SEPARATOR, $names);

        return $this;
    }

    public function setType(PointType $type): self
    {
        $this->criteria['type'] = $type->getValue();

        return $this;
    }

    /**
     * @param PointType[] $types
     */
    public function setTypes(array $types): self
    {
        $this->criteria['type'] = implode(
            self::SEPARATOR,
            array_map(static function ($type): string {
                return $type->getValue();
            }, $types)
        );

        return $this;
    }

    public function setFunction(PointFunctionsType $function): self
    {
        $this->criteria['functions'] = $function->getValue();

        return $this;
    }

    /**
     * @param PointFunctionsType[] $functions
     */
    public function setFunctions(array $functions): self
    {
        $this->criteria['functions'] = implode(
            self::SEPARATOR,
            array_map(static function ($type): string {
                return $type->getValue();
            }, $functions)
        );

        return $this;
    }

    public function setPartnerId(int $partnerId): self
    {
        $this->criteria['partner_id'] = $partnerId;

        return $this;
    }

    /**
     * @param int[] $partnersId
     */
    public function setPartnersId(array $partnersId): self
    {
        $this->criteria['partner_id'] = implode(self::SEPARATOR, $partnersId);

        return $this;
    }

    public function setIsNext(bool $isNext): self
    {
        $this->criteria['is_next'] = $isNext;

        return $this;
    }

    public function setPaymentAvailable(bool $paymentAvailable): self
    {
        $this->criteria['payment_available'] = $paymentAvailable;

        return $this;
    }

    public function setPostCode(string $postCode): self
    {
        $this->criteria['post_code'] = $postCode;

        return $this;
    }

    /**
     * @param string[] $postCodes
     */
    public function setPostCodes(array $postCodes): self
    {
        $this->criteria['post_code'] = implode(self::SEPARATOR, $postCodes);

        return $this;
    }

    public function setCity(string $city): self
    {
        $this->criteria['city'] = $city;

        return $this;
    }

    /**
     * @param string[] $cities
     */
    public function setCities(array $cities): self
    {
        $this->criteria['city'] = implode(self::SEPARATOR, $cities);

        return $this;
    }

    public function setProvince(string $province): self
    {
        $this->criteria['province'] = $province;

        return $this;
    }

    /**
     * @param string[] $provinces
     */
    public function setProvinces(array $provinces): self
    {
        $this->criteria['province'] = implode(self::SEPARATOR, $provinces);

        return $this;
    }

    public function setVirtual(int $virtual): self
    {
        $this->criteria['virtual'] = $virtual;

        return $this;
    }

    /**
     * @param int[] $virtuals
     */
    public function setVirtuals(array $virtuals): self
    {
        $this->criteria['virtual'] = implode(self::SEPARATOR, $virtuals);

        return $this;
    }

    public function setUpdatedFrom(\DateTimeInterface $updatedFrom): self
    {
        $this->criteria['updated_from'] = $updatedFrom->format('Y-m-d');

        return $this;
    }

    public function setUpdatedTo(\DateTimeInterface $updatedTo): self
    {
        $this->criteria['updated_to'] = $updatedTo->format('Y-m-d');

        return $this;
    }

    public function setPage(int $page): self
    {
        $this->criteria['page'] = $page < 1 ? 1 : $page;

        return $this;
    }

    public function setPerPage(int $perPage): self
    {
        if ($perPage > 500) {
            throw new FindPointsRequestBuilderException(sprintf('max value of perPage parameter is 500 (%d given)', $perPage));
        }

        $this->criteria['per_page'] = max(1, $perPage);

        return $this;
    }

    /**
     * @param string[] $fields
     */
    public function setFields(array $fields): self
    {
        $this->criteria['fields'] = implode(self::SEPARATOR, $fields);

        return $this;
    }

    public function build(): FindPointsRequest
    {
        return new FindPointsRequest($this->criteria);
    }
}
