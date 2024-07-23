<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DesignationController extends Controller
{

    public function index()
    {
    
           
            $department  = DB::table('departments')->get();
            return view('usermanagement.user_control',compact('department'));
        }
       
        
    
    public function getDesignations()
    {
        // Use the Department model to query the database
        $designations = Designation::all();
    
        // Return the collection of departments
        return $designations;
    }


public function saveRecordDesignation(Request $request)
    {
        $request->validate([
            'designation'       =>'required|string|max:255',
            'department'        => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try{
            $designation = designation::where('designation',$request->designation);
            $department = department::where('department',$request->department);
            if ($department === null)
            {
                $designation = new designation;
                
                $department->department = $request->department;
                $designation->save();
    
                DB::commit();
                Toastr::success('Add new desigantion successfully :)','Success');
                return redirect()->route('form/designation/page');
            } else {
                DB::rollback();
                Toastr::error('Add new designation exits :)','Error');
                return redirect()->back();
            }
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Add new designation fail :)','Error');
            return redirect()->back();
        }
    }

    /** update record department */
    public function updateRecordDepartment(Request $request)
    {
        DB::beginTransaction();
        try{
            // update table departments
            $department = [
                'id'=>$request->id,
                'department'=>$request->department,
            ];
            department::where('id',$request->id)->update($department);
        
            DB::commit();
            Toastr::success('updated record successfully :)','Success');
            return redirect()->route('form/departments/page');
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('updated record fail :)','Error');
            return redirect()->back();
        }
    }

    /** delete record department */
    public function deleteRecordDepartment(Request $request) 
    {
        try {

            department::destroy($request->id);
            Toastr::success('Department deleted successfully :)','Success');
            return redirect()->back();
        
        } catch(\Exception $e) {

            DB::rollback();
            Toastr::error('Department delete fail :)','Error');
            return redirect()->back();
        }
    }
}