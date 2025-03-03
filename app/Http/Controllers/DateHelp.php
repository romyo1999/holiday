<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class DateHelp extends Controller
{
    public static function calculateWorkingDays($startDate, $endDate)
    {
        $startDate = Carbon::parse($startDate);
        $endDate   = Carbon::parse($endDate);
    
        // Use 'CarbonPeriod::create' with end date excluded
        $period = CarbonPeriod::create($startDate, $endDate->subDay()); 
    
        $taken_leave = 0;
        foreach ($period as $date) {
            if (!$date->isWeekend()) {
                $taken_leave++;
            }
        }
    
        return $taken_leave;
    }
    

    
}
