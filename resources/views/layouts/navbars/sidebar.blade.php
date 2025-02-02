<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('dashboard') }}">
            <img src="{{ asset('spccweb/img/brand.png') }}" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        @if(auth()->user()->gender == 'F')
                            <img alt="Image placeholder" src="https://res.cloudinary.com/spccweb/profile_pictures/default-female.png">
                        @else
                            <img alt="Image placeholder" src="https://res.cloudinary.com/spccweb/profile_pictures/default-male.png">
                        @endif
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ auth()->user()->getRole() }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item {{ $title == 'Profile' ? 'active' : '' }}">
                        <i class="ni ni-single-02"></i>
                        <span>Profile</span>
                    </a>
                    @role('writer|admin')
                    <a href="/posts/create" class="dropdown-item {{ $title == 'Write Post' ? 'active' : '' }}">
                        <i class="ni ni-fat-add"></i>
                        <span>Write Post</span>
                    </a>
                    <a href="/posts" class="dropdown-item {{ $title == 'View My Posts' ? 'active' : '' }}">
                        <i class="ni ni-single-copy-04"></i>
                        <span>View My Posts</span>
                    </a>
                    @endrole
                    @role('admin|moderator')
                    <a href="/posts/mod/published" class="dropdown-item {{ $title == 'All Published Posts' ? 'active' : '' }}">
                        <i class="ni ni-books"></i>
                        <span>All Published Posts</span>
                    </a>
                    <a href="/posts/mod/approval" class="dropdown-item {{ $title == 'Approval of Posts' ? 'active' : '' }}">
                        <i class="ni ni-check-bold"></i>
                        <span>Approval of Posts</span>
                    </a>
                    @endrole
                    @role('admin')
                    <a href="/events" class="dropdown-item {{ $title == 'Events' ? 'active' : '' }}">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>Events</span>
                    </a>
                    @endrole
                    <a href="#" class="dropdown-item {{ $title == 'About' ? 'active' : '' }}">
                        <i class="ni ni-app"></i>
                        <span>About</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('dashboard') }}">
                            <img src="{{ asset('spccweb/img/brand.png') }}">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item {{ $title == 'Dashboard' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="ni ni-tv-2"></i> Dashboard
                    </a>
                </li>
                @role('admin|registrar')
                <li class="nav-item {{ $title == 'Examination Period' ? 'active' : '' }}">
                    <a class="nav-link" href="/acad_terms">
                        <i class="ni ni-ruler-pencil"></i> Examination Period
                    </a>
                </li>
                @endrole
                @role('admin')
                <li class="nav-item {{ $title == 'Class Scheduling' ? 'active' : '' }}">
                    <a class="nav-link" href="/classes">
                        <i class="ni ni-calendar-grid-58"></i> Class Scheduling
                    </a>
                </li>
                @endrole
                @role('admin|registrar|head registrar')
                <li class="nav-item {{ $title == 'Grade Report' ? 'active' : '' }}">
                    <a class="nav-link" href="/grades">
                        <i class="ni ni-chart-bar-32"></i> Grade Report
                    </a>
                </li>
                @endrole
                @role('faculty')
                <li class="nav-item {{ $title == 'Faculty' ? 'active' : '' }}">
                    <a class="nav-link" href="/faculty">
                        <i class="ni ni-calendar-grid-58"></i> Schedule
                    </a>
                </li>
                <li class="nav-item {{ $title == 'View Faculty Load' ? 'active' : '' }}">
                    <a class="nav-link" href="/faculty/load">
                        <i class="ni ni-bullet-list-67"></i> View Faculty Load
                    </a>
                </li>
                @endrole
                @role('student')
                <li class="nav-item {{ $title == 'Students' ? 'active' : '' }}">
                    <a class="nav-link" href="/student">
                        <i class="ni ni-calendar-grid-58"></i> Schedule
                    </a>
                </li>
                <li class="nav-item {{ $title == 'View Enlistment' ? 'active' : '' }}">
                    <a class="nav-link" href="/student/enlistment">
                        <i class="ni ni-bullet-list-67"></i> View Enlistment
                    </a>
                </li>
                <li class="nav-item {{ $title == 'View Curriculum' ? 'active' : '' }}">
                    <a class="nav-link" href="/student/curriculum">
                        <i class="ni ni-collection"></i> View Curriculum
                    </a>
                </li>
                @endrole
                @role('admin')
                <li class="nav-item {{ $title == 'Faculty' ? 'active' : '' }}">
                    <a class="nav-link" href="/faculties">
                        <i class="ni ni-badge"></i> Manage Faculty
                    </a>
                </li>
                @endrole
                @role('head registrar')
                <li class="nav-item {{ $title == 'Registrar Staff' ? 'active' : '' }}">
                    <a class="nav-link" href="/registrars">
                        <i class="ni ni-badge"></i> Manage Registrar Staff
                    </a>
                </li>
                @endrole
                @role('admin|registrar')
                <li class="nav-item {{ $title == 'Students' ? 'active' : '' }}">
                    <a class="nav-link" href="/students">
                        <i class="ni ni-single-02"></i> Manage Students
                    </a>
                </li>
                @endrole
                @role('admin|registrar')
                <li class="nav-item {{ $title == 'Manage Curriculum' ? 'active' : '' }}">
                    <a class="nav-link" href="#navbar-curriculum" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-curriculum">
                        <i class="ni ni-collection"></i>
                        <span class="nav-link-text">Manage Curriculum</span>
                    </a>

                    <div class="collapse" id="navbar-curriculum">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="/curriculums">
                                    Curriculum Masterlist
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/courses">
                                    Course Masterlist
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endrole
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">

                @role('admin')
                <li class="nav-item {{ $title == 'User Management' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.index') }}">
                        <i class="ni ni-circle-08"></i> User Management
                    </a>
                </li>
                @endrole

                @role('admin|registrar')
                <li class="nav-item {{ $title == 'Settings' ? 'active' : '' }}">
                    <a class="nav-link" href="/settings">
                        <i class="ni ni-settings"></i> Settings
                    </a>
                </li>
                @endrole

                @role('writer')
                <li class="nav-item {{ $title == 'Write Post' ? 'active' : '' }}">
                    <a href="/posts/create" class="nav-link">
                        <i class="ni ni-fat-add"></i> Write Post
                    </a>
                </li>
                <li class="nav-item {{ $title == 'View My Posts' ? 'active' : '' }}">
                    <a href="/posts" class="nav-link">
                        <i class="ni ni-single-copy-04"></i> View My Posts
                    </a>
                </li>
                @endrole

                @role('moderator')
                <li class="nav-item {{ $title == 'All Published Posts' ? 'active' : '' }}">
                    <a href="/posts/mod/published" class="nav-link">
                        <i class="ni ni-books"></i> All Published Posts
                    </a>
                </li>
                <li class="nav-item {{ $title == 'Approval of Posts' ? 'active' : '' }}">
                    <a href="/posts/mod/approval" class="nav-link">
                        <i class="ni ni-check-bold"></i> Approval of Posts
                    </a>
                </li>
                @endrole
            </ul>
        </div>
    </div>
</nav>