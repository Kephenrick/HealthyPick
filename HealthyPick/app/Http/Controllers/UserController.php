<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TransactionHeader;
use App\Models\TransactionItem;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function home(){
        return view('user.userHome');
    }

    public function product(){
        return view('user.userProduct');
    }

    public function vendor(Request $request){
        $vendors = Vendor::with('user')
            ->paginate(10);
        
        return view('user.userVendor', compact('vendors'));
    }

    public function payment(Request $request){
        // Ambil data dari session
        $pendingTransaction = $request->session()->get('pending_transaction');
        
        if (!$pendingTransaction) {
            return redirect()->route('user.userProduct')
                ->with('error', 'Tidak ada transaksi yang sedang diproses.');
        }

        $order = [
            'id' => 'TXN-' . time(),
            'amount' => $pendingTransaction['total_price'],
            'product_name' => $pendingTransaction['product_name'],
            'quantity' => $pendingTransaction['quantity'],
            'price' => $pendingTransaction['price'],
        ];

        return view('user.userPayment', compact('order'));
    }

    public function submitPayment(Request $request){
        $request->validate([
            'method' => 'required|string',
        ]);

        // Ambil data dari session
        $pendingTransaction = $request->session()->get('pending_transaction');
        
        if (!$pendingTransaction) {
            return redirect()->route('user.userProduct')
                ->with('error', 'Tidak ada transaksi yang sedang diproses.');
        }

        $user = Auth::user();
        
        // Cek stock lagi sebelum menyimpan
        $product = Product::findOrFail($pendingTransaction['product_id']);
        if ($product->stock < $pendingTransaction['quantity']) {
            $request->session()->forget('pending_transaction');
            return redirect()->route('user.userProduct')
                ->with('error', 'Stock tidak mencukupi. Stock tersedia: ' . $product->stock);
        }

        try {
            // Buat transaction header
            $transactionId = (string) Str::uuid();
            TransactionHeader::create([
                'Transaction_ID' => $transactionId,
                'Customer_ID' => $user->User_ID,
                'Vendor_ID' => $pendingTransaction['vendor_id'],
                'total_price' => $pendingTransaction['total_price'],
                'status' => 'paid', // Set status menjadi paid setelah payment
            ]);

            // Buat transaction item
            TransactionItem::create([
                'Transaction_Item_ID' => (string) Str::uuid(),
                'Transaction_ID' => $transactionId,
                'Product_ID' => $pendingTransaction['product_id'],
                'quantity' => $pendingTransaction['quantity'],
                'price' => $pendingTransaction['price'],
                'subtotal' => $pendingTransaction['total_price'],
            ]);

            // Update stock product
            $product->stock = $product->stock - $pendingTransaction['quantity'];
            $product->save();

            // Hapus session
            $request->session()->forget('pending_transaction');

            return redirect()->route('user.userTransaction')
                ->with('success', __('messages.payment_success'));
        } catch (\Exception $e) {
            return redirect()->route('user.userPayment')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function transaction(Request $request){
        $user = Auth::user();
        
        // Ambil semua transaksi user yang login (filter berdasarkan Customer_ID) dengan pagination
        $transactions = TransactionHeader::where('Customer_ID', $user->User_ID)
            ->with(['items.product', 'vendor'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.userTransaction', compact('transactions'));
    }

    public function about(){
        return view ('user.userAbout');
    }
}
