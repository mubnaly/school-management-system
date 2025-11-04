@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp


<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="{{ route('dashboard') }}">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="Logo">
                        <h3><b>D</b>awwar</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="{{ $route == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i data-feather="grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="header nav-small-cap">User</li>

            @if (Auth::user()->role == 'admin')
                <li class="treeview {{ $prefix == '/users' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-light fa-users"></i>
                        <span>User Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('user.view') }}"><i class="ti-more"></i>View Users</a></li>
                    </ul>
                </li>
            @endif

            <li class="treeview {{ $prefix == '/profile' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-solid fa-user"></i> <span>Manage Profile</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('profile.view') }}"><i class="ti-more"></i>My Profile</a></li>
                    <li><a href="{{ route('password.view') }}"><i class="ti-more"></i>Password</a></li>
                </ul>
            </li>

            <!-- Show different menus based on user role -->
            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'Instructor')
                <li class="header nav-small-cap">Student Affairs</li>
                <li class="treeview {{ $prefix == '/administrations' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-solid fa-book"></i><span>Administration</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if (Auth::user()->role == 'admin')
                            <li><a href="{{ route('student.class.view') }}"><i class="ti-more"></i>Student Class</a>
                            </li>
                            <li><a href="{{ route('student.year.view') }}"><i class="ti-more"></i>Year of the Force</a>
                            </li>
                            <li><a href="{{ route('student.group.view') }}"><i class="ti-more"></i>Department</a></li>
                            <li><a href="{{ route('student.shift.view') }}"><i class="ti-more"></i>Student Shift</a>
                            </li>
                            <li><a href="{{ route('fee.category.view') }}"><i class="ti-more"></i>Payment
                                    Categories</a></li>
                            <li><a href="{{ route('fee.amount.view') }}"><i class="ti-more"></i>Manage Bills</a></li>
                        @endif
                        <li><a href="{{ route('exam.type.view') }}"><i class="ti-more"></i>Student Exam</a></li>
                        <li><a href="{{ route('school.subject.view') }}"><i class="ti-more"></i>Subjects</a></li>
                        <li><a href="{{ route('assign.subject.view') }}"><i class="ti-more"></i>Curriculum</a></li>
                        @if (Auth::user()->role == 'admin')
                            <li><a href="{{ route('designation.view') }}"><i class="ti-more"></i>School Department</a>
                            </li>
                        @endif
                    </ul>
                </li>

                <li class="treeview {{ $prefix == '/students' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-solid fa-graduation-cap"></i>
                        <span>Student Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('student.registration.view') }}"><i class="ti-more"></i>Student
                                Enrollment</a></li>
                        <li><a href="{{ route('roll.generate.view') }}"><i class="ti-more"></i>Roll</a></li>
                        @if (Auth::user()->role == 'admin')
                            <li><a href="{{ route('registration.fee.view') }}"><i class="ti-more"></i>Application
                                    Fee</a></li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (Auth::user()->role == 'admin')
                <li class="header nav-small-cap">Personnel</li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-solid fa-users-gear"></i>
                        <span>Instructors Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="ti-more"></i>Coming Soon</a></li>
                    </ul>
                </li>
            @endif

        </ul>
    </section>

    <!-- LOGOUT FOOTER SECTION -->
    <div class="sidebar-footer">
        <!-- Settings -->
        <a href="{{ route('profile.edit') }}" class="link" data-toggle="tooltip" title="Settings">
            <i class="ti-settings"></i>
        </a>

        {{-- <!-- Profile -->
        <a href="{{ route('profile.view') }}" class="link" data-toggle="tooltip" title="Profile">
            <i class="ti-user"></i>
        </a> --}}

        <!-- Password -->
        <a href="{{ route('password.view') }}" class="link" data-toggle="tooltip" title="Password">
            <i class="ti-lock"></i>
        </a>

        <!-- LOGOUT BUTTON -->
        <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="link" data-toggle="tooltip" title="Log Out">
            <i class="ti-power-off"></i>
        </a>

        <!-- Hidden Logout Form -->
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>


{{-- @php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp


<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="{{ route('dashboard') }}">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="Logo">
                        <h3><b>D</b>awwar</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="{{ $route == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i data-feather="grid"></i>
                    <span>Home</span>
                </a>
            </li>

            <li class="header nav-small-cap">User</li>
            @if (Auth::user()->role == 'admin')
                <li class="treeview {{ $prefix == '/users' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-light fa-users"></i>
                        <span>User Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('user.view') }}"><i class="ti-more"></i>View Users</a></li>
                    </ul>
                </li>
            @endif

            <li class="treeview {{ $prefix == '/profile' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-solid fa-user"></i> <span>Profile Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('profile.view') }}"><i class="ti-more"></i>My Profile</a></li>
                    <li><a href="{{ route('password.view') }}"><i class="ti-more"></i>Password</a></li>
                </ul>
            </li>

            <li class="header nav-small-cap">Student Affairs</li>
            <li class="treeview {{ $prefix == '/administrations' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-solid fa-book"></i><span>Adminstration</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('student.class.view') }}"><i class="ti-more"></i>Student Classes</a></li>
                    <li><a href="{{ route('student.year.view') }}"><i class="ti-more"></i>Year Class</a></li>
                    <li><a href="{{ route('student.group.view') }}"><i class="ti-more"></i>Major</a></li>
                    <li><a href="{{ route('student.shift.view') }}"><i class="ti-more"></i>Student Shift</a></li>
                    <li><a href="{{ route('fee.category.view') }}"><i class="ti-more"></i>Payment Category</a></li>
                    <li><a href="{{ route('fee.amount.view') }}"><i class="ti-more"></i>Manage Billing</a></li>
                    <li><a href="{{ route('exam.type.view') }}"><i class="ti-more"></i>Student Exams</a></li>
                    <li><a href="{{ route('school.subject.view') }}"><i class="ti-more"></i>Subjects</a></li>
                    <li><a href="{{ route('assign.subject.view') }}"><i class="ti-more"></i>Curriculum</a></li>
                    <li><a href="{{ route('designation.view') }}"><i class="ti-more"></i>School Position</a></li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/students' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-solid fa-graduation-cap"></i>
                    <span>Student Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('student.registration.view') }}"><i class="ti-more"></i>Student
                            Registration</a>
                    <li><a href="{{ route('roll.generate.view') }}"><i class="ti-more"></i></a>
                    <li><a href="{{ route('registration.fee.view') }}"><i class="ti-more"></i>Registration Fee</a>
                    </li>
                </ul>
            </li>



            <li class="header nav-small-cap">Personnel Affairs</li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-solid fa-users-gear"></i>
                    <span>Instructors Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="components_alerts.html"><i class="ti-more"></i>Alerts</a></li>
                    <li><a href="components_badges.html"><i class="ti-more"></i>Badge</a></li>

                </ul>
            </li>





        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings"
            aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i
                class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside> --}}
