<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Enum;

use MabeEnum\Enum;

class PointFunctionsType extends Enum
{
    public const PARCEL = 'parcel';
    public const PARCEL_SEND = 'parcel_send';
    public const PARCEL_COLLECT = 'parcel_collect';
    public const PARCEL_REVERSE_RETURN_SEND = 'parcel_reverse_return_send';
    public const STANDARD_LETTER_COLLECT = 'standard_letter_collect';
    public const STANDARD_LETTER_SEND = 'standard_letter_send';
    public const ALLEGRO_PARCEL_COLLECT = 'allegro_parcel_collect';
    public const ALLEGRO_PARCEL_SEND = 'allegro_parcel_send';
    public const ALLEGRO_PARCEL_REVERSE_RETURN_SEND = 'allegro_parcel_reverse_return_send';
    public const ALLEGRO_LETTER_COLLECT = 'allegro_letter_collect';
    public const ALLEGRO_LETTER_SEND = 'allegro_letter_send';
    public const ALLEGRO_LETTER_REVERSE_RETURN_SEND = 'allegro_letter_reverse_return_send';
    public const ALLEGRO_COURIER_COLLECT = 'allegro_courier_collect';
    public const ALLEGRO_COURIER_SEND = 'allegro_courier_send';
    public const ALLEGRO_COURIER_REVERSE_RETURN_SEND = 'allegro_courier_reverse_return_send';
    public const STANDARD_COURIER_COLLECT = 'standard_courier_collect';
    public const STANDARD_COURIER_SEND = 'standard_courier_send';
    public const STANDARD_COURIER_REVERSE_RETURN_SEND = 'standard_courier_reverse_return_send';
    public const AIR_ON_AIRPORT = 'air_on_airport';
    public const AIR_OUTSIDE_AIRPORT = 'air_outside_airport';
    public const COOL_PARCEL_COLLECT = 'cool_parcel_collect';
    public const LAUNDRY = 'laundry';
    public const LAUNDRY_COLLECT = 'laundry_collect';
    public const AVIZO = 'avizo';

    public static function parcel(): self
    {
        return static::get(static::PARCEL);
    }

    public static function parcelSend(): self
    {
        return static::get(static::PARCEL_SEND);
    }

    public static function parcelCollect(): self
    {
        return static::get(static::PARCEL_COLLECT);
    }

    public static function parcelReverseReturnSend(): self
    {
        return static::get(static::PARCEL_REVERSE_RETURN_SEND);
    }

    public static function standardLetterCollect(): self
    {
        return static::get(static::STANDARD_LETTER_COLLECT);
    }

    public static function standardLetterSend(): self
    {
        return static::get(static::STANDARD_LETTER_SEND);
    }

    public static function allegroParcelCollect(): self
    {
        return static::get(static::ALLEGRO_PARCEL_COLLECT);
    }

    public static function allegroParcelSend(): self
    {
        return static::get(static::ALLEGRO_PARCEL_SEND);
    }

    public static function allegroParcelReverseReturnSend(): self
    {
        return static::get(static::ALLEGRO_PARCEL_REVERSE_RETURN_SEND);
    }

    public static function allegroLetterCollect(): self
    {
        return static::get(static::ALLEGRO_LETTER_COLLECT);
    }

    public static function allegroLetterSend(): self
    {
        return static::get(static::ALLEGRO_LETTER_SEND);
    }

    public static function allegroLetterReverseReturnSend(): self
    {
        return static::get(static::ALLEGRO_LETTER_REVERSE_RETURN_SEND);
    }

    public static function allegroCourierCollect(): self
    {
        return static::get(static::ALLEGRO_COURIER_COLLECT);
    }

    public static function allegroCourierSend(): self
    {
        return static::get(static::ALLEGRO_COURIER_SEND);
    }

    public static function allegroCourierReverseReturnSend(): self
    {
        return static::get(static::ALLEGRO_COURIER_REVERSE_RETURN_SEND);
    }

    public static function standardCourierCollect(): self
    {
        return static::get(static::STANDARD_COURIER_COLLECT);
    }

    public static function standardCourierSend(): self
    {
        return static::get(static::STANDARD_COURIER_SEND);
    }

    public static function standardCourierReverseReturnSend(): self
    {
        return static::get(static::STANDARD_COURIER_REVERSE_RETURN_SEND);
    }

    public static function airOnAirport(): self
    {
        return static::get(static::AIR_ON_AIRPORT);
    }

    public static function airOutsideAirport(): self
    {
        return static::get(static::AIR_OUTSIDE_AIRPORT);
    }

    public static function coolParcelCollect(): self
    {
        return static::get(static::COOL_PARCEL_COLLECT);
    }

    public static function laundry(): self
    {
        return static::get(static::LAUNDRY);
    }

    public static function laundryCollect(): self
    {
        return static::get(static::LAUNDRY_COLLECT);
    }

    public static function avizo(): self
    {
        return static::get(static::AVIZO);
    }
}
