
@extends('layouts.master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Employee <span id="year"></span></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Attendance</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_salary"><i class="fa fa-plus"></i> Add Attendance</a>
                    </div>
                </div>
            </div>

            <!-- Search Filter -->
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating">
                        <label class="focus-label">Employee Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                    <div class="form-group form-focus select-focus">
                        <select class="select floating"> 
                            <option value=""> -- Select -- </option>
                            <option value="">Employee</option>
                            <option value="1">Manager</option>
                        </select>
                        <label class="focus-label">Role</label>
                    </div>
                </div>
               
               
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                    <a href="#" class="btn btn-success btn-block"> Search </a>  
                </div>     
            </div>
            
            <!-- /Search Filter -->  
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Employee ID</th>
                                    <th>Date</th>
                                    <th>Punch_in</th>
                                    <th>Punch_out</th>
                                    <th>Break</th>
                                    <th>Production</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if (session('status'))
    <div class="alert alert-success">
        {{ session('status')}}
    </div>
    @endif

<ul>
    @foreach ($errors->all() as $error )
    <li class="alert alert-danger"> {{ $error}} </li>
    @endforeach
</ul>     
                            @foreach ($users as  $items)
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="{{ url('employee/profile/'.$items->user_id) }}" class="avatar"><img alt="" src="{{ URL::to('/assets/images/'. $items->avatar) }}"></a>
                                            <a href="{{ url('employee/profile/'.$items->user_id) }}">{{ $items->name }}<span>{{ $items->position }}</span></a>
                                        </h2>
                                    </td>
                                    <td>{{ $items->user_id }}</td>
                                    <td hidden class="id">{{ $items->id }}</td>
                                    <td hidden class="name">{{ $items->name }}</td>
                                
                                    <td>{{ $items->date }}</td>
                                    <td hidden class="date">{{ $items->date}}</td>

                                    <td>{{ $items->punch_in }} </td>
                                    <td hidden class="punch_in">{{ $items->punch_in }}</td>
                                    
                                    <td>{{ $items->punch_out }} </td>
                                    <td hidden class="punch_out">{{ $items->punch_out }}</td>

                                    <td>{{ $items->break }} </td>
                                    <td hidden class="break">{{ $items->break }}</td>

   
<td hidden class="production"></td>
                        
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item userAttendance" href="#" data-toggle="modal" data-target="#edit_attendance"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item attendanceDelete" href="#" data-toggle="modal" data-target="#delete_attendance"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Page Content -->

        <div id="add_salary" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Staff Attendance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('form/attendanceemployee/save') }}" method="POST">
                            @csrf
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <div class="form-group">
                                        <label>Select Staff</label>
                                        <select class="select select2s-hidden-accessible @error('name') is-invalid @enderror" style="width: 100%;" tabindex="-1" aria-hidden="true" id="name" name="name">
                                            <option value="">-- Select --</option>
                                            @foreach ($userList as $key=>$user )
                                                <option value="{{ $user->name }}" data-employee_id={{ $user->user_id }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <input class="form-control" type="hidden" name="user_id" id="employee_id" readonly>
                                <div class="col-sm-6"> 
                                    <label>Date</label>
                                    <input class="form-control @error('date') is-invalid @enderror" type="date" name="date" id="date" value="{{ old('date') }}">
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                               
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Punch_in</label>
                                        <input class="form-control @error('punch_in') is-invalid @enderror" type="time"  name="punch_in" id="punch_in" value="{{ old('punch_in') }}" >
                                        @error('punch_in')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    </div>
                                 
                                    <div class="col-sm-6">
                                   
                                        <label>Punch_out</label>
                                        <input class="form-control @error('punch_out') is-invalid @enderror" type="time"   name="punch_out" id="punch_out" value="{{ old('punch_out') }}">
                                        @error('punch_out')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                </div>
                               
                                
                                    <div class="col-sm-6">
                                        <label>Break</label>
                                        <input class="form-control @error('break') is-invalid @enderror" type="time"  name="break" id="break" value="{{ old('break') }}" >
                                        @error('break')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                 
                                   
                                    
                              
                                   
                                 
                           
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Edit Salary Modal -->
        <div id="edit_attendance" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Staff Attendance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('form/attendanceemployee/update') }}" method="POST">
                            @csrf
                            <input class="form-control" type="hidden" name="id" id="e_id" value="" >
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <div class="form-group">
                                        <label>Name Staff</label>
                                    
                                        <select class="select select2s-hidden-accessible @error('name') is-invalid @enderror" style="width: 100%;" tabindex="-1" aria-hidden="true" name="name" id="e_name" value="">
                                            <option value="">-- Select --</option>
                                            @foreach ($userList as $key=>$user )
                                                <option value="{{ $user->name }}" data-employee_id={{ $user->user_id }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    
                                    </div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6"> 
                                    <label>Date</label>
                                    <input class="form-control" type="date" name="date"  id="e_date" value="">
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                <div class="form-group">

                                        <label>Punch_in</label>
                                        <input class="form-control" type="time" name="punch_in" id="e_punch_in" value="">
                                    </div>
                                 
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Punch_out</label>
                                        <input class="form-control" type="time" name="punch_out" id="e_punch_out" value="">
                                    </div>
                                    
                                  </div>
                                
                                    <div class="row"> 
                                <div class="col-sm-6"> 
                                 
                                  
                                        <label>Break</label>
                                        <input class="form-control" type="time" name="break" id="e_break" value="">
                                    </div>
                                
                                     
                                    <div class="col-sm-6">
                                        <label>Production</label>
                                        <input class="form-control" type="text"  readonly name="production" id="e_production" value="">
                                    </div>
                                
                                </div>
                                
                            
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
         
        
        <!-- Delete Salary Modal -->
        <div class="modal custom-modal fade" id="delete_attendance" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Salary</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('form/attendanceemployee/delete') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <input type="hidden" name="id" class="e_id" value="">
                                        <button type="submit" class="btn btn-primary continue-btn submit-btn">Delete</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Salary Modal -->
     
    </div>

    <style>
      
      

    </style>
    <!-- /Page Wrapper -->
    @section('script')
        <script>
            $(document).ready(function() {
                $('.select2s-hidden-accessible').select2({
                    closeOnSelect: false
                });
            });
        </script>
        <script>
            // select auto id and email
            $('#name').on('change',function()
            {
                $('#employee_id').val($(this).find(':selected').data('employee_id'));
            });
        </script>
        {{-- update js --}}
        <script>
            $(document).on('click','.userAttendance',function()
            {
                var _this = $(this).parents('tr');
                $('#e_id').val(_this.find('.id').text());
            

                var name = (_this.find(".name").text());
            var _option = '<option selected value="' +name+ '">' + _this.find('.name').text() + '</option>'
            $( _option).appendTo("#e_name");

                $('#e_date').val(_this.find('.date').text());
                $('#e_punch_in').val(_this.find('.punch_in').text());
                $('#e_punch_out').val(_this.find('.punch_out').text());
                $('#e_break').val(_this.find('.break').text());
                $('#e_production').val(_this.find('.production').text());               
                
            });
        </script>
         {{-- delete js --}}
    <script>
        $(document).on('click','.attendanceDelete',function()
        {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
 
  
    @endsection
@endsection
