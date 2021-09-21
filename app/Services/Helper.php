<?php


namespace App\Services;


use Carbon\Carbon;

class Helper
{

    static function getTimestampFromDate($date, $format = 'd-m-Y H:i:s'): string
    {
        return Carbon::createFromFormat($format, $date)->toDateTimeString();
    }

    static function getTimestampFromDateString($date): string
    {
        return Carbon::parse($date)->toDateTimeString();
    }

    static function getDateFromTimestamp($date, $format = 'd-m-Y H:i:s'): string
    {
        return Carbon::parse($date)->format($format);
    }

    static function defaultDateFormat($date): string
    {
        return Carbon::parse($date)->format('d-m-y');
    }

    static function datePickerFormat($date): string
    {
        return Carbon::parse($date)->format('d-m-Y H:i:s');
    }

    static function readableDate($date): string
    {
        return $date !== null ? Carbon::parse($date)->format('j M, Y') : '';
    }

    static function readableDateTime($date): string
    {
        return $date !== null ? Carbon::parse($date)->format('j M, Y h:i a') : '';
    }

    static function getDifferenceInDays($date): int
    {
        return Carbon::parse(Carbon::now())->diffInDays($date);
    }
}
