<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $user  = Auth::user();
        // Lấy hoặc tạo cart cho user
        $cart  = $user->cart()->firstOrCreate([]);
        $items = $cart->items()->with('product')->get();
        $total = $items->sum(fn($i) => $i->product->price * $i->quantity);

        return view('cart.index', compact('cart','items','total'));
    }

    // Thêm sản phẩm vào giỏ
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1'
        ]);

        $user = Auth::user();
        $cart = $user->cart()->firstOrCreate([]);

        // Thêm hoặc cập nhật số lượng
        $item = $cart->items()->firstOrNew(['product_id' => $product->id]);
        $item->quantity = ($item->exists ? $item->quantity : 0) + ($request->quantity ?: 1);
        $item->save();

        return redirect()
            ->route('cart.index')
            ->with('success','Đã thêm vào giỏ hàng!');
    }

    // Cập nhật số lượng
    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success','Cập nhật giỏ hàng thành công!');
    }

    // Xóa 1 item khỏi giỏ
    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();

        return back()->with('success','Đã xóa sản phẩm khỏi giỏ hàng');
    }

    // Xóa toàn bộ giỏ
    public function clear()
    {
        $user = Auth::user();
        if ($cart = $user->cart) {
            $cart->items()->delete();
        }
        return back()->with('success','Giỏ hàng đã được làm trống');
    }
}
