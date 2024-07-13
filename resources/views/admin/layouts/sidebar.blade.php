  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link">
      <img src="{{asset('images/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <h4 class="brand-text font-weight-light">SIAKAD SMEPRI</h4>
</div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('images/AdminLTELogo.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <p>{{ Auth::user()->username }}</p>
       
        </div>
      </div>

      <!-- SidebarSearch Form -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
                <a href="{{ route('admin.home') }}" class="nav-link">
                <i class="fas fa-fw fa-tachometer-alt nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Data Akademik
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('admin.akademik') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelola Tahun Akademik</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.kurikulum') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelola Kurikulum</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.jurusan') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelola Jurusan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.kelas') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelola Kelas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.mapel') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelola Mata Pelajaran</p>
                </a>
              </li>
            </ul>
          </li> 
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               
              <li class="nav-item">
                <a href="{{ route('admin.jadwal') }}" class="nav-link ">
                  <i class="fas fa-calendar nav-icon"></i>
                  <p>Kelola Jadwal</p>
                </a>
              </li>
              
  <li class="nav-item">
                <a href="{{ route('admin.walikelas') }}" class="nav-link">
                  <i class="fas fa-address-card nav-icon"></i>
                  <p>Kelola Walikelas</p>
                </a>
              </li>
  <li class="nav-item">
                <a href="{{ route('admin.ekskul') }}" class="nav-link">
                  <i class="fas fa-gamepad nav-icon"></i>
                  <p>Kelola Ekskul</p>
                </a>
              </li>
  <li class="nav-item">
                <a href="{{ route('admin.pengampu') }}" class="nav-link">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Kelola Nilai</p>
                </a>
              </li>
  <li class="nav-item">
                <a href="{{ route('admin.RTindakan') }}" class="nav-link">
                <i class="fas fa-minus-circle nav-icon"></i>
                  <p>Kelola Tindakan Kelas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.laporan') }}" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Laporan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.pengguna') }}" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Pengguna</p>
                </a>
              </li>

              <!-- <li class="nav-item">
                <a href="info" class="nav-link">
                  <i class="fas fa-user nav-icon"></i>
                  <p>Info</p>
                </a>
              </li> -->

              
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    </aside>