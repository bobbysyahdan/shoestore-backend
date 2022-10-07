<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit');
        $name = $request->input('name');
        $show_product = $request->input('show_product');
        if($id) {
            $category = ProductCategory::with(['products'])->find($id);
            if($category) {
                return ResponseFormatter::success(
                    $category,
                    'Success',
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Product Category not found',
                    '404',
                );
            }
        }

        $category = ProductCategory::query();
        if($name) {
            $category = $category->where('name', $name);
        }

        if($show_product) {
            $category = $category->with('products');
        }

        return ResponseFormatter::success(
            $category->paginate($limit),
            'Success',
        );

    }
}
