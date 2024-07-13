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
                <a href="{{ route('guru.home') }}" class="nav-link">
                <i class="fas fa-fw fa-tachometer-alt nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
  <li class="nav-item">
                <a href="{{ route('guru.jadwal') }}" class="nav-link ">
                <i class="fas fa-calendar nav-icon"></i>
                  <p>Jadwal</p>
                </a>
              </li>
              @if($ekskul == null)
              @else
  <li class="nav-item">
                <a href="{{ route('guru.ekskul') }}" class="nav-link">
                  <i class="fas fa-gamepad nav-icon"></i>
                  <p>Ekskul</p>
                </a>
              </li>
              @endif
  <li class="nav-item">
                <a href="{{ route('guru.pengampu') }}" class="nav-link">
                <i class="fas fa-book nav-icon"></i>
                  <p>Nilai</p>
                </a>
              </li>
  <li class="nav-item">
                <a href="{{ route('guru.RTindakan') }}" class="nav-link">
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