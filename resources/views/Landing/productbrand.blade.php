<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NextBee Wholesale | B2B Brands</title>
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

        /* User Profile Dropdown */
        .profile-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 0.5rem;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            min-width: 280px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 100;
        }

        .profile-dropdown.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* Notification Badge */
        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            width: 18px;
            height: 18px;
            background: #dc2626;
            color: white;
            font-size: 10px;
            font-weight: 700;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }

        /* Items on Sea Section */
        .sea-items-section {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 100%);
            position: relative;
            overflow: hidden;
        }

        .sea-items-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .sea-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .sea-card:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .eta-badge {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
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

        /* Sales Order Modal */
        .order-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .order-modal.active {
            opacity: 1;
            visibility: visible;
        }

        .order-modal-content {
            background: white;
            border-radius: 1.5rem;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            transform: scale(0.9) translateY(20px);
            transition: all 0.3s ease;
        }

        .order-modal.active .order-modal-content {
            transform: scale(1) translateY(0);
        }

        .order-option {
            border: 2px solid #e2e8f0;
            border-radius: 1rem;
            padding: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .order-option:hover {
            border-color: #1e40af;
            background: #eff6ff;
        }

        .order-option.selected {
            border-color: #1e40af;
            background: #eff6ff;
        }

        .order-option input[type="radio"] {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 20px;
            height: 20px;
            accent-color: #1e40af;
        }

        /* Sales Order Panel */
        .sales-order-panel {
            position: fixed;
            right: 0;
            top: 80px;
            width: 400px;
            height: calc(100vh - 80px);
            background: white;
            box-shadow: -10px 0 40px rgba(0, 0, 0, 0.1);
            transform: translateX(100%);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 50;
            display: flex;
            flex-direction: column;
        }

        .sales-order-panel.active {
            transform: translateX(0);
        }

        @media (max-width: 640px) {
            .sales-order-panel {
                width: 100%;
            }
        }

        /* Order Line Item */
        .order-line {
            display: grid;
            grid-template-columns: 3fr 1fr 1.5fr auto;
            gap: 1rem;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            font-size: 0.875rem;
        }

        @media (max-width: 640px) {
            .order-line {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }
        }

        /* Quantity Input */
        .qty-input {
            width: 80px;
            padding: 0.5rem;
            border: 2px solid #e2e8f0;
            border-radius: 0.5rem;
            text-align: center;
            font-weight: 600;
        }

        .qty-input:focus {
            border-color: #1e40af;
            outline: none;
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

        /* Mobile Menu */
        .mobile-menu {
            transform: translateX(100%);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .mobile-menu.active {
            transform: translateX(0);
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

        /* Status Indicators */
        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 6px;
        }

        .status-dot.green {
            background: #10b981;
        }

        .status-dot.amber {
            background: #f59e0b;
        }

        .status-dot.blue {
            background: #3b82f6;
        }

        #brandSlider {
            animation: scrollBrands 25s linear infinite;
        }

        @keyframes scrollBrands {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
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

    <!-- Navigation - LOGGED IN VERSION -->
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
                    <a href="/main" class="text-sm font-medium text-slate-600 hover:text-blue-900 transition">Home</a>

                    <a href="#products"
                        class="text-sm font-medium text-slate-600 hover:text-blue-900 transition">Products</a>

                    <a href="#brands"
                        class="text-sm font-medium text-slate-600 hover:text-blue-900 transition">Brands</a>
                    <a href="#services"
                        class="text-sm font-medium text-slate-600 hover:text-blue-900 transition">Services</a>
                    <a href="/checkout"
                        class="text-sm font-medium text-blue-900 hover:text-blue-700 transition flex items-center gap-2">
                        <i class="fas fa-clipboard-list"></i>
                        Sales Order
                    </a>
                </div>

                <!-- LOGGED IN USER SECTION -->
                <div class="flex items-center gap-4">
                    <!-- Notifications -->
                    <button onclick="toggleNotifications()"
                        class="relative p-2 text-slate-600 hover:text-blue-900 transition">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="notification-badge">3</span>
                    </button>

                    <!-- Account Manager Info -->
                    <!-- <div class="hidden md:flex items-center gap-3 px-4 py-2 bg-slate-50 rounded-xl">
                        <div class="text-right">
                            <p class="text-xs text-slate-500">Account Manager</p>
                            <p class="text-sm font-semibold text-slate-900">Sarah Johnson</p>
                        </div>
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-headset text-blue-900"></i>
                        </div>
                    </div> -->

                    <!-- User Profile -->
                    <div class="relative" id="profile-container">
                        <button onclick="toggleProfile()"
                            class="flex items-center gap-3 p-2 hover:bg-slate-50 rounded-xl transition">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-blue-900 to-blue-700 rounded-full flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="hidden md:block text-left">
                                <p class="text-sm font-semibold text-slate-900"> {{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-500"> {{ Auth::user()->role }}</p>
                            </div>
                            <i class="fas fa-chevron-down text-slate-400 text-xs"></i>
                        </button>

                        <!-- Profile Dropdown -->
                        <div class="profile-dropdown" id="profile-dropdown">
                            <div class="p-4 border-b border-slate-100">
                                <p class="font-semibold text-slate-900"> {{ Auth::user()->name }}</p>
                                <p class="text-sm text-slate-500">{{ Auth::user()->email }}</p>
                                <!-- <p class="text-xs text-slate-400 mt-1">Business ID: MET-78432</p> -->
                            </div>
                            <div class="p-2">
                                <a href="/customer/profile"
                                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-50 transition text-sm text-slate-700">
                                    <i class="fas fa-user text-slate-400"></i>
                                    My Profile
                                </a>
                                <a href="/customer/dashboard"
                                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-50 transition text-sm text-slate-700">
                                    <i class="fas fa-building text-slate-400"></i>
                                    Dashboard
                                </a>

                            </div>
                            <div class="p-2 border-t border-slate-100">
                                <form method="POST" action="{{ url('/logout') }}">
                                    @csrf
                                    <button type="submit" {{-- onclick="logout()" --}}
                                        class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-50 transition text-sm text-red-600">
                                        <i class="fas fa-sign-out-alt"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <button class="lg:hidden p-2" onclick="toggleMobileMenu()">
                        <i class="fas fa-bars text-2xl text-slate-700"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Notification Panel -->
    <div id="notification-panel"
        class="fixed top-20 right-4 w-80 bg-white rounded-2xl shadow-2xl z-50 opacity-0 invisible transition-all duration-300 transform translate-y-2">
        <div class="p-4 border-b border-slate-100 flex justify-between items-center">
            <h3 class="font-semibold text-slate-900">Notifications</h3>
            <button onclick="toggleNotifications()" class="text-slate-400 hover:text-slate-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="max-h-96 overflow-y-auto">
            <div class="p-4 border-b border-slate-100 hover:bg-slate-50 cursor-pointer">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-ship text-blue-600 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-900">Shipment Update</p>
                        <p class="text-xs text-slate-500 mt-1">Container MET-2024-089 has arrived at Felixstowe Port</p>
                        <p class="text-xs text-slate-400 mt-1">2 hours ago</p>
                    </div>
                </div>
            </div>
            <div class="p-4 border-b border-slate-100 hover:bg-slate-50 cursor-pointer">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check text-green-600 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-900">Order Confirmed</p>
                        <p class="text-xs text-slate-500 mt-1">Sales Order #SO-2024-1567 has been confirmed</p>
                        <p class="text-xs text-slate-400 mt-1">5 hours ago</p>
                    </div>
                </div>
            </div>
            <div class="p-4 hover:bg-slate-50 cursor-pointer">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-exclamation text-amber-600 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-900">Price Change Alert</p>
                        <p class="text-xs text-slate-500 mt-1">Coca-Cola 330ml pricing updated for Q2 2024</p>
                        <p class="text-xs text-slate-400 mt-1">1 day ago</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3 border-t border-slate-100 text-center">
            <a href="#" class="text-sm text-blue-900 font-medium hover:underline">View All Notifications</a>
        </div>
    </div>

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
                <a href="#sea-items" class="block text-2xl font-medium text-slate-800"
                    onclick="toggleMobileMenu()">Items on Sea</a>
                <a href="#brands" class="block text-2xl font-medium text-slate-800"
                    onclick="toggleMobileMenu()">Brands</a>
                <a href="#services" class="block text-2xl font-medium text-slate-800"
                    onclick="toggleMobileMenu()">Services</a>
                <a href="/checkout" onclick="toggleMobileMenu();" class="block text-2xl font-medium text-blue-900">
                    Sales Order</a>
                <hr class="border-slate-200">
                <a href="/customer/profile" class="block text-lg font-medium text-slate-600">My Profile</a>
                <a href="//customer/orders" class="block text-lg font-medium text-slate-600">Order History</a>
                <button onclick="logout()" class="block text-lg font-medium text-red-600">Logout</button>
            </div>
        </div>
    </div>


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
                <div>

                    <p class="text-slate-500" id="productTitle">
                        @if(request()->is('brand/*'))
                            Showing products of {{ $brand }}
                        @else
                            Showing all products
                        @endif
                    </p>
                </div>
                <div class="category-nav flex gap-2 overflow-x-auto py-4">

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
            <div class="category-group mb-16" data-category="beverages">


                <div class="category-grid">
                    <!-- Product 1 -->
                    @foreach($products as $product)


                        @php
                            $slug = \Illuminate\Support\Str::slug($product->category->name);
                        @endphp
                        <!-- <div class="product-card bg-white rounded-2xl mt-20 overflow-hidden product-item"
                                                                                                                data-category="{{ $slug }}"> -->
                        <div class="product-card bg-white rounded-2xl mt-20 overflow-hidden product-item
                                    {{ in_array($product->id, $brandProducts) ? 'brand-product' : '' }}"
                            data-category="{{ $slug }}"
                            data-brand="{{ in_array($product->id, $brandProducts) ? 'selected' : 'other' }}">
                            <div class="relative h-48 bg-gray-100 overflow-hidden">
                                <img src="{{ $product->image ? asset($product->image) : 'https://via.placeholder.com/300' }}"
                                    alt="Coca Cola" class="product-image w-full h-full object-cover">
                                <div class="product-badge">
                                    <span
                                        class="px-3 py-1 bg-red-600 text-white text-xs font-bold rounded-full">POPULAR</span>
                                </div>
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity">
                                </div>
                                <div class="quick-add absolute bottom-4 left-4 right-4">
                                    <button
                                        onclick="addToSalesOrder('{{ $product->title }}', '{{ $product->sku_code }}', {{ $product->moq }}, {{ $product->price }}, {{ $product->id }})"
                                        class="w-full py-3 bg-blue-900 text-white rounded-xl font-medium shadow-lg hover:bg-blue-800 transition">
                                        <i class="fas fa-plus mr-2"></i>Add to Sales Order
                                    </button>
                                    <!-- <button onclick="addToCart({{ $product->id }})"
                                                                                                                                                class="w-full py-3 bg-blue-900 text-white rounded-xl">
                                                                                                                                                <i class="fas fa-plus mr-2"></i>Add to Sales Order
                                                                                                                                            </button> -->
                                </div>
                            </div>
                            <div class="p-5">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs text-slate-500">SKU : {{ $product->sku_code }}</span>
                                    <span class="status-dot green"></span><span class="text-xs text-green-600">In
                                        Stock</span>
                                </div>
                                <h3 class="font-bold text-slate-900 mb-2 line-clamp-2">{{ $product->title }}</h3>
                                <p class="text-sm text-slate-500 mb-3">{{ $product->category->name }}</p>
                                <div class="flex items-center justify-between pt-3 border-t border-slate-100">
                                    <div>
                                        <p class="text-xs text-slate-400">Trade Price</p>
                                        <p class="text-lg font-bold text-blue-900">£ {{ $product->price }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs text-slate-400">MOQ</p>
                                        <p class="text-sm font-semibold text-slate-700">{{ $product->moq }} cases</p>
                                    </div>
                                </div>
                                <div class="mt-3 flex items-center gap-2 text-xs text-slate-500">
                                    <i class="fas fa-truck"></i>
                                    <span>Next-day delivery available</span>
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
                <h2 class="font-display text-3xl font-bold text-slate-900 mb-4">
                    Featured Brands
                </h2>
                <p class="text-slate-600">
                    Official distributor for leading FMCG brands
                </p>
            </div>

            <!-- SLIDER WRAPPER -->
            <div class="overflow-hidden relative">

                <div id="brandSlider" class="flex gap-6 w-max">

                    @php
                        $colors = [
                            'text-red-600',
                            'text-blue-700',
                            'text-purple-700',
                            'text-red-500',
                            'text-blue-600',
                            'text-green-600'
                        ];
                    @endphp

                    @foreach($brands as $index => $brand)

                        @php
                            $color = $colors[$index % 6]; // 🔥 repeat colors
                            $urlBrand = str_replace("'", "", $brand);
                        @endphp

                        <a href="{{ url('/brand/' . $urlBrand) }}">

                            <div
                                class="min-w-[160px] flex items-center justify-center h-20 bg-slate-50 rounded-xl hover:bg-blue-50 transition">

                                <span class="font-bold text-lg {{ $color }}">
                                    {{ $brand }}
                                </span>

                            </div>

                        </a>

                    @endforeach

                    <!-- 🔥 duplicate for infinite loop -->
                    @foreach($brands as $index => $brand)

                        @php
                            $color = $colors[$index % 6];
                            $urlBrand = str_replace("'", "", $brand);
                        @endphp

                        <a href="{{ url('/brand/' . $urlBrand) }}">

                            <div
                                class="min-w-[160px] flex items-center justify-center h-20 bg-slate-50 rounded-xl hover:bg-blue-50 transition">

                                <span class="font-bold text-lg {{ $color }}">
                                    {{ $brand }}
                                </span>

                            </div>

                        </a>

                    @endforeach

                </div>
            </div>
        </div>
    </section>

    <!-- SALES ORDER SLIDE PANEL -->
    <div class="sales-order-panel" id="sales-order-panel">
        <div class="p-6 border-b border-slate-200 bg-slate-50">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="font-display text-xl font-bold text-slate-900">Sales Order</h2>
                    <p class="text-sm text-slate-500">Draft #SO-2024-DRAFT</p>
                </div>
                <button onclick="toggleOrderPanel()"
                    class="w-10 h-10 rounded-full bg-white flex items-center justify-center hover:bg-slate-100 transition shadow-sm">
                    <i class="fas fa-times text-slate-600"></i>
                </button>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto p-4" id="order-lines">
            <!-- Empty State -->
            <div id="empty-order" class="text-center py-12">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clipboard-list text-slate-400 text-2xl"></i>
                </div>
                <p class="text-slate-500 mb-2">No items added yet</p>
                <p class="text-sm text-slate-400">Click "Add to Sales Order" on any product</p>
            </div>
            <!-- Order lines will be added here dynamically -->
        </div>

        <div class="p-6 border-t border-slate-200 bg-slate-50">
            <!-- NEW: Coupon Code Section -->
            <div class="mb-4 p-3 bg-white rounded-xl border border-slate-200">
                <label class="block text-xs font-semibold text-slate-700 mb-2 uppercase tracking-wider">Coupon
                    Code</label>
                <div class="flex gap-2">
                    <input type="text" id="coupon-input" placeholder="Enter code (e.g., BULK10)"
                        class="flex-1 px-3 py-2 text-sm border-2 border-slate-200 rounded-lg focus:border-blue-900 focus:outline-none uppercase">
                    <button onclick="applyCoupon()"
                        class="px-4 py-2 bg-slate-800 text-white text-sm font-medium rounded-lg hover:bg-slate-700 transition">
                        Apply
                    </button>
                </div>
                <div id="coupon-message" class="text-xs mt-2"></div>
                <div id="active-coupon"
                    class="hidden mt-2 flex items-center justify-between bg-green-50 px-3 py-2 rounded-lg">
                    <span class="text-xs text-green-700 font-medium" id="active-coupon-name"></span>
                    <button onclick="removeCoupon()" class="text-xs text-red-600 hover:underline">Remove</button>
                </div>
            </div>

            <div class="space-y-3 mb-4">
                <div class="flex justify-between text-sm">
                    <span class="text-slate-600">Subtotal</span>
                    <span class="font-semibold text-slate-900" id="subtotal">£0.00</span>
                </div>

                <!-- NEW: Discount Row (Hidden by default) -->
                <div id="discount-row" class="flex justify-between text-sm hidden">
                    <span class="text-green-600 font-medium">Discount</span>
                    <span class="font-semibold text-green-600" id="discount-amount">-£0.00</span>
                </div>

                <div class="flex justify-between text-sm">
                    <span class="text-slate-600">VAT (20%)</span>
                    <span class="font-semibold text-slate-900" id="vat">£0.00</span>
                </div>
                <div class="flex justify-between text-lg font-bold pt-3 border-t border-slate-200">
                    <span class="text-slate-900">Total</span>
                    <span class="text-blue-900" id="total">£0.00</span>
                </div>
            </div>

            <div class="space-y-2">
                <button onclick="submitSalesOrder()"
                    class="w-full py-3 bg-blue-900 text-white rounded-xl font-bold hover:bg-blue-800 transition shadow-lg"
                    id="submit-order-btn" disabled>
                    Submit Sales Order
                </button>
                <button onclick="saveDraftOrder()"
                    class="w-full py-3 bg-white text-slate-700 border-2 border-slate-200 rounded-xl font-medium hover:bg-slate-50 transition">
                    Save as Draft
                </button>
                <button onclick="clearOrder()" class="w-full py-2 text-red-600 text-sm hover:underline">
                    Clear All Items
                </button>
            </div>

            <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                <p class="text-xs text-blue-800">
                    <i class="fas fa-info-circle mr-1"></i>
                    Payment Terms: Net 30 days from invoice date
                </p>
            </div>
        </div>
    </div>

    <!-- SALES ORDER OPTIONS MODAL -->
    <div class="order-modal" id="order-modal">
        <div class="order-modal-content">
            <div class="p-6 border-b border-slate-200">
                <div class="flex justify-between items-center">
                    <h3 class="font-display text-xl font-bold text-slate-900">Add to Sales Order</h3>
                    <button onclick="closeOrderModal()"
                        class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition">
                        <i class="fas fa-times text-slate-600"></i>
                    </button>
                </div>
                <p class="text-sm text-slate-500 mt-1" id="modal-product-name">Product Name</p>
            </div>

            <div class="p-6">
                <div class="mb-6">
                    <div id="cart-message" class="mb-4 hidden p-3 rounded-lg text-sm"></div>

                    <label class="block text-sm font-medium text-slate-700 mb-2">Quantity (cases)</label>
                    <div class="flex items-center gap-3">
                        <button onclick="adjustQty(-1)"
                            class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition">
                            <i class="fas fa-minus text-slate-600"></i>
                        </button>
                        <input type="number" id="modal-qty" value="1" min="1" class="qty-input text-lg">
                        <button onclick="adjustQty(1)"
                            class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition">
                            <i class="fas fa-plus text-slate-600"></i>
                        </button>
                    </div>
                    <p class="text-xs text-slate-500 mt-2">Minimum Order Quantity: <span id="modal-moq">5</span> cases
                    </p>
                </div>

                <p class="text-sm font-medium text-slate-700 mb-3">How would you like to add this item?</p>

                <div class="space-y-3">
                    <label class="order-option block cursor-pointer" onclick="selectOrderOption('new')">
                        <input type="radio" name="order-option" value="new" checked>
                        <div class="flex items-start gap-3">
                            <div
                                class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-file text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">Start New Sales Order</p>
                                <p class="text-sm text-slate-500">Create a new order with only this item</p>
                            </div>
                        </div>
                    </label>

                    <label class="order-option block cursor-pointer" onclick="selectOrderOption('regular')">
                        <input type="radio" name="order-option" value="regular">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-sync text-green-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">Add to Regular Items</p>
                                <p class="text-sm text-slate-500">Include with your standard recurring order</p>
                            </div>
                        </div>
                    </label>

                    <label class="order-option block cursor-pointer" onclick="selectOrderOption('current')">
                        <input type="radio" name="order-option" value="current">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-plus-circle text-purple-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">Add to Current Draft</p>
                                <p class="text-sm text-slate-500">Append to your existing sales order</p>
                            </div>
                        </div>
                    </label>
                </div>

                <button onclick="confirmAddToOrder()"
                    class="w-full mt-6 py-4 bg-blue-900 text-white rounded-xl font-bold hover:bg-blue-800 transition shadow-lg">
                    Confirm Addition
                </button>
            </div>
        </div>
    </div>





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
                    <h4 class="text-white font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#products" class="hover:text-white transition">Browse Products</a></li>
                        <li><a href="#sea-items" class="hover:text-white transition">Items on Sea</a></li>
                        <li><a href="/checkout" class="hover:text-white transition">My Sales
                                Orders</a></li>
                        <li><a href="/customer/orders" class="hover:text-white transition">Order History</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Account</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/customer/profile" class="hover:text-white transition">My Profile</a></li>
                        <li><a href="#" class="hover:text-white transition">Payment Terms</a></li>
                        <li><a href="/customer/dashboard" class="hover:text-white transition">Invoices</a></li>
                        <li><a href="/customer/profile" class="hover:text-white transition">Delivery Addresses</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Contact</h4>
                    <ul class="space-y-2 text-sm">
                        <li><i class="fas fa-user mr-2"></i>Sarah Johnson (Your AM)</li>
                        <li><i class="fas fa-phone mr-2"></i>020 7946 0958 ext. 204</li>
                        <li><i class="fas fa-envelope mr-2"></i>sarah.j@NextBeewholesale.co.uk</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i>45 Industrial Way, Barking<br>London IG11 8TJ</li>
                    </ul>
                </div>
            </div>
            <div
                class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-sm">
                <p>&copy; 2026 NextBee Wholesale London Ltd. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-white transition">Privacy</a>
                    <a href="#" class="hover:text-white transition">Terms of Trade</a>
                    <a href="#" class="hover:text-white transition">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- TOAST -->
    <div id="toast"
        class="toast fixed bottom-8 right-8 bg-slate-900 text-white px-6 py-4 rounded-xl shadow-2xl z-50 flex items-center gap-3">
        <i class="fas fa-check-circle text-green-400 text-xl"></i>
        <span id="toast-message">Added to sales order</span>
    </div>

    <script>

        // Global state
        let currentOrder = [];
        let tempProduct = null;

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

        // Profile dropdown
        function toggleProfile() {
            const dropdown = document.getElementById('profile-dropdown');
            dropdown.classList.toggle('active');
        }

        // Close profile when clicking outside
        document.addEventListener('click', (e) => {
            const container = document.getElementById('profile-container');
            const dropdown = document.getElementById('profile-dropdown');
            if (!container.contains(e.target)) {
                dropdown.classList.remove('active');
            }
        });

        // Notifications
        function toggleNotifications() {
            const panel = document.getElementById('notification-panel');
            if (panel.classList.contains('opacity-0')) {
                panel.classList.remove('opacity-0', 'invisible', 'translate-y-2');
            } else {
                panel.classList.add('opacity-0', 'invisible', 'translate-y-2');
            }
        }

        // Mobile menu
        function toggleMobileMenu() {
            document.getElementById('mobile-menu').classList.toggle('active');
        }

        // Sales Order Panel
        function toggleOrderPanel() {
            const panel = document.getElementById('sales-order-panel');
            panel.classList.toggle('active');
            updateOrderDisplay();
        }

        // Add to Sales Order - Open Modal
        function addToSalesOrder(name, sku, moq, price, id) {

            tempProduct = { name, sku, moq, price, id };

            document.getElementById('modal-product-name').textContent = name;
            document.getElementById('modal-moq').textContent = moq;
            document.getElementById('modal-qty').value = moq;

            // 🔥 BACKEND CHECK
            fetch('/cart/check/' + id)
                .then(res => res.json())
                .then(data => {

                    const options = document.querySelectorAll('.order-option');
                    const messageBox = document.getElementById('cart-message');

                    // 🔄 RESET
                    options.forEach(el => {
                        el.style.display = 'none';
                        el.classList.remove('selected');
                    });

                    messageBox.classList.add('hidden');
                    messageBox.innerHTML = "";

                    // ✅ CASE 1: CART EMPTY
                    if (data.hasCartItems === false) {

                        document.querySelector('[value="new"]').closest('.order-option').style.display = 'block';
                        document.querySelector('[value="regular"]').closest('.order-option').style.display = 'block';

                        document.querySelector('[value="new"]').checked = true;
                    }

                    // ✅ CASE 2: CART HAS ITEMS
                    else {

                        // 👉 ONLY CURRENT SHOW
                        document.querySelector('[value="current"]').closest('.order-option').style.display = 'block';
                        document.querySelector('[value="current"]').checked = true;

                        // 👉 CASE 2A: SAME PRODUCT ALREADY EXISTS → SHOW MESSAGE
                        if (data.exists === true) {

                            messageBox.classList.remove('hidden');
                            messageBox.className = "mb-4 p-3 rounded-lg bg-yellow-50 text-yellow-800";

                            messageBox.innerHTML = `
                    <b>Already in Sales Order</b><br>
                    This item is already added to your Sales Order.<br>
                    You can add more quantity to the current draft.
                `;
                        }

                        // 👉 CASE 2B: DIFFERENT PRODUCT → NO MESSAGE
                    }

                    document.getElementById('order-modal').classList.add('active');
                });
        }
        // Close Order Modal
        function closeOrderModal() {
            document.getElementById('order-modal').classList.remove('active');
            tempProduct = null;

            // ✅ RESET OPTIONS BACK
            document.querySelectorAll('.order-option').forEach(el => {
                el.style.display = 'block';
                el.classList.remove('selected');
            });

            document.querySelector('input[value="new"]').checked = true;
        }

        // Adjust quantity
        function adjustQty(delta) {

            const input = document.getElementById('modal-qty');
            let val = parseInt(input.value) || tempProduct.moq;

            val += delta;

            // ✅ MOQ apply
            if (val < tempProduct.moq) {
                val = tempProduct.moq;
                showToast('Minimum ' + tempProduct.moq);
            }

            input.value = val;
        }

        // Select order option
        function selectOrderOption(option) {
            document.querySelectorAll('.order-option').forEach(el => {
                el.classList.remove('selected');
            });
            event.currentTarget.classList.add('selected');
        }

        // Confirm add to order
        function confirmAddToOrder() {

            const qty = parseInt(document.getElementById('modal-qty').value);

            if (qty < tempProduct.moq) {
                showToast('Minimum ' + tempProduct.moq);
                return;
            }

            // ✅ backend call (IMPORTANT)
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: tempProduct.id, // 👈 product id pass karo
                    quantity: qty
                })
            })
                .then(res => res.json())
                .then(data => {

                    if (data.success) {
                        closeOrderModal();
                        showToast('Added to cart successfully ✅');

                        // optional: panel me bhi dikhao
                        currentOrder.push({
                            ...tempProduct,
                            qty: qty,
                            lineTotal: qty * tempProduct.price
                        });

                        updateOrderDisplay();
                        closeOrderModal();
                    }

                });
        }

        // Update order display
        function updateOrderDisplay() {
            const container = document.getElementById('order-lines');
            const emptyState = document.getElementById('empty-order');
            const submitBtn = document.getElementById('submit-order-btn');
            const orderCount = document.getElementById('order-count');

            if (currentOrder.length === 0) {
                emptyState.style.display = 'block';
                submitBtn.disabled = true;
                orderCount.classList.add('hidden');
                // Remove all line items
                const lines = container.querySelectorAll('.order-line-item');
                lines.forEach(l => l.remove());
            } else {
                emptyState.style.display = 'none';
                submitBtn.disabled = false;
                orderCount.textContent = currentOrder.length;
                orderCount.classList.remove('hidden');

                // Remove existing lines
                const lines = container.querySelectorAll('.order-line-item');
                lines.forEach(l => l.remove());

                // Add current lines
                currentOrder.forEach((item, index) => {
                    const div = document.createElement('div');
                    div.className = 'order-line-item order-line bg-white rounded-xl mb-2 shadow-sm';
                    div.innerHTML = `
                        <div>
                            <p class="font-semibold text-slate-900 text-sm">${item.name}</p>
                            <p class="text-xs text-slate-500">${item.sku}</p>
                        </div>
                        <div class="text-center">
                            <input type="number" value="${item.qty}" min="${item.moq}" 
                                onchange="updateLineQty(${index}, this.value)"
                                class="qty-input text-sm">
                            <p class="text-xs text-slate-400 mt-1">cases</p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-slate-900">£${(item.price * item.qty).toFixed(2)}</p>
                            <p class="text-xs text-slate-500">£${item.price.toFixed(2)}/case</p>
                        </div>
                        <button onclick="removeLine(${index})" class="text-red-400 hover:text-red-600 transition">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    `;
                    container.appendChild(div);
                });
            }

            updateTotals();
        }

        // Update line quantity
        function updateLineQty(index, newQty) {
            newQty = parseInt(newQty);
            if (newQty < currentOrder[index].moq) {
                showToast('Minimum ' + currentOrder[index].moq + ' cases required');
                updateOrderDisplay();
                return;
            }
            currentOrder[index].qty = newQty;
            currentOrder[index].lineTotal = newQty * currentOrder[index].price;
            updateOrderDisplay();
        }

        // Remove line item
        function removeLine(index) {
            currentOrder.splice(index, 1);
            updateOrderDisplay();
            showToast('Item removed from order');
        }

        // Update totals
        function updateTotals() {
            const subtotal = currentOrder.reduce((sum, item) => sum + (item.price * item.qty), 0);
            const vat = subtotal * 0.20;
            const total = subtotal + vat;

            document.getElementById('subtotal').textContent = '£' + subtotal.toFixed(2);
            document.getElementById('vat').textContent = '£' + vat.toFixed(2);
            document.getElementById('total').textContent = '£' + total.toFixed(2);
        }

        // Submit sales order
        function submitSalesOrder() {
            if (currentOrder.length === 0) return;

            // localStorage me save karo
            localStorage.setItem('checkout_items', JSON.stringify(currentOrder));

            // redirect to checkout
            window.location.href = "/checkout";
        }

        // Save draft
        function saveDraftOrder() {
            if (currentOrder.length === 0) {
                showToast('No items to save');
                return;
            }
            showToast('Draft order saved. Reference: DRAFT-' + Date.now().toString().slice(-6));
        }

        // Clear order
        function clearOrder() {
            if (currentOrder.length === 0) return;
            if (confirm('Clear all items from this order?')) {
                currentOrder = [];
                updateOrderDisplay();
                showToast('Order cleared');
            }
        }

        // Preorder container
        function preorderContainer(containerId) {
            showToast('Pre-order request for ' + containerId + ' submitted. Your account manager will contact you.');
        }

        // View price list
        function viewPriceList(category) {
            showToast('Price list for ' + category + ' downloaded');
        }

        // Logout
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                showToast('Logged out successfully');
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }
        }



        // Toast notification
        function showToast(message) {
            const toast = document.getElementById('toast');
            document.getElementById('toast-message').textContent = message;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
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

        function filterCategory(category, btn) {

            document.querySelectorAll('.category-btn').forEach(b => {
                b.classList.remove('active');
            });
            btn.classList.add('active');

            let title = document.getElementById('productTitle');
            let isBrandPage = window.location.pathname.includes('/brand/');

            // ✅ ALL PRODUCTS CLICK
            if (category === 'all') {

                showAllMode = true; // 🔥 MODE ON

                title.innerText = "Showing all products";

                document.querySelectorAll('.product-item').forEach(item => {
                    item.style.display = 'block';
                });

                return;
            }

            // ❗ CATEGORY FILTER
            document.querySelectorAll('.product-item').forEach(item => {

                // 🔥 CASE 1: ALL MODE (brand ignore)
                if (showAllMode) {

                    if (item.dataset.category === category) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }

                }

                // 🔥 CASE 2: BRAND PAGE NORMAL
                else if (isBrandPage) {

                    if (item.dataset.category === category && item.dataset.brand === 'selected') {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }

                }

                // 🔥 CASE 3: NORMAL PAGE
                else {

                    if (item.dataset.category === category) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }

                }

            });

            // TITLE UPDATE
            if (showAllMode) {
                title.innerText = "Showing " + category + " (All Brands)";
            } else if (isBrandPage) {
                title.innerText = "Showing products of {{ $brand }}";
            } else {
                title.innerText = "Showing category: " + category;
            }
        }
        window.onload = function () {

            let isBrandPage = window.location.pathname.includes('/brand/');

            if (!isBrandPage) return;

            showAllMode = false; // 🔥 RESET

            document.querySelectorAll('.product-item').forEach(item => {

                if (item.dataset.brand === 'selected') {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }

            });

        };

    </script>

    <script>
        function addToCart(productId) {

            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // 🔥 DIRECT CHECKOUT
                        showToast('Added to cart ✅');
                    }
                })
        }
        const slider = document.getElementById('brandSlider');

        slider.addEventListener('mouseenter', () => {
            slider.style.animationPlayState = 'paused';
        });

        slider.addEventListener('mouseleave', () => {
            slider.style.animationPlayState = 'running';
        });

        const wrapper = document.querySelector('#brandSlider');

        wrapper.addEventListener('wheel', (e) => {
            e.preventDefault();
            wrapper.scrollLeft += e.deltaY;
        });
    </script>
</body>

</html>