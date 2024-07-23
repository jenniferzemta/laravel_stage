
@extends('layouts.master')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
        
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Projects</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                          
                            <li class="breadcrumb-item active">Projects</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                       <!-- <a href="{{ route('form/shiftlist/page') }}" class="btn add-btn m-r-5">Projects</a>-->
                       <a href="#" class="btn add-btn m-r-5" data-toggle="modal" data-target="#add_schedule"> Assign projects</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->


            <!-- Content Starts -->
            <!-- Search Filter -->
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">  
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating">
                        <label class="focus-label">Employee</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-2">  
                    <div class="form-group form-focus focused">
                        <div class="cal-icon">
                            <input class="form-control floating datetimepicker" type="text">
                        </div>
                        <label class="focus-label">From</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-2">  
                    <div class="form-group form-focus focused">
                        <div class="cal-icon">
                            <input class="form-control floating datetimepicker" type="text">
                        </div>
                        <label class="focus-label">To</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-2">  
                    <a href="#" class="btn btn-success btn-block"> Search </a>  
                </div>     
            </div>
            <!-- Search Filter--> 

            {!! Toastr::message() !!}
            <!-- /Search Filter -->  
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Employee ID</th>
                                    <th>Name_project</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Statut</th>
                                 
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
                            @foreach ($users as $items)
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

                                    <td>{{ $items->name_project }}</td>
                                    <td hidden class="name_project">{{ $items->name_project}}</td>

                                
                                    <td>{{ $items->from_date }}</td>
                                    <td hidden class="from_date">{{ $items->from_date}}</td>
                                     <td>{{ $items->to_date }}</td>
                                    <td hidden class="to_date">{{ $items->to_date}}</td>

                                    <td>{{ $items->statut}}</td>
                                    <td hidden class="statut">{{ $items->statut}}</td>

                        
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item updateSchedule" href="#" data-toggle="modal" data-target="#edit_schedule"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item scheduleDelete" href="#" data-toggle="modal" data-target="#delete_schedule"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
     
        <!-- Add Schedule Modal -->
        <div id="add_schedule" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Projects</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form action="{{ route('form/projects/save') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Staff Name <span class="text-danger">*</span></label>
                                        <select class="select select2s-hidden-accessible @error('name') is-invalid @enderror" style="width: 100%;" tabindex="-1" aria-hidden="true" id="name" name="name" value="">
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
                                <div class="form-group">
                                        <label class="col-form-label">Project Name </span></label>
                                
                                            <input class="form-control @error('name_project') is-invalid @enderror" type="text" id="name_project" name="name_project" value="{{ old('name_project') }}">
                                        </div>
                                    </div>
                                    @error('name_project')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror   
                                    </div>
                                    <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="">Start Date</label>
                                       <input class="form-control @error('from_date') is-invalid @enderror" type="date" id="from_date" name="from_date" value="{{ old('from_date') }}">
                                    
                                    </div>
                                    @error('from_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6"> 
                                    <label>End Date</label>
                                    <input class="form-control @error('to_date') is-invalid @enderror" type="date" name="to_date" id="to_date" value="{{ old('to_date') }} " >
                                    @error('to_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
</div>
<div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                  <label class="col-form-label">Statut <span class="text-danger">*</span></label>
                                        <select class="select select2s-hidden-accessible @error('statut') is-invalid @enderror" style="width: 100%;" tabindex="-1" aria-hidden="true" id="statut" name="statut" value="{{ old('statut') }}">
                                            <option value="">-- Select --</option>
                                           <option value="Initie">Initie</option>
                                           <option value="En cours">En cours</option>
                                           <option value="Termine">Terminé</option>
                                           <option value="Bloque">Bloque</option>
                                        </select>
                                    </div>
                                    @error('statut')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                   
                        </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      
        
        <!-- Edit Schedule Modal -->
        <div id="edit_schedule" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('form/projects/update')}}" method="POST">
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
                                    <label>Name_project</label>
                                    <input class="form-control" type="text" name="name_project"  id="e_name_project" value="">
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                <div class="form-group">

                                        <label>from_date</label>
                                        <input class="form-control" type="date" name="from_date" id="e_from_date" value="">
                                    </div>
                                 
                                    </div>
                                    <div class="col-sm-6">
                                        <label>End_date</label>
                                        <input class="form-control" type="date" name="to_date" id="e_to_date" value="">
                                    </div>
                                    
                                  </div>
                                
                                    <div class="row"> 
                                <div class="col-sm-6"> 
                                 
                                  
                                     
                                        <label class="col-form-label">Statut </label>
                                        <select class="select select2s-hidden-accessible @error('statut') is-invalid @enderror" style="width: 100%;" tabindex="-1" aria-hidden="true"  name="statut" id="e_statut">
                                            <option value="">-- Select --</option>
                                           <option value="Initie">Initie</option>
                                           <option value="En cours">En cours</option>
                                           <option value="Termine">Terminé</option>
                                           <option value="Bloque">Bloque</option>
                                        </select>
                                    </div>
                                    @error('statut')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
        <!-- /Edit Schedule Modal -->

    </div>
    <!-- Page Wrapper -->

        
        <div class="modal custom-modal fade" id="delete_schedule" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Projects</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="" method="POST">
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
         
     
    </div>

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
            $(document).on('click','.updateSchedule',function()
            {
                var _this = $(this).parents('tr');
                $('#e_id').val(_this.find('.id').text());
               

                var name = (_this.find(".name").text());
            var _option = '<option selected value="' +name+ '">' + _this.find('.name').text() + '</option>'
            $( _option).appendTo("#e_name");

                $('#e_name_project').val(_this.find('.name_project').text());
                $('#e_from_date').val(_this.find('.from_date').text());
                $('#e_to_date').val(_this.find('.to_date').text());
            
               
                

                var statut= (_this.find(".statut").text());
            var _option = '<option selected value="' +statut+ '">' + _this.find('.statut').text() + '</option>'
            $( _option).appendTo("#e_statut");
            });
        </script>
         {{-- delete js --}}
    <script>
        $(document).on('click','.scheduleDelete',function()
        {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
    
   
@endsection

@endsection
