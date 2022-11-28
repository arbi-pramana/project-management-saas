<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use App\Services\Users\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    protected $client;
    public function __construct(ClientService $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        $data['clients'] = Client::where('create_by',Auth::guard('users')->id())->get();
        return view('users.client.index',$data);
    }

    public function store(Request $request)
    {
        if($this->maximum()){
            return redirect()->back()->with('danger','Your Client is Maximum, Please Updgrade Your Plan');
        };
        $this->client->store($request);
        return redirect()->back()->with('success','Data has been Added');
    }

    public function update(Request $request)
    {
        $this->client->update($request);
        return redirect()->back()->with('success','Data has been Updated');
    }

    public function destroy(Request $request)
    {
        $client = Project::where('client_id',$request->id)->count();
        if($client > 0){
            return redirect()->back()->with('danger','Please Delete Relate Project First');
        }
        Client::find($request->id)->delete();
        return redirect()->back()->with('danger','Data has been Deleted');
    }

    public function maximum()
    {
        $user = User::find(Auth::guard('users')->id());
        $client = Client::where('create_by',Auth::guard('users')->id())->count();
        if($client >= $user->user_plan->max_clients && $client != 0){
            return true;
        }
    }
}
