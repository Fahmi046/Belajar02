<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-gray-900 bg-gray-100">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-white border-r shadow">
            <div class="p-4 text-xl font-bold border-b">
                <span class="text-blue-600">MyApp</span> Dashboard
            </div>
            <nav class="p-4 space-y-2">
                <a href="#" class="block px-4 py-2 rounded hover:bg-blue-100">Dashboard</a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-blue-100">Produk</a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-blue-100">Transaksi</a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-blue-100">Laporan</a>
            </nav>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>

</html>
