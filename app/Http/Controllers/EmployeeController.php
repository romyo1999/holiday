<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index() {
        $employees = Employee::orderBy('created_at', 'desc')->paginate(9);
        
        return view('employees.index', ["employees" => $employees]);
      }



      public function search(Request $request)
{
    $request->validate(["term"=>"required|string"]);

    $employees = Employee::where('name', 'like', '%' . $request->term . '%')
                        ->orWhere('national_id', 'like', '%' . $request->term . '%')
                        ->orderBy('created_at', 'desc')
                        ->paginate(9);

    return view('employees.index',  ['employees' => $employees,"term"=>$request->term]);
}

public function create() {

    return view('employees.create');
  }



  public function show($id)
  {
    $lastHoliday = Holiday::where('employee_id', $id)->where("year",Carbon::now()->year)
    ->orderBy('created_at', 'desc')
    ->first();
      $employee = Employee::findOrFail($id);
      $holidays = Holiday::where('employee_id', $employee->id)
      ->orderBy('created_at', 'desc') // Sort by created_at in descending order
      ->orderBy('year', 'desc')      // Sort by year in descending order
      ->paginate(10);      
      return view('employees.show', [
          'employee' => $employee,
          'holidays' => $holidays,
          "lastHoliday"=>$lastHoliday
      ]);
  }



public function store(Request $request){
    $request->validate([
        "name"        => "required|string|max:255",
        "national_id" => "required|string|unique:employees,national_id",
        "department"  => "required|string|max:255",
        "grade"       => "required|string|max:255",
    ]);

    $employee =new Employee();
    $employee->name=$request->name;
    $employee->national_id=$request->national_id;
    $employee->department=$request->department;
    $employee->grade=$request->grade;
    $employee->save();
    return redirect()->back()->with('message', 'تمت الاضافة بنجاح');

}


public function edit($id) {
    $employee=Employee::findOrFail($id);
    return view('employees.update' ,["employee"=>$employee]);
  }


  public function update(Request $request, $id)
  {
      $employee = Employee::findOrFail($id);
  
      // Define base validation rules
      $rules = [
          "name"       => "required|string|max:255",
          "department" => "required|string|max:255",
          "grade"      => "required|string|max:255",
      ];
  
      // If national_id is changed, add unique validation
      if ($request->national_id !== $employee->national_id) {
          $rules["national_id"] = "required|string|unique:employees,national_id";
      }
  
      // Validate request
      $request->validate($rules);
  
      // Update employee record
      $employee->update($request->only(["name", "national_id", "department", "grade"]));
  
      return redirect()->route("employee.show", ["id" => $employee->id])
          ->with("success", "تم تعديل المعلومات بنجاح");
  }
  




public function destroy($id)
{
    $employee = Employee::findOrFail($id);
    $employee->delete();
    
    return redirect()->route("employee.index")->with("message" , "تم الحذف بنجاح");
}
















































}


