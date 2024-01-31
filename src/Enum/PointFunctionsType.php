<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Enum;

enum PointFunctionsType: string
{
    case Parcel = 'parcel';
    case ParcelSend = 'parcel_send';
    case ParcelCollect = 'parcel_collect';
    case ParcelReverseReturnSend = 'parcel_reverse_return_send';
    case StandardLetterCollect = 'standard_letter_collect';
    case StandardLetterSend = 'standard_letter_send';
    case AllegroParcelCollect = 'allegro_parcel_collect';
    case AllegroParcelSend = 'allegro_parcel_send';
    case AllegroParcelReverseReturnSend = 'allegro_parcel_reverse_return_send';
    case AllegroLetterCollect = 'allegro_letter_collect';
    case AllegroLetterSend = 'allegro_letter_send';
    case AllegroLetterReverseReturnSend = 'allegro_letter_reverse_return_send';
    case AllegroCourierCollect = 'allegro_courier_collect';
    case AllegroCourierSend = 'allegro_courier_send';
    case AllegroCourierReverseReturnSend = 'allegro_courier_reverse_return_send';
    case StandardCourierCollect = 'standard_courier_collect';
    case StandardCourierSend = 'standard_courier_send';
    case StandardCourierReverseReturnSend = 'standard_courier_reverse_return_send';
    case AirOnAirport = 'air_on_airport';
    case AirOutsideAirport = 'air_outside_airport';
    case CoolParcelCollect = 'cool_parcel_collect';
    case Laundry = 'laundry';
    case LaundryCollect = 'laundry_collect';
    case Avizo = 'avizo';
}
