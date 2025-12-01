<?php

namespace App\Http\Controllers;

use App\Product;
<<<<<<< HEAD
use App\Item;
use App\Client;
use App\Dealer;
use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
=======
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
>>>>>>> cbcdc328ee536f65b48e8e78150a46183d1dd68e

class ProductController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $products = Item::orderBy('created_at', 'desc')->get();
        $customers = Client::whereHas('serial')->get();
        $items = Item::get();
        $dealers = Dealer::get();
        $transactions = [];

        if (auth()->user()->role == "Admin") {
            $transactions = TransactionDetail::get();
        } elseif (auth()->user()->role == "Dealer") {
            $transactions = TransactionDetail::where('dealer_id', auth()->user()->id)->get();
        }

        $dealerProfile = null;
        if (auth()->user()->role == "Dealer") {
            $dealerProfile = Dealer::where('user_id', auth()->user()->id)->first();
        }

        return view('products', [
            'products' => $products,
            'transactions' => $transactions,
            'items' => $items,
            'customers' => $customers,
            'dealers' => $dealers,
            'dealerProfile' => $dealerProfile,
        ]);
    }

}
=======
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('product', compact('products'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'deposit' => 'nullable|numeric|min:0',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'product_name' => $request->product_name,
            'price' => $request->price,
            'deposit' => $request->deposit,
        ];

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/products');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $image->move($destinationPath, $imageName);
            $data['product_image'] = $imageName;
        }

        Product::create($data);

        return redirect()->route('product.index')->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        return view('show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'deposit' => 'nullable|numeric|min:0',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'product_name' => $request->product_name,
            'price' => $request->price,
            'deposit' => $request->deposit,
        ];

        if ($request->hasFile('product_image')) {
            if ($product->product_image) {
                Storage::delete('public/products/' . $product->product_image);
            }

            $image = $request->file('product_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/products', $imageName);
            $data['product_image'] = $imageName;
        }

        $product->update($data);

        return redirect()->route('product.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->product_image) {
            Storage::delete('public/products/' . $product->product_image);
        }

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
    }
}
>>>>>>> cbcdc328ee536f65b48e8e78150a46183d1dd68e
