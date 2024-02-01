<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Exception;

class TodoController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'message' => 'something went wrong ']);
        }

        try {

            $todo = new Todo();
            $todo->description = $request->item;
            $todo->user_id = Auth::id();
            $todo->save();
            return response()->json(['status' => 200, 'message' => 'done', 'data' => $todo]);
        } catch (Exception $e) {
            return response()->json(['status' => 400, 'message' => 'something went wrong ']);
        }
    }


    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required']
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 400, 'message' => 'something went wrong ']);
        }
        try {

            Todo::where('id', $request->id)->delete();
            return response()->json(['status' => 200, 'message' => 'deleted']);
        } catch (Exception $e) {
            return response()->json(['status' => 400, 'message' => 'something went wrong ']);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'status' => ['required', 'between:0,1']
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'message' => 'something went wrong ']);
        }
        try {

            $todo = Todo::find($request->id);
            $todo->is_completed = $request->status;
            $todo->save();

            return response()->json(['status' => 200, 'message' => 'updated']);
        } catch (Exception $e) {
            return response()->json(['status' => 400, 'message' => 'something went wrong ']);
        }
    }
}
