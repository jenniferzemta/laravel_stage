<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estimates;
use Brian2694\Toastr\Facades\Toastr;
use DB;

class SalesController extends Controller
{
    /** page estimates */
    public function estimatesIndex()
    {
        return view('sales.estimates');
    }

    /** page create estimates */
    public function createEstimateIndex()
    {
        return view('sales.createestimate');
    }

    /** page edit estimates */
    public function editEstimateIndex()
    {
        return view('sales.editestimate');
    }

    /** view page estimate */
    public function viewEstimateIndex()
    {
        return view('sales.estimateview');
    }

    /** save record create estimate */
    public function createEstimateSaveRecord(Request $request)
    {
        $request->validate([
            'client'   => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $estimates = new Estimates;
            $estimates->client = $request->client;
            $estimates->project= $request->project;
            $estimates->email  = $request->email;
            $estimates->tax    = $request->tax;
            $estimates->client_address = $request->client_address;
            $estimates->billing_address= $request->billing_address;
            $estimates->estimate_date = $request->estimate_date;
            $estimates->expiry_date   = $request->expiry_date;
            $estimates->total = $request->total;
            $estimates->tax_1 = $request->tax_1;
            $estimates->discount    = $request->discount;
            $estimates->grand_total = $request->grand_total;
            $estimates->other_information = $request->other_information;
            $estimates->save();

            DB::commit();
            Toastr::success('Create new Estimates successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Estimates fail :)','Error');
            return redirect()->back();
        }
    }
}
