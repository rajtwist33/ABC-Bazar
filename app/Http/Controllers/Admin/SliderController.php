<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        $page ="Slider";
        $data = Slider::get();
        if ($request->ajax()) {
            $data = Slider::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    if (file_exists($data->file_path)) {
                        $url = asset($data->file_path);
                        $title = $data->image;
                        return '<a href="' . $url . '" target="_blank"><img src="' . $url . '"    class="image-fluid" width=80%;/ alt="' . $title . '"> </a>';
                    } else {
                        $url = url('default_image/not.jpg');
                        $title = "image not found";
                        return '<a href="' . $url . '" target="_blank"><img src="' . $url . '"  class="image-fluid" width=80%;/ alt="' . $title . '"> </a>';
                    }
                })

                ->addColumn('action', function($row){
                    $edit = '<button class="edit btn btn-primary btn-sm m-1 edit-btn" data-id="' . $row->id . '" title="Edit">Edit</button>';
                    $delete =
                        '<button  title="delete"  data-id="' . $row->id . '"  class="btn btn-danger btn-sm m-1 delete-btn">Delete</button>';
                    return  $edit . " " . $delete;
                })
                ->rawColumns(['action','image'])
                ->make(true);
        }
        return view('backend.pages.slider.index',compact('page'));
    }




    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

            $rules = [
                'title' => 'required|unique:categories,title',
            ];



        if(!$request->data_id)
            {
                // Validate the incoming request data
                $validator = Validator::make($request->all(), $rules);

                // Check if validation fails
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 400);
                }
            }
        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image'=>'nullable|image|mimes:jpg,jpeg,png|max:1999',
            ]);

            $file = $request->file('image');
            $image_name = md5(rand(1000, 10000));
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $uploade_path = 'uploads/slider/images/';
            $image_url = $uploade_path . $image_full_name;
            $file->move($uploade_path, $image_full_name);

           Slider::UpdateOrcreate(
                [
                    'id' => $request->data_id,
                ],
                [
                    'title' => $request->title,
                    'image'=> $image_full_name,
                    'file_path'=> $image_url,

                ]
            );
        }
        else{
           Slider::UpdateOrcreate(
                [
                    'id' => $request->data_id,
                ],
                [
                    'title' => $request->title,
                ]
            );
        }

        if ($request->data_id != '') {
            return response()->json(['success'=> 'Slider Updated.']);
        } else {
            return response()->json(['success'=> 'Slider Added.']);
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
    public function edit(Request $request, $id)
    {
       $data_list = Slider::find($id);
       return response()->json(['data_list' => $data_list]);
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
    public function destroy(Request $request, $id)
    {
        $record = Category::find($id);
        if (!$record) {
            return response()->json(['success' => 'Record not found.'], 404);
        }

        $record->delete();
        return response()->json(['success' => 'Record Moved to Trash.']);
    }
    public function trashed(Request $request)
    {
        $page ="Category";
        $data = Category::get();
        if ($request->ajax()) {
            $data = Category::onlyTrashed()->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    if (file_exists($data->file_path)) {
                        $url = asset($data->file_path);
                        $title = $data->image;
                        return '<a href="' . $url . '" target="_blank"><img src="' . $url . '"    class="image-fluid" width=80%;/ alt="' . $title . '"> </a>';
                    } else {
                        $url = url('default_image/not.jpg');
                        $title = "image not found";
                        return '<a href="' . $url . '" target="_blank"><img src="' . $url . '"  class="image-fluid" width=80%;/ alt="' . $title . '"> </a>';
                    }
                })
                ->addColumn('description', function($data){
                    $description = Str::limit(strip_tags($data->description), 100);;
                    return $description;

                })
                ->addColumn('action', function($row){
                    $edit = '<button class="edit btn btn-primary btn-sm m-1 edit-btn" data-id="' . $row->id . '" title="restore">Restore</button>';
                    $delete =
                        '<button  title="Delete"  data-id="' . $row->id . '"  class="btn btn-danger btn-sm m-1 delete-btn"> Permanent Delete</button>';
                    return  $edit . " " . $delete;
                })
                ->rawColumns(['action','image','description'])
                ->make(true);
        }
        return view('backend.pages.category.trashed.index',compact('page'));
    }

    public function forceDelete($id){
        $data  = Slider::where('id', $id)->delete();

        if (!$data) {
            return response()->json(['success' => 'Record not found.'], 404);
        }
        return response()->json(['success' => 'Record deleted successfully.']);
    }

    public function restore($id){
        $data  = Category::where('id', $id)->withTrashed()->restore();
        return response()->json(['success' => 'Record Restore successfully.']);
    }

}
