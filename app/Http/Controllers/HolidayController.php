<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Holiday;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

use function Laravel\Prompts\error;

class HolidayController extends Controller
{

    public function store(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            "leave_start" => "required|date",
            "leave_end"   => "required|date|after_or_equal:leave_start",
        ]);
    
        // Calculate taken leave days
        $takenLeave = DateHelp::calculateWorkingDays($request->leave_start, $request->leave_end);
        
        // Fetch last holiday record for the employee
        $lastHoliday = Holiday::where('employee_id', $id)->where("type","administrative")
        ->orderBy('created_at', 'desc') // Sort by created_at in descending order
        ->orderBy('year', 'desc')      // Sort by year in descending order
            ->first();

            if(!isset($lastHoliday)){
            if($takenLeave<=22){
                $this->saveHoliday($id, $request, 22, $takenLeave,'administrative');
                return redirect()->back()->with("success", "تم تسجيل الاجازة بنجاح");
            }else{
                return redirect()->back()->with("error", "عدد الايام المطلوبة اكبر من المسموح به");
            }

        }
        // If no previous records exist, assume the employee is new
        $lastYear = $lastHoliday->year;
        $remainingLeave = $lastHoliday->remaining_leave ;
    
            // Compare the dates
        // dd(strtotime($request->leave_start));
        $newDate=strtotime($request->leave_start);
        $oldDate=strtotime($lastHoliday->leave_end);
    if ( $newDate < $oldDate) {
        // Return back with a custom error message
        return redirect()->back()->with("error", "هذا التاريخ  محجوز  ادخل تاريخ جديد");

    }

    
        // Determine the applicable limit based on the year difference
        $yearDifference = Carbon::now()->year - $lastYear;
        switch ($yearDifference) {
            case 0:
                $allowedLeave = $remainingLeave ;
                break;

            case 1:
                $allowedLeave = $remainingLeave +22 ;
                break;

            case 2:
                $allowedLeave = 44 ;
                break;

            default:
                 $allowedLeave = 44 ;
                break;
        }

    
        // Check if the requested leave exceeds the allowed limit
        if ($takenLeave > $allowedLeave) {
            return redirect()->back()->with("error", "عدد الايام المطلوبة اكبر من المسموح به");
        }
    
        // Save the new holiday record
        $this->saveHoliday($id, $request, $allowedLeave, $takenLeave ,'administrative');
    
        return redirect()->back()->with("success", "تم تسجيل الاجازة بنجاح");
    }
    













    
    public function extraHoliday(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            "leave_start" => "required|date",
            "leave_end"   => "required|date|after_or_equal:leave_start",
        ]);
    
        // Calculate taken leave days
        $takenLeave = DateHelp::calculateWorkingDays($request->leave_start, $request->leave_end);
        
        // Fetch last holiday record for the employee
        $lastHoliday = Holiday::where('employee_id', $id)
            ->where("year", Carbon::now()->year)
            ->orderBy('created_at', 'desc')
            ->first();
    
        if (!$lastHoliday) {
            return redirect()->back()->with("error", "لا يزال لديك رصيد من العطل الادارية");
        }
    
        $remainingLeave = $lastHoliday->remaining_leave;
        $typeHoliday = $lastHoliday->type;
    
        // Ensure the new leave start date is after the last leave end date
        if (strtotime($request->leave_start) < strtotime($lastHoliday->leave_end)) {
            return redirect()->back()->with("error", "هذا التاريخ محجوز، ادخل تاريخ جديد");
        }
    
        // Handle leave types and limits
        $allowedLeave = $this->calculateAllowedLeave($remainingLeave, $typeHoliday);
    
        if ($allowedLeave === false) {
            return redirect()->back()->with("error", "نفذ رصيدك من العطل الإستثنائية");
        }
    
        if ($takenLeave > $allowedLeave) {
            return redirect()->back()->with("error", "عدد الأيام المطلوبة أكبر من المسموح به");
        }
    
        // Save the new holiday record
        $this->saveHoliday($id, $request, $allowedLeave, $takenLeave, "exceptional");
    
        return redirect()->back()->with("success", "تم تسجيل الإجازة بنجاح");
    }
    

    private function calculateAllowedLeave($remainingLeave, $typeHoliday)
    {
        if ($remainingLeave == 0 && $typeHoliday == "administrative") {
            return 10; // Switch to exceptional leave
        }


        if ($remainingLeave > 0 && $typeHoliday == "exceptional") {
            return $remainingLeave; 
        }

        if ($remainingLeave > 0 && $typeHoliday == "administrative") {
            return redirect()->back()->with("error", "لا يزال لديك رصيد من العطل الإدارية");
        }
    
    
        if ($remainingLeave == 0 && $typeHoliday == "exceptional") {
            return false; // No leave available
        }
    
        return $remainingLeave; // If exceptional leave is still available
    }


    private function saveHoliday($employeeId, $request, $totalLeave, $takenLeave ,$type) 
    {
        Holiday::create([
            "employee_id" => $employeeId,
            "total_leave" => $totalLeave,
            "leave_start" => $request->leave_start,
            "leave_end" => $request->leave_end,
            "year" => Carbon::now()->year,
            "type"=>$type,
            "remaining_leave" => $totalLeave - $takenLeave,
        ]);
    }

























}