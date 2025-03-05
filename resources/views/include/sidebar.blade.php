<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('landing')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="bi bi-backpack3"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Ambaaaaataris</div>
    </a>

    @role('Murid')
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <div class="sidebar-heading">Dashboard</div>

    <li class="nav-item active">
        <a class="nav-link {{ Route::is('user.dashboard') ? 'active' : '' }}" href="{{route('user.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Menu</div>

    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-cog"></i>
            <span>Permintaan</span>
        </a>
    </li>

    <!-- Divider -->
    {{-- <hr class="sidebar-divider">
    <div class="sidebar-heading">Transaksi</div>

    <li class="nav-item">
        <a class="nav-link" href="{{route('user.transaksi')}}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Riwayat</span>
        </a>
    </li> --}}

    <!-- Tambahan Peminjaman -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Peminjaman</div>

    <li class="nav-item">
        <a class="nav-link" href="{{route('user.peminjaman.index')}}">
            <i class="fas fa-fw fa-box"></i>
            <span>Peminjaman Barang</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('user.peminjaman.my')}}">
            <i class="fas fa-fw fa-history"></i>
            <span>Riwayat Peminjaman</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('user.pengembalian.index')}}">
            <i class="fas fa-fw fa-undo-alt"></i>
            <span>Pengembalian Barang</span>
        </a>
    </li>
    @endrole

    @hasanyrole('Admin|superadmin')
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <div class="sidebar-heading">Dashboard</div>

    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}" href="{{route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Master</div>

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
        <a class="nav-link" href="{{route('admin.barang.index')}}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Barang</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <div class="sidebar-heading">Stock</div>

    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.stock.index') }}" href="{{route('admin.stock.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Stock</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Transaksi</div>

    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-cog"></i>
            <span>Permintaan</span>
        </a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{route('admin.transaksi.barang')}}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Barang Keluar</span>
        </a>
    </li> --}}

    <!-- Tambahan Peminjaman -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Peminjaman & Pengembalian</div>

    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.peminjaman.index')}}">
            <i class="fas fa-fw fa-check-circle"></i>
            <span>Kelola Peminjaman</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.pengembalian.index')}}">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Kelola Pengembalian</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Setting</div>

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
