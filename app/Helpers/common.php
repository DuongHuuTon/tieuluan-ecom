<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

function prx($arr)
{
    echo "<pre>";
    print_r($arr);
    die();
}

function getTopNavCat()
{
    $result = DB::table('categories')
        ->where(['status' => 1])
        ->get();

    $arr = [];

    foreach ($result as $row) {
        $arr[$row->id]['category_name'] = $row->category_name;
        $arr[$row->id]['parent_id'] = $row->parent_category_id;
        $arr[$row->id]['category_slug'] = $row->category_slug;
    }

    $str = buildTreeView($arr, 0);

    return $str;
}

$html = '';

function buildTreeView($arr, $parent, $level = 0, $preLevel = -1)
{
    global $html;

    foreach ($arr as $id => $data) {
        if ($parent == $data['parent_id']) {
            if ($level > $preLevel) {
                if ($html == '') {
                    $html .= '<ul class="nav navbar-nav">';
                } else {
                    $html .= '<ul class="dropdown-menu">';
                }
            }
            if ($level == $preLevel) {
                $html .= '</li>';
            }
            $url = url("/category/" . $data['category_slug']);
            $html .= '<li><a href="' . $url . '">' . $data['category_name'] . '<span class="caret"></span></a>';
            if ($level > $preLevel) {
                $preLevel = $level;
            }
            $level++;
            buildTreeView($arr, $id, $level, $preLevel);
            $level--;
        }
    }

    if ($level == $preLevel) {
        $html .= '</li></ul>';
    }

    return $html;
}

function getUserTempId()
{
    if (!session()->has('USER_TEMP_ID')) {
        $rand = rand(111111111, 999999999);
        session()->put('USER_TEMP_ID', $rand);
        return $rand;
    } else {
        return session()->get('USER_TEMP_ID');
    }
}

function getAddToCartTotalItem()
{
    if (!Auth::user()) {
        $uid = getUserTempId();
        $user_type = "Not-Register";
    } else {
        $uid = Auth::user()->id;
        $user_type = "Register";
    }

    $result = DB::table('carts')
        ->leftJoin('products', 'products.id', '=', 'carts.cart_product_id')
        ->leftJoin('product_attrs', 'product_attrs.id', '=', 'carts.cart_product_attr_id')
        ->leftJoin('covers', 'covers.id', '=', 'product_attrs.product_attr_cover_id')
        ->where(['cart_user_id' => $uid])
        ->where(['cart_user_type' => $user_type])
        ->select('carts.qty', 'products.name', 'products.image', 'covers.cover_type', 'product_attrs.price', 'products.slug', 'products.id as pid', 'product_attrs.id as attr_id')
        ->get();

    return $result;
}

function apply_coupon_code($coupon_code)
{
    $totalPrice = 0;

    $result = DB::table('coupons')
        ->where(['code' => $coupon_code])
        ->get();

    if (isset($result[0])) {
        $value = $result[0]->value;
        $type = $result[0]->type;
        $getAddToCartTotalItem = getAddToCartTotalItem();

        foreach ($getAddToCartTotalItem as $list) {
            $totalPrice = $totalPrice + ($list->qty * $list->price);
        }

        if ($result[0]->status == 1) {
            if ($result[0]->is_one_time == 1) {
                $status = "error";
                $msg = "Mã giảm giá đã được sử dụng";
            } else {
                $min_order_amt = $result[0]->min_order_amt;
                if ($min_order_amt > 0) {

                    if ($min_order_amt < $totalPrice) {
                        $status = "success";
                        $msg = "Đã áp dụng mã giảm giá";
                    } else {
                        $status = "error";
                        $msg = "Tổng thanh toán trong giỏ hàng phải lới hơn $min_order_amt đ";
                    }
                } else {
                    $status = "success";
                    $msg = "Đã áp dụng mã giảm giá";
                }
            }
        } else {
            $status = "error";
            $msg = "Đã hủy mã giảm giá";
        }
    } else {
        $status = "error";
        $msg = "Mã giảm giá không hợp lệ, vui lòng nhập lại!";
    }

    $coupon_code_value = 0;

    if ($status == 'success') {
        if ($type == 'Value') {
            $coupon_code_value = $value;
            $totalPrice = $totalPrice - $value;
        }
        if ($type == 'Percent') {
            $newPrice = ($value / 100) * $totalPrice;
            $totalPrice = round($totalPrice - $newPrice);
            $coupon_code_value = $newPrice;
        }
    }

    return json_encode(['status' => $status, 'msg' => $msg, 'totalPrice' => $totalPrice, 'coupon_code_value' => $coupon_code_value]);
}

function getCustomDate($date)
{
    if ($date != '') {
        $date = strtotime($date);
        return date('d-M Y', $date);
    }
}

function getAvailableQty($product_id, $attr_id)
{
    $result = DB::table('order_details')
        ->leftJoin('orders', 'orders.id', '=', 'order_details.order_detail_order_id')
        ->leftJoin('product_attrs', 'product_attrs.id', '=', 'order_details.order_detail_product_attr_id')
        ->where(['order_details.order_detail_product_id' => $product_id])
        ->where(['order_details.order_detail_product_attr_id' => $attr_id])
        ->select('order_details.qty', 'product_attrs.qty as pqty')
        ->get();

    return $result;
}
