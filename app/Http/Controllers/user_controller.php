<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;

class user_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        # Lấy dữ liệu từ database.
        $data = DB::table('users')->get(); 

        # Dòng code này sẽ dừng việc thực hiện xử lý và hiển thị giá trị của biến $detail trên màn hình trình duyệt. Rất thích hợp để kiểm tra. Sau khi kiểm tra dữ liệu, Xóa dòng này đi để chạy tiếp xử lý nhé.
        // dd($detail);
        
        # Đã giới thiệu ở phần trước. Việc check biến có khác NULL hay không rất quan trọng.
        if (! $data) {
            abort(404, 'Sorry, that detail was not found.');
        }

        return view('showUsers', [
            'users' => $data
        ]);
        // return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('welcome');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(User $user)
    {
        //
        return view('editUser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->user()->cannot('update', $user)) {
            abort(403);
        }
        $user->update($request->all());
        // DB::table('users')->update([
        //     $user->date => $request.input('date_of_birth')
        // ]);
        return redirect()->route('users.index')->with('noti', 'Edit successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('noti', 'Delete successfully');
    }
}
