 <!-- Navbar -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
     <div class="container">
         <a class="navbar-brand" href="#"><b>Inventariz TIRIZ</b></a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
             aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav ms-auto">
                 <li class="nav-item">
                     @guest
                         <a href="{{ route('login') }}" class="btn btn-outline-light">
                             Masuk
                         </a>
                         <a href="{{ route('register') }}" class="btn btn-outline-light">
                             Daftar
                         </a>
                     @endguest
                 </li>
                 <li class="nav-item">
                     @role('Admin|superadmin')
                         <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light">Dashboard</a>
                     @endrole
                 </li>
                 <li>
                     @role('Murid')
                         <a href="{{ route('Users.dashboard') }}" class="btn btn-outline-light">Dashboard</a>
                     @endrole
                 </li>
             </ul>
         </div>
     </div>
 </nav>
