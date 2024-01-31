<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioMedia;
use App\Models\portfolioSkills;
use App\Traits\FileUpload;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Portfolio::all();
        return view('admin.pages.portfolio.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = null;
        $title = 'Create';

        return view('admin.pages.portfolio.index', compact('data', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'short_title' => ['required'],
            'title' => ['required'],
            'type' => ['required'],
            'short_description' => ['required'],
            'description' => ['required'],
            // 'images' => ['required'],
            // 'image' => ['required'],
            'skills' => ['required'],
        ]);


        DB::beginTransaction();
        try {
            if (filled($request->PortfolioId)) {

                $portfolio = Portfolio::find($request->PortfolioId);
                $msg = 'updated';
            } else {
                $msg = 'created';

                $portfolio = new Portfolio();
            }

            $portfolio->title = $request->title;
            $portfolio->short_title  = $request->short_title;
            $portfolio->short_desc = $request->short_description;
            $portfolio->description = $request->description;
            $portfolio->type = $request->type;
            $portfolio->slug = Str::slug($request->title);

            if ($request->file('image')) {
                $file =   $this->Upload($request->file('image'), 'featureImages');
                $portfolio->feature_image = $file;
            }

            $portfolio->save();

            if ($request->file('images')) {
                foreach ($request->file('images') as $image) {
                    $image =   $this->Upload($request->file('image'), 'featureImages');

                    $portfolioMedia = new PortfolioMedia();
                    $portfolioMedia->portfolio_id = $portfolio->id;
                    $portfolioMedia->image = $image;
                    $portfolioMedia->save();
                }
            }
            if (filled($request->skills)) {
                portfolioSkills::where('portfolio_id', $portfolio->id)->delete();
                foreach ($request->skills as $skill) {

                    $portfolioSkills = new portfolioSkills();
                    $portfolioSkills->portfolio_id = $portfolio->id;
                    $portfolioSkills->name = $skill;
                    $portfolioSkills->save();
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Portfolio ' . $msg . ' successfully');
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
    public function edit(string $portfolioId)
    {
        $data = Portfolio::with('skills')->find($portfolioId);
        $title = 'Update';

        return view('admin.pages.portfolio.index', compact('data', 'title'));
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
