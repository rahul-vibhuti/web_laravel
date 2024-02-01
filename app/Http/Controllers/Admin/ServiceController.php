<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceDescription;
use App\Models\ServiceMedia;
use App\Traits\FileUpload;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Service::all();
        return view('admin.pages.services.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = null;
        $title = 'Create';
        return view('admin.pages.services.index', compact('data', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
            'data' => ['required'],
        ]);

        DB::beginTransaction();
        try {
            if (filled($request->servicesId)) {

                $service = Service::find($request->servicesId);
                $msg = 'updated';
            } else {
                $msg = 'created';

                $service = new Service();
            }

            $service->name = $request->name;
            $service->title  = $request->title;
            $service->description = $request->description;
            $service->slug = Str::slug($request->title);

            if ($request->file('image')) {
                $file =   $this->Upload($request->file('image'), 'featureImages');
                $service->feature_image = $file;
            }

            $service->save();

            if ($request->file('images')) {
                foreach ($request->file('images') as $image) {
                    $image =   $this->Upload($request->file('image'), 'serviceImages');

                    $serviceMedia = new ServiceMedia();
                    $serviceMedia->service_id = $service->id;
                    $serviceMedia->image = $image;
                    $serviceMedia->save();
                }
            }
            if (filled($request->data)) {
                ServiceDescription::where('service_id', $service->id)->delete();
                foreach ($request->data as $value) {
                    $ServiceDescription = new ServiceDescription();
                    $ServiceDescription->service_id = $service->id;
                    $ServiceDescription->title = $value['title'];
                    $ServiceDescription->description = $value['desc'];
                    $ServiceDescription->save();
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Service ' . $msg . ' successfully');
        } catch (Exception $e) {
            DB::commit();
            return redirect()->back()->with('error', $e->getMessage());
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
