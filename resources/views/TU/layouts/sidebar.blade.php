  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home" class="brand-link">
      <img src="{{asset('images/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SIAKAD SMEPRI</span>
    </a>

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
                <a href="{{ route('TU.home') }}" class="nav-link">
                <i class="fas fa-fw fa-tachometer-alt nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{ route('TU.pendaftaran') }}" class="nav-link ">
                <i class="fas fa-address-book nav-icon"></i>
                
                  <p>Kelola Pendaftaran</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{ route('TU.penerimaan') }}" class="nav-link ">
                <i class="fas fa-address-book nav-icon"></i>
                  <p>Kelola Penerimaan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('TU.siswa') }}" class="nav-link ">
                  <i class="fas fa-user-circle nav-icon"></i>
                  <p>Kelola Siswa</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('TU.guru') }}" class="nav-link ">
                  <i class="fas far fa-address-card nav-icon"></i>
                  <p>Kelola Guru</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{ route('TU.administrasi') }}" class="nav-link ">
                  <i class="fas fa-donate nav-icon"></i>
                  <p>Kelola List Administrasi</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('TU.administrasi.siswa') }}" class="nav-link ">
                  <i class="fas fa-money-bill-alt nav-icon"></i>
                  <p>Administrasi Siswa</p>
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