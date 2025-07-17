<div>
    <nav class="navbar navbar-expand-lg py-2"
        style="background: linear-gradient(90deg, #d6336c, #fd7e14); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
        <div class="container">
            <!-- Brand Logo with Icon -->
            <a class="navbar-brand fw-bold text-white d-flex align-items-center" href="/">
                <i class="fas fa-helmet-safety me-2"></i>
                <span class="logo-text">AntiTilang</span>
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-white">
                    <i class="fas fa-bars"></i>
                </span>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Main Navigation Links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-1">
                        <a class="nav-link text-white fw-medium d-flex align-items-center py-2 px-3 rounded-pill {{ Request::is('/') ? 'active-nav' : '' }}"
                            href="/">
                            <i class="fas fa-home me-2"></i>
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link text-white fw-medium d-flex align-items-center py-2 px-3 rounded-pill {{ Request::is('categories*') ? 'active-nav' : '' }}"
                            href="/categories">
                            <i class="fas fa-tags me-2"></i>
                            Kategori
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link text-white fw-medium d-flex align-items-center py-2 px-3 rounded-pill {{ Request::is('products*') ? 'active-nav' : '' }}"
                            href="/products">
                            <i class="fas fa-tshirt me-2"></i>
                            Produk
                        </a>
                    </li>
                </ul>

                <!-- Right Side Elements -->
                <div class="d-flex align-items-center ms-lg-3">
                    <!-- Cart Icon with Badge -->
                    <x-cart-icon />

                    <!-- User Authentication Section -->
                    @auth('customer')
                        <div class="dropdown ms-3">
                            <a class="btn btn-light dropdown-toggle d-flex align-items-center" href="#"
                                id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="avatar-circle me-2">
                                    {{ substr(Auth::guard('customer')->user()->name, 0, 1) }}
                                </div>
                                <span class="d-none d-lg-inline">{{ Auth::guard('customer')->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="fas fa-user-circle me-2"></i>
                                        Profil Saya
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="fas fa-tachometer-alt me-2"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="fas fa-history me-2"></i>
                                        Riwayat Pesanan
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('customer.logout') }}">
                                        @csrf
                                        <button class="dropdown-item d-flex align-items-center" type="submit">
                                            <i class="fas fa-sign-out-alt me-2"></i>
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a class="btn btn-outline-light me-2 d-flex align-items-center"
                            href="{{ route('customer.login') }}">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            <span class="d-none d-lg-inline">Login</span>
                        </a>
                        <a class="btn btn-light text-primary d-flex align-items-center"
                            href="{{ route('customer.register') }}">
                            <i class="fas fa-user-plus me-2"></i>
                            <span class="d-none d-lg-inline">Register</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</div>

<style>
    /* Navbar Styling */
    .navbar {
        transition: all 0.3s ease;
    }

    .logo-text {
        font-size: 1.5rem;
        letter-spacing: 0.5px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .navbar-toggler {
        border: none;
        padding: 0.5rem;
    }

    .navbar-toggler:focus {
        box-shadow: none;
    }

    .nav-link {
        transition: all 0.3s ease;
        position: relative;
    }

    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.15) !important;
    }

    .active-nav {
        background-color: rgba(255, 255, 255, 0.25) !important;
        font-weight: 600 !important;
    }

    /* User Avatar */
    .avatar-circle {
        width: 32px;
        height: 32px;
        background-color: #d6336c;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    /* Dropdown Menu */
    .dropdown-menu {
        border: none;
        border-radius: 10px;
        padding: 0.5rem 0;
    }

    .dropdown-item {
        padding: 0.5rem 1.5rem;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #d6336c;
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .navbar-collapse {
            padding-top: 1rem;
        }

        .nav-link {
            margin-bottom: 0.5rem;
            border-radius: 8px !important;
        }

        .d-flex.ms-lg-3 {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
    }
</style>

<script>
    // Add scroll effect to navbar
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 20) {
            navbar.style.padding = '0.5rem 0';
            navbar.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
        } else {
            navbar.style.padding = '0.5rem 0';
            navbar.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.1)';
        }
    });
</script>
