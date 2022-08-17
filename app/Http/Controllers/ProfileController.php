<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use mysqli;

class ProfileController extends Controller
{
    public function update(ProfileUpdateRequest $request)
    {
        auth()->user()->update($request->only('name', 'email', 'dob'));

        if ($request->input('password')) {
            auth()->user()->update([
                'password' => Hash::make($request->password),
            ]);
        }
        return redirect()->route('profile')->with('message', 'Doi thong tin thanh cong');
    }

    public function admin_update(ProfileUpdateRequest $request)
    {
        DB::table('users')
            ->where('id', $request['id'])
            ->update(['name' => $request['name'], 'email' => $request['email'], 'dob' => $request['dob']]); 
        return redirect()->route('admin.profile', $request['id'])->with('message', 'Doi thong tin user thanh cong');
    }

    public function owner_update(ProfileUpdateRequest $request)
    {
        DB::table('users')
            ->where('id', $request['id'])
            ->update(['name' => $request['name'], 'email' => $request['email'], 'dob' => $request['dob']]); 
        return redirect()->route('admin.profile', $request['id'])->with('message', 'Doi thong tin user thanh cong');
    }
}
