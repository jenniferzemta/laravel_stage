<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Carbon;
use App\Models\User;
use App\Models\Project;
use App\Models\Configuration;
use App\Models\Projects;
use App\Models\Payment;
use Illuminate\Http\Request;
use DB;
use App\Models\StaffSalary;
use Brian2694\Toastr\Facades\Toastr;
use PDF;

class PayrollController extends Controller
{



   

    // view page salary
    public function salary()
    {
        $users            = DB::table('users')->join('staff_salaries', 'users.user_id', '=', 'staff_salaries.user_id')->select('users.*', 'staff_salaries.*')->get(); 
        $userList         = DB::table('users')->get();
        $permission_lists = DB::table('permission_lists')->get();
        return view('payroll.employeesalary',compact('users','userList','permission_lists'));
    }

    // save record
    public function saveRecord(Request $request)
    {
    $request->validate([
        'name'         => 'required|string|max:255',
       // 'salary'       => 'required|string|max:255',
        'basic' => 'required|string|max:255',
        'allowance'  => 'required|string|max:255',
      
    ]);

    DB::beginTransaction();
    try {
        $salary = StaffSalary::updateOrCreate(['user_id' => $request->user_id]);
        $salary->name              = $request->name;
        $salary->user_id            = $request->user_id;
      
        $salary->basic             = $request->basic;
        $salary->allowance         = $request->allowance;
        $salary->salary            = $request->salary;
        $salary->save();

        DB::commit();
        Toastr::success('Create new Salary successfully :)','Success');
        return redirect()->back();
    } catch(\Exception $e) {
        DB::rollback();
        Toastr::error('Add Salary fail :)','Error');
        return redirect()->back();
    }
    }

    // salary view detail
   
    public function salaryView($user_id)
    {
        $users = DB::table('users')
                ->join('staff_salaries', 'users.user_id','=', 'staff_salaries.user_id')
                ->join('profile_information', 'users.user_id', '=','profile_information.user_id')
                ->select('users.*', 'staff_salaries.*','profile_information.*')
               ->where('staff_salaries.user_id',$user_id)
              ->first();
        if(!empty($users)) {
           return view('payroll.salaryview',compact('users'));
        }else {
            Toastr::warning('Please update information user :)','Warning');
           return redirect()->route('profile_user');
       }
      
}
   
    // update record
    public function updateRecord(Request $request)
    {
        DB::beginTransaction();
        try{
            $update = [

                'id'      => $request->id,
                'name'    => $request->name,
                'salary'  => $request->salary,
                'basic'   => $request->basic,
              
                'allowance'  => $request->allowance,
              
            ];


            StaffSalary::where('id',$request->id)->update($update);
            DB::commit();
            Toastr::success('Salary updated successfully :)','Success');
            return redirect()->back();

        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Salary update fail :)','Error');
            return redirect()->back();
        }
    }

    // delete record
    public function deleteRecord(Request $request)
    {
        DB::beginTransaction();
        try {

            StaffSalary::destroy($request->id);

            DB::commit();
            Toastr::success('Salary deleted successfully :)','Success');
            return redirect()->back();
            
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Salary deleted fail :)','Error');
            return redirect()->back();
        }
    }

    // payroll Items
    public function payrollItems()
    {
        return view('payroll.payrollitems');
    }
    public function salaryv()
    {
        return view('payroll.salaryview');
    }


    

    
    

    //presence

public function attendance()
{
    $users            = DB::table('users')->join('presences', 'users.user_id', '=', 'presences.user_id')
    ->select('users.*', 'presences.*')->get(); 
    $userList         = DB::table('users')->get();
    
    return view('payroll.attendanceemployee',compact('users','userList'));
}

// save record
public function saveRecor(Request $request)
{
$request->validate([
    'name'         => 'required|string|max:255',
    'date' => 'required|string|max:255',
    'punch_in'  => 'required|string|max:255',
    'punch_out'  => 'required|string|max:255',
    'break'  => 'required|string|max:255',
  
]);

DB::beginTransaction();
try {
    $salary = Presence::updateOrCreate(['user_id' => $request->user_id]);
    $salary->name              = $request->name;
    $salary->user_id            = $request->user_id;
  
    $salary->date            = $request->date;
    $salary->punch_in         = $request->punch_in;
    $salary->punch_out         = $request->punch_out;
    $salary->break         = $request->break;
    $salary->production      = $request->production;
    $salary->save();

    DB::commit();
    Toastr::success('Create new attendance successfully :)','Success');
    return redirect()->back();
} catch(\Exception $e) {
    DB::rollback();
    Toastr::error('Add attendance fail :)','Error');
    return redirect()->back();
}
}

// salary view detail
public function attendanceView($user_id)
{
    $users = DB::table('users')
            ->join('presences', 'users.user_id', 'presence.user_id')
            ->join('profile_information', 'users.user_id', 'profile_information.user_id')
            ->select('users.*', 'presences.*','profile_information.*')
            ->where('presences.user_id',$user_id)->first();
    if(!empty($users)) {
        return view('payroll.salaryview',compact('users'));
    } else {
        Toastr::warning('Please update information user :)','Warning');
        return redirect()->route('profile_user');
    }
}

public function deleteRecor(Request $request)
{
    DB::beginTransaction();
    try {

        Presence::destroy($request->id);

        DB::commit();
        Toastr::success('Attendance deleted successfully :)','Success');
        return redirect()->back();
        
    } catch(\Exception $e) {
        DB::rollback();
        Toastr::error('Attendance deleted fail :)','Error');
        return redirect()->back();
    }
}
   
public function updateRecor(Request $request)
{
    DB::beginTransaction();
    try{
        $update = [

            'id'      => $request->id,
            'name'    => $request->name,
            'date'  => $request->date,
            'punch_in'   => $request->punch_in,
          
            'punch_out'  => $request->punch_out,
            'break'=>$request->break,
            'production'=>$request->production,
          
        ];


        Presence::where('id',$request->id)->update($update);
        DB::commit();
        Toastr::success('Attendance updated successfully :)','Success');
        return redirect()->back();

    }catch(\Exception $e){
        DB::rollback();
        Toastr::error('Attendance update fail :)','Error');
        return redirect()->back();
    }
}

// delete recor


// name project



public function index()
    { $result= DB::table('project')->get();

        $department = DB::table('departments')->get();

        return view('payroll.project',compact('result','department'));
    }
    
    
   
    public function saveRecordProject(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'department'        => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try{

            $department = Project::all();
              
    
                $department = new Project;
                $department->name=$request->name;
                $department->department = $request->department;
                $department->save();
    
                DB::commit();
                Toastr::success('Add new department successfully :)','Success');
                return redirect()->route('form/project/page');
            
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Add new department fail :)','Error');
            return redirect()->back();
        }
    }

   
    public function updateRecordProject(Request $request)
    {
        DB::beginTransaction();
        try{
            $update = [

                'id'      => $request->id,
                'name'    => $request->name,
                'department'  => $request->department,
                
              
            ];


            StaffSalary::where('id',$request->id)->update($update);
            DB::commit();
            Toastr::success('Project updated successfully :)','Success');
            return redirect()->back();

        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Project update fail :)','Error');
            return redirect()->back();
        }
    }

   
    public function deleteRecordProject(Request $request) 
    {
        DB::beginTransaction();
        try {

            Project::destroy($request->id);

            DB::commit();
            Toastr::success('Project deleted successfully :)','Success');
            return redirect()->back();
            
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Project deleted fail :)','Error');
            return redirect()->back();
        }
    }










//assign project


public function projects()
    {
        $users            = DB::table('users')->join('projects', 'users.user_id', '=', 'projects.user_id')->select('users.*', 'projects.*')->get(); 
        $userList         = DB::table('users')->get();
       
        return view('payroll.shiftscheduling',compact('users','userList'));
    }

    // save record
    public function saveReco(Request $request)
    {
    $request->validate([
        'name'         => 'required|string|max:255',
        'name_project'         => 'required|string|max:255',
        'from_date' => 'required|string|max:255',
        'to_date'  => 'required|string|max:255',
        'statut'         => 'required|string|max:255',
      
    ]);

    DB::beginTransaction();
    try {
        $salary = Projects::updateOrCreate(['user_id' => $request->user_id]);
        $salary->name              = $request->name;
        $salary->user_id            = $request->user_id;
        $salary->name_project       =$request->name_project;
        $salary->from_date           = $request->from_date;
        $salary->to_date        = $request->to_date;
        $salary->statut         = $request->statut;
        $salary->save();

        DB::commit();
        Toastr::success('Create new Assign project successfully :)','Success');
        return redirect()->back();
    } catch(\Exception $e) {
        DB::rollback();
        Toastr::error('Add Assign Project fail :)','Error');
        return redirect()->back();
    }
    }


    public function deleteReco(Request $request)
{
    DB::beginTransaction();
    try {

        Projects::destroy($request->id);

        DB::commit();
        Toastr::success('Assign projects deleted successfully :)','Success');
        return redirect()->back();
        
    } catch(\Exception $e) {
        DB::rollback();
        Toastr::error('Assign projects deleted fail :)','Error');
        return redirect()->back();
    }
}
   
public function updateReco(Request $request)
{
    DB::beginTransaction();
    try{
        $update = [

            'id'      => $request->id,
            'name'    => $request->name,
            'name_project'  => $request->name_project,
            'from_date'   => $request->from_date,
          
            'to_date'  => $request->to_date,
            'statut'=>$request->statut,
           
          
        ];


        Projects::where('id',$request->id)->update($update);
        DB::commit();
        Toastr::success('Project updated successfully :)','Success');
        return redirect()->back();

    }catch(\Exception $e){
        DB::rollback();
        Toastr::error('Project update fail :)','Error');
        return redirect()->back();
    }
}


}


