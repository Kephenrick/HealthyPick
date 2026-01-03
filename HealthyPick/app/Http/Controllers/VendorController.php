<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Vendor;
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
        return view('vendor.vendorHome');
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
        return view('vendor.vendorTransaction');
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
            $file->move(public_path('img'), $imageName);
            $product->Image = $imageName;
        }

        $product->Name = $request->input('name');
        $product->Description = $request->input('description');
        $product->Price = $request->input('price');
        $product->Stock = $request->input('stock');
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

        $imageName = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $imageName);
        }

        Product::create([
            'Product_ID' => (string) Str::uuid(),
            'Name' => $request->input('name'),
            'Description' => $request->input('description'),
            'Price' => $request->input('price'),
            'Vendor_ID' => $vendor->Vendor_ID,
            'Stock' => $request->input('stock'),
            'Image' => $imageName,
        ]);

        return redirect()->route('vendor.vendorProduct')->with('success', 'Produk berhasil ditambahkan.');
    }
}
