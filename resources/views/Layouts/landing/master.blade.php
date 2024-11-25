<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        /* Navbar */
        .navbar .btn-outline-secondary {
            margin: 0 5px;
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

        footer {
            padding: 2rem 0;
            background-color: #000000;
            color: white;
        }
    </style>
</head>

<body>
    {{-- Navbar --}}
    @include('Layouts.landing.navbar')
    @yield('content')
    @include('Layouts.landing.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
