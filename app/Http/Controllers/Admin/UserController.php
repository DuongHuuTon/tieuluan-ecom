<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = User::all();
        return view('admin/user', $result);
    }

    public function show(Request $request, $id = '')
    {
        $arr = User::where(['id' => $id])->get();
        $result['user_list'] = $arr['0'];

        return view('admin/show_user', $result);
    }

    public function status(Request $request, $status, $id)
    {
        $model = User::find($id);
        $model->status = $status;

        $model->save();
        $request->session()->flash('message', 'Đã cập nhật trạng thái người dùng!');

        return redirect('admin/user');
    }
}
