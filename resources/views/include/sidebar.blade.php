  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('landing')}}">
          <div class="sidebar-brand-icon rotate-n-15">
              <i class="bi bi-backpack3"></i>
          </div>
          <div class="sidebar-brand-text mx-3">Ambaaaaataris <sup></sup></div>
      </a>
      @role('Murid')
       <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <div class="sidebar-heading">
          Dashboard
      </div>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
           <a class="nav-link {{ Route::is('Users.dashboard') ? 'active' : '' }}"
          href="{{route('Users.dashboard')}}">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Dashboard</span></a>
      </li>
       <!-- Divider -->
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
          Menu
      </div>
      {{-- End Divider --}}
      <li class="nav-item">
          <a class="nav-link" href="">
              <i class="fas fa-fw fa-cog"></i>
              <span>Permintaan</span>
          </a>
      </li>
        <!-- Divider -->
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
          Transaksi
      </div>
      {{-- End Divider --}}
      <li class="nav-item">
          <a class="nav-link" href="{{route('Users.transaksi')}}">
              <i class="fas fa-fw fa-cog"></i>
              <span>Riwayat</span>
          </a>
      </li>
      @endrole
      @hasanyrole('Admin|superadmin')
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <div class="sidebar-heading">
          Dashboard
      </div>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
          <a class="nav-link {{ Route::is('admin.dashboard') }}"
          href="{{route('admin.dashboard')}}">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
          Master
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link" href="{{route('admin.pemasok.index')}}">
              <i class="fas fa-fw fa-cog"></i>
              <span>Pemasok</span>
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('admin.kategori.index')}}">
              <i class="fas fa-fw fa-cog"></i>
              <span>Kategori</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="">
              <i class="fas fa-fw fa-cog"></i>
              <span>Kendaraan</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{route('admin.barang.index')}}">
              <i class="fas fa-fw fa-cog"></i>
              <span>Barang</span>
          </a>
      </li>
        <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <div class="sidebar-heading">
          Stock
      </div>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item ">
          <a class="nav-link {{ Route::is('admin.stock.index') }}"
          href="{{route('admin.stock.index')}}">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Stock</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
          Transaksi
      </div>
      {{-- End Divider --}}
      <li class="nav-item">
          <a class="nav-link" href="">
              <i class="fas fa-fw fa-cog"></i>
              <span>Permintaan</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{route('admin.transaksi.barang')}}">
              <i class="fas fa-fw fa-cog"></i>
              <span>Barang Keluar</span>
          </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
          Setting
      </div>
      {{-- End Divider --}}
      <li class="nav-item">
          <a class="nav-link" href="{{route('admin.user.index')}}">
              <i class="fas fa-fw fa-cog"></i>
              <span>User</span>
          </a>
      </li>
      @can('index-dashboard')
      <li class="nav-item">
          <a class="nav-link" href="{{route('admin.roles.index')}}">
              <i class="fas fa-fw fa-cog"></i>
              <span>Role & Permission</span>
          </a>
      </li>
      @endcan
      @endrole
  </ul>
  <!-- End of Sidebar -->
