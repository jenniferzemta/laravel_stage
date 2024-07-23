
@extends('layouts.exportmaster')
@section('content')
    <!-- Page Wrapper -->
    
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid" id="app">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col" >
                        <h3 class="page-title">Payslip</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('form/salary/page') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Payslip</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-white">CSV</button>
                            <button class="btn btn-white"><a href=""@click.prevent="printme" target="_blank">PDF</a></button>
                            <button class="btn btn-white"><i class="fa fa-print fa-lg"></i><a href="" @click.prevent="printme" target="_blank"> Print</a></button>
                        </div>
                    </div>
                </div>
           
            <div class="row" >
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="payslip-title">Facture de Paie  {{ \Carbon\Carbon::now()->format('M') }}   {{ \Carbon\Carbon::now()->year }}  </h4>
                            <div class="row">
                                <div class="col-sm-6 m-b-20">
                                    @if(!empty($users->avatar))
                                    <img src="{{ URL::to('/assets/images/'. $users->avatar) }}" class="inv-logo" alt="{{ $users->name }}">
                                    @endif
                                    <ul class="list-unstyled mb-0">
                                        <li>{{ $users->name }}</li>
                                        <li>{{ $users->address }}</li>
                                        <li>{{ $users->country }}</li>
                                    </ul>
                                </div>
                                <div class="col-sm-6 m-b-20">
                                    <div class="invoice-details">
                                        <h3 class="text-uppercase">Payslip #49029</h3>
                                        <ul class="list-unstyled">
                                            <li>Salary Month: <span>{{ \Carbon\Carbon::now()->format('M') }}  , {{ \Carbon\Carbon::now()->year }}  </span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 m-b-20">
                                    <ul class="list-unstyled">
                                        <li><h5 class="mb-0"><strong>{{ $users->name }}</strong></h5></li>
                                        <li><span>{{ $users->position }}</span></li>
                                        <li>Employee ID: {{ $users->user_id }}</li>
                                        <li>Joining Date: {{ $users->join_date }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div>
                                        <h4 class="m-b-10"><strong>Earnings</strong></h4>
                                        <table class="table table-bordered">
                                            <tbody>
                                                <?php
                                                    $a =  (int)$users->basic;
                                                  
                                                    $e =  (int)$users->allowance;
                                                    $Total_Earnings   = $a + $e;
                                                ?>
                                                <tr>
                                                    <td><strong>Basic Salary</strong> <span class="float-right">FCFA{{ $users->basic }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Allowance</strong> <span class="float-right">FCFA{{ $users->allowance }}</span></td>
                                                </tr>
                                            
                                                <tr>
                                                    <td><strong>Total Earnings</strong> <span class="float-right"><strong>FCFA <?php echo $Total_Earnings ?></strong></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                               <!--<div class="col-sm-6">
                                    <div>
                                        <h4 class="m-b-10"><strong>Deductions</strong></h4>
                                        <table class="table table-bordered">
                                            <tbody>
                                              
                                                <tr>
                                                    <td><strong>Tax Deducted at Source (T.D.S.)</strong> <span class="float-right"></span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Provident Fund</strong> <span class="float-right"></span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>ESI</strong> <span class="float-right"></span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Loan</strong> <span class="float-right"></span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Total Deductions</strong> <span class="float-right"><strong></strong></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>-->
                                <div class="col-sm-12" >
                                    <p><strong>Salary: <?php echo $Total_Earnings ?> FCFA</strong> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
    </div>
@endsection