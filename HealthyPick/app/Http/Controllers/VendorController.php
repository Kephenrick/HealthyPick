<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\TransactionHeader;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    /**
     * Get vendor dari authenticated user (dengan caching)
     */
    protected function getVendor()
    {
        $user = Auth::user();
        return $user->vendor; // Menggunakan relasi dari User model
    }

    public function home(){
        $vendor = $this->getVendor();
        if (!$vendor) {
            return redirect()->route('vendor.login')->with('error', 'Data vendor tidak ditemukan.');
        }

        $totalProducts = Product::where('Vendor_ID', $vendor->Vendor_ID)->count();
        $totalOrders = TransactionHeader::where('Vendor_ID', $vendor->Vendor_ID)->count();

        return view('vendor.vendorHome', compact('totalProducts', 'totalOrders'));
    }

    public function product(){
        $vendor = $this->getVendor();

        if (!$vendor) {
            return redirect()->route('vendor.login')->with('error', 'Data vendor tidak ditemukan.');
        }

        $products = Product::where('Vendor_ID', $vendor->Vendor_ID)->get();
        return view('vendor.vendorProduct', compact('products'));
    }

    public function transaction(){
        $vendor = $this->getVendor();
        if (!$vendor) {
            return redirect()->route('vendor.login')->with('error', 'Data vendor tidak ditemukan.');
        }

        $transactions = TransactionHeader::with(['customer', 'items.product'])
            ->where('Vendor_ID', $vendor->Vendor_ID)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('vendor.vendorTransaction', compact('transactions'));
    }

    public function completeTransaction($id)
    {
        $vendor = $this->getVendor();
        if (!$vendor) {
            return redirect()->route('vendor.login')->with('error', 'Data vendor tidak ditemukan.');
        }

        $tx = TransactionHeader::where('Transaction_ID', $id)
            ->where('Vendor_ID', $vendor->Vendor_ID)
            ->firstOrFail();

        $tx->status = 'completed';
        $tx->save();

        return redirect()->back()->with('success', 'Transaksi diubah menjadi Completed.');
    }

    public function cancelTransaction($id)
    {
        $vendor = $this->getVendor();
        if (!$vendor) {
            return redirect()->route('vendor.login')->with('error', 'Data vendor tidak ditemukan.');
        }

        $tx = TransactionHeader::where('Transaction_ID', $id)
            ->where('Vendor_ID', $vendor->Vendor_ID)
            ->firstOrFail();

        $tx->status = 'cancelled';
        $tx->save();

        return redirect()->back()->with('success', 'Transaksi dibatalkan.');
    }

    public function add(){
        return view('vendor.vendorAdd');
    }

    public function edit($id)
    {
        $vendor = $this->getVendor();

        if (!$vendor) {
            return redirect()->route('vendor.login')->with('error', 'Data vendor tidak ditemukan.');
        }

        $product = Product::where('Product_ID', $id)->where('Vendor_ID', $vendor->Vendor_ID)->firstOrFail();
        return view('vendor.vendorAdd', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $vendor = $this->getVendor();

        if (!$vendor) {
            return redirect()->route('vendor.login')->with('error', 'Data vendor tidak ditemukan.');
        }

        $product = Product::where('Product_ID', $id)->where('Vendor_ID', $vendor->Vendor_ID)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = Str::uuid() . '.' . $file->getClientOriginalExtension();

            // Pastikan folder img ada
            $imgPath = public_path('img');
            if (!file_exists($imgPath)) {
                mkdir($imgPath, 0755, true);
            }

            $file->move($imgPath, $imageName);
            $product->image = $imageName;
        }

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->save();

        return redirect()->route('vendor.vendorProduct')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $vendor = $this->getVendor();

        if (!$vendor) {
            return redirect()->route('vendor.login')->with('error', 'Data vendor tidak ditemukan.');
        }

        $product = Product::where('Product_ID', $id)->where('Vendor_ID', $vendor->Vendor_ID)->firstOrFail();
        $product->delete();

        return redirect()->route('vendor.vendorProduct')->with('success', 'Produk berhasil dihapus.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $vendor = $this->getVendor();

        if (!$vendor) {
            return redirect()->route('vendor.login')->with('error', 'Data vendor tidak ditemukan.');
        }

        $imageName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = Str::uuid() . '.' . $file->getClientOriginalExtension();

            // Pastikan folder img ada
            $imgPath = public_path('img');
            if (!file_exists($imgPath)) {
                mkdir($imgPath, 0755, true);
            }

            $file->move($imgPath, $imageName);
        }

        Product::create([
            'Product_ID' => (string) Str::uuid(),
            'Vendor_ID' => $vendor->Vendor_ID,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'image' => $imageName,
        ]);

        return redirect()->route('vendor.vendorProduct')->with('success', 'Produk berhasil ditambahkan.');
    }
}
