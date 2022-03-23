<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Publisher::all();
        return view('admin/publisher', $result);
    }

    public function manage_publisher(Request $request, $id = '')
    {
        if ($id > 0) {
            $arr = Publisher::where(['id' => $id])->get();

            $result['name'] = $arr['0']->name;
            $result['image'] = $arr['0']->image;
            $result['is_home'] = $arr['0']->is_home;
            $result['is_home_selected'] = "";

            if ($arr['0']->is_home == 1) {
                $result['is_home_selected'] = "checked";
            }

            $result['status'] = $arr['0']->status;
            $result['id'] = $arr['0']->id;
        } else {
            $result['name'] = '';
            $result['image'] = '';
            $result['is_home'] = "";
            $result['is_home_selected'] = "";
            $result['status'] = '';
            $result['id'] = 0;
        }

        return view('admin/manage_publisher', $result);
    }

    public function manage_publisher_process(Request $request)
    {
        if ($request->post('id') > 0) {
            $image_validation = "mimes:jpeg,jpg,png";
        } else {
            $image_validation = "required|mimes:jpeg,jpg,png";
        }

        $request->validate([
            'name' => 'required|unique:publishers,name,' . $request->post('id'),
            'image' => $image_validation
        ]);

        if ($request->post('id') > 0) {
            $model = Publisher::find($request->post('id'));
            $msg = "Cập nhật nhà xuất bản thành công!";
        } else {
            $model = new Publisher();
            $msg = "Thêm nhà xuất bản thành công!";
        }

        if ($request->hasFile('image')) {

            if ($request->post('id') > 0) {
                $arrImage = DB::table('publishers')->where(['id' => $request->post('id')])->get();

                if (Storage::exists('/public/media/publisher/' . $arrImage[0]->image)) {
                    Storage::delete('/public/media/publisher/' . $arrImage[0]->image);
                }
            }

            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time() . '.' . $ext;
            $image->storeAs('/public/media/publisher', $image_name);
            $model->image = $image_name;
        }

        $model->is_home = 0;

        if ($request->post('is_home') !== null) {
            $model->is_home = 1;
        }

        $model->name = $request->post('name');

        $model->save();
        $request->session()->flash('message', $msg);

        return redirect('admin/publisher');
    }

    public function delete(Request $request, $id)
    {
        $model = Publisher::find($id);

        if (Storage::exists('/public/media/publisher/' . $model->image)) {
            Storage::delete('/public/media/publisher/' . $model->image);
        }

        $model->delete();
        $request->session()->flash('message', 'Nhà xuất bản đã được xóa!');

        return redirect('admin/publisher');
    }

    public function status(Request $request, $status, $id)
    {
        $model = Publisher::find($id);
        $model->status = $status;

        $model->save();
        $request->session()->flash('message', 'Đã cập nhật trạng thái nhà xuất bản!');

        return redirect('admin/publisher');
    }
}
