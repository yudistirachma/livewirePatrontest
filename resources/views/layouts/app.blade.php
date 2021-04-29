<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- csrf token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title : config('app.name', 'Laravel') }}</title>
    
    <link rel="icon" type="image/png" href="{{asset('tamplate/img/logo-Patron.png')}}">

    <!-- Custom fonts for this template-->
    <link href="{{asset('tamplate/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('tamplate/css/sb-admin-2.min.css')}}" rel="stylesheet">
    @isset($livewire)
        @livewireStyles
    @endisset
    @isset($tinymce)
        {{-- text editor WYSIWYG tinymce --}}
        <script src="{{ asset('tamplate/vendor/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
        {{-- <script src="https://cdn.tiny.cloud/1/ipgx6lqgnxjv7k6r5fs53rsqvx0agxuqf9sos17sqabms3v1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}
    @endisset
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <script>
                if (screen.width <= 425 ) {
                    document.getElementById("accordionSidebar").classList.add("toggled");
                }
            </script>

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-user-secret"></i>
                </div>
                <div class="sidebar-brand-text mx-3"> {{ auth()->user()->roles[0]->name }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            @if (auth()->user()->roles[0]->name == 'pimpinan redaktur')

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                PIMRED
            </div>

            <li class="nav-item ">
                <a class="nav-link" href="{{ route('employesList') }}" style="color:white">
                    <i class="fas fa-users-cog" style="color: white"></i>
                    <span>User Manage</span></a>
            </li>
                            
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item ">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" style="color:white">
                    <i class="fas fa-chalkboard-teacher" style="color:white"></i>
                    <span>Manage Group</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage</h6>
                        <a class="collapse-item" href="{{ route('listGroup') }}">List Group</a>
                        <a class="collapse-item" href="{{ route('groupCreate') }}">Create Group</a>
                    </div>                    
                </div>
            </li>
            @endif
            
            @if (auth()->user()->roles[0]->name == 'redaktur')

            <!-- Divider -->
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Redaktur
            </div>

            <li class="nav-item  ">
                <a class="nav-link" href="{{ route('redakturGroup') }}" style="color:white">
                    <i class="fas fa-chalkboard" style="color:white"></i>
                    <span>Redaktur Group</span></a>
            </li>
            @endif


            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Jurnalis
            </div>

            <li class="nav-item " style="color:white">
                <a class="nav-link" href="{{ route('myGroup') }}" style="color:white">
                    <i class="fas fa-tasks" style="color:white"></i>
                    <span>My Group</span></a>
            </li>

            <hr class="sidebar-divider">


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item  dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small text-capitalize">{{ auth()->user()->name }}</span>
                                @if(isset(auth()->user()->imgprofile))
                                    <img class="img-profile rounded-circle"  src="{{asset('storage/'.auth()->user()->imgprofile)}}">
                                @else
                                    <img class="img-profile rounded-circle"  src="{{asset('tamplate/img/undraw_profile.svg')}}">
                                @endif
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('updateProfile', ['user' => auth()->user()->id])}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright <a class="card-link text-gray-600 font-weight-bold" href="{{ route('home') }}">{{ config('app.name') }}</a> &copy; {{  \Carbon\Carbon::now()->year }}</span>

                        <div class="mt-1">Develop with <span class="text-danger">&#10084;</span> by 
                        <a class="card-link text-gray-600 font-weight-bold" href="https://github.com/yudistirachma">Yudistirachma</a>
                        
                        </div>
                    </div>
                    {{-- <div class="copyright text-center my-auto">
                        
                    </div> --}}
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top" style="z-index: 10;">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('tamplate/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('tamplate/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('tamplate/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('tamplate/js/sb-admin-2.min.js')}}"></script>

    @isset($livewire)
        @livewireScripts
    @endisset


</body>
</html>