<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;
use App\Models\Admin\ProductImage;
use App\Models\Admin\ProductImperfectionImage;
use App\Models\Seller\SellerProduct;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\Datatables;
use RealRashid\SweetAlert\Facades\Alert;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $page ="Product";
        $data = SellerProduct::with(['product_image','detail'])->where('approved_status','pending')->latest('id')->get();
        if ($request->ajax()) {
            $data = SellerProduct::with(['product_image','detail'])->where('approved_status','pending')->latest('id')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product_code', function($data){

                $product_code = "<span class='text-success'>". $data->product_code. "</span>";

                    return $product_code;
                })
               ->addColumn('image', function ($data) {
                    if (file_exists($data->product_image->front_part)) {
                        $url = asset($data->product_image->front_part);
                        $title = $data->product_code;
                        return '<a href="' . $url . '" target="_blank"><img src="' . $url . '"    class="image-fluid" width=80%;/ alt="' . $title . '"> </a>';
                    } else {
                        $url = url('default_image/not.jpg');
                        $title = "image not found";
                        return '<a href="' . $url . '" target="_blank"><img src="' . $url . '"  class="image-fluid" width=80%;/ alt="' . $title . '"> </a>';
                    }
                })
                ->addColumn('model', function($data){

                    $model = "<span class='text-dark'>" . $data->model . "</span>";

                    return $model;
                })
                ->addColumn('mobile_condition', function($data){

                    $mobile_condition = "<span class='text-dark'>". $data->mobile_condition. "</span>";

                    return $mobile_condition;
                })
                ->addColumn('seller_name', function($data){

                    $seller_name = "<span class='text-dark'> ". $data->detail->name. "</span>";

                    return $seller_name;
                })
                ->addColumn('seller_phone', function($data){

                    $seller_phone = "<span class='text-dark'> ". $data->detail->phone. "</span>";

                    return $seller_phone;
                })
                ->addColumn('seller_city', function($data){

                    $seller_city = "<span class='text-dark'> ". $data->detail->city. "</span>";

                    return $seller_city;
                })
                ->addColumn('date',function($data){
                    $date = "<span class='text-dark'> ". $data->created_at->format('Y-M-d') . ' </br>' . $data->created_at->format('H:i:A'). "</span>";
                    return $date;
                })
                ->addColumn('action', function($row){
                    // $edit = '<a href="' . route('admin.product.edit', $row->id) . '" class="edit btn btn-primary btn-sm m-1" title="Edit">Edit</i></a>';
                    $view = '<a href="' . route('admin.product.show', $row->id) . '" class="view btn btn-primary btn-sm m-1" title="Edit">View</i></a>';
                    $delete = '<button  title="move trash"  data-id="' . $row->id . '"  class="btn btn-danger btn-sm m-1 delete-btn">Reject</button>';
                    return   $view . " " . $delete;
                })
                ->rawColumns(['product_code','image','model','mobile_condition','seller_name','seller_phone','seller_city','date','action'])
                ->make(true);
        }
        return view('backend.pages.product.index',compact('page'));
    }


    public function store(Request $request)
    {

        if(!$request->data_id)
            {
                $request->validate([
                    'product_code'=>'required',
                    'select_category'=>'required',
                    'price'=>'required',
                    'title' => 'required|unique:products,title',
                    'description' =>'required',
                    'specification' =>'required',
                ]);
            }
            $slug = Str::slug($request->title) . rand(1, 9999);
            $slug_display = Str::slug($request->title);

        if ($request->hasFile('images') || $request->hasFile('imperfectionimages')) {
            $images = $request->file('images');
            $imperfectionImages  = $request->file('imperfectionimages');

            $Parent =  Product::UpdateOrcreate(
                [
                    'id' => $request->data_id,
                ],
                [
                    'product_code'=>$request->product_code,
                    'category_id' => $request->select_category,
                    'title'  => $request->title,
                    'description' => $request->description,
                    'specification' => $request->specification,
                    'imperfections' => $request->imperfections,
                    'price' => $request->price,
                    'created_by'=> Auth::user()->id,
                    'slug' => $slug,
                    'slug_display' => $slug_display,

                ]
            );

            if($images)
            {
                foreach($images as $file) {
                $image_name = md5(rand(1000, 10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $uploade_path = 'uploads/product/images/';
                $image_url = $uploade_path . $image_full_name;
                $file->move($uploade_path, $image_full_name);

                    ProductImage::create([
                        'product_id'=>$Parent->id,
                        'image' =>$image_name,
                        'file_path'=>$image_url,
                    ]);
                }
            }

            if($imperfectionImages)
            {
                foreach($imperfectionImages as $file) {
                $image_name = md5(rand(1000, 10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $uploade_path = 'uploads/product/imperfection/images/';
                $image_url = $uploade_path . $image_full_name;
                $file->move($uploade_path, $image_full_name);

                    ProductImperfectionImage::create([
                        'product_id'=>$Parent->id,
                        'image' =>$image_name,
                        'file_path'=>$image_url,
                    ]);
                }
            }

        }

        else{
            $Parent = Product::UpdateOrcreate(
                [
                    'id' => $request->data_id,
                ],
                [
                    'product_code'=>$request->product_code,
                    'category_id' => $request->select_category,
                    'title'  => $request->title,
                    'description' => $request->description,
                    'specification' => $request->specification,
                    'imperfections' => $request->imperfections,
                    'price' => $request->price,
                    'created_by'=>Auth::user()->id,
                    'slug' => $slug,
                    'slug_display' => $slug_display,
                ]
            );
        }

        if ($request->data_id != '') {
            Alert::success('Success Title', 'Product Updated Successfully!');
            return redirect()->route('admin.product.index');

        } else {
            Alert::success('Success Title', 'Product Added Successfully!');
            return redirect()->route('admin.product.index');
        }
    }


    public function show(string $id)
    {
        $page =" Product | View ";
        $data_lists = SellerProduct::with(['product_image','detail'])->where('id',$id)->first();
        return view('backend.pages.product.view',compact('page','data_lists'));
    }


    public function edit(Request $request, $id)
    {
        $page ="Product | Edit";
        $title = 'Delete Image!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $categories = Category::get();
        $data_lists = Product::with('hascategory','hasimperfection_image','hasproduct_image')->where('slug',$id)->first();
        return view('backend.pages.product.edit',compact('page','categories','data_lists'));
    }


    public function update(Request $request, string $id)
    {

    }


    public function destroy(Request $request, $id)
    {
        $record = SellerProduct::find($id);
        if (!$record) {
            return response()->json(['success' => 'Record not found.'], 404);
        }
        $record->update([
            'approved_status' => 'rejected',
            'approved_by'=>Auth::user()->id,
        ]);
        $record->delete();
        return response()->json(['success' => 'Product  Rejected Success.']);
    }
    public function trashed(Request $request)
    {
        $page ="Product Rejected";
        $data = SellerProduct::onlyTrashed()->with(['product_image','detail'])->where('approved_status','rejected')->latest('id')->get();
        if ($request->ajax()) {
            $data = SellerProduct::onlyTrashed()->with(['product_image','detail'])->where('approved_status','rejected')->latest('id')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product_code', function($data){

                $product_code = "<span class='text-success'>". $data->product_code. "</span>";

                    return $product_code;
                })
               ->addColumn('image', function ($data) {
                    if (file_exists($data->product_image->front_part)) {
                        $url = asset($data->product_image->front_part);
                        $title = $data->product_code;
                        return '<a href="' . $url . '" target="_blank"><img src="' . $url . '"    class="image-fluid" width=80%;/ alt="' . $title . '"> </a>';
                    } else {
                        $url = url('default_image/not.jpg');
                        $title = "image not found";
                        return '<a href="' . $url . '" target="_blank"><img src="' . $url . '"  class="image-fluid" width=80%;/ alt="' . $title . '"> </a>';
                    }
                })
                ->addColumn('model', function($data){

                    $model = "<span class='text-dark'>" . $data->model . "</span>";

                    return $model;
                })
                ->addColumn('mobile_condition', function($data){

                    $mobile_condition = "<span class='text-dark'>". $data->mobile_condition. "</span>";

                    return $mobile_condition;
                })
                ->addColumn('seller_name', function($data){

                    $seller_name = "<span class='text-dark'> ". $data->detail->name. "</span>";

                    return $seller_name;
                })
                ->addColumn('seller_phone', function($data){

                    $seller_phone = "<span class='text-dark'> ". $data->detail->phone. "</span>";

                    return $seller_phone;
                })
                ->addColumn('seller_city', function($data){

                    $seller_city = "<span class='text-dark'> ". $data->detail->city. "</span>";

                    return $seller_city;
                })
                ->addColumn('date',function($data){
                    $date = "<span class='text-dark'> ". $data->created_at->format('Y-M-d') . ' </br>' . $data->created_at->format('H:i:A'). "</span>";
                    return $date;
                })
                ->addColumn('action', function($row){
                    $edit = '<button class="edit btn btn-primary btn-sm m-1 edit-btn" data-id="' . $row->id . '" title="restore">Restore</button>';
                    $delete ='<button  title="Delete"  data-id="' . $row->id . '"  class="btn btn-danger btn-sm m-1 delete-btn"> Permanent Delete</button>';
                    return  $edit . " " . $delete;
                })
                ->rawColumns(['product_code','image','model','mobile_condition','seller_name','seller_phone','seller_city','date','action'])
                ->make(true);
        }

        return view('backend.pages.product.trashed.index',compact('page'));
    }

    public function forceDelete($id){
        $data  = SellerProduct::where('id', $id)->withTrashed()->forceDelete();
        if (!$data) {
            return response()->json(['success' => 'Record not found.'], 404);
        }
        return response()->json(['success' => 'Record deleted successfully.']);
    }

    public function restore($id){
        $data = SellerProduct::withTrashed()->find($id);
        if ($data) {
            $data->update([
                'approved_status' => 'pending'
            ]);

            $data->restore();

            return response()->json(['success' => 'Record restored successfully.']);
        } else {
            return response()->json(['error' => 'Record not found.'], 404);
        }
    }

    public function delete_product_image($id){
       $data = ProductImage::where('id',$id)->first();
       if (file_exists($data->file_path)) {
        unlink($data->file_path);
        }
        $data->delete();
        toast('Product Image Removed','success');
        return redirect()->back();
    }
    public function imperfectionimage($id){
       $data = ProductImperfectionImage::where('id',$id)->first();
       if (file_exists($data->file_path)) {
        unlink($data->file_path);
        }
        $data->delete();
        toast('Imperfection Image Removed','success');
        return redirect()->back();
    }

}
