<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        /* Navbar */
        .navbar .btn-outline-secondary {
            margin: 0 5px;
        }

        /* Jumbotron */
        .jumbotron {
            padding: 6rem 2rem;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                        url('https://source.unsplash.com/1600x900/?technology,office') no-repeat center center;
            background-size: cover;
            color: white;
            text-align: center;
        }
        .jumbotron h1 {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .jumbotron p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Cards in Features Section */
        .features .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .features .card:hover {
            transform: translateY(-10px);
        }

        /* Footer */
        footer {
            padding: 2rem 0;
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>
    {{-- Navbar --}}
    @include('Layouts.landing.navbar')
    <!-- Jumbotron -->
    <div class="jumbotron">
        <div class="container">
            <h1>Welcome to Inventariz</h1>
            <p>Pusat Dimana Barang - Barang Yang Kamu Perlukan Berada Disini.</p>
        </div>
    </div>
    <br>
    @yield('content')

    <!-- Footer -->
    <footer class="text-center">
        &copy; {{ date('Y') }} AmbaTaris. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
