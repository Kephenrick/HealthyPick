<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\TransactionHeader;
use App\Models\TransactionItem;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        
        // Filter by vendor jika ada
        if ($request->has('vendor_id') && $request->vendor_id != '') {
            $query->where('Vendor_ID', $request->vendor_id);
        }
        
        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        
        $products = $query->paginate(10);
        
        // Ambil vendor info jika filter by vendor
        $vendor = null;
        if ($request->has('vendor_id') && $request->vendor_id != '') {
            $vendor = Vendor::with('user')->find($request->vendor_id);
        }
        
        return view('user.userProduct', compact('products', 'vendor'));
    }

    public function purchase(Request $request, $productId)
    {
        try {
            $request->validate([
                'quantity' => 'required|integer|min:1',
            ]);

            $product = Product::findOrFail($productId);
            $quantity = $request->input('quantity');
            $user = Auth::user();

            // Cek stock
            if ($product->stock < $quantity) {
                return redirect()->route('user.userProduct')
                    ->with('error', 'Stock tidak mencukupi. Stock tersedia: ' . $product->stock);
            }

            // Cek apakah user adalah vendor (vendor tidak bisa beli produk sendiri)
            if ($user->role === 'vendor') {
                return redirect()->route('user.userProduct')
                    ->with('error', 'Vendor tidak dapat membeli produk.');
            }

            // Get vendor dari product
            $vendor = $product->vendor;
            if (!$vendor) {
                return redirect()->route('user.userProduct')
                    ->with('error', 'Vendor tidak ditemukan.');
            }

            // Hitung total price
            $totalPrice = $product->price * $quantity;

            // Simpan data ke session untuk payment
            $request->session()->put('pending_transaction', [
                'product_id' => $product->Product_ID,
                'product_name' => $product->name,
                'vendor_id' => $vendor->Vendor_ID,
                'quantity' => $quantity,
                'price' => $product->price,
                'total_price' => $totalPrice,
            ]);

            // Redirect ke payment page
            return redirect()->route('user.userPayment');
        } catch (\Exception $e) {
            return redirect()->route('user.userProduct')
                ->with('error', 'Terjadi kesalahan saat membeli produk: ' . $e->getMessage());
        }
    }
}
