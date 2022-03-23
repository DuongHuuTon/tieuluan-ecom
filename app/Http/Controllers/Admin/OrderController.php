<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['orders'] = DB::table('orders')
            ->select('orders.*', 'order_statuses.order_status')
            ->leftJoin('order_statuses', 'order_statuses.id', '=', 'orders.order_order_status_id')
            ->get();

        return view('admin.order', $result);
    }

    public function order_detail(Request $request, $id)
    {
        $result['order_details'] =
            DB::table('order_details')
            ->select('orders.*', 'order_details.price', 'order_details.qty', 'products.name as pname', 'product_attrs.attr_image', 'covers.cover_type', 'order_statuses.order_status')
            ->leftJoin('orders', 'orders.id', '=', 'order_details.order_detail_order_id')
            ->leftJoin('product_attrs', 'product_attrs.id', '=', 'order_details.order_detail_product_attr_id')
            ->leftJoin('products', 'products.id', '=', 'product_attrs.product_attr_product_id')
            ->leftJoin('order_statuses', 'order_statuses.id', '=', 'orders.order_order_status_id')
            ->leftJoin('covers', 'covers.id', '=', 'product_attrs.product_attr_cover_id')
            ->where(['orders.id' => $id])
            ->get();

        $result['order_statuses'] =
            DB::table('order_statuses')
            ->get();

        $result['payment_status'] = ['Đang giả quyết', 'Thành công', 'Thất bại'];

        return view('admin.order_detail', $result);
    }

    public function update_payment_status(Request $request, $status, $id)
    {
        DB::table('orders')
            ->where(['id' => $id])
            ->update(['payment_status' => $status]);

        return redirect('/admin/order_detail/' . $id);
    }

    public function update_order_status(Request $request, $status, $id)
    {
        DB::table('orders')
            ->where(['id' => $id])
            ->update(['order_order_status_id' => $status]);

        return redirect('/admin/order_detail/' . $id);
    }

    public function update_track_detail(Request $request, $id)
    {
        $track_details = $request->post('track_details');

        DB::table('orders')
            ->where(['id' => $id])
            ->update(['track_details' => $track_details]);

        return redirect('/admin/order_detail/' . $id);
    }
}
