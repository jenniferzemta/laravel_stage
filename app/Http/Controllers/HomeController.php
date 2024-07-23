<?php

namespace App\Http\Controllers;

use App\Models\LeavesAdmin;
use App\Models\Projects;
use App\Models\StaffSalary;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use PDF;
use App\Models\User;
use App\Models\department;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // main dashboard
    public function index()
    {

      
          $users = User::where('role_name', 'Employee')->get(); // Assuming 'staff' is the role for staff users
          $staffCount = $users->count();

          $users = User::where('role_name', 'Admin')->get(); // Assuming 'staff' is the role for staff users
          $admin = $users->count();

          $departement = department::count();
          $leave= LeavesAdmin::count();
          $project= Projects::count();
          $salary= StaffSalary::count();
          
    
       
        return view('dashboard.dashboard',compact('staffCount','admin','departement','leave','project','salary'));
    }
    // employee dashboard
    public function emDashboard()
    {
        $dt        = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();
        return view('dashboard.emdashboard',compact('todayDate'));
    }
   

    public function generatePDF(Request $request)
    {
         $data = ['title' => 'Welcome to ItSolutionStuff.com'];
         $pdf = PDF::loadView('payroll.salaryview', $data);
         return $pdf->download('text.pdf');
        // selecting PDF view
        $pdf = PDF::loadView('payroll.salaryview');
        // download pdf file
        return $pdf->download('pdfview.pdf');
    }
}
