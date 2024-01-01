<?php

namespace App\Http\Controllers\Frontend;

use App\Mail\NotifyMail;
use App\Mail\NotifyMailToOwner;
use Illuminate\Http\Request;
use App\Models\Admin\Enquiry;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class SendEnquiryController extends Controller
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
       $request->validate([
        "client_name" => 'required',
        "client_phone" => 'required',
        "client_email" => 'required',
        "client_address" => 'required',
       ]);

       $product_id =$request->product_id;
       $client_phone = $request->client_phone;
       $client_email = $request->client_email;

       $check_phone = Enquiry::where([
        'product_id' => $product_id,
        'phone' => $client_phone,
    ])->exists();


      $check_email = Enquiry::where([
                    'product_id' => $product_id,
                    'email'=>$client_email,
                ])->exists();

      if($check_phone == false && $check_email == false) {

        Enquiry::create([
                'product_id'=> $request->product_id,
                'name'=>$request->client_name,
                'phone'=>$request->client_phone,
                'email'=>$request->client_email,
                'address'=>$request->client_address,
                'message'=>$request->client_message,
        ]);

        Mail::to($client_email)->send(new NotifyMail());
        Mail::to('developerraj27@gmail.com')->send(new NotifyMailToOwner);

        return response()->json([
            'success'=>'Your Post has Submitted. We will contact you Soon.'
       ]);

      }else{
        return response()->json([
            'error'=>'You have already Submitted for this Post.'
       ]);
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
