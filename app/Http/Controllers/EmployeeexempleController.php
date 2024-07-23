<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use App\Models\department;
use App\Models\User;
use App\Models\module_permission;

use App\Models\Employeeemployee;
use PDF;

class EmployeeexempleController extends Controller {

    // Display user data in view
    public function showEmployees(){
      $employee = Employeeexemple::all();
      return view('index', compact('employee'));
    }

    // Generate PDF
    public function createPDF() {
      // retreive all records from db
      $data = Employeeexemple::all();

      // share data to view
      view()->share('employee',$data);
      $pdf = PDF::loadView('pdf_view', $data);

      // download PDF file with download method
      return $pdf->download('pdf_file.pdf');
    }
}