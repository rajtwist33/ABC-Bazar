<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Seller\SellerDetail;
use App\Http\Controllers\Controller;
use App\Models\Seller\SellerProduct;
use App\Http\Requests\MyValidationRequest;
use App\Models\Seller\SellerProductImages;

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
    public function store(MyValidationRequest $request)
    {

        DB::beginTransaction();
        try {

            $slug = strtolower($request->model_name);
            $slug_display =  $slug . rand(1111, 9999);

            $seller_product =  SellerProduct::create([
                            'product_code' =>$request->product_code,
                            'model' =>$request->model_name,
                            'storage' =>$request->storage,
                            'warenty_left' =>$request->warrenty_left,
                            'battery_percentage' =>$request->battery_percenatge,
                            'woking_properly' =>$request->working_properly,
                            'original_screen' =>$request->original_screen,
                            'phone_unopened' =>$request->phone_unopened,
                            'battery_original' =>$request->battery_original,
                            'mobile_condition'=>$request->mobile_condition,
                            'mdms_registered'=>$request->mdms_registered,
                            'defect' =>$request->device_defect,
                            'defect_description' =>$request->defect_description,
                            'created_by' => null,
                            'approved_by' => null,
                            'slug' =>$slug,
                            'slug_display' =>$slug_display
                ]);

                SellerDetail::create([
                            'seller_product_id'=>$seller_product->id,
                            'name'=>$request->name,
                            'phone'=>$request->phone,
                            'province'=>$request->province,
                            'city'=>$request->city,
                            'agreed'=>$request->agreed,
                ]);
                if ($request->hasFile('front_part') || $request->hasFile('back_part') ||  $request->hasFile('with_box')
                            || $request->hasFile('with_battery_percentage') || $request->hasFile('with_warrenty')
                            || $request->hasFile('with_model'))
                    {

                    $fileFields = [
                        'front_part',
                        'back_part',
                        'with_box',
                        'with_battery_percentage',
                        'with_warrenty',
                        'with_model',
                    ];
                    $uploadedImages = [];
                foreach ($fileFields as $field) {
                        $file = $request->file($field);
                        if ($file) {
                            $image_name = md5(rand(1000, 10000));
                            $ext = strtolower($file->getClientOriginalExtension());
                            $image_full_name = $image_name . '.' . $ext;
                            $uploade_path = 'uploads/seller/product/' . $field . '/images/';
                            $image_url = $uploade_path . $image_full_name;
                            $file->move($uploade_path, $image_full_name);

                            $uploadedImages[$field] = $image_url;

                        }
                    }
                    SellerProductImages::create([
                        'seller_product_id' => $seller_product->id,
                        'front_part' => $uploadedImages['front_part'] ?? null,
                        'back_part' => $uploadedImages['back_part'] ?? null,
                        'with_box' => $uploadedImages['with_box'] ?? null,
                        'with_battery_percentage' => $uploadedImages['with_battery_percentage'] ?? null,
                        'with_warrenty' => $uploadedImages['with_warrenty'] ?? null,
                        'with_model' => $uploadedImages['with_model'] ?? null,
                    ]);

                }

                    DB::commit();
                    return response()->json(['success' => 'Your Mobile Data has Successfully Stored.']);

            } catch (\Exception $e) {
                // If an error occurs, rollback the transaction
                DB::rollBack();

                // Handle the exception (e.g., log it or return an error response)
                return response()->json(['error' => 'An error occurred while processing the request.']);
            }

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
