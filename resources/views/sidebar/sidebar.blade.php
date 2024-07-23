
<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                @if (Auth::user()->role_name=='Admin')
                <li class="{{set_active(['home','em/dashboard'])}} submenu">
                    <a href="#" class="{{ set_active(['home','em/dashboard']) ? 'noti-dot' : '' }}">
                        <i class="la la-dashboard"></i>
                        <span> Dashboard</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['home'])}}" href="{{ route('home') }}">Admin Dashboard</a></li>
                        <li><a class="{{set_active(['em/dashboard'])}}" href="{{ route('em/dashboard') }}"></a></li>
                    </ul>
</li>
@endif
      @if (Auth::user()->role_name=='Admin')
                    <li class="menu-title"> <span>Authentication</span> </li>
                    <li class="{{set_active(['search/user/list','userManagement','activity/log','activity/login/logout'])}} submenu">
                        <a href="#" class="{{ set_active(['search/user/list','userManagement','activity/log','activity/login/logout']) ? 'noti-dot' : '' }}">
                            <i class="fa fa-users"></i> <span> Staff</span> <span class="menu-arrow"></span>
                        </a>
                        <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                            <li><a class="{{set_active(['search/user/list','userManagement'])}}" href="{{ route('userManagement') }}">All Staff</a></li>
                            <li><a class="{{set_active(['activity/log'])}}" href="{{ route('activity/log') }}">Activity Log</a></li>
                            <li><a class="{{set_active(['activity/login/logout'])}}" href="{{ route('activity/login/logout') }}"><i class="fa fa-user-plus"></i> <span> Attendance</span> </a></li>
                        </ul>
                    </li>
              @endif
              @if (Auth::user()->role_name=='Admin')
                <li class="menu-title"> <span>  </span> </li>
                <li class="{{set_active(['all/employee/list','all/employee/list','all/employee/card','form/holidays/new','form/leaves/new',
                    'form/leavesemployee/new','form/leavesettings/page','attendance/page',
                    'attendance/employee/page','form/departments/page','form/designations/page',
                    'form/timesheet/page','form/shiftscheduling/page','form/overtime/page'])}} submenu">
                   
                   
                   <a href="#" class="{{ set_active(['all/employee/list','all/employee/card','form/holidays/new','form/leaves/new',
                    'form/leavesemployee/new','form/leavesettings/page','attendance/page',
                    'attendance/employee/page','form/departments/page','form/designations/page',
                    'form/timesheet/page','form/shiftscheduling/page','form/overtime/page']) ? 'noti-dot' : '' }}">
                    <i class="la la-table"></i> 
                    <span> Departement</span> <span class="menu-arrow"></span>
                      </a>
                      <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                      <li>
                       <a class="{{set_active(['form/departments/page'])}}" href="{{ route('form/departments/page') }}">
                        <i class="fa fa-hand-o-right"></i>Add department</a>
                       <!-- <li><a class="{{set_active(['form/designations/page'])}}" href="{{ route('form/designations/page') }}">Designations</a></li>-->
                        </li>
                        </ul>
</li>
@endif

  
                  <!--  <a href="#" class="{{ set_active(['all/employee/list','all/employee/card','form/holidays/new','form/leaves/new',
                    'form/leavesemployee/new','form/leavesettings/page','attendance/page',
                    'attendance/employee/page','form/departments/page','form/designations/page',
                    'form/timesheet/page','form/shiftscheduling/page','form/overtime/page']) ? 'noti-dot' : '' }}">
                    <i class="fa fa-users"></i> <span> Staff</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['all/employee/list','all/employee/card'])}}" href="{{ route('all/employee/card') }}">
                        <i class="fa fa-hand-o-right"></i>All Staff</a></li>

                    </ul>

                

                    <a href="#" class="{{ set_active([ 'form/attendanceemployee/page', 
                    ]) ? 'noti-dot' : '' }}">

                        <i class="fa fa-user-plus"></i> <span> Attendance</span> <span class="menu-arrow"></span>
                        </a>
                         <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['form/attendanceemployee/page'])}}" href="{{ route('form/attendanceemployee/page') }}"> <i class="fa fa-hand-o-right"></i>Staff</a></li>
                     
                        
                        
                    </ul>-->
                    <li class="menu-title"> <span>  </span> </li>
                <li class="{{set_active(['all/employee/list','all/employee/list','all/employee/card','form/holidays/new','form/leaves/new',
                    'form/leavesemployee/new','form/leavesettings/page','attendance/page',
                    'attendance/employee/page','form/departments/page','form/designations/page',
                    'form/timesheet/page','form/shiftscheduling/page','form/overtime/page'])}} submenu">
                   

                    <a href="#" class="{{ set_active(['all/employee/list','all/employee/card','form/holidays/new','form/leaves/new',
                    'form/leavesemployee/new','form/leavesettings/page','attendance/page','form/project/page',
                    'attendance/employee/page','form/departments/page','form/designations/page',
                    'form/timesheet/page','form/shiftscheduling/page','form/overtime/page']) ? 'noti-dot' : '' }}">
                    <i class="fa fa-tasks"></i> <span> Projects</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                    <!--<li><a class="{{set_active(['form/project/page'])}}" href="{{ route('form/project/page') }}"> <i class="fa fa-hand-o-right"></i>Project</a></li>-->
                    <li><a class="{{set_active(['form/shiftscheduling/page'])}}" href="{{ route('form/shiftscheduling/page') }}"> <i class="fa fa-hand-o-right"></i> Assign Projects</a></li>
                        
                    
                    </ul>


                    <a href="#" class="{{ set_active(['all/employee/list','all/employee/card','form/holidays/new','form/leaves/new',
                    'form/leavesemployee/new','form/leavesettings/page','attendance/page',
                    'attendance/employee/page','form/departments/page','form/designations/page',
                    'form/timesheet/page','form/shiftscheduling/page','form/overtime/page']) ? 'noti-dot' : '' }}">
                    <i class="fa fa-sign-out"></i> <span> Leaves</span> <span class="menu-arrow"></span></a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['form/holidays/new'])}}" href="{{ route('form/holidays/new') }}"> <i class="fa fa-hand-o-right"></i>Holidays</a></li>
                        <li><a class="{{set_active(['form/leaves/new'])}}" href="{{ route('form/leaves/new') }}"> <i class="fa fa-hand-o-right"></i>Leaves (Admin) 
                            <span class="badge badge-pill bg-primary float-right">1</span></a>
                        </li>

                   <!-- <li><a class="{{set_active(['form/leavesemployee/new'])}}" href="{{route('form/leavesemployee/new')}}"> <i class="fa fa-hand-o-right"></i>Leaves (Employee)</a></li>-->
                       <!-- <li><a class="{{set_active(['form/leavesettings/page'])}}" href="{{ route('form/leavesettings/page') }}"> <i class="fa fa-hand-o-right"></i>Leave Settings</a></li>-->
                    </ul>
                        
                        
              <!--  <li class="{{set_active(['form/salary/page','form/payroll/items'])}} submenu">-->
              
                   
              <a href="#" class="{{ set_active(['form/salary/page','form/payroll/items','form/payroll/salaryview','payroll/salaryview']) ? 'noti-dot' : '' }}"><i class="fa fa-money"></i>
                    <span> Salary</span> <span class="menu-arrow"></span></a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['form/salary/page'])}}" href="{{ route('form/salary/page') }}"> <i class="fa fa-hand-o-right"></i> Employee Salary </a></li>
                     <!--   <li><a href="{{ route('form/payroll/salaryview') }}"> Payslip </a></li>
                        <li><a class="{{set_active(['form/payroll/items'])}}" href="{{ route('form/payroll/items') }}"> Payroll Items </a></li>-->
                    </ul>


<!-- <li class="menu-title"> <span>HR</span> </li>
               <li class="{{set_active(['create/estimate/page','form/estimates/page','payments','expenses/page'])}} submenu">
                    <a href="#" class="{{ set_active(['create/estimate/page','form/estimates/page','payments','expenses/page']) ? 'noti-dot' : '' }}">
                        <i class="la la-files-o"></i>
                        <span> Sales </span> 
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['create/estimate/page','form/estimates/page'])}}" href="{{ route('form/estimates/page') }}">Estimates</a></li>
                        <li><a class="{{set_active(['payments'])}}" href="{{ route('payments') }}">Payments</a></li>
                        <li><a class="{{set_active(['expenses/page'])}}" href="{{ route('expenses/page') }}">Expenses</a></li>
                    </ul>
                </li>
                <li class="{{set_active(['form/salary/page','form/payroll/items'])}} submenu">
                    <a href="#" class="{{ set_active(['form/salary/page','form/payroll/items']) ? 'noti-dot' : '' }}"><i class="la la-money"></i>
                    <span> Salaire</span> <span class="menu-arrow"></span></a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['form/salary/page'])}}" href="{{ route('form/salary/page') }}"> Employee Salary </a></li>
                        <li><a href="{{ route('form/salary/page') }}"> Payslip </a></li>
                        <li><a class="{{set_active(['form/payroll/items'])}}" href="{{ route('form/payroll/items') }}"> Payroll Items </a></li>
                    </ul>
                </li>-->
             <li class="{{set_active(['form/expense/reports/page','form/invoice/reports/page','form/leave/reports/page','form/daily/reports/page'])}} submenu">
                    <a href="#" class="{{ set_active(['form/expense/reports/page','form/invoice/reports/page','form/leave/reports/page','form/daily/reports/page']) ? 'noti-dot' : '' }}"><i class="la la-pie-chart"></i>
                    <span> Reports </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                      <!--  <li><a class="{{set_active(['form/expense/reports/page'])}}" href="{{ route('form/expense/reports/page') }}"> Expense Report </a></li>
                        <li><a class="{{set_active(['form/invoice/reports/page'])}}" href="{{ route('form/invoice/reports/page') }}"> Invoice Report </a></li>
                        <li><a class="{{set_active([''])}}" href="payments-reports.html"> Payments Report </a></li>
                        <li><a class="{{set_active([''])}}" href="employee-reports.html"> Employee Report </a></li>
                        <li><a class="{{set_active([''])}}" href="payslip-reports.html"> Payslip Report </a></li>
                        <li><a class="{{set_active([''])}}" href="attendance-reports.html"> Attendance Report </a></li>
                           <li><a class="{{set_active(['form/daily/reports/page'])}}" href="{{ route('form/daily/reports/page') }}"> Daily Report </a></li>-->
                        <li><a class="{{set_active(['form/leave/reports/page'])}}" href="{{ route('form/leave/reports/page') }}"> Leave Report </a></li>
                     
                    </ul>
                </li>
                <!--
                <li class="menu-title"> <span>Performance</span> </li>
                <li class="{{set_active(['form/performance/indicator/page','form/performance/page','form/performance/appraisal/page'])}} submenu">
                    <a href="#" class="{{ set_active(['form/performance/indicator/page','form/performance/page','form/performance/appraisal/page']) ? 'noti-dot' : '' }}"><i class="la la-graduation-cap"></i>
                    <span> Performance </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['form/performance/indicator/page'])}}" href="{{ route('form/performance/indicator/page') }}"> Performance Indicator </a></li>
                        <li><a class="{{set_active(['form/performance/page'])}}" href="{{ route('form/performance/page') }}"> Performance Review </a></li>
                        <li><a class="{{set_active(['form/performance/appraisal/page'])}}" href="{{ route('form/performance/appraisal/page') }}"> Performance Appraisal </a></li>
                    </ul>
                </li>
                <li class="{{set_active(['form/training/list/page','form/trainers/list/page'])}} submenu"> 
                    <a href="#" class="{{ set_active(['form/training/list/page','form/trainers/list/page']) ? 'noti-dot' : '' }}"><i class="la la-edit"></i>
                    <span> Training </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['form/training/list/page'])}}" href="{{ route('form/training/list/page') }}"> Training List </a></li>
                        <li><a class="{{set_active(['form/trainers/list/page'])}}" href="{{ route('form/trainers/list/page') }}"> Trainers</a></li>
                        <li><a class="{{set_active(['form/training/type/list/page'])}}" href="{{ route('form/training/type/list/page') }}"> Training Type </a></li>
                    </ul>-->
                </li>
              
                
                <li class="menu-title"> <span>Pages</span> </li>
                <li class="{{set_active(['employee/profile/*','profile_user'])}} submenu">
                    <a href="#"><i class="la la-user"></i>
                        <span> Profile </span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="display: none;">
                        <li><a class="{{set_active(['employee/profile/*'])}}" href="{{ route('profile_user') }}"> Employee Profile </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
