<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\metaData;
use App\Models\Review;
use App\Traits\FileUpload;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PhpParser\Node\Stmt\TryCatch;

class ReviewController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Review::all();
        $metaData = metaData::where('meta_key', Config::get('constants.CLIENT_SAYING'))->first();
        return view('admin.pages.review.list', ['data' => $data, 'metaData' => $metaData]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = null;
        return view('admin.pages.review.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'rating' => ['required', 'numeric', 'between:1,5'],
            'description' => ['required'],
            'name' => ['required'],
        ]);

        try {
            if (filled($request->review_id)) {
                $review =  Review::find($request->review_id);
                $msg = 'Update';
            } else {

                $review = new Review();
                $msg = 'Added';
            }
            $review->title = $request->title;
            $review->rating = $request->rating;
            $review->user_name = $request->name;
            $review->description = $request->description;
            $review->status = $request->status;

            if (filled($request->file('image'))) {
                $review->image =    $this->imageThumbnail($request->file('image'), 'thumbnails');
            }

            $review->save();

            return redirect()->back()->with('success', 'Review ' . $msg . ' Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $reviewId)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Review::find($id);
        return view('admin.pages.review.index', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required']
        ]);

        Review::where('id', $request->id)->delete();

        return response()->json(['status' => 200, 'message' => 'Review Deleted']);
    }
}
