<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Cover;
use Illuminate\Http\Request;

class CoverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Cover::all();
        return view('admin/cover', $result);
    }

    public function manage_cover(Request $request, $id = '')
    {
        if ($id > 0) {
            $arr = Cover::where(['id' => $id])->get();

            $result['cover_type'] = $arr['0']->cover_type;
            $result['status'] = $arr['0']->status;
            $result['id'] = $arr['0']->id;
        } else {
            $result['cover_type'] = '';
            $result['status'] = '';
            $result['id'] = 0;
        }

        return view('admin/manage_cover', $result);
    }

    public function manage_cover_process(Request $request)
    {
        $request->validate([
            'cover_type' => 'required|unique:covers,cover_type,' . $request->post('id'),
        ]);

        if ($request->post('id') > 0) {
            $model = Cover::find($request->post('id'));
            $msg = "Cập nhật bìa sách thành công!";
        } else {
            $model = new Cover();
            $msg = "Thêm bìa sách thành công!";
        }

        $model->cover_type = $request->post('cover_type');

        $model->save();
        $request->session()->flash('message', $msg);

        return redirect('admin/cover');
    }

    public function delete(Request $request, $id)
    {
        $model = Cover::find($id);

        $model->delete();
        $request->session()->flash('message', 'Bìa sách đã được xóa!');

        return redirect('admin/cover');
    }

    public function status(Request $request, $status, $id)
    {
        $model = Cover::find($id);
        $model->status = $status;

        $model->save();
        $request->session()->flash('message', 'Đã cập nhật trạng thái bìa sách!');

        return redirect('admin/cover');
    }
}
