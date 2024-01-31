<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Category::find($request->id);
            return response()->json(['status' => 200, 'message' => 'Category data', 'data' => $data]);
        }
        $data = Category::all();
        return view('admin.pages.category.index', compact('data'));
    }


    // Store category
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required']
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => 403, 'message' => 'Feilds is required']);
        }

        if (!isset($request->category_id)) {

            $check = Category::where('name', $request->name)->first();
            if ($check) {
                return response()->json(['status' => 403, 'message' => 'Category already exists']);
            }
        }

        try {
            if ($request->category_id) {

                $category =  Category::find($request->category_id);
            } else {

                $category = new Category();
            }

            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            if (filled($request->status)) {
                $category->status = $request->status;
            }
            $category->save();
            return response()->json(['status' => 200, 'message' => 'Category Added']);
        } catch (Exception $e) {
            return response()->json(['status' => 403, 'message' => 'Something went wrong']);
        }
    }

    // Delete category 
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required']
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => 403, 'message' => 'Id is required']);
        }

        try {
            Category::where('id', $request->id)->delete();
            return response()->json(['status' => 200, 'message' => 'Category Deleted']);
        } catch (Exception $e) {
            return response()->json(['status' => 403, 'message' => 'Something went wrong']);
        }
    }
}
