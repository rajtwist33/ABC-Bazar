<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{

    public function index(Request $request)
    {
       return view('frontend.section.search_product');
    }


    public function create()
    {

    }

    public function store(Request $request)
    {

    }


    public function show(string $id)
    {
        $category = Category::where('id',$id)->first('title');
        $products = Product::with('hasproduct_image','hasimperfection_image','hascategory')
                ->where(['category_id'=> $id,
                        'status'=> 0,
                        ])
                ->latest()
                ->paginate(9);

        return view('frontend.pages.search_products',compact('products','category'));
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
