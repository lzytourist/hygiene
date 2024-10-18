<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $orders = Order::query()->with(['items', 'user']);
        return view('admin.order.index', [
            'orders' => $orders->paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        if (count($cart)) {
            $order = Order::query()->create([
                'user_id' => auth()->id(),
                'total' => $request->session()->get('total', 0),
                'status' => 'pending',
                'city' => $request->get('city'),
                'address' => $request->get('address'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
            ]);

            $items = [];
            foreach ($cart as $key => $item) {
                $items[] = [
                    'product_id' => $key,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['quantity'] * $item['price'],
                ];
            }

            $order->items()->createMany($items);

            $request->session()->forget('cart');
            $request->session()->forget('total');
            $request->session()->forget('tax');

            return redirect()->route('order.confirmation', $order->id);
        }

        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order): View
    {
        return view('admin.order.edit', [
            'order' => $order
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,cancelled,delivered,completed,refunded'
        ]);

        $order->update([
            'status' => $request->get('status'),
        ]);

        return redirect()->route('admin.orders.index')->with('status', 'Order status has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
