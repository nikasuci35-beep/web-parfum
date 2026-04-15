<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Show the rating form for a specific product in an order.
     */
    public function index($order_id, $product_id)
    {
        $user = Auth::user();
        $order = $user->orders()->findOrFail($order_id);
        
        // Ensure the order is completed
        if ($order->status !== 'selesai') {
            return redirect()->route('user.pesanan.detail', $order_id)
                             ->with('error', 'Pesanan harus diselesaikan terlebih dahulu untuk memberi ulasan.');
        }

        $product = Product::findOrFail($product_id);

        // Check if user already reviewed this product in this order
        $existingReview = Review::where('user_id', $user->id)
                                ->where('order_id', $order_id)
                                ->where('product_id', $product_id)
                                ->first();

        return view('user.retingproduk', compact('order', 'product', 'existingReview'));
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        
        // Check if review already exists
        $existingReview = Review::where('user_id', $user->id)
                                ->where('order_id', $request->order_id)
                                ->where('product_id', $request->product_id)
                                ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'Anda sudah memberikan ulasan untuk produk ini pada pesanan ini.');
        }

        // Create Review
        Review::create([
            'user_id' => $user->id,
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Update Product Average Rating
        $product = Product::find($request->product_id);
        $averageRating = Review::where('product_id', $product->id)->avg('rating');
        $product->update(['rating' => round($averageRating, 1)]);

        return redirect()->route('user.pesanan.detail', $request->order_id)
                         ->with('success', 'Terima kasih atas ulasan Anda!');
    }
}
