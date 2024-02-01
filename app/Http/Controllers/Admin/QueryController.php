<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Query;
use App\Traits\FileUpload;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QueryController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Query::all();
        return view('admin.pages.main.queries', compact('data'));
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
        $valid = Validator::make(
            $request->all(),
            [
                'name' => ['required'],
                'email' => ['required', 'email'],
                'phone' => ['number'],
                'description' => ['required'],
                'services' => ['required'],
                'file' => ['required']
            ]
        );

        if ($valid->fails()) {
            return response()->json(['status' => 400, 'message' => 'All feilds are required']);
        }
        try {

            return response()->json(['status' => 200, 'message' => 'Query added']);
        } catch (Exception $e) {
            return response()->json(['status' => 400, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($queryId)
    {

        try {
            $data  = Query::where('id', $queryId)->with('services.service:id,name')->first();
        } catch (Exception $e) {
            $data = null;
        }

        return view('admin.pages.main.queries_details', compact('data'));
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
        $valid = Validator::make(
            $request->all(),
            [
                'id' => ['required', 'exists:queries,id']
            ]
        );

        if ($valid->fails()) {
            return response()->json(['status' => 400, 'message' => $valid->errors()]);
        }
        try {
            Query::where('id', $request->id)->delete();
            return response()->json(['status' => 200, 'message' => 'Query deleted']);
        } catch (Exception $e) {
            return response()->json(['status' => 400, 'message' => $e->getMessage()]);
        }
    }
}
