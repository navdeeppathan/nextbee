 <!-- Header -->
        <header class="bg-white border-b border-slate-200 sticky top-0 z-30">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center gap-4">
                    <button class="mobile-toggle p-2 hover:bg-slate-100 rounded-lg lg:hidden" onclick="openMobileSidebar()" aria-label="Open menu">
                        <i class="fas fa-bars text-slate-600 text-xl"></i>
                    </button>
                    <div>
                        <h1 class="font-display text-2xl font-bold text-slate-900">Sales Dashboard</h1>
                        <p class="text-sm text-slate-500">Welcome back, Mike! Here's your overview for April 2026</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="hidden md:flex items-center gap-2 px-4 py-2 bg-green-50 rounded-lg border border-green-200">
                        <i class="fas fa-circle text-green-500 text-xs"></i>
                        <span class="text-sm font-medium text-green-700">Online</span>
                    </div>
                    <button class="relative p-2 text-slate-600 hover:text-blue-900 transition" aria-label="Notifications">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center font-semibold">8</span>
                    </button>
                    <button class="p-2 text-slate-600 hover:text-blue-900 transition" onclick="openMessages()" aria-label="Messages">
                        <i class="fas fa-envelope text-xl"></i>
                    </button>
                </div>
            </div>
        </header>