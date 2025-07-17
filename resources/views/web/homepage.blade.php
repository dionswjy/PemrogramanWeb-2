@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        :root {
            --primary: #E63946;
            --primary-light: #FF758F;
            --secondary: #1D3557;
            --accent: #FF9E00;
            --light: #F1FAEE;
            --dark: #212529;
            --gray: #6C757D;
            --gradient: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FAFAFA;
            color: var(--dark);
            line-height: 1.7;
        }

        /* Typography */
        .anton-font {
            font-family: 'Anton', sans-serif;
            letter-spacing: 1px;
        }

        /* Section Titles */
        .section-title {
            position: relative;
            margin-bottom: 2.5rem;
            padding-bottom: 0.5rem;
        }

        .section-title h3 {
            font-family: 'Anton', sans-serif;
            font-size: 2.2rem;
            color: var(--secondary);
            letter-spacing: 1px;
            position: relative;
            display: inline-block;
        }

        .section-title h3::before {
            content: '';
            position: absolute;
            left: 0;
            bottom: -10px;
            width: 60px;
            height: 4px;
            background: var(--gradient);
            border-radius: 2px;
        }

        /* Buttons */
        .btn-outline-primary {
            border-color: var(--accent);
            color: var(--accent);
            border-radius: 50px;
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border-width: 2px;
        }

        .btn-outline-primary:hover {
            background: var(--gradient);
            border-color: transparent;
            color: white;
            box-shadow: 0 4px 15px rgba(230, 57, 70, 0.3);
            transform: translateY(-2px);
        }

        /* Cards */
        .category-card {
            border-radius: 16px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: white;
            height: 100%;
            border: none;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .category-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .category-img-container {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background-color: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            border: 3px solid var(--accent);
            transition: all 0.3s ease;
        }

        .category-card:hover .category-img-container {
            transform: scale(1.1);
            border-color: var(--primary);
        }

        .category-img {
            max-width: 70px;
            max-height: 70px;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .category-card:hover .category-img {
            transform: scale(1.1);
        }

        .product-card {
            border-radius: 16px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: white;
            height: 100%;
            border: none;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .product-img {
            height: 220px;
            object-fit: cover;
            width: 100%;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-img {
            transform: scale(1.05);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-family: 'Anton', sans-serif;
            font-size: 1.4rem;
            color: var(--secondary);
            margin-bottom: 0.75rem;
            letter-spacing: 0.5px;
        }

        .card-text {
            color: var(--gray);
            font-size: 0.95rem;
            margin-bottom: 1.25rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .price-tag {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.2rem;
        }

        /* Badges */
        .badge-new {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--gradient);
            color: white;
            font-weight: 600;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            box-shadow: 0 2px 10px rgba(230, 57, 70, 0.3);
        }

        /* Animations */
        .animate-delay-1 {
            animation-delay: 0.2s;
        }

        .animate-delay-2 {
            animation-delay: 0.4s;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .section-title h3 {
                font-size: 1.8rem;
            }

            .category-img-container {
                width: 90px;
                height: 90px;
            }
        }

        @media (max-width: 576px) {
            .section-title h3 {
                font-size: 1.6rem;
            }
        }
    </style>
@endpush

<x-layout>
    <x-slot name="title">AntiTilang - Helm Berkualitas</x-slot>

    {{-- Hero Section --}}
    <section class="hero-section py-5 mb-5"
        style="background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="text-white fw-bold mb-4 animate__animated animate__fadeInDown">Temukan Helm Terbaik untuk
                        Keselamatan Anda</h1>
                    <p class="text-white-80 mb-4 animate__animated animate__fadeIn animate__delay-1s">Koleksi helm
                        berkualitas tinggi dengan standar keamanan terbaik dan desain stylish untuk kenyamanan
                        berkendara.</p>
                    <a href="/products"
                        class="btn btn-light btn-lg rounded-pill px-4 animate__animated animate__fadeIn animate__delay-2s">
                        <i class="fas fa-shopping-bag me-2"></i> Belanja Sekarang
                    </a>
                </div>
                <div class="col-lg-6 d-none d-lg-block animate__animated animate__fadeInRight">
                    <img src="{{ asset('images/hero-helmet.png') }}" alt="Helm Safety" class="img-fluid"
                        style="max-height: 400px;">
                </div>
            </div>
        </div>
    </section>

    {{-- Section: Kategori Produk --}}
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div class="section-title">
                <h3 class="animate__animated animate__fadeIn">Kategori Helm</h3>
            </div>
            <a href="{{ URL::to('/categories') }}" class="btn btn-outline-primary animate__animated animate__fadeIn">
                Lihat Semua <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($categories as $category)
                <div class="col animate__animated animate__fadeInUp animate__fast">
                    <a href="{{ URL::to('/category/' . $category->slug) }}" class="text-decoration-none">
                        <div class="card h-100 category-card p-4 text-center">
                            <div class="category-img-container mb-3">
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                    class="category-img">
                            </div>
                            <div class="card-body p-0">
                                <h6 class="text-dark fw-semibold mb-2">{{ $category->name }}</h6>
                                <p class="text-muted small mb-0">{{ Str::limit($category->description, 50) }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Section: Produk --}}
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div class="section-title">
                <h3 class="animate__animated animate__fadeIn">Produk Helm Terbaik</h3>
            </div>
            <a href="{{ URL::to('/products') }}" class="btn btn-outline-primary animate__animated animate__fadeIn">
                Lihat Semua <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>

        <div class="row g-4">
            @forelse($products as $product)
                <div class="col-md-6 col-lg-4 col-xl-3 animate__animated animate__fadeInUp animate__fast">
                    <div class="card h-100 product-card">
                        <div class="position-relative">
                            <img src="{{ $product->image_url ? asset('storage/' . ltrim($product->image_url, '/')) : 'https://via.placeholder.com/350x200?text=No+Image' }}"
                                class="card-img-top product-img" alt="{{ $product->name }}">
                            @if ($product->is_new)
                                <span class="badge-new">BARU</span>
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($product->description, 70) }}</p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="price-tag">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <a href="{{ route('product.show', $product->slug) }}"
                                    class="btn btn-outline-primary btn-sm">
                                    Detail <i class="fas fa-chevron-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 animate__animated animate__fadeIn">
                    <div class="alert alert-info text-center py-4">
                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                        <h5 class="mb-0">Belum ada produk yang tersedia.</h5>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5 animate__animated animate__fadeIn">
            {{ $products->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>

    {{-- Features Section --}}
    <section class="py-5 my-5 bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h3 class="animate__animated animate__fadeIn">Kenapa Memilih Kami?</h3>
            </div>
            <div class="row g-4">
                <div class="col-md-4 animate__animated animate__fadeInUp">
                    <div class="text-center p-4 h-100">
                        <div class="icon-circle mb-4 mx-auto">
                            <i class="fas fa-shield-alt fa-2x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Standar Keamanan Tinggi</h4>
                        <p class="text-muted">Helm kami memenuhi standar keamanan internasional untuk perlindungan
                            maksimal.</p>
                    </div>
                </div>
                <div class="col-md-4 animate__animated animate__fadeInUp animate-delay-1">
                    <div class="text-center p-4 h-100">
                        <div class="icon-circle mb-4 mx-auto">
                            <i class="fas fa-tags fa-2x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Harga Terbaik</h4>
                        <p class="text-muted">Kami menawarkan produk berkualitas dengan harga kompetitif di pasaran.</p>
                    </div>
                </div>
                <div class="col-md-4 animate__animated animate__fadeInUp animate-delay-2">
                    <div class="text-center p-4 h-100">
                        <div class="icon-circle mb-4 mx-auto">
                            <i class="fas fa-headset fa-2x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Layanan 24/7</h4>
                        <p class="text-muted">Tim kami siap membantu Anda kapan saja melalui berbagai channel.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>

<script>
    // Add scroll animations
    document.addEventListener('DOMContentLoaded', function() {
        const animateElements = document.querySelectorAll('.animate__animated');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add(entry.target.dataset.animation);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });

        animateElements.forEach(el => {
            observer.observe(el);
        });
    });
</script>
