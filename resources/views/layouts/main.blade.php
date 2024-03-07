<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS - SMKS YPPT GARUT</title>
    
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/bootstrap.css">
    
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendors/chartjs/Chart.min.css">

    <link rel="stylesheet" href="{{ url('/') }}/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/app.css">
    <link rel="shortcut icon" href="{{ url('/') }}/assets/images/favicon.ico" type="image/x-icon">
</head>
<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <img src="{{ url('/') }}/assets/images/banner.svg" alt="" srcset="">
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
                <li class='sidebar-title'>Main Menu</li>
                <li class="sidebar-item {{ ($menu === 'dashboard') ? 'active' : '' }}">
                    <a href="{{ url('/') }}/" class='sidebar-link'>
                        <i data-feather="home" width="20"></i> 
                        <span>Dashboard</span>
                    </a>
                </li>
                @if (auth()->user()->role->id == 1)
                <li class="sidebar-item  has-sub {{ ($menu === 'pengaturan') ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="tool" width="20"></i> 
                        <span>Pengaturan</span>
                    </a>                    
                    <ul class="submenu {{ ($smenu === 'tahunpelajaran') ? 'active' : '' }}">                        
                        <li>
                            <a href="{{ url('/') }}/tahunpelajaran">Tahun Pelajaran</a>
                        </li>
                        <li>
                            <a href="{{ url('/') }}/hakakses">Hak Akses</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item  has-sub {{ ($menu === 'referensi') ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="list" width="20"></i> 
                        <span>Referensi</span>
                    </a>                    
                    <ul class="submenu {{ ($smenu === 'user') ? 'active' : '' }}">                        
                        <li>
                            <a href="{{ url('/') }}/users">Data Pengguna</a>
                        </li>
                        <li>
                            <a href="{{ url('/') }}/rombonganbelajar">Data Rombongan Belajar</a>
                        </li>
                    </ul>
                </li>
                @elseif(auth()->user()->role->id == 2)
                <li class="sidebar-item {{ ($menu === 'pembelajaran') ? 'active' : '' }}">
                    <a href="{{ url('/') }}/pembelajaran" class='sidebar-link'>
                        <i data-feather="book-open" width="20"></i> 
                        <span>Pembelajaran</span>
                    </a>
                </li>
                <li class="sidebar-item {{ ($menu === 'administrasi') ? 'active' : '' }}">
                    <a href="{{ url('/') }}/administrasi" class='sidebar-link'>
                        <i data-feather="archive" width="20"></i> 
                        <span>Administrasi</span>
                    </a>
                </li>
                @elseif(auth()->user()->role->id == 3)
                <li class="sidebar-item {{ ($menu === 'pembelajaran') ? 'active' : '' }}">
                    <a href="{{ url('/') }}/pembelajaranpd" class='sidebar-link'>
                        <i data-feather="book-open" width="20"></i> 
                        <span>Pembelajaran</span>
                    </a>
                </li>
                @endif
                <li class="sidebar-item {{ ($menu === 'profil') ? 'active' : '' }}">
                    <a href="{{ url('/') }}/profil" class='sidebar-link'>
                        <i data-feather="user" width="20"></i> 
                        <span>Profil Saya</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="dropdown-item" type="submit">
                            <i data-feather="log-out" width="20"></i> 
                            <span>Keluar</span></button>
                        </form>
                    </li>
                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>
    <div id="main">
            @include('layouts.side')
            @yield('content')
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-left">
                        <p>{{ date('Y') }} &copy; SMKS YPPT GARUT</p>
                    </div>
                    <div class="float-right">
                        <p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by <a href="#">PPLG</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ url('/') }}/assets/js/feather-icons/feather.min.js"></script>
    <script src="{{ url('/') }}/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ url('/') }}/assets/js/app.js"></script>
    
    <script src="{{ url('/') }}/assets/vendors/chartjs/Chart.min.js"></script>
    <script src="{{ url('/') }}/assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="{{ url('/') }}/assets/js/pages/dashboard.js"></script>

    <script src="{{ url('/') }}/assets/js/main.js"></script>
</body>
</html>
