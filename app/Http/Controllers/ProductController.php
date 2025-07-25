<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm (trang /san-pham).
     */
    public function index(Request $request)
    {
        $query = Product::with(['category','size']);

        // filter size
        if ($request->filled('size_id')) {
            $query->where('size_id', $request->size_id);
        }
        // filter price
        if ($request->filled('price_min')) {
            $query->where('price','>=',$request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price','<=',$request->price_max);
        }
        // sort
        switch ($request->get('sort')) {
            case 'price_asc':  $query->orderBy('price','asc'); break;
            case 'price_desc': $query->orderBy('price','desc'); break;
            case 'newest':     $query->orderBy('created_at','desc'); break;
            default:           $query->orderBy('id','desc');
        }

        $sizes    = Size::all();
        $products = $query->paginate(12)->withQueryString();

        return view('products', compact('products','sizes'));
    }

    /**
     * Hiển thị chi tiết sản phẩm (trang /san-pham/{product}).
     */
    public function show(Product $product)
    {
        $isNew = $product->created_at->gt(now()->subDays(30));

        $relatedProducts = Product::with(['category','size'])
            ->where('category_id', $product->category_id)
            ->where('id','<>',$product->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('products.show', compact('product','isNew','relatedProducts'));
    }
}
