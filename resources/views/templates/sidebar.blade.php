 <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            @hasrole('admin')

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Data Master</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="{{route('admin.kelas.index')}}">Data Kelas</a>
                        <a class="collapse-item" href="{{route('admin.tahunAjaran.index')}}">Data Tahun Ajaran</a>
                        <a class="collapse-item" href="{{route('admin.mataPelajaran.index')}}">Data Matapelajaran</a>
                        <a class="collapse-item" href="{{route('admin.guru.index')}}">Data Guru</a>
                        <a class="collapse-item" href="{{route('admin.orangTua.index')}}">Data Orang Tua</a>
                        <a class="collapse-item" href="{{ route('admin.siswa.index') }}">Data Siswa</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Management Pengguna</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Management Pengguna</h6>
                        <a class="collapse-item" href="{{ route('admin.createAdmin.index') }}">Create Account TU</a>
                        <a class="collapse-item" href="{{ route('admin.createGuru.index') }}">Create Account Guru</a>
                        <a class="collapse-item" href="{{ route('admin.createOrangTua.index') }}">Create Account Orang Tua</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.adminReportPresensi.index') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Laporan presensi</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.tahunAjaranAktif.index') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tahun Ajaran Aktif</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            @endhasrole


            @hasrole('guru')
           
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('guru.dashboard.index') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
            
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('guru.presensi.index') }}">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>presensi</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('guru.presensi.riwayatPresensi') }}">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>riwayat presensi</span></a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="{{ route('guru.presensi.Laporan') }}">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Laporan</span></a>
                </li>
            

        

        
        <!-- End of Sidebar -->

        @endhasrole

        </ul>

            

            

          <!-- Nav Item - Charts -->

         