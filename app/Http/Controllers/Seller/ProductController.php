<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;
use App\Models\Admin\ProductImage;
use App\Models\Admin\ProductImperfectionImage;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\Datatables;
use RealRashid\SweetAlert\Facades\Alert;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $page ="Product";
        $data = Product::with('hascategory')->where('created_by',Auth::user()->id)->get();

        if ($request->ajax()) {
            $data = Product::latest()->where('created_by',Auth::user()->id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product_code', function($data){
                    if($data->category_id == 1){
                            $product_code = "<span class='text-primary'>". $data->product_code. "</span>";
                        }else{
                            $product_code = "<span class='text-success'>". $data->product_code. "</span>";
                        }
                    return $product_code;
                })
                ->addColumn('category', function($data){
                    if($data->category_id == 1){
                    $category = "<span class='text-primary'>". $data->hascategory->title. "</span>";
                    }else{
                        $category = "<span class='text-success'>". $data->hascategory->title. "</span>";
                    }
                    return $category;
                })
                ->addColumn('model', function($data){
                    if($data->category_id == 1){
                    $model = "<span class='text-primary'>". $data->title. "</span>";
                    }else{
                        $model = "<span class='text-success'>". $data->title. "</span>";
                    }
                    return $model;
                })
                ->addColumn('price', function($data){
                    if($data->category_id == 1){
                    $price = "<span class='text-primary'> Rs. ". $data->price. "</span>";
                    }else{
                        $price = "<span class='text-success'> Rs. ". $data->price. "</span>";
                    }
                    return $price;
                })
                ->addColumn('date',function($data){
                    $date = "<span class='text-primary'> ". $data->created_at->format('Y-M-d') . ' </br>' . $data->created_at->format('H:i:A'). "</span>";
                    return $date;
                })
                ->addColumn('action', function($row){
                    $edit = '<a href="' . route('seller.product.edit', $row->slug) . '" class="edit btn btn-primary btn-sm m-1" title="Edit">Edit</i></a>';
                    $delete = '<button  title="move trash"  data-id="' . $row->id . '"  class="btn btn-danger btn-sm m-1 delete-btn"> Move Trash</button>';
                    return  $edit . " " . $delete;
                })
                ->rawColumns(['product_code','category','model','price','date','action'])
                ->make(true);
        }
        return view('backend.seller.pages.product.index',compact('page'));
    }


 public function productcode(Request $request)
 {
        $pre = Category::where('id',$request->id)->select('title')->first();
        $product_id = $pre->title . rand(1, 9999);
        return response()->json([
                'product_id'=>$product_id,
        ]);
 }

    public function create()
    {
        $page ="Product | Create";
        $categories = Category::get();
        return view('backend.seller.pages.product.create',compact('page','categories'));
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

    public function dropzoneStore(Request $request)
    {

        $file = $request->file('file');
        $image_name = md5(rand(1000, 10000));
        $ext = strtolower($file->getClientOriginalExtension());
        $image_full_name = $image_name . '.' . $ext;
        $uploade_path = 'uploads/product/images/';
        $image_url = $uploade_path . $image_full_name;
        $file->move($uploade_path, $image_full_name);
        ProductImage::UpdateOrcreate(
            [
                'id' => $request->data_id,
            ],
            [
                'product_id' => $request->product_id,
                'image'=> $image_full_name,
                'file_path'=> $image_url,

            ]
        );

        return response()->json(['success'=>$image_full_name]);
    }
    public function show(string $id)
    {
        //
    }


    public function edit(Request $request, $id)
    {
        $page ="Product | Edit";
        $title = 'Delete Image!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $categories = Category::get();
        $data_lists = Product::with('hascategory','hasimperfection_image','hasproduct_image')->where('slug',$id)->first();
        return view('backend.seller.pages.product.edit',compact('page','categories','data_lists'));
    }


    public function update(Request $request, string $id)
    {

    }


    public function destroy(Request $request, $id)
    {
        $record = Product::find($id);
        if (!$record) {
            return response()->json(['success' => 'Record not found.'], 404);
        }

        $record->delete();
        return response()->json(['success' => 'Record Moved to Trash.']);
    }
    public function trashed(Request $request)
    {
        $page ="Product";
        $data = Product::get();
        if ($request->ajax()) {
            $data = Product::onlyTrashed()->where('created_by',Auth::user()->id)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product_code', function($data){
                    if($data->category_id == 1){
                            $product_code = "<span class='text-primary'>". $data->product_code. "</span>";
                        }else{
                            $product_code = "<span class='text-success'>". $data->product_code. "</span>";
                        }
                    return $product_code;
                })
                ->addColumn('category', function($data){
                    if($data->category_id == 1){
                    $category = "<span class='text-primary'>". $data->hascategory->title. "</span>";
                    }else{
                        $category = "<span class='text-success'>". $data->hascategory->title. "</span>";
                    }
                    return $category;
                })
                ->addColumn('model', function($data){
                    if($data->category_id == 1){
                    $model = "<span class='text-primary'>". $data->title. "</span>";
                    }else{
                        $model = "<span class='text-success'>". $data->title. "</span>";
                    }
                    return $model;
                })
                ->addColumn('price', function($data){
                    if($data->category_id == 1){
                    $price = "<span class='text-primary'> Rs. ". $data->price. "</span>";
                    }else{
                        $price = "<span class='text-success'> Rs. ". $data->price. "</span>";
                    }
                    return $price;
                })
                ->addColumn('date',function($data){
                    $date = "<span class='text-primary'> ". $data->deleted_at->format('Y-M-d') . ' </br>' . $data->deleted_at->format('H:i:A'). "</span>";
                    return $date;
                })
                ->addColumn('action', function($row){

                    $edit = '<button class="edit btn btn-primary btn-sm m-1 edit-btn" data-id="' . $row->id . '" title="restore">Restore</button>';
                    $delete ='<button  title="Delete"  data-id="' . $row->id . '"  class="btn btn-danger btn-sm m-1 delete-btn"> Permanent Delete</button>';
                    return  $edit . " " . $delete;
                })
                ->rawColumns(['product_code','category','model','price','date','action'])
                ->make(true);
        }
        return view('backend.seller.pages.product.trashed.index',compact('page'));
    }

    public function forceDelete($id){
        $data  = Product::where('id', $id)->withTrashed()->forceDelete();
        if (!$data) {
            return response()->json(['success' => 'Record not found.'], 404);
        }
        return response()->json(['success' => 'Record deleted successfully.']);
    }

    public function restore($id){
        $data  = Product::where('id', $id)->withTrashed()->restore();
        return response()->json(['success' => 'Record Restore successfully.']);
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
