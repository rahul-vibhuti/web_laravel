<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\metaData;
use App\Models\successStory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = successStory::all();
        $metaData = metaData::where('meta_key', Config::get('constants.SUCCESS_STORIES'))->first();
        return view('admin.pages.stories.list', compact('data', 'metaData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = null;
        $title = 'Create';
        return view('admin.pages.stories.index', compact('data', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_name' => ['required'],
            'client_name' => ['required'],
            'challanges' => ['required'],
            'issues' => ['required'],
            'tasks' => ['required'],
            'feedback' => ['required'],
        ]);


        try {
            if (filled($request->storyId)) {
                $story =  successStory::find($request->storyId);
                $msg = 'updated';
            } else {
                $story = new successStory();
                $msg = 'created';
            }

            $story->project_name = $request->project_name;
            $story->client_name = $request->client_name;
            $story->challanges = $request->challanges;
            $story->issues = $request->issues;
            $story->tasks = $request->tasks;
            $story->feedback = $request->feedback;
            $story->save();

            return redirect()->back()->with('success', 'Story ' . $msg . ' successfully');
        } catch (Exception $e) {
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
    public function edit(string $storyId)
    {
        $data = successStory::find($storyId);
        $title = 'Update';
        return view('admin.pages.stories.index', compact('data', 'title'));
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
