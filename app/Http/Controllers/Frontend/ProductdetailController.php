<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;

class ProductdetailController extends Controller
{
    public function index()
    {

    }


    public function create()
    {

    }


    public function store(Request $request)
    {

    }

    public function show(string $id)
    {

        $products = Product::with('hasproduct_image','hasimperfection_image','hascategory')
                ->where(['product_code'=> $id,
                        'status'=> 0,
                        ])
                ->first();

        $related_products = Product::with('hasproduct_image','hasimperfection_image','hascategory')
        ->where(['category_id'=> $products->category_id,
                'status'=> 0,
                ])
                ->whereNot('product_code', $id)
               ->latest('id')
                ->paginate(3);
        return view('frontend.pages.product_details',compact('products','related_products'));
    }

    public function edit(string $id)
    {

    }


    public function update(Request $request, string $id)
    {

    }


    public function destroy(string $id)
    {

    }
}
