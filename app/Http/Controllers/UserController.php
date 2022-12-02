<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth'); // Must login
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @see https://laravel.com/docs/9.x/eloquent#retrieving-models
     * @see https://laravel.com/docs/9.x/queries#update-statements
     * @see https://laravel.com/docs/9.x/requests#retrieving-input
     */
    public function index(Request $request)
    {
        // if ($request->search != "") {
        //     return view('user.list', ['users' => User::search($request->search)->paginate(20)]);
        // }
        if (Auth::user()->role === 'user') {
            return view('user.list', ['users' => User::where('role', 'user')->paginate(20)]);
        }
        return view('user.list', ['users' => User::paginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @see https://laravel.com/docs/9.x/authorization#user-model-actions-that-dont-require-models
     */
    public function create()
    {
        if (Auth::user()->cannot('create', User::class)) {
            abort(403);
        }
        return view('user.create');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->role == 'admin')
            if ($request->role == 'owner')
                abort(403);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->date_of_birth = $request->date_of_birth;
        $user->save();
        return redirect()->route('users.index')->with('noti', 'Create user successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Retrieve a single row by its id column value
        $user = User::find($id);
        if (Auth::user()->cannot('update', $user)) {
            abort(403);
        }
        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @see https://laravel.com/docs/9.x/authorization#policy-responses
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->user()->cannot('update', $user)) {
            abort(403);
        }

        // Owners can change other owners', admins' and users' profiles - no password required
        // Admins can change users' profiles - no password required
        if (Auth::user()->role == 'admin') {
            if ($request->role == 'owner')
                abort(403);
        }
        else if (Auth::user()->role == 'owner' || Auth::user()->role == 'admin') {
            $user->update([
                'role' => $request->role,
                'name' => $request->name,
                'email' => $request->email,
                'date_of_birth' => $request->date_of_birth,
            ]);

            // Change password
            if ($request->filled('new_password')) {
                if ($request->new_password == $request->confirmation) {
                    $user->update(['password' => Hash::make($request->new_password)]);
                }
                else return redirect()->route('users.index')->with('noti', 'New password does not match');
            }
        }

        // Change oneself's profile - password required
        else if (Auth::user()->Id == $user->Id) {
            if ($request->filled('password') && Hash::check($request->password, $user->password)) {
                $user->update([
                    'role' => $request->role,
                    'name' => $request->name,
                    'email' => $request->email,
                    'date_of_birth' => $request->date_of_birth,
                ]);

                // Change password
                if ($request->filled('new_password')) {
                    if ($request->new_password == $request->confirmation) {
                        $user->update(['password' => Hash::make($request->new_password)]);
                    }
                    else return redirect()->route('users.index')->with('noti', 'New password does not match');
                }

            }
            else return redirect()->route('users.index')->with('noti', 'Wrong current password');
        }

        
        

        // if (Auth::user()->role == 'owner') {
        //     $user->update([
        //         'role' => $request->role,
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'password' => ($request->new_password)? Hash::make($request->new_password) : $request->old_password,
        //         'date_of_birth' => $request->date_of_birth,
        //     ]);
        // }
        // else {
        //     if (Hash::check($request->old_password, $user->password) && $request->new_password == $request->confirm_new_password) {
        //         $user->update([
        //             'name' => $request->name,
        //             'email' => $request->email,
        //             'password' => ($request->new_password)? Hash::make($request->new_password) : $request->old_password,
        //             'date_of_birth' => $request->date_of_birth,
        //         ]);
        //     }
        //     else if (Auth::user()->role == 'admin' && $user->role == 'user') {
        //         $user->update([
        //             'name' => $request->name,
        //             'email' => $request->email,
        //             'password' => Hash::make($request->new_password),
        //             'date_of_birth' => $request->date_of_birth,
        //         ]);
        //     }
        //     return redirect()->route('users.index')->with('noti', 'NOPE');
        // }
        return redirect()->route('users.index')->with('noti', 'Edit successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (Auth::user()->cannot('delete', $user)) {
            abort(403);
        }
        $user->delete();
        return redirect()->route('users.index')->with('noti', 'Delete successfully');
    }
}
