<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('landing') }}"><b>AMBATARIZ</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-light">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-light">Daftar</a>
                    @endguest
                </li>
                <li class="nav-item">
                    @role('Admin|superadmin')
                        {{--  <a href="{{ route('cart.index') }}" class="btn btn-outline-light">
                            <i class="bi bi-basket3-fill"></i>
                        </a>  --}}
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light">Dashboard</a>
                    @endrole
                </li>
                <li class="nav-item">
                    @role('user')
                        {{--  <a href="{{ route('cart.index') }}" class="btn btn-outline-light">
                            <i class="bi bi-basket3-fill"></i>
                        </a>  --}}
                        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-light">Dashboard</a>
                    @endrole
                </li>
            </ul>
        </div>
    </div>
</nav>
