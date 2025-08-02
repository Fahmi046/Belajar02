<?php

namespace App\Http\Controllers;

use App\Models\Product; // Jangan lupa import Model Product
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Tampilkan daftar produk.
     */
    public function index()
    {
        // Ambil semua data produk dari database.
        // Kita gunakan `with('batches')` agar data batch ikut terload
        // ini lebih efisien daripada query terpisah untuk setiap produk.
        $products = Product::with('batches')->get();

        // Kirimkan data produk ke view 'products.index'
        return view('products.index', compact('products'));
    }
}