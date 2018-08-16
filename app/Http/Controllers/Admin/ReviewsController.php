<?php

namespace App\Http\Controllers\Admin;

use App\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReviewsController extends Controller
{

    /**
     * Display a listing of Reviews.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('product_category_access')) {
            return abort(401);
        }

        $reviews = Review::with(['product', 'user'])->get();

        return view('admin.reviews.index', compact('reviews'));
    }
    /**
     * Store a newly created Review in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Review::create($request->all() + ['user_id' => auth()->id()]);
        return redirect()->route('admin.products.show', $request->product_id);
    }

    /**
     * Remove Review from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('product_category_delete')) {
            return abort(401);
        }
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.reviews.index');
    }

    /**
     * Delete all selected Product at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('product_category_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Review::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
