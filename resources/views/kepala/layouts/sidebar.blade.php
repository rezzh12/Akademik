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
                <a href="{{ route('kepala.home') }}" class="nav-link">
                <i class="fas fa-fw fa-tachometer-alt nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
  <li class="nav-item">
                <a href="{{ route('kepala.jadwal') }}" class="nav-link ">
                  <i class="fas fa-calendar nav-icon"></i>
                  <p>Jadwal</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('kepala.pengampu') }}" class="nav-link">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Nilai</p>
                </a>
              </li>
  <li class="nav-item">
                <a href="{{ route('kepala.penerimaan') }}" class="nav-link">
                  <i class="fas fa-address-book nav-icon"></i>
                  <p>Riwayat Penerimaan</p>
                </a>
              </li>
  <li class="nav-item">
                <a href="{{ route('kepala.riwayat.penilaian') }}" class="nav-link">
                  <i class="fas fa-marker nav-icon"></i>
                  <p>Riwayat Penilaian</p>
                </a>
              </li>
  <li class="nav-item">
                <a href="{{ route('kepala.riwayat.administrasi') }}" class="nav-link">
                  <i class="fas fa-money-bill-alt nav-icon"></i>
                  <p>Riwayat Administrasi</p>
                </a>
              </li>
  <li class="nav-item">
                <a href="{{ route('kepala.RTindakan') }}" class="nav-link">
                  <i class="fas fa-minus-circle nav-icon"></i>
                  <p>Tindakan Kelas</p>
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