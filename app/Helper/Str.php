<?php

namespace App\Helper;

use Carbon\Carbon;

class Str {

    /**
     * Slugify a string
     * @param string $name
     * @return string $slug
     */
    public static function slugify( $name ){
        return \Illuminate\Support\Str::slug( $name );
    }
    
    /**
     * Convert a datetime to human read string
     * @param Carbon $datetime
     * @param string $precisely - day|hour|minute
     * @return string $timestring
     */
    public static function humanReadDatetime( Carbon $datetime, $precisely = 'hour' ){

        $convertable = false;

        switch( $precisely ) {
            case 'day':
                $convertable = $datetime->diffInDays() <= 7;
                break;
            case 'hour':
                $convertable = $datetime->diffInHours() <= 24;
                break;
            case 'minute':
                $convertable = $datetime->diffInMinutes() <= 60;
                break;
        }

        if( $convertable ){
            return $datetime->diffForHumans();
        }

        return $datetime->format('Y-m-d H:i:s');

    }

    public static function humanReadMoney( $amount ){
        return '$ ' . number_format( $amount, 2 );
    }

    public static function humanReadNumber( $num ){
        return number_format( $num, 0 );
    }
}