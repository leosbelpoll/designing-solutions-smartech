<?php

namespace App;

use Carbon\Carbon;

class WeekDaysEnum
{
    const MONDAY = 'MONDAY';
    const TUESDAY = 'TUESDAY';
    const WEDNESDAY = 'WEDNESDAY';
    const THURSDAY = 'THURSDAY';
    const FRIDAY = 'FRIDAY';
    const SATURDAY = 'SATURDAY';
    const SUNDAY = 'SUNDAY';

    function __construct()
    {
    }

    public function getWeekByDay($numberDay)
    {
        switch ($numberDay) {
            case 0:
                return self::SUNDAY;
                break;
            case 1:
                return self::MONDAY;
                break;
            case 2:
                return self::TUESDAY;
                break;
            case 3:
                return self::WEDNESDAY;
                break;
            case 4:
                return self::THURSDAY;
                break;
            case 5:
                return self::FRIDAY;
                break;
            case 6:
                return self::SATURDAY;
                break;
            default:
                return null;
                break;
        }
    }

    public function getWeekDay()
    {
        $numberDay = Carbon::now()->dayOfWeek;
        return $this->getWeekByDay($numberDay);
    }
}
