<?php
namespace App\Services\Users;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class ClientService{
    public function store($request)
    {
        $client = new Client();
        $client->name = $request->name;
        $client->company = $request->company;
        $client->country = $request->country;
        $client->address = $request->address;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->create_by = Auth::guard('users')->id();
        $client->save();
    }

    public function update($request)
    {
        $client = Client::find($request->id);
        $client->name = $request->name;
        $client->company = $request->company;
        $client->country = $request->country;
        $client->address = $request->address;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->create_by = Auth::guard('users')->id();
        $client->save();
    }
}