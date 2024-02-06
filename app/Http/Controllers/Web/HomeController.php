<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\metaData;
use App\Models\Query;
use App\Models\QueryService;
use App\Models\Review;
use App\Models\Service;
use App\Models\successStory;
use App\Traits\FileUpload;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::with(['desc', 'media'])->get();
        $stories = successStory::all();
        $clients = Client::all();
        $reviews = Review::all();
        $metaData = metaData::pluck('value', 'meta_key')->toArray();

        return view('web.pages.index', compact('services', 'stories', 'clients', 'reviews', 'metaData'));
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
    public function storeQuery(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'description' => ['required'],
            'document' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 404, 'message' => 'All feilds are required']);
        }

        DB::beginTransaction();
        try {
            $query = new Query();
            $query->name = $request->name;
            $query->email = $request->email;
            $query->phone = $request->phone;
            $query->description = $request->description;
            if (filled($request->document)) {
                $query->file = $this->upload($request->document, 'documents');
            }
            $query->save();

            if (filled($request->services)) {
                foreach ($request->services as $ser) {

                    $service = new QueryService();
                    $service->query_id = $query->id;
                    $service->service_id = $ser;
                    $service->save();
                }
            }
            DB::commit();
            return response()->json(['status' => 200, 'message' => 'Thanks ' . $request->name . ' we will contact you soon']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 404, 'message' => 'something went wrong']);
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
