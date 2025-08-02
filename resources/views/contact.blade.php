<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
     @if ($products->isEmpty())
        <p class="no-data">Belum ada data produk. Silakan jalankan seeder!</p>
    <x-table>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">ID</th>
                        <th scope="col" class="px-4 py-3">Nama Produk</th>
                        <th scope="col" class="px-4 py-3">SKU</th>
                        <th scope="col" class="px-4 py-3">Merek</th>
                        <th scope="col" class="px-4 py-3">HNA</th>
                        <th scope="col" class="px-4 py-3">Harga Jual</th>
                        <th scope="col" class="px-4 py-3">Total Stok</th>
                        <th scope="col" class="px-4 py-3">Status</th>
                        <th scope="col" class="px-4 py-3">Detail Batch</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $product->id }}
                                iMac 27&#34;</th>
                            <td class="px-4 py-3">{{ $product->name }}<br><small>({{ $product->formulation }}
                                    {{ $product->strength }})</small></td>
                            <td class="px-4 py-3">{{ $product->sku }}</td>
                            <td class="px-4 py-3">{{ $product->brand }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($product->hna, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($product->sell_price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">**{{ $product->batches->sum('current_stock') }}**
                                {{ $product->unit }}
                                <br><small>Min: {{ $product->min_stock_level }}</small>
                            </td>
                            <td class="px-4 py-3"> <span
                                    class="status {{ $product->is_active ? 'active' : 'inactive' }}">
                                    {{ $product->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span></td>
                            <td class="px-4 py-3">
                                @if ($product->batches->isEmpty())
                                    <small>Tidak ada data batch.</small>
                                @else
                                    <ul>
                                        @foreach ($product->batches as $batch)
                                            <li>
                                                **{{ $batch->batch_number }}**<br>
                                                Kadaluarsa: {{ $batch->expiry_date->format('d-m-Y') }}<br>
                                                Stok: **{{ $batch->current_stock }}** (Lokasi: {{ $batch->location }})
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                            <td class="flex items-center justify-end px-4 py-3">
                                <button id="apple-imac-27-dropdown-button" data-dropdown-toggle="apple-imac-27-dropdown"
                                    class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                    type="button">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                                <div id="apple-imac-27-dropdown"
                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="apple-imac-27-dropdown-button">
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                        </li>
                                    </ul>
                                    <div class="py-1">
                                        <a href="#"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </x-table>
</x-layout>
