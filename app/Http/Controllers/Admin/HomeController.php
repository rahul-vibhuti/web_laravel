<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\metaData;
use App\Models\Team;
use App\Models\Todo;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    use FileUpload;
    public function index()
    {
        $data = Todo::where('user_id', Auth::id())->whereDate('created_at', Carbon::now()->format('Y-m-d'))->get();
        return view('admin.pages.auth.dashboard', compact('data'));
    }

    public function metaIndex()
    {
        $data = null;
        return view('admin.pages.main.meta', compact('data'));
    }

    /*--- team  listings ---*/
    public function team()
    {
        $data = Team::all();
        return view('admin.pages.teams.list', compact('data'));
    }

    /*---  Create team  ---*/
    public function createTeam()
    {
        $title = 'Create';
        $data = null;
        return view('admin.pages.teams.index', compact('title', 'data'));
    }

    /*---  Store team  ---*/
    public function storeTeam(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'role' => ['required']
        ]);

        try {
            if (filled($request->teamId)) {

                $team =  Team::find($request->teamId);
                $msg = 'Updated';
            } else {
                $team = new Team();
                $msg = 'Added';
            }
            $team->name = $request->name;
            $team->role = $request->role;
            if ($request->file('image')) {
                $team->image =    $this->imageThumbnail($request->file('image'), 'thumbnails');
            }
            $team->save();
            return redirect()->back()->with('success', 'Team-mate ' . $msg . ' Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /*---  edit team  ---*/
    public function editTeam($teamId)
    {
        $title = 'Update';
        $data = Team::find($teamId);
        return view('admin.pages.teams.index', compact('title', 'data'));
    }

    /*---  delete team  ---*/
    public function teamDestroy(Request $request)
    {

        Team::where('id', $request->id)->delete();
        return response()->json(['status' => 200, 'message' => 'deleted']);
    }


    /*--- Customers  listings ---*/
    public function customers()
    {
        $data = Client::all();
        $metaData =  metaData::where('meta_key', Config::get('constants.CLIENT_TITLE'))->first();
        return view('admin.pages.customers.list', compact('data','metaData'));
    }
    /*---  Create Customers  ---*/
    public function createCustomers()
    {
        $title = 'Create';
        $data = null;
        return view('admin.pages.customers.index', compact('title', 'data'));
    }

    /*---  store Customers  ---*/
    public function storeCustomers(Request $request)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        try {
            if (filled($request->customerId)) {

                $customer =  Client::find($request->customerId);
                $msg = 'Updated';
            } else {
                $customer = new Client();
                $msg = 'Added';
            }
            $customer->name = $request->name;
            if ($request->file('image')) {
                $customer->image =    $this->imageThumbnail($request->file('image'), 'thumbnails');
            }
            $customer->save();
            return redirect()->back()->with('success', 'Client ' . $msg . ' Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /*---  edit Customers  ---*/
    public function editCustomers($customerId)
    {
        $title = 'Update';
        $data = Client::find($customerId);
        return view('admin.pages.customers.index', compact('title', 'data'));
    }

    /*---  delete Customers  ---*/
    public function clientsDestroy(Request $request)
    {

        Client::where('id', $request->id)->delete();
        return response()->json(['status' => 200, 'message' => 'deleted']);
    }



    // update meta  description 
    public function updateMetaDescription(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'description' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'message' => 'All Feilds are required']);
        }

        try {
            $metaData = metaData::where('meta_key', $request->title)->first();
            if (!$metaData) {
                $metaData =  new metaData();
            }
            $metaData->key = $request->title;
            $metaData->meta_key = str_replace(' ', '_', $request->title);
            $metaData->value = $request->description;
            $metaData->save();

            return response()->json(['status' => 200, 'message' => 'Added']);
        } catch (Exception $e) {
            return response()->json(['status' => 400, 'message' => $e->getMessage()]);
        }
    }
}
