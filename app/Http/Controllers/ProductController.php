<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.product.index', [
            'products' => Product::query()
                ->with(['category', 'images'])
                ->orderByDesc('id')
                ->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.product.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate each image
        ]);

        $product = Product::query()->create([
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name')),
            'category_id' => $request->get('category_id'),
            'description' => $request->get('description'),
            'price' => $request->get('price')
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');

                $product->images()->create([
                    'image' => $path,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('status', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('admin.product.edit', [
            'product' => $product,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product->update([
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name')),
            'category_id' => $request->get('category_id'),
            'description' => $request->get('description'),
            'price' => $request->get('price')
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');

                $product->images()->create([
                    'image' => $path,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('status', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        foreach ($product->images()->get() as $image) {
            if (Storage::disk('public')->exists($image->getOriginal('image'))) {
                Storage::disk('public')->delete($image->getOriginal('image'));
            }
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('status', 'Product deleted successfully!');
    }
}
