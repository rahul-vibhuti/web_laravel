<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Exception;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SubCategory::find($request->id);
            return response()->json(['status' => 200, 'message' => 'data', 'data' => $data]);
        }
        return  $this->show($request);
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
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'category_id' => ['required']
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => 403, 'message' => 'Feilds are required']);
        }

        if (!isset($request->subcategory_id)) {

            $check = SubCategory::where('name', $request->name)->where('category_id', $request->category_id)->first();
            if ($check) {
                return response()->json(['status' => 403, 'message' => 'Category already exists']);
            }
        }

        try {
            if ($request->subcategory_id) {

                $subCategory =  SubCategory::find($request->subcategory_id);
            } else {
                $subCategory = new SubCategory();
            }
            $subCategory->name = $request->name;
            $subCategory->category_id = $request->category_id;
            $subCategory->slug = Str::slug($request->name);
            if (filled($request->status)) {
                $subCategory->status = $request->status;
            }
            $subCategory->save();
            return response()->json(['status' => 200, 'message' => 'subCategory Added']);
        } catch (Exception $e) {
            return response()->json(['status' => 403, 'message' => 'Something went wrong']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

        $data =   SubCategory::query();
        $data->when(request('subcategory'), function ($query) use ($request) {
            $query->where('category_id', $request->subcategory);
        });
        $data =  $data->with(['category'])->get();

        $categories = Category::all();

        $category = (filled($request->subcategory)) ? $request->subcategory : 0;
        return view('admin.pages.subcategory.index', compact('data', 'category', 'categories'));
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
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required']
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => 403, 'message' => 'Id is required']);
        }

        try {
            SubCategory::where('id', $request->id)->delete();
            return response()->json(['status' => 200, 'message' => 'Sub-Category Deleted']);
        } catch (Exception $e) {
            return response()->json(['status' => 403, 'message' => 'Something went wrong']);
        }
    }
}
