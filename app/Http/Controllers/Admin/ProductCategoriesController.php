<?php

namespace App\Http\Controllers\Admin;

use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductCategoriesRequest;
use App\Http\Requests\Admin\UpdateProductCategoriesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class ProductCategoriesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of ProductCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('product_category_access')) {
            return abort(401);
        }


                $product_categories = ProductCategory::all();

        return view('admin.product_categories.index', compact('product_categories'));
    }

    /**
     * Show the form for creating new ProductCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('product_category_create')) {
            return abort(401);
        }
        return view('admin.product_categories.create');
    }

    /**
     * Store a newly created ProductCategory in storage.
     *
     * @param  \App\Http\Requests\StoreProductCategoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductCategoriesRequest $request)
    {
        if (! Gate::allows('product_category_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $product_category = ProductCategory::create($request->all());



        return redirect()->route('admin.product_categories.index');
    }


    /**
     * Show the form for editing ProductCategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('product_category_edit')) {
            return abort(401);
        }
        $product_category = ProductCategory::findOrFail($id);

        return view('admin.product_categories.edit', compact('product_category'));
    }

    /**
     * Update ProductCategory in storage.
     *
     * @param  \App\Http\Requests\UpdateProductCategoriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductCategoriesRequest $request, $id)
    {
        if (! Gate::allows('product_category_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $product_category = ProductCategory::findOrFail($id);
        $product_category->update($request->all());



        return redirect()->route('admin.product_categories.index');
    }


    /**
     * Display ProductCategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('product_category_view')) {
            return abort(401);
        }
        $products = \App\Product::whereHas('category',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $product_category = ProductCategory::findOrFail($id);

        return view('admin.product_categories.show', compact('product_category', 'products'));
    }


    /**
     * Remove ProductCategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('product_category_delete')) {
            return abort(401);
        }
        $product_category = ProductCategory::findOrFail($id);
        $product_category->delete();

        return redirect()->route('admin.product_categories.index');
    }

    /**
     * Delete all selected ProductCategory at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('product_category_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ProductCategory::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
