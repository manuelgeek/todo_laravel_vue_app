<?php


namespace App\Services;


use Carbon\Carbon;
use Illuminate\Support\Str;

class Helper
{
    static function getTimestampFromDateString($date): string
    {
        return Carbon::parse($date)->toDateTimeString();
    }

    static function readableDate($date): string
    {
        return $date !== null ? Carbon::parse($date)->format('j M, Y') : '';
    }

    static function readableDateTime($date): string
    {
        return $date !== null ? Carbon::parse($date)->format('j M, Y h:i a') : '';
    }

    static function getSlug($str): string
    {
        return Str::slug($str).'-'.Str::random(3);
    }
}
