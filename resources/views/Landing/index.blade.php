<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NextBee Wholesale | London's Premier B2B Food & Grocery Distributor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <style>
        :root {
            --navy: #0f172a;
            --royal: #1e40af;
            --gold: #d4af37;
            --emerald: #059669;
            --slate: #64748b;
            --crimson: #dc2626;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #fafafa;
            color: #1e293b;
            overflow-x: hidden;
        }

        .font-display {
            font-family: 'Space Grotesk', sans-serif;
        }

        /* Loader */
        .loader-container {
            position: fixed;
            inset: 0;
            background: var(--navy);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .loader-text {
            font-size: 3rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            background: linear-gradient(90deg, var(--gold), #fff, var(--gold));
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shine 3s linear infinite;
        }

        @keyframes shine {
            to {
                background-position: 200% center;
            }
        }

        /* Navigation */
        .nav-scrolled {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        /* Hero Animation */
        .hero-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e40af 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        /* Category Section */
        .category-section {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
        }

        .category-nav {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .category-nav::-webkit-scrollbar {
            display: none;
        }

        .category-btn {
            white-space: nowrap;
            transition: all 0.3s;
            border-bottom: 3px solid transparent;
        }

        .category-btn.active {
            color: #1e40af;
            border-bottom-color: #1e40af;
            background: #eff6ff;
        }

        .category-btn:hover {
            color: #1e40af;
            background: #f8fafc;
        }

        /* Product Cards */
        .product-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #e2e8f0;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
            border-color: #1e40af;
        }

        .product-image {
            transition: transform 0.5s;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .quick-add {
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s;
        }

        .product-card:hover .quick-add {
            opacity: 1;
            transform: translateY(0);
        }

        /* Brand Tags */
        .brand-tag {
            background: #f1f5f9;
            transition: all 0.2s;
        }

        .brand-tag:hover {
            background: #1e40af;
            color: white;
        }

        /* Stats Counter */
        .stat-number {
            font-variant-numeric: tabular-nums;
        }

        /* Process Steps */
        .process-line {
            position: absolute;
            top: 2rem;
            left: 0;
            right: 0;
            height: 2px;
            background: #e2e8f0;
            z-index: 0;
        }

        .process-step {
            position: relative;
            z-index: 1;
        }

        /* CTA Section */
        .cta-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e40af 50%, #059669 100%);
            position: relative;
        }

        /* Form Styling */
        .form-input {
            transition: all 0.3s;
            border: 2px solid #e2e8f0;
        }

        .form-input:focus {
            border-color: #1e40af;
            box-shadow: 0 0 0 4px rgba(30, 64, 175, 0.1);
        }

        /* Mobile Menu */
        .mobile-menu {
            transform: translateX(100%);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .mobile-menu.active {
            transform: translateX(0);
        }

        /* Scroll Reveal */
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #1e40af;
            border-radius: 4px;
        }

        /* Toast Notification */
        .toast {
            transform: translateX(400px);
            transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .toast.show {
            transform: translateX(0);
        }

        /* Category Grid */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        @media (max-width: 640px) {
            .category-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Sticky Category Bar */
        .sticky-cat {
            position: sticky;
            top: 80px;
            z-index: 40;
            background: white;
            border-bottom: 1px solid #e2e8f0;
        }

        /* Product Badge */
        .product-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 10;
        }

        /* View Toggle */
        .view-btn {
            transition: all 0.2s;
        }

        .view-btn.active {
            background: #1e40af;
            color: white;
        }
    </style>
</head>

<body>

    <!-- Loader -->
    <div class="loader-container" id="loader">
        <div class="loader-text font-display">NextBee</div>
        <div class="mt-6 flex gap-3">
            <div class="w-3 h-3 bg-yellow-500 rounded-full animate-bounce"></div>
            <div class="w-3 h-3 bg-yellow-500 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
            <div class="w-3 h-3 bg-yellow-500 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
        </div>
        <p class="mt-8 text-slate-400 text-sm tracking-widest uppercase">B2B Wholesale Solutions</p>
    </div>

    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300 bg-white/95 backdrop-blur" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="#" class="flex items-center gap-3 group">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-blue-900 to-blue-700 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-building text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="font-display text-2xl font-bold text-slate-900">NextBee</h1>
                        <p class="text-xs text-slate-500 tracking-widest font-medium">B2B WHOLESALE</p>
                    </div>
                </a>

                <div class="hidden lg:flex items-center gap-8">
                    <a href="#products"
                        class="text-sm font-medium text-slate-600 hover:text-blue-900 transition">Products</a>
                    <a href="#brands"
                        class="text-sm font-medium text-slate-600 hover:text-blue-900 transition">Brands</a>
                    <a href="#services"
                        class="text-sm font-medium text-slate-600 hover:text-blue-900 transition">Services</a>
                    <a href="#about" class="text-sm font-medium text-slate-600 hover:text-blue-900 transition">About</a>
                </div>

                <div class="flex items-center gap-4">
                    <a href="tel:02079460958"
                        class="hidden md:flex items-center gap-2 text-sm font-medium text-slate-600">
                        <i class="fas fa-phone text-yellow-600"></i>
                        020 7946 0958
                    </a>
                    <button onclick="openModal('register')"
                        class="px-5 py-2.5 text-sm font-medium bg-blue-900 text-white rounded-full hover:bg-blue-800 transition shadow-lg">
                        Login / Registration
                    </button>
                    <button class="lg:hidden p-2" onclick="toggleMobileMenu()">
                        <i class="fas fa-bars text-2xl text-slate-700"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu fixed inset-0 bg-white z-50 lg:hidden" id="mobile-menu">
        <div class="p-6">
            <div class="flex justify-between items-center mb-12">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-900 rounded-lg flex items-center justify-center">
                        <i class="fas fa-building text-white"></i>
                    </div>
                    <span class="font-display text-xl font-bold">NextBee</span>
                </div>
                <button onclick="toggleMobileMenu()" class="p-2">
                    <i class="fas fa-times text-2xl text-slate-700"></i>
                </button>
            </div>
            <div class="space-y-6">
                <a href="#products" class="block text-2xl font-medium text-slate-800"
                    onclick="toggleMobileMenu()">Products</a>
                <a href="#brands" class="block text-2xl font-medium text-slate-800"
                    onclick="toggleMobileMenu()">Brands</a>
                <a href="#services" class="block text-2xl font-medium text-slate-800"
                    onclick="toggleMobileMenu()">Services</a>
                <a href="#about" class="block text-2xl font-medium text-slate-800"
                    onclick="toggleMobileMenu()">About</a>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero-bg pt-32 pb-16 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center text-white mb-12">
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur rounded-full mb-6 border border-white/20">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    <span class="text-sm font-medium">Serving 500+ London Businesses</span>
                </div>
                <h1 class="font-display text-4xl md:text-6xl font-bold leading-tight mb-6">
                    Wholesale Food & Grocery<br>
                    <span class="text-yellow-400">Supply Solutions</span>
                </h1>
                <p class="text-xl text-slate-300 max-w-2xl mx-auto mb-8">
                    10,000+ products across beverages, groceries, frozen foods, and household supplies. Trade pricing
                    available upon account approval.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <button onclick="scrollToSection('products')"
                        class="px-8 py-4 bg-yellow-500 text-blue-900 font-bold rounded-full hover:bg-yellow-400 transition">
                        Browse Categories
                    </button>
                    <button onclick="openModal('register')"
                        class="px-8 py-4 bg-white/10 backdrop-blur text-white font-medium rounded-full hover:bg-white/20 transition border border-white/30">
                        Request Price List
                    </button>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto">
                <div class="bg-white/10 backdrop-blur rounded-2xl p-4 text-center border border-white/20">
                    <div class="text-3xl font-bold text-yellow-400">10K+</div>
                    <div class="text-sm text-slate-300">Products</div>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-2xl p-4 text-center border border-white/20">
                    <div class="text-3xl font-bold text-yellow-400">24h</div>
                    <div class="text-sm text-slate-300">Delivery</div>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-2xl p-4 text-center border border-white/20">
                    <div class="text-3xl font-bold text-yellow-400">MOQ</div>
                    <div class="text-sm text-slate-300">1 Pallet</div>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-2xl p-4 text-center border border-white/20">
                    <div class="text-3xl font-bold text-yellow-400">30%</div>
                    <div class="text-sm text-slate-300">Savings</div>
                </div>
            </div>
        </div>
    </section>

    @php
        $categoryIcons = [
            'beverages' => '🥤',
            'food-groceries' => '🥫',
            'frozen-foods' => '❄️',
            'snacks-confectionery' => '🍿',
            'household' => '🧴',
            'health-beauty' => '💊',
        ];
    @endphp
    <!-- ALL CATEGORIES & PRODUCTS SECTION -->
    <section id="products" class="bg-slate-50 min-h-screen">

        <!-- Sticky Category Navigation -->
        <div class="sticky-cat">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="category-nav flex gap-2 overflow-x-auto py-4">
                    {{-- <button class="category-btn active px-6 py-3 rounded-full text-sm font-medium"
                        onclick="filterCategory('all', this)">
                        All Products
                    </button>
                    <button class="category-btn px-6 py-3 rounded-full text-sm font-medium text-slate-600"
                        onclick="filterCategory('beverages', this)">
                        🥤 Beverages
                    </button>
                    <button class="category-btn px-6 py-3 rounded-full text-sm font-medium text-slate-600"
                        onclick="filterCategory('food', this)">
                        🥫 Food & Groceries
                    </button>
                    <button class="category-btn px-6 py-3 rounded-full text-sm font-medium text-slate-600"
                        onclick="filterCategory('frozen', this)">
                        ❄️ Frozen Foods
                    </button>
                    <button class="category-btn px-6 py-3 rounded-full text-sm font-medium text-slate-600"
                        onclick="filterCategory('snacks', this)">
                        🍿 Snacks & Confectionery
                    </button>
                    <button class="category-btn px-6 py-3 rounded-full text-sm font-medium text-slate-600"
                        onclick="filterCategory('household', this)">
                        🧴 Household
                    </button>
                    <button class="category-btn px-6 py-3 rounded-full text-sm font-medium text-slate-600"
                        onclick="filterCategory('health', this)">
                        💊 Health & Beauty
                    </button>
                    <button class="category-btn px-6 py-3 rounded-full text-sm font-medium text-slate-600"
                        onclick="filterCategory('baby', this)">
                        👶 Baby & Child
                    </button>
                    <button class="category-btn px-6 py-3 rounded-full text-sm font-medium text-slate-600"
                        onclick="filterCategory('pet', this)">
                        🐾 Pet Supplies
                    </button> --}}

                    <!-- All Products -->
                    <button class="category-btn active px-6 py-3 rounded-full text-sm font-medium"
                        onclick="filterCategory('all', this)">
                        All Products
                    </button>

                    <!-- Dynamic Categories -->
                    @foreach($categories as $category)
                        @php
                            $slug = \Illuminate\Support\Str::slug($category->name);
                            $icon = $categoryIcons[$slug] ?? '📦';
                        @endphp

                        <button class="category-btn px-6 py-3 rounded-full text-sm font-medium text-slate-600"
                            onclick="filterCategory('{{ $slug }}', this)">

                            {{ $icon }} {{ $category->name }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Category Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- BEVERAGES CATEGORY -->
            <div class="category-group mb-16">
                <div class="category-grid">
                    <!-- Product 1 -->
                    @foreach($products as $product)

                        @php
                            $slug = \Illuminate\Support\Str::slug($product->category->name);
                        @endphp
                       
                        <div class="product-card bg-white rounded-2xl overflow-hidden product-item"
                                data-category="{{ $slug }}">
                            <div class="relative h-48 bg-gray-100 overflow-hidden">
                                <!-- <img src="https://images.unsplash.com/photo-1622483767028-3f66f32aef97?w=400&h=400&fit=crop" alt="Coca Cola" class="product-image w-full h-full object-cover"> -->
                                <img src="{{ $product->image ? asset($product->image) : 'https://via.placeholder.com/300' }}"
                                    class="w-full h-full object-cover">
                                <div class="product-badge">
                                    <span
                                        class="px-3 py-1 bg-red-600 text-white text-xs font-bold rounded-full">POPULAR</span>
                                </div>
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity">
                                </div>
                                <div class="quick-add absolute bottom-4 left-4 right-4">
                                    <button onclick="quickAdd('Coca Cola 330ml Cans (24 pack)')"
                                        class="w-full py-3 bg-white text-blue-900 rounded-xl font-medium shadow-lg hover:bg-blue-900 hover:text-white transition">
                                        Quick Add
                                    </button>
                                </div>
                            </div>
                            <div class="p-5">
                                <div class="text-xs text-slate-500 mb-1">{{ $product->category->name }}</div>
                                <h3 class="font-bold text-slate-900 mb-2 line-clamp-2"> {{ $product->title }}</h3>
                                <p class="text-sm text-slate-500 mb-3">SKU : {{ $product->sku_code }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-slate-600">£ {{ $product->price }}</span>
                                    <button onclick="openModal('register')"
                                        class="text-blue-900 font-medium text-sm hover:underline">
                                        View Price
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

    <!-- BRANDS SECTION -->
    <section id="brands" class="py-16 bg-white border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-display text-3xl font-bold text-slate-900 mb-4">Featured Brands</h2>
                <p class="text-slate-600">Official distributor for leading FMCG brands</p>
            </div>

            <div class="grid grid-cols-3 md:grid-cols-6 gap-8 items-center opacity-70">
                <div class="flex items-center justify-center h-20 bg-slate-50 rounded-xl">
                    <span class="font-bold text-xl text-red-600">Coca-Cola</span>
                </div>
                <div class="flex items-center justify-center h-20 bg-slate-50 rounded-xl">
                    <span class="font-bold text-xl text-blue-700">Pepsi</span>
                </div>
                <div class="flex items-center justify-center h-20 bg-slate-50 rounded-xl">
                    <span class="font-bold text-xl text-purple-700">Cadbury</span>
                </div>
                <div class="flex items-center justify-center h-20 bg-slate-50 rounded-xl">
                    <span class="font-bold text-xl text-red-500">Kellogg's</span>
                </div>
                <div class="flex items-center justify-center h-20 bg-slate-50 rounded-xl">
                    <span class="font-bold text-xl text-blue-600">Heinz</span>
                </div>
                <div class="flex items-center justify-center h-20 bg-slate-50 rounded-xl">
                    <span class="font-bold text-xl text-green-600">Nestlé</span>
                </div>
            </div>
        </div>
    </section>

    <!-- SERVICES SECTION -->
    <section id="services" class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-display text-3xl font-bold text-slate-900 mb-4">Why Choose NextBee?</h2>
                <p class="text-slate-600">B2B wholesale solutions tailored for your business</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-sm">
                    <div
                        class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-blue-900 text-2xl mb-6">
                        <i class="fas fa-truck-fast"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-3">Next-Day Delivery</h3>
                    <p class="text-slate-600">Order by 6PM for delivery across Greater London within 24 hours.
                        Temperature-controlled vehicles for frozen goods.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 shadow-sm">
                    <div
                        class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-blue-900 text-2xl mb-6">
                        <i class="fas fa-pound-sign"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-3">Trade Credit</h3>
                    <p class="text-slate-600">30-60 day payment terms for established businesses. Credit limits from
                        £10,000 to £50,000 available.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 shadow-sm">
                    <div
                        class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-blue-900 text-2xl mb-6">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-3">Dedicated Support</h3>
                    <p class="text-slate-600">Your personal account manager available 7 days a week. Emergency stock
                        available for urgent orders.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="cta-bg py-20 text-white relative">
        <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
            <h2 class="font-display text-4xl md:text-5xl font-bold mb-6">Ready to Stock Your Business?</h2>
            <p class="text-xl text-blue-100 mb-8">Open a trade account today and access wholesale pricing on 10,000+
                products. Application approved within 24 hours.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <button onclick="openModal('register')"
                    class="px-8 py-4 bg-yellow-500 text-blue-900 font-bold rounded-full hover:bg-yellow-400 transition text-lg">
                    Open Trade Account
                </button>
                <a href="tel:02079460958"
                    class="px-8 py-4 bg-white/10 backdrop-blur text-white font-medium rounded-full hover:bg-white/20 transition border border-white/30 text-lg">
                    <i class="fas fa-phone mr-2"></i> 020 7946 0958
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-slate-900 text-slate-400 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-12">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-blue-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-building text-white"></i>
                        </div>
                        <div>
                            <h3 class="font-display text-xl font-bold text-white">NextBee</h3>
                            <p class="text-xs">B2B WHOLESALE</p>
                        </div>
                    </div>
                    <p class="text-sm mb-4">London's premier wholesale food and grocery distributor since 1995.</p>
                    <div class="flex gap-3">
                        <a href="#"
                            class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center hover:bg-blue-900 transition"><i
                                class="fab fa-linkedin-in"></i></a>
                        <a href="#"
                            class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center hover:bg-blue-900 transition"><i
                                class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Categories</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Beverages</a></li>
                        <li><a href="#" class="hover:text-white transition">Food & Groceries</a></li>
                        <li><a href="#" class="hover:text-white transition">Frozen Foods</a></li>
                        <li><a href="#" class="hover:text-white transition">Household</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Business</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Open Account</a></li>
                        <li><a href="#" class="hover:text-white transition">Trade Login</a></li>
                        <li><a href="#" class="hover:text-white transition">Credit Terms</a></li>
                        <li><a href="#" class="hover:text-white transition">Export</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Contact</h4>
                    <ul class="space-y-2 text-sm">
                        <li>020 7946 0958</li>
                        <li>sales@NextBeewholesale.co.uk</li>
                        <li>45 Industrial Way, Barking<br>London IG11 8TJ</li>
                    </ul>
                </div>
            </div>
            <div
                class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-sm">
                <p>&copy; 2026 NextBee Wholesale London Ltd. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-white transition">Privacy</a>
                    <a href="#" class="hover:text-white transition">Terms</a>
                    <a href="#" class="hover:text-white transition">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- MODAL -->
    <div id="modal-overlay"
        class="fixed inset-0 bg-black/50 backdrop-blur z-50 opacity-0 pointer-events-none transition-opacity"
        onclick="closeModal()"></div>
    <div id="modal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity overflow-y-auto">
        <div class="bg-white rounded-3xl max-w-md w-full p-8 transform scale-95 transition-transform"
            id="modal-content">

            <!-- Tab Navigation -->
            <div class="flex mb-6 bg-slate-100 rounded-xl p-1">
                <button onclick="switchTab('login')" id="tab-login"
                    class="flex-1 py-3 px-4 rounded-lg text-sm font-medium transition-all duration-300 text-slate-600 hover:text-slate-900">
                    Trade Login
                </button>
                <button onclick="switchTab('register')" id="tab-register"
                    class="flex-1 py-3 px-4 rounded-lg text-sm font-medium transition-all duration-300 bg-white text-blue-900 shadow-sm">
                    Open Account
                </button>
            </div>

            <!-- Close Button -->
            <div class="absolute top-6 right-6">
                <button onclick="closeModal()"
                    class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition">
                    <i class="fas fa-times text-slate-600"></i>
                </button>
            </div>

            <!-- Login Form -->
            <div id="form-login" class="hidden">
                <div class="text-center mb-6">
                    <h3 class="font-display text-2xl font-bold text-slate-900 mb-2">Welcome Back</h3>
                    <p class="text-sm text-slate-500">Sign in to access your trade account and pricing</p>
                </div>
                {{-- <form onsubmit="event.preventDefault(); handleLogin();"> --}}
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Business Email</label>
                                <input type="email" name="email" id="login-email"
                                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border-2 border-slate-200 focus:border-blue-900 focus:outline-none transition"
                                    placeholder="your@business.com" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                                <div class="relative">
                                    <input type="password" name='password' id="login-password"
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border-2 border-slate-200 focus:border-blue-900 focus:outline-none transition"
                                        placeholder="••••••••" required>
                                    <button type="button" onclick="togglePassword('login-password')"
                                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-slate-600">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox"
                                        class="w-4 h-4 rounded border-slate-300 text-blue-900 focus:ring-blue-900">
                                    <span class="text-slate-600">Remember me</span>
                                </label>
                                <a href="#" onclick="showForgotPassword()"
                                    class="text-blue-900 font-medium hover:underline">Forgot password?</a>
                            </div>
                            <button type="submit"
                                class="w-full py-4 bg-blue-900 text-white rounded-xl font-bold hover:bg-blue-800 transition shadow-lg shadow-blue-900/20">
                                Sign In
                            </button>
                            {{-- onclick="window.location.href='main.html'" --}}
                        </div>
                    </form>
                    <div class="mt-6 pt-6 border-t border-slate-200 text-center">
                        <p class="text-sm text-slate-500 mb-3">Don't have a trade account?</p>
                        <button onclick="switchTab('register')" class="text-blue-900 font-medium hover:underline">
                            Register your business <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>
            </div>

            <!-- Register Form (Original) -->
            <div id="form-register">
                <div class="text-center mb-6">
                    <h3 class="font-display text-2xl font-bold text-slate-900 mb-2">Open Trade Account</h3>
                </div>
                <form onsubmit="event.preventDefault(); handleRegister();">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Business Name</label>
                            <input type="text" id="reg-business"
                                class="w-full px-4 py-3 rounded-xl bg-slate-50 border-2 border-slate-200 focus:border-blue-900 focus:outline-none transition"
                                placeholder="Your Business Ltd" required>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">First Name</label>
                                <input type="text" id="reg-firstname"
                                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border-2 border-slate-200 focus:border-blue-900 focus:outline-none transition"
                                    placeholder="John" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Last Name</label>
                                <input type="text" id="reg-lastname"
                                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border-2 border-slate-200 focus:border-blue-900 focus:outline-none transition"
                                    placeholder="Smith" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Business Email</label>
                            <input type="email" id="reg-email"
                                class="w-full px-4 py-3 rounded-xl bg-slate-50 border-2 border-slate-200 focus:border-blue-900 focus:outline-none transition"
                                placeholder="john@yourbusiness.com" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Phone</label>
                            <input type="tel" id="reg-phone"
                                class="w-full px-4 py-3 rounded-xl bg-slate-50 border-2 border-slate-200 focus:border-blue-900 focus:outline-none transition"
                                placeholder="020 7946 0958" required>
                        </div>

                        <div class="flex items-start gap-3">
                            <input type="checkbox" id="reg-terms"
                                class="w-4 h-4 mt-1 rounded border-slate-300 text-blue-900 focus:ring-blue-900"
                                required>
                            <label for="reg-terms" class="text-sm text-slate-600">
                                I agree to the <a href="#" class="text-blue-900 font-medium hover:underline">Terms of
                                    Trade</a> and confirm this is a legitimate business enquiry
                            </label>
                        </div>
                        <button type="submit"
                            class="w-full py-4 bg-blue-900 text-white rounded-xl font-bold hover:bg-blue-800 transition shadow-lg shadow-blue-900/20">
                            Submit Application
                        </button>

                    </div>
                </form>
                <div class="mt-6 pt-6 border-t border-slate-200 text-center">
                    <p class="text-sm text-slate-500 mb-3">Already have an account?</p>
                    <button onclick="switchTab('login')" class="text-blue-900 font-medium hover:underline">
                        Sign in here <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                </div>
            </div>

            <!-- Forgot Password Form -->
            <div id="form-forgot" class="hidden">
                <div class="text-center mb-6">
                    <button onclick="switchTab('login')"
                        class="text-sm text-slate-500 hover:text-blue-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i> Back to login
                    </button>
                    <h3 class="font-display text-2xl font-bold text-slate-900 mb-2">Reset Password</h3>
                    <p class="text-sm text-slate-500">Enter your email and we'll send you a reset link</p>
                </div>
                <form onsubmit="event.preventDefault(); handleForgotPassword();">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Business Email</label>
                            <input type="email" id="forgot-email"
                                class="w-full px-4 py-3 rounded-xl bg-slate-50 border-2 border-slate-200 focus:border-blue-900 focus:outline-none transition"
                                required>
                        </div>
                        <button type="submit"
                            class="w-full py-4 bg-blue-900 text-white rounded-xl font-bold hover:bg-blue-800 transition">
                            Send Reset Link
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>




    <script>
        // Tab switching functionality
        function switchTab(tab) {
            const loginTab = document.getElementById('tab-login');
            const registerTab = document.getElementById('tab-register');
            const loginForm = document.getElementById('form-login');
            const registerForm = document.getElementById('form-register');
            const forgotForm = document.getElementById('form-forgot');

            // Reset all forms
            forgotForm.classList.add('hidden');

            if (tab === 'login') {
                loginTab.classList.add('bg-white', 'text-blue-900', 'shadow-sm');
                loginTab.classList.remove('text-slate-600');
                registerTab.classList.remove('bg-white', 'text-blue-900', 'shadow-sm');
                registerTab.classList.add('text-slate-600');

                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
            } else {
                registerTab.classList.add('bg-white', 'text-blue-900', 'shadow-sm');
                registerTab.classList.remove('text-slate-600');
                loginTab.classList.remove('bg-white', 'text-blue-900', 'shadow-sm');
                loginTab.classList.add('text-slate-600');

                registerForm.classList.remove('hidden');
                loginForm.classList.add('hidden');
            }
        }

        // Show forgot password
        function showForgotPassword() {
            document.getElementById('form-login').classList.add('hidden');
            document.getElementById('form-register').classList.add('hidden');
            document.getElementById('form-forgot').classList.remove('hidden');

            // Hide tabs
            document.querySelector('.flex.mb-6').classList.add('hidden');
        }

        // Toggle password visibility
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Handle login
        function handleLogin() {
            const email = document.getElementById('login-email').value;
            closeModal();
            showToast(`Welcome back! Logging in as ${email}...`);
        }

        // Handle register
        function handleRegister() {
            const business = document.getElementById('reg-business').value;
            closeModal();
            showToast(`Application submitted for ${business}! We'll contact you within 24 hours.`);
        }

        // Handle forgot password
        function handleForgotPassword() {
            const email = document.getElementById('forgot-email').value;
            closeModal();
            showToast(`Password reset link sent to ${email}`);
            // Reset view for next time
            setTimeout(() => {
                document.querySelector('.flex.mb-6').classList.remove('hidden');
                switchTab('login');
            }, 500);
        }

        // Open modal
        function openModal(type) {
            const overlay = document.getElementById('modal-overlay');
            const modal = document.getElementById('modal');
            const content = document.getElementById('modal-content');

            // Show tabs
            document.querySelector('.flex.mb-6').classList.remove('hidden');

            // Switch to appropriate tab
            if (type === 'login') {
                switchTab('login');
            } else {
                switchTab('register');
            }

            overlay.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.remove('opacity-0', 'pointer-events-none');
            content.classList.remove('scale-95');
            content.classList.add('scale-100');
        }

        // Close modal
        function closeModal() {
            const overlay = document.getElementById('modal-overlay');
            const modal = document.getElementById('modal');
            const content = document.getElementById('modal-content');

            overlay.classList.add('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-0', 'pointer-events-none');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');

            // Reset to register tab after close
            setTimeout(() => {
                document.querySelector('.flex.mb-6').classList.remove('hidden');
                switchTab('register');
            }, 300);
        }
    </script>

    <!-- TOAST -->
    <div id="toast"
        class="toast fixed bottom-8 right-8 bg-slate-900 text-white px-6 py-4 rounded-xl shadow-2xl z-50 flex items-center gap-3">
        <i class="fas fa-check-circle text-green-400 text-xl"></i>
        <span id="toast-message">Added to quote</span>
    </div>

    <script>
        // Loader
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.getElementById('loader').style.opacity = '0';
                setTimeout(() => {
                    document.getElementById('loader').style.display = 'none';
                }, 500);
            }, 1500);
        });

        // Navigation scroll
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.pageYOffset > 100) {
                navbar.classList.add('nav-scrolled');
            } else {
                navbar.classList.remove('nav-scrolled');
            }
        });

        // Mobile menu
        function toggleMobileMenu() {
            document.getElementById('mobile-menu').classList.toggle('active');
        }

        // Category filter
        function filterCategory(category, btn) {
            // Update buttons
            document.querySelectorAll('.category-btn').forEach(b => {
                b.classList.remove('active');
                b.classList.add('text-slate-600');
            });
            btn.classList.add('active');
            btn.classList.remove('text-slate-600');

            // Filter content
            const groups = document.querySelectorAll('.category-group');
            groups.forEach(group => {
                if (category === 'all' || group.dataset.category === category) {
                    group.style.display = 'block';
                    gsap.from(group, { opacity: 0, y: 20, duration: 0.5 });
                } else {
                    group.style.display = 'none';
                }
            });

            // Scroll to products
            if (category !== 'all') {
                document.getElementById('products').scrollIntoView({ behavior: 'smooth' });
            }
        }





        function handleSubmit() {
            closeModal();
            showToast('Application submitted! We will contact you within 24 hours.');
        }

        // Quick add
        function quickAdd(product) {
            showToast(`${product} added to quote request`);
        }

        // Toast
        function showToast(message) {
            const toast = document.getElementById('toast');
            document.getElementById('toast-message').textContent = message;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }

        // Smooth scroll
        function scrollToSection(id) {
            document.getElementById(id).scrollIntoView({ behavior: 'smooth' });
        }

        // GSAP animations
        gsap.registerPlugin(ScrollTrigger);

        gsap.utils.toArray('.reveal').forEach(elem => {
            gsap.from(elem, {
                scrollTrigger: {
                    trigger: elem,
                    start: 'top 85%',
                },
                y: 30,
                opacity: 0,
                duration: 0.8,
                ease: 'power3.out'
            });
        });

        // Counter animation
        const counters = document.querySelectorAll('.stat-number');
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            gsap.to(counter, {
                scrollTrigger: {
                    trigger: counter,
                    start: 'top 80%',
                },
                innerHTML: target,
                duration: 2,
                snap: { innerHTML: 1 },
                ease: 'power2.out',
                onUpdate: function () {
                    counter.innerHTML = Math.ceil(this.targets()[0].innerHTML).toLocaleString();
                }
            });
        });

        
    </script>
    
<script>
function filterCategory(category, btn) {

    // active button
    document.querySelectorAll('.category-btn').forEach(b => {
        b.classList.remove('active');
    });
    btn.classList.add('active');

    // filter products
    document.querySelectorAll('.product-item').forEach(item => {

        if (category === 'all') {
            item.style.display = 'block';
        } else {
            if (item.dataset.category === category) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        }

    });
}
</script>

</body>

</html>