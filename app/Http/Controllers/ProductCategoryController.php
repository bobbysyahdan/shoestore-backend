<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ProductCategoryRequest;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $query = ProductCategory::query();

            return DataTables::of($query)
                ->addColumn('action', function($item){
                    return '<a class="btn btn-primary" href="'.route('dashboard.productCategory.edit', $item->id).'">Edit</a>
                    <form method="post" action="'.route('dashboard.productCategory.destroy', $item->id).'">
                    <button type="submit" class="btn btn-danger mt-2" style="background-color: #dc3545 !important;">Delete</button>'.@method_field('delete'). csrf_field().'
                    </form>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('pages.dashboard.product_category.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.product_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCategoryRequest $request)
    {
        $data = $request->all();
        ProductCategory::create($data);
        return redirect()->route('dashboard.productCategory.index')->with('success', 'Data has been saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
    {
        return view('pages.dashboard.product_category.update',[
            'item' => $productCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $data = $request->all();
        $productCategory->update($data);
        return redirect()->route('dashboard.productCategory.index')->with('success', 'Data has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();
        return redirect()->route('dashboard.productCategory.index')->with('success', 'Data has been deleted successfully');
    }
}
