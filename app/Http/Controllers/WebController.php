<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(): View
    {
        $promotions = [
            'Big Sale' => 'Up to 50% off on selected items',
            'Free Shipping' => 'On orders over $50',
        ];

        return view('welcome', [
            'promotions' => $promotions,
            'posts' => Post::query()->latest()->take(4)->get(),
            'products' => Product::query()->latest()->take(4)->get(),
        ]);
    }

    public function products(Request $request): View
    {
        $products = Product::query()->with(['category', 'images']);
        $categories = Category::query()->orderBy('name');

        if ($request->query->get('category_id')) {
            $products->where('category_id', $request->query->get('category_id'));
        }

        if ($request->query->get('search')) {
            $products->where('name', 'like', '%' . $request->query->get('search') . '%');
        }

        return view('products', [
            'products' => $products->paginate(12),
            'categories' => $categories->get()
        ]);
    }

    public function product($slug): View
    {
        $product = Product::with(['category', 'images', 'stocks'])
            ->where('slug', '=', $slug)
            ->firstOrFail();
        return view('product', [
            'product' => $product
        ]);
    }

    public function checkout(): View
    {
        return view('checkout');
    }

    public function orderConfirm(Order $order): View
    {
        if ($order->user()->isNot(auth()->user())) {
            abort(401);
        }

        return view('order-confirmation', [
            'order' => $order
        ]);
    }

    public function orders(): View
    {
        return view('dashboard', [
            'orders' => Order::query()
                ->where('user_id', auth()->id())
                ->orderByDesc('created_at')
                ->paginate()
        ]);
    }

    public function order(Order $order): View
    {
        return view('order-details', [
            'order' => $order
        ]);
    }

    public function blog()
    {
        return view('blog', [
            'posts' => Post::query()
                ->latest()
                ->paginate()
        ]);
    }

    public function blogDetails($slug)
    {
        $post = Post::query()
            ->where('slug', '=', $slug)
            ->firstOrFail();
        return view('blog-details', [
            'post' => $post
        ]);
    }
}
