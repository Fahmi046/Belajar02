<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Batch;
use App\Models\PurchaseOrder;
use App\Models\GoodsReceipt;
use App\Models\SalesOrder;
use App\Models\GoodsIssue;
use App\Models\Invoice;

class PbFSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama untuk mencegah duplikasi saat migrate:fresh --seed
        // Hanya jika Anda ingin database selalu bersih saat seeding
        // Batch::truncate();
        // Product::truncate();
        // Supplier::truncate();
        // Customer::truncate();
        // User::truncate();
        // PurchaseOrder::truncate();
        // GoodsReceipt::truncate();
        // SalesOrder::truncate();
        // GoodsIssue::truncate();
        // Invoice::truncate();


        /// 1. Buat User (Admin, Gudang, Sales)
        $admin = User::factory()->create([
            'name' => 'Admin User', // Added name for clarity
            'email' => 'admin@pbf.com',
            'username' => 'adminpbf', // <--- Add username here
            'role' => 'admin'
        ]);
        $warehouseUser = User::factory()->create([
            'name' => 'Warehouse User', // Added name for clarity
            'email' => 'gudang@pbf.com',
            'username' => 'gudangpbf', // <--- Add username here
            'role' => 'gudang'
        ]);
        $salesUser = User::factory()->create([
            'name' => 'Sales User', // Added name for clarity
            'email' => 'sales@pbf.com',
            'username' => 'salespbf', // <--- Add username here
            'role' => 'sales'
        ]);
        User::factory(7)->create();
        $users = User::all(); // Ambil semua user yang sudah dibuat

        // 2. Buat Supplier
        $suppliers = Supplier::factory(10)->create();

        // 3. Buat Customer
        $customers = Customer::factory(10)->create();

        // 4. Buat Product
        $products = Product::factory(20)->create(); // Buat 20 produk berbeda

        // 5. Buat Batch untuk setiap Product
        foreach ($products as $product) {
            // Setiap produk memiliki minimal 2 batch yang berbeda
            Batch::factory()->count(fake()->numberBetween(1, 3))->create([
                'product_id' => $product->id,
                'current_stock' => fake()->numberBetween(50, 500), // Stok awal
            ]);
        }

        // 6. Buat Purchase Orders (PO)
        $purchaseOrders = PurchaseOrder::factory(10)
            ->state(function (array $attributes) use ($suppliers, $users) {
                return [
                    'supplier_id' => $suppliers->random()->id,
                    'created_by' => $users->random()->id,
                ];
            })
            ->create();

        // 7. Isi Item untuk setiap PO
        foreach ($purchaseOrders as $po) {
            $itemsCount = fake()->numberBetween(1, 5); // Jumlah item per PO
            for ($i = 0; $i < $itemsCount; $i++) {
                $product = $products->random();
                $quantity = fake()->numberBetween(50, 200);
                $unitPrice = $product->hna * fake()->randomFloat(2, 0.9, 1.0); // Harga beli bisa sedikit lebih rendah dari HNA

                $po->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                ]);
            }

            // 8. Buat Goods Receipt untuk beberapa PO (misalnya 80%)
            if (fake()->boolean(80)) {
                $receipt = GoodsReceipt::factory()->create([
                    'purchase_order_id' => $po->id,
                    'received_by' => $warehouseUser->id,
                    'receipt_date' => fake()->dateTimeBetween($po->order_date, $po->expected_delivery_date ?? 'now'),
                ]);

                // Isi Item untuk setiap Goods Receipt
                foreach ($po->items as $poItem) {
                    // Cek apakah batch sudah ada untuk produk ini (dari penerimaan sebelumnya)
                    $existingBatch = Batch::where('product_id', $poItem->product_id)
                                          ->where('batch_number', 'LIKE', 'B%') // Ambil batch yang dibuat oleh factory
                                          ->inRandomOrder()
                                          ->first();

                    $batchId = null;
                    $batchNumber = fake()->bothify('B???-###??');
                    $expiryDate = fake()->dateTimeBetween('+6 months', '+5 years')->format('Y-m-d');
                    $receivedQuantity = $poItem->quantity;

                    if ($existingBatch && fake()->boolean(70)) { // 70% kemungkinan menggunakan batch yang sudah ada
                        $batchId = $existingBatch->id;
                        $batchNumber = $existingBatch->batch_number;
                        $expiryDate = $existingBatch->expiry_date;
                        $existingBatch->increment('current_stock', $receivedQuantity); // Update stok batch
                    } else { // Buat batch baru jika belum ada atau dipilih untuk membuat baru
                        $newBatch = Batch::factory()->create([
                            'product_id' => $poItem->product_id,
                            'batch_number' => $batchNumber,
                            'expiry_date' => $expiryDate,
                            'current_stock' => $receivedQuantity,
                            'location' => fake()->randomElement(['Gudang A', 'Gudang B', 'Rak 1', 'Rak 2', 'Zona Dingin']),
                        ]);
                        $batchId = $newBatch->id;
                    }

                    $receipt->items()->create([
                        'product_id' => $poItem->product_id,
                        'batch_id' => $batchId,
                        'batch_number_received' => $batchNumber,
                        'expiry_date_received' => $expiryDate,
                        'quantity_received' => $receivedQuantity,
                        'unit_price_at_receipt' => $poItem->unit_price,
                    ]);

                    // Update status PO menjadi 'received' jika semua item diterima
                    if ($receipt->items()->count() == $po->items()->count()) {
                        $po->status = 'received';
                        $po->save();
                    }
                }
            }
        }

        // 9. Buat Sales Orders (SO)
        $salesOrders = SalesOrder::factory(10)
            ->state(function (array $attributes) use ($customers, $users) {
                return [
                    'customer_id' => $customers->random()->id,
                    'created_by' => $users->random()->id,
                ];
            })
            ->create();

        // 10. Isi Item untuk setiap SO
        foreach ($salesOrders as $so) {
            $itemsCount = fake()->numberBetween(1, 4); // Jumlah item per SO
            for ($i = 0; $i < $itemsCount; $i++) {
                $product = $products->random();
                $quantity = fake()->numberBetween(1, 20);
                $sellPrice = $product->sell_price;
                $discount = fake()->randomElement([0, 5, 10]);

                $so->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $sellPrice,
                    'discount_percentage' => $discount,
                ]);
            }

            // 11. Buat Goods Issue untuk beberapa SO (misalnya 70%)
            if (fake()->boolean(70)) {
                $issue = GoodsIssue::factory()->create([
                    'sales_order_id' => $so->id,
                    'issued_by' => $warehouseUser->id,
                    'issue_date' => fake()->dateTimeBetween($so->order_date, 'now'),
                ]);

                // Isi Item untuk setiap Goods Issue
                foreach ($so->items as $soItem) {
                    $product = $soItem->product;
                    $quantityIssued = $soItem->quantity;

                    // Ambil batch yang tersedia dari produk ini (FIFO/FEFO sederhana)
                    $availableBatches = Batch::where('product_id', $product->id)
                                            ->where('current_stock', '>', 0)
                                            ->orderBy('expiry_date', 'asc') // Prioritaskan FEFO
                                            ->get();

                    $remainingToIssue = $quantityIssued;
                    foreach ($availableBatches as $batch) {
                        if ($remainingToIssue <= 0) break;

                        $takeFromBatch = min($remainingToIssue, $batch->current_stock);

                        if ($takeFromBatch > 0) {
                            $issue->items()->create([
                                'product_id' => $product->id,
                                'batch_id' => $batch->id,
                                'quantity_issued' => $takeFromBatch,
                            ]);
                            $batch->decrement('current_stock', $takeFromBatch); // Kurangi stok batch
                            $remainingToIssue -= $takeFromBatch;
                        }
                    }
                    // Jika masih ada sisa yang harus dikeluarkan tapi stok tidak cukup, bisa tambahkan logik error/peringatan
                }

                // Update status SO menjadi 'shipped' jika semua item dikeluarkan
                if ($issue->items()->count() == $so->items()->count()) {
                    $so->status = 'shipped';
                    $so->save();
                }

                // 12. Buat Invoice untuk Goods Issue yang sudah dibuat
                $totalAmount = 0;
                foreach ($so->items as $soItem) {
                    $itemPrice = $soItem->quantity * $soItem->unit_price;
                    $discountAmount = $itemPrice * ($soItem->discount_percentage / 100);
                    $totalAmount += ($itemPrice - $discountAmount);
                }

                $invoice = Invoice::factory()->create([
                    'sales_order_id' => $so->id,
                    'customer_id' => $so->customer_id,
                    'total_amount' => $totalAmount,
                    'created_by' => $salesUser->id,
                    'invoice_date' => fake()->dateTimeBetween($issue->issue_date, 'now'),
                    'status' => fake()->randomElement(['unpaid', 'paid', 'partially_paid']),
                ]);

                // 13. Buat Invoice Payment untuk beberapa Invoice (misalnya 60%)
                if ($invoice->status != 'unpaid' && fake()->boolean(60)) {
                    $paidAmount = $invoice->total_amount;
                    if ($invoice->status == 'partially_paid') {
                        $paidAmount = fake()->randomFloat(2, $invoice->total_amount * 0.3, $invoice->total_amount * 0.7);
                    }

                    Invoice::factory()->create([
                        'invoice_id' => $invoice->id,
                        'amount' => $paidAmount,
                        'received_by' => $salesUser->id,
                        'payment_date' => fake()->dateTimeBetween($invoice->invoice_date, 'now'),
                    ]);
                }
            }
        }
    }
}