# Inpost Bundle
Inpost integration for Symfony
Documentation of the API can be found here: https://docs.inpost24.com/display/PL/Dokumentacja+API+SHIPX

## Instalation

* install with Composer
```
composer require answear/inpost-pickup-point-bundle
```
`Answear\InpostBundle\AnswearInpostBundle::class => ['all' => true],`  
should be added automatically to your `config/bundles.php` file by Symfony Flex.

## Usage

### Find parcel machines
```php
use Answear\InpostBundle\Command\FindPoints;
use Answear\InpostBundle\Request\FindPointsRequestBuilder;

$findPointsRequest = (new FindPointsRequestBuilder())->build();

/** @var FindPoints $findPointsCommand */
$findOfficeResponse = $findPointsCommand->findPoints($findPointsRequest);
```

#### FindPointsRequestBuilder
This class allows you to quickly search for specific parcel machines

* **Example:** search parcel machine with given name
```php
use Answear\InpostBundle\Request\FindPointsRequestBuilder;

$findPointsRequest = (new FindPointsRequestBuilder())
                        ->setName('AK1001')
                        ->build();
```

**Available methods**
* setName (*string*)
* setNames (*array*)
* setType (*PointType*)
* setTypes (*PointType[]*)
* setFunction (*PointFunctionsType*)
* setFunctions (*PointFunctionsType[]*)
* setPartnerId (*integer*)
* setPartnersId (*array*)
* setIsNext (*boolean*)
* setPaymentAvailable (*boolean*)
* setPostCode (*string*)
* setPostCodes (*array*)
* setCity (*string*)
* setCities (*array*)
* setProvince (*string*)
* setVirtual (*integer*)
* setVirtuals (*array*)
* setUpdatedFrom (*DateTimeInterface*)
* setUpdatedTo (*DateTimeInterface*)
* setPage (*integer*)
* setPerPage (*integer*)