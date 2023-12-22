<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Setting;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Support\Facades\Validator;
class SettingController extends Controller
{
    public function index(Request $request)
    {
        $page ="Setting";
        $data = Setting::get();
        if ($request->ajax()) {
            $data = Setting::latest()->get();
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
                        '<button  title="move trash"  data-id="' . $row->id . '"  class="btn btn-danger btn-sm m-1 delete-btn">Move Trash</button>';
                    return  $edit . " " . $delete;
                })
                ->rawColumns(['action','image'])
                ->make(true);
        }
        return view('backend.pages.setting.index',compact('page'));
    }




    public function create()
    {
        $count = Setting::onlyTrashed()->count();
        $data =Setting::count();
        // dd($count);
        return response()->json([
            'count'=>$count,
            'data'=>$data,
        ]);
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
            $uploade_path = 'uploads/category/images/';
            $image_url = $uploade_path . $image_full_name;
            $file->move($uploade_path, $image_full_name);

           Setting::UpdateOrcreate(
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
            Setting::UpdateOrcreate(
                [
                    'id' => $request->data_id,
                ],
                [
                    'title' => $request->title,
                ]
            );
        }

        if ($request->data_id != '') {
            return response()->json(['success'=> 'Setting Updated.']);
        } else {
            return response()->json(['success'=> 'Setting Added.']);
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
       $data_list = Setting::find($id);
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
        $record = Setting::find($id);
        if (!$record) {
            return response()->json(['success' => 'Record not found.'], 404);
        }

        $record->delete();
        return response()->json(['success' => 'Record Moved to Trash.']);
    }
    public function trashed(Request $request)
    {
        $page ="Setting";
        $data = Setting::get();
        if ($request->ajax()) {
            $data = Setting::onlyTrashed()->latest()->get();
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
                    $edit = '<button class="edit btn btn-primary btn-sm m-1 edit-btn" data-id="' . $row->id . '" title="restore">Restore</button>';
                    $delete =
                        '<button  title="Delete"  data-id="' . $row->id . '"  class="btn btn-danger btn-sm m-1 delete-btn"> Permanent Delete</button>';
                    return  $edit . " " . $delete;
                })
                ->rawColumns(['action','image'])
                ->make(true);
        }
        return view('backend.pages.setting.trashed.index',compact('page'));
    }

    public function forceDelete($id){
        $data  = Setting::where('id', $id)->withTrashed()->forceDelete();
        if (!$data) {
            return response()->json(['success' => 'Record not found.'], 404);
        }
        return response()->json(['success' => 'Record deleted successfully.']);
    }

    public function restore($id){
        $data  = Setting::where('id', $id)->withTrashed()->restore();
        return response()->json(['success' => 'Record Restore successfully.']);
    }

    public function category_list(){
        $categories = Setting::whereNull('deleted_at')->get()->toArray();
        return response()->json(['categories'=> $categories]);
    }
}
