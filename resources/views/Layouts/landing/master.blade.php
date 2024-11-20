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

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container text-center">
            <h2>About Us</h2>
            <p class="mt-3">
                We provide innovative solutions to help your business grow. Our team is dedicated to ensuring your success.
            </p>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center">Our Features</h2>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Feature 1</h5>
                            <p class="card-text">Highlight your first unique feature.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Feature 2</h5>
                            <p class="card-text">Showcase another key aspect of your offering.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Feature 3</h5>
                            <p class="card-text">Emphasize what sets you apart.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container text-center">
            <h2>Contact Us</h2>
            <p class="mt-3">We'd love to hear from you. Reach out today!</p>
            <form action="#" method="post" class="mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control mb-3" placeholder="Your Name" required>
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="form-control mb-3" placeholder="Your Email" required>
                    </div>
                </div>
                <textarea class="form-control mb-3" rows="4" placeholder="Your Message" required></textarea>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        &copy; {{ date('Y') }} Inventariz TIRIZ. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
