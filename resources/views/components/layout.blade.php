<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'AntiTilang - Helm Berkualitas' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    {{ $style ?? '' }}
    <style>
        :root {
            --primary: #e63946;
            --primary-light: #ff686b;
            --secondary: #1d3557;
            --light: #f1faee;
            --accent: #a8dadc;
            --dark: #212529;
            --gray: #6c757d;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: var(--dark);
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            transition: all 0.3s ease;
        }

        /* Navbar */
        .navbar {
            background: white;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary) !important;
            font-size: 1.5rem;
        }

        .navbar-brand span {
            color: var(--secondary);
        }

        .nav-link {
            color: var(--secondary) !important;
            font-weight: 500;
            padding: 8px 15px !important;
            border-radius: 50px;
            margin: 0 5px;
        }

        .nav-link:hover,
        .nav-link.active {
            color: white !important;
            background-color: var(--primary);
        }

        .navbar-toggler {
            border: none;
            padding: 0.5rem;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
            color: white;
            padding: 100px 0;
            border-radius: 0 0 20px 20px;
            margin-bottom: 50px;
        }

        .hero-title {
            font-weight: 700;
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .hero-subtitle {
            font-weight: 300;
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        /* Card */
        .product-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 25px;
            background: white;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .product-img {
            height: 220px;
            object-fit: cover;
            width: 100%;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-weight: 600;
            color: var(--secondary);
            margin-bottom: 10px;
        }

        .card-text {
            color: var(--gray);
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .price {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.2rem;
        }

        .badge-category {
            background-color: var(--accent);
            color: var(--secondary);
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 50px;
            font-size: 0.75rem;
            position: absolute;
            top: 15px;
            right: 15px;
        }

        .btn-primary {
            background-color: var(--primary);
            border: none;
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .btn-primary:hover {
            background-color: var(--secondary);
        }

        .btn-outline-primary {
            border-color: var(--primary);
            color: var(--primary);
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 500;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        /* Section Titles */
        .section-title {
            position: relative;
            margin-bottom: 50px;
            text-align: center;
        }

        .section-title h2 {
            font-weight: 700;
            color: var(--secondary);
            display: inline-block;
            margin-bottom: 15px;
        }

        .section-title h2:after {
            content: '';
            display: block;
            width: 50px;
            height: 3px;
            background: var(--primary);
            margin: 10px auto;
        }

        /* Features */
        .feature-box {
            text-align: center;
            padding: 30px 20px;
            border-radius: 10px;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 30px;
        }

        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 20px;
        }

        /* Footer */
        footer {
            background-color: var(--secondary);
            color: white;
            padding: 60px 0 0;
        }

        .footer-logo {
            font-weight: 700;
            color: white;
            font-size: 1.8rem;
            margin-bottom: 20px;
            display: inline-block;
        }

        .footer-logo span {
            color: var(--primary);
        }

        .footer-about p {
            opacity: 0.8;
            margin-bottom: 20px;
        }

        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 50%;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            background-color: var(--primary);
            transform: translateY(-3px);
        }

        .footer-links h5 {
            font-weight: 600;
            margin-bottom: 25px;
            position: relative;
        }

        .footer-links h5:after {
            content: '';
            display: block;
            width: 30px;
            height: 2px;
            background: var(--primary);
            position: absolute;
            bottom: -10px;
            left: 0;
        }

        .footer-links ul {
            list-style: none;
            padding-left: 0;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: white;
            padding-left: 5px;
        }

        .footer-contact p {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
            opacity: 0.8;
        }

        .footer-contact i {
            margin-right: 10px;
            color: var(--primary);
        }

        .footer-bottom {
            background-color: rgba(0, 0, 0, 0.1);
            padding: 20px 0;
            margin-top: 40px;
        }

        .copyright {
            opacity: 0.8;
            font-size: 0.9rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .navbar-brand {
                font-size: 1.3rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">Anti<span>Tilang</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="/products">Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="/categories">Kategori</a></li>
                </ul>
                <div class="ms-lg-3 mt-3 mt-lg-0">
                    <a href="/cart" class="btn btn-primary">
                        <i class="fas fa-shopping-cart me-2"></i>Keranjang
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                    <a href="/" class="footer-logo">Anti<span>Tilang</span></a>
                    <div class="footer-about">
                        <p>Menjadi pilihan utama untuk helm berkualitas dengan standar keamanan tinggi dan desain modern
                            untuk kenyamanan berkendara Anda.</p>
                        <div class="social-icons">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-5 mb-md-0">
                    <div class="footer-links">
                        <h5>Menu</h5>
                        <ul>
                            <li><a href="/">Beranda</a></li>
                            <li><a href="/products">Produk</a></li>
                            <li><a href="/categories">Kategori</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-5 mb-md-0">
                    <div class="footer-links">
                        <h5>Layanan</h5>
                        <ul>
                            <li><a href="#">Pembelian Online</a></li>
                            <li><a href="#">Pengiriman</a></li>
                            <li><a href="#">Garansi Produk</a></li>
                            <li><a href="#">Panduan Ukuran</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-contact">
                        <h5>Hubungi Kami</h5>
                        <p><i class="fas fa-map-marker-alt"></i> Jl. Perintis Kemerdekaan No. 123, Tegal, Indonesia</p>
                        <p><i class="fas fa-phone-alt"></i> +62 856 6100 994</p>
                        <p><i class="fas fa-envelope"></i> helmetkushop@gmail.com</p>
                        <p><i class="fas fa-clock"></i> Buka Setiap Hari: 08.00 - 17.00 WIB</p>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start">
                            <p class="copyright">© {{ date('Y') }} AntiTilang. All rights reserved.</p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <p class="copyright">
                                <a href="#" class="text-white">Kebijakan Privasi</a> |
                                <a href="#" class="text-white">Syarat & Ketentuan</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple animation for elements when they come into view
        document.addEventListener('DOMContentLoaded', function() {
            const animateOnScroll = function() {
                const elements = document.querySelectorAll('.product-card, .feature-box, .section-title');

                elements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect().top;
                    const screenPosition = window.innerHeight / 1.3;

                    if (elementPosition < screenPosition) {
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    }
                });
            };

            // Set initial state
            const animatedElements = document.querySelectorAll('.product-card, .feature-box, .section-title');
            animatedElements.forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'all 0.5s ease';
            });

            // Run on load and scroll
            animateOnScroll();
            window.addEventListener('scroll', animateOnScroll);
        });
    </script>
</body>

</html>
