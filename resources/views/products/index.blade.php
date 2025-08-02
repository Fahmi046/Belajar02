<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk PBF</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 30px;
            background-color: #f4f7f6;
            color: #333;
        }

        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            /* Penting untuk border-radius tabel */
        }

        th,
        td {
            border: 1px solid #dee2e6;
            padding: 12px 15px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #e9ecef;
            color: #495057;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.9em;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tbody tr:hover {
            background-color: #e2e6ea;
            cursor: pointer;
        }

        .no-data {
            text-align: center;
            color: #777;
            padding: 30px;
            font-size: 1.1em;
            background-color: #fff;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        ul li {
            margin-bottom: 5px;
            background-color: #f0f3f6;
            padding: 8px;
            border-radius: 4px;
            font-size: 0.85em;
        }

        ul li:last-child {
            margin-bottom: 0;
        }

        .currency {
            text-align: right;
        }

        .status {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75em;
            font-weight: bold;
            color: #fff;
        }

        .status.active {
            background-color: #28a745;
        }

        /* Green */
        .status.inactive {
            background-color: #dc3545;
        }

        /* Red */
    </style>
</head>

<body>
    <h1>Daftar Produk dan Detail Batch</h1>

    @if ($products->isEmpty())
        <p class="no-data">Belum ada data produk. Silakan jalankan seeder!</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>SKU</th>
                    <th>Merek</th>
                    <th>HNA</th>
                    <th>Harga Jual</th>
                    <th>Total Stok</th>
                    <th>Status</th>
                    <th>Detail Batch</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}<br><small>({{ $product->formulation }}
                                {{ $product->strength }})</small></td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->brand }}</td>
                        <td class="currency">Rp {{ number_format($product->hna, 0, ',', '.') }}</td>
                        <td class="currency">Rp {{ number_format($product->sell_price, 0, ',', '.') }}</td>
                        <td>
                            {{-- Hitung total stok dari semua batch --}}
                            **{{ $product->batches->sum('current_stock') }}** {{ $product->unit }}
                            <br><small>Min: {{ $product->min_stock_level }}</small>
                        </td>
                        <td>
                            <span class="status {{ $product->is_active ? 'active' : 'inactive' }}">
                                {{ $product->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                        <td>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>

</html>
