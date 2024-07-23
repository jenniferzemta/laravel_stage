<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function getDepartments()
    {
        // Use the Department model to query the database
        $departments = Department::all();
    
        // Return the collection of departments
        return $departments;
    }

}
