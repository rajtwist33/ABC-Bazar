<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Seller\SellerDetail;
use App\Models\Seller\SellerProduct;
use App\Models\Seller\SellerProductImages;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->all([
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'province'=>'required',
            'city'=>'required',
            'zip_code'=>'required',
            'agreed'=>'required',
        ]);


       $seller_product =  SellerProduct::create([
                    'product_code' =>$request->model,
                    'model' =>$request->model,
                    'storage' =>$request->model,
                    'warenty_left' =>$request->model,
                    'battery_percentage' =>$request->model,
                    'woking_properly' =>$request->model,
                    'original_screen' =>$request->model,
                    'phone_unopened' =>$request->model,
                    'battery_original' =>$request->model,
                    'defect' =>$request->model,
                    'defect_description' =>$request->model,
                    'approved_status' =>$request->model,
                    'created_by' =>$request->model,
                    'approved_by' =>$request->model,
                    'slug' =>$request->model,
                    'slug_display'  =>$request->model,
        ]);

        SellerProductImages::create([
                    'seller_product_id'=>$request->model,
                    'front_photo'=>$request->model,
                    'back_photo'=>$request->model,
                    'photo_with_box'=>$request->model,
                    'photo_with_battery_percentage'=>$request->model,
                    'photo_with_warrenty'=>$request->model,
                    'photo_with_model'=>$request->model,
        ]);

        SellerDetail::create([
                    'seller_product_id'=>$request->model,
                    'name'=>$request->model,
                    'phone'=>$request->model,
                    'email'=>$request->model,
                    'province'=>$request->model,
                    'city'=>$request->model,
                    'zip_code'=>$request->model,
                    'agreed'=>$request->model,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
