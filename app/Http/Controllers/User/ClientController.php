<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Client;
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
        Client::find($request->id)->delete();
        return redirect()->back()->with('danger','Data has been Deleted');
    }
}
