<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', "Dreo's Slamdunk System")</title>
    @vite('resources/css/app.css') <!-- Tailwind -->
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow p-6">

            <!-- Sidebar Header with Image and Glow -->
            <div class="flex flex-col items-center mb-8 relative">
                <div class="relative w-28 h-28 rounded-full shadow-lg">
                    <div class="absolute inset-0 rounded-full border-2 border-black border-opacity-20"></div>
                    <img src="{{ asset('images/me.png') }}" alt="Dreo Cartoon"
                        class="w-28 h-28 object-cover rounded-full">
                </div>

                <h1 class="text-xl font-bold text-center leading-tight mt-3">
                    Dreo's Slamdunk System
                </h1>
            </div>

            <!-- Navigation -->
            <nav class="space-y-1">
                <a href="{{ route('customers.index') }}"
                    class="block px-1 py-2 border-b border-gray-200 transition
                          {{ request()->routeIs('customers.*') ? 'bg-gray-200 font-semibold' : 'hover:bg-gray-100' }}">
                    Customers
                </a>

                <a href="{{ route('customer-addresses.index') }}"
                    class="block px-1 py-2 border-b border-gray-200 transition
                          {{ request()->routeIs('customer-addresses.*') ? 'bg-gray-200 font-semibold' : 'hover:bg-gray-100' }}">
                    Customer Addresses
                </a>

                <a href="{{ route('teams.index') }}"
                    class="block px-1 py-2 border-b border-gray-200 transition
                          {{ request()->routeIs('teams.*') ? 'bg-gray-200 font-semibold' : 'hover:bg-gray-100' }}">
                    Teams
                </a>

                <a href="{{ route('sales-reps.index') }}"
                    class="block px-1 py-2 border-b border-gray-200 transition
                          {{ request()->routeIs('sales-reps.*') ? 'bg-gray-200 font-semibold' : 'hover:bg-gray-100' }}">
                    Sales Representative
                </a>

                <a href="{{ route('sales-rep-addresses.index') }}"
                    class="block px-1 py-2 border-b border-gray-200 transition
                          {{ request()->routeIs('sales-rep-addresses.*') ? 'bg-gray-200 font-semibold' : 'hover:bg-gray-100' }}">
                    Sales Rep Addresses
                </a>

                <a href="{{ route('items.index') }}"
                    class="block px-1 py-2 border-b border-gray-200 transition
                          {{ request()->routeIs('items.*') ? 'bg-gray-200 font-semibold' : 'hover:bg-gray-100' }}">
                    Items
                </a>

                <a href="{{ route('inventory.index') }}"
                    class="block px-1 py-2 border-b border-gray-200 transition
                          {{ request()->routeIs('inventory.*') ? 'bg-gray-200 font-semibold' : 'hover:bg-gray-100' }}">
                    Inventory
                </a>

                <a href="{{ route('orders.index') }}"
                    class="block px-1 py-2 border-b border-gray-200 transition
                          {{ request()->routeIs('orders.*') ? 'bg-gray-200 font-semibold' : 'hover:bg-gray-100' }}">
                    Orders
                </a>

                <a href="{{ route('order-items.index') }}"
                    class="block px-1 py-2 border-b border-gray-200 transition
                          {{ request()->routeIs('order-items.*') ? 'bg-gray-200 font-semibold' : 'hover:bg-gray-100' }}">
                    Order Items
                </a>

                <a href="{{ route('price-history.index') }}"
                    class="block px-1 py-2 border-b border-gray-200 transition
                          {{ request()->routeIs('price-history.*') ? 'bg-gray-200 font-semibold' : 'hover:bg-gray-100' }}">
                    Price History
                </a>
            </nav>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-6">
            <h2 class="text-2xl font-semibold mb-6">@yield('page-title', 'Dashboard')</h2>

            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>

</html>
