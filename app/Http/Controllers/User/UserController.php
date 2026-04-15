<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Product;

class UserController extends Controller
{
    public function keranjang()
    {
        $cartItems = Auth::user()->carts()->with('product')->get();
        return view('user.keranjang', compact('cartItems')); 
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $userId = Auth::id();
        $productId = $request->product_id;

        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function updateCart(Request $request, $id)
    {
        $cartItem = Auth::user()->carts()->findOrFail($id);
        
        if ($request->action == 'increase') {
            $cartItem->increment('quantity');
        } elseif ($request->action == 'decrease') {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
            } else {
                $cartItem->delete();
            }
        }

        return redirect()->back()->with('success', 'Keranjang berhasil diperbarui!');
    }

    public function removeFromCart($id)
    {
        $cartItem = Auth::user()->carts()->findOrFail($id);
        $cartItem->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    public function detail($id)
    {
        $product = Product::with('categories')->findOrFail($id);

        // Ambil produk terkait (dari kategori yang sama)
        $categoryIds = $product->categories->pluck('id');
        $relatedProducts = Product::whereHas('categories', function($q) use ($categoryIds) {
            $q->whereIn('categories.id', $categoryIds);
        })->where('id', '!=', $id)->take(4)->get();

        $cartCount = Auth::user()->carts()->sum('quantity');

        return view('user.detailproduk', compact('product', 'relatedProducts', 'cartCount'));
    }

    public function pesanan(Request $request)
    {
        $user = Auth::user();
        $status = $request->query('status');
        
        $ordersQuery = $user->orders()->with('items.product')->latest();

        if ($status) {
            if ($status === 'dikemas') {
                $ordersQuery->whereIn('status', ['dibayar', 'diproses']);
            } else {
                $ordersQuery->where('status', $status);
            }
        }

        $orders = $ordersQuery->get();
        $cartCount = $user->carts()->sum('quantity');
        
        return view('user.pesanan', compact('orders', 'cartCount')); 
    }

    public function detailPesanan($id)
    {
        $user = Auth::user();
        $order = $user->orders()->with('items.product')->findOrFail($id);
        $cartCount = $user->carts()->sum('quantity');
        
        return view('user.detailpesanan', compact('order', 'cartCount'));
    }

    public function checkout()
    {
        $user = Auth::user();
        $cartItems = $user->carts()->with('product')->get();
        $cartCount = $cartItems->sum('quantity');

        $subtotal = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        $total = $subtotal;

        return view('user.checkout', compact('cartItems', 'cartCount', 'subtotal', 'total'));
    }

    public function checkoutSuccess()
    {
        $user = Auth::user();
        $cartItems = $user->carts()->with('product')->get();

        if ($cartItems->count() > 0) {
            $total = $cartItems->sum(function($item) {
                return $item->product->price * $item->quantity;
            });

            // Create Order
            $order = \App\Models\Order::create([
                'user_id' => $user->id,
                'order_number' => 'ELX-' . strtoupper(bin2hex(random_bytes(3))),
                'total_price' => $total,
                'status' => 'dibayar', // Karena success redirect
                'shipping_address' => 'Jl. Alamat User (Dummy)', // Bisa diambil dari session nanti
            ]);

            // Move Cart items to Order Items
            foreach ($cartItems as $cartItem) {
                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ]);
            }

            // Create Admin Notification
            \App\Models\AdminNotification::create([
                'title' => 'Pesanan Baru Masuk!',
                'message' => 'Pesanan #' . $order->order_number . ' telah dibayar oleh ' . $user->name,
                'type' => 'new_order',
                'data_id' => $order->id,
                'is_read' => false,
            ]);

            // Menghapus semua item di keranjang user setelah berhasil membayar
            $user->carts()->delete();
        }
        
        $cartCount = 0;
        
        return view('user.success', compact('cartCount'));
    }

    public function payLater(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $user = Auth::user();
        $cartItems = $user->carts()->with('product')->get();

        if ($cartItems->count() > 0) {
            $total = $cartItems->sum(function($item) {
                return $item->product->price * $item->quantity;
            });

            // Create Order with 'menunggu' status
            $order = \App\Models\Order::create([
                'user_id' => $user->id,
                'order_number' => 'ELX-' . strtoupper(bin2hex(random_bytes(3))),
                'total_price' => $total,
                'status' => 'menunggu', // Status "Menunggu Pembayaran / Transfer Manual"
                'shipping_address' => $request->address,
            ]);

            // Move Cart items to Order Items
            foreach ($cartItems as $cartItem) {
                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ]);
            }

            // Create Admin Notification
            \App\Models\AdminNotification::create([
                'title' => 'Pesanan Baru (Transfer Manual)',
                'message' => 'Pesanan #' . $order->order_number . ' menunggu pembayaran transfer dari ' . $request->name,
                'type' => 'new_order',
                'data_id' => $order->id,
                'is_read' => false,
            ]);

            // Clear Cart
            $user->carts()->delete();

            return redirect()->route('user.checkout.success')->with('success', 'Pesanan berhasil dibuat! Silakan lakukan transfer.');
        }

        return redirect()->route('user.keranjang')->with('error', 'Keranjang Anda kosong.');
    }

    public function cancelOrder($id)
    {
        $user = Auth::user();
        $order = $user->orders()->findOrFail($id);

        if ($order->status == 'menunggu') {
            $order->update(['status' => 'dibatalkan']);
            return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');
        }

        return redirect()->back()->with('error', 'Pesanan ini tidak dapat dibatalkan.');
    }
}
