<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Product;
use App\ProductCategory;
use App\ProductTag;
use App\Scopes\ProductUserScope;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = ProductCategory::all();
        $tags = ProductTag::all();

        $products = Product::withoutGlobalScope(ProductUserScope::class)
            ->when($request->get('query') != '', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->get('query').'%');
            })
            ->when($request->get('category_id', 0) > 0, function ($query) use ($request) {
                $query->whereHas('category', function($q) use ($request) { $q->where('id', $request->category_id); });
            })
            ->when($request->get('tag_id', 0) > 0, function ($query) use ($request) {
                $query->whereHas('tag', function($q) use ($request) { $q->where('id', $request->tag_id); });
            })
            ->with('reviews')
            ->orderBy('avg_rating', 'desc')
            ->orderBy('reviews_count', 'desc')
            ->get();

        return view('home', compact('products', 'categories', 'tags'));
    }
}
