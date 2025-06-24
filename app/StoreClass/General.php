<?php

namespace App\StoreClass;

use Carbon\Carbon;

class General
{
    public static function generateUniqueId()
    {
        $microtime = microtime(true);
        $micro = sprintf("%06d", ($microtime - floor($microtime)) * 1000000);
        $dateTime = Carbon::createFromTimestamp(floor($microtime))->format('ymd');
        $random = mt_rand(100, 999);
        return "{$dateTime}{$micro}{$random}";
    }
}
