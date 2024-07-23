<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Department;
use App\Models\Employer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class AppController extends Controller
{
    public function index()
    {
        $totalDepartements = Department::all()->count();
       
        $totalAdministrateurs = User::all()->count();

    
        return view('dashboard', compact('totalDepartements', 'totalAdministrateurs'));
    }
}
