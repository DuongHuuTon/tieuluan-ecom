<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function redirect(Request $request)
    {
        $user_type = Auth::user()->user_type;

        if ($user_type == '1') {
            $count_prod = DB::table('products')->get();
            $data['count_prod'] = count($count_prod);
            $count_comment = DB::table('product_reviews')->get();
            $data['count_comment'] = count($count_comment);
            $count_user = DB::table('users')->get();
            $data['count_user'] = count($count_user);
            $count_order = DB::table('orders')->get();
            $data['count_order'] = count($count_order);

            return view('admin.info', $data);
        } else {
            $result['home_categories'] = DB::table('categories')
                ->where(['status' => 1])
                ->where(['is_home' => 1])
                ->get();

            foreach ($result['home_categories'] as $list) {
                $result['home_categories_product'][$list->id] =
                    DB::table('products')
                    ->where(['status' => 1])
                    ->where(['product_category_id' => $list->id])
                    ->get();

                foreach ($result['home_categories_product'][$list->id] as $list1) {
                    $result['home_product_attr'][$list1->id] =
                        DB::table('product_attrs')
                        ->leftJoin('covers', 'covers.id', '=', 'product_attrs.product_attr_cover_id')
                        ->where(['product_attrs.product_attr_product_id' => $list1->id])
                        ->get();
                }
            }

            $result['home_publisher'] = DB::table('publishers')
                ->where(['status' => 1])
                ->where(['is_home' => 1])
                ->get();

            $result['home_featured_product'][$list->id] =
                DB::table('products')
                ->where(['status' => 1])
                ->where(['is_featured' => 1])
                ->get();

            foreach ($result['home_featured_product'][$list->id] as $list1) {
                $result['home_featured_product_attr'][$list1->id] =
                    DB::table('product_attrs')
                    ->leftJoin('covers', 'covers.id', '=', 'product_attrs.product_attr_cover_id')
                    ->where(['product_attrs.product_attr_product_id' => $list1->id])
                    ->get();
            }

            $result['home_trending_product'][$list->id] =
                DB::table('products')
                ->where(['status' => 1])
                ->where(['is_trending' => 1])
                ->get();

            foreach ($result['home_trending_product'][$list->id] as $list1) {
                $result['home_trending_product_attr'][$list1->id] =
                    DB::table('product_attrs')
                    ->leftJoin('covers', 'covers.id', '=', 'product_attrs.product_attr_cover_id')
                    ->where(['product_attrs.product_attr_product_id' => $list1->id])
                    ->get();
            }

            $result['home_discounted_product'][$list->id] =
                DB::table('products')
                ->where(['status' => 1])
                ->where(['is_discounted' => 1])
                ->get();

            foreach ($result['home_discounted_product'][$list->id] as $list1) {
                $result['home_discounted_product_attr'][$list1->id] =
                    DB::table('product_attrs')
                    ->leftJoin('covers', 'covers.id', '=', 'product_attrs.product_attr_cover_id')
                    ->where(['product_attrs.product_attr_product_id' => $list1->id])
                    ->get();
            }

            $result['home_banner'] = DB::table('home_banners')
                ->where(['status' => 1])
                ->get();

            return view('front.index', $result);
        }
    }

    public function info()
    {
        $count_prod = DB::table('products')->get();
        $data['count_prod'] = count($count_prod);
        $count_comment = DB::table('product_reviews')->get();
        $data['count_comment'] = count($count_comment);
        $count_user = DB::table('users')->get();
        $data['count_user'] = count($count_user);
        $count_order = DB::table('orders')->get();
        $data['count_order'] = count($count_order);

        return view('admin.info', $data);
    }

    public function user_info()
    {
        return view('profile.show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pro = DB::table('products')->count();

        if ($pro == 0) {
            return view('auth.login');
        } else {
            $result['home_categories'] = DB::table('categories')
                ->where(['status' => 1])
                ->where(['is_home' => 1])
                ->get();

            foreach ($result['home_categories'] as $list) {
                $result['home_categories_product'][$list->id] =
                    DB::table('products')
                    ->where(['status' => 1])
                    ->where(['product_category_id' => $list->id])
                    ->get();

                foreach ($result['home_categories_product'][$list->id] as $list1) {
                    $result['home_product_attr'][$list1->id] =
                        DB::table('product_attrs')
                        ->leftJoin('covers', 'covers.id', '=', 'product_attrs.product_attr_cover_id')
                        ->where(['product_attrs.product_attr_product_id' => $list1->id])
                        ->get();
                }
            }

            $result['home_publisher'] = DB::table('publishers')
                ->where(['status' => 1])
                ->where(['is_home' => 1])
                ->get();

            $result['home_featured_product'][$list->id] =
                DB::table('products')
                ->where(['status' => 1])
                ->where(['is_featured' => 1])
                ->get();

            foreach ($result['home_featured_product'][$list->id] as $list1) {
                $result['home_featured_product_attr'][$list1->id] =
                    DB::table('product_attrs')
                    ->leftJoin('covers', 'covers.id', '=', 'product_attrs.product_attr_cover_id')
                    ->where(['product_attrs.product_attr_product_id' => $list1->id])
                    ->get();
            }

            $result['home_trending_product'][$list->id] =
                DB::table('products')
                ->where(['status' => 1])
                ->where(['is_trending' => 1])
                ->get();

            foreach ($result['home_trending_product'][$list->id] as $list1) {
                $result['home_trending_product_attr'][$list1->id] =
                    DB::table('product_attrs')
                    ->leftJoin('covers', 'covers.id', '=', 'product_attrs.product_attr_cover_id')
                    ->where(['product_attrs.product_attr_product_id' => $list1->id])
                    ->get();
            }

            $result['home_discounted_product'][$list->id] =
                DB::table('products')
                ->where(['status' => 1])
                ->where(['is_discounted' => 1])
                ->get();

            foreach ($result['home_discounted_product'][$list->id] as $list1) {
                $result['home_discounted_product_attr'][$list1->id] =
                    DB::table('product_attrs')
                    ->leftJoin('covers', 'covers.id', '=', 'product_attrs.product_attr_cover_id')
                    ->where(['product_attrs.product_attr_product_id' => $list1->id])
                    ->get();
            }

            $result['home_banner'] = DB::table('home_banners')
                ->where(['status' => 1])
                ->get();

            return view('front.index', $result);
        }
    }

    public function product(Request $request, $slug)
    {
        $result['product'] =
            DB::table('products')
            ->where(['status' => 1])
            ->where(['slug' => $slug])
            ->get();

        foreach ($result['product'] as $list1) {
            $result['product_attr'][$list1->id] =
                DB::table('product_attrs')
                ->leftJoin('covers', 'covers.id', '=', 'product_attrs.product_attr_cover_id')
                ->where(['product_attrs.product_attr_product_id' => $list1->id])
                ->get();
        }

        foreach ($result['product'] as $list1) {
            // prx($list1);
            $result['product_category'][$list1->id] =
                DB::table('categories')
                ->where(['categories.id' => $list1->product_category_id])
                ->get();
        }

        foreach ($result['product'] as $list1) {
            $result['product_images'][$list1->id] =
                DB::table('product_images')
                ->where(['product_images.product_image_product_id' => $list1->id])
                ->get();
        }

        $result['related_product'] =
            DB::table('products')
            ->where(['status' => 1])
            ->where('slug', '!=', $slug)
            ->where(['product_category_id' => $result['product'][0]->product_category_id])
            ->get();

        foreach ($result['related_product'] as $list1) {
            $result['related_product_attr'][$list1->id] =
                DB::table('product_attrs')
                ->leftJoin('covers', 'covers.id', '=', 'product_attrs.product_attr_cover_id')
                ->where(['product_attrs.product_attr_product_id' => $list1->id])
                ->get();
        }

        $result['product_reviews'] =
            DB::table('product_reviews')
            ->leftJoin('users', 'users.id', '=', 'product_reviews.product_review_user_id')
            ->where(['product_reviews.product_review_product_id' => $result['product'][0]->id])
            ->where(['product_reviews.status' => 1])
            ->orderBy('product_reviews.added_on', 'desc')
            ->select('product_reviews.rating', 'product_reviews.review', 'product_reviews.added_on', 'users.name')
            ->get();

        return view('front.product', $result);
    }

    public function category(Request $request, $slug)
    {
        $sort = "";
        $sort_txt = "";
        $filter_price_start = "";
        $filter_price_end = "";
        $cover_filter = "";

        if ($request->get('sort') !== null) {
            $sort = $request->get('sort');
        }

        $query = DB::table('products');
        $query = $query->leftJoin('categories', 'categories.id', '=', 'products.product_category_id');
        $query = $query->leftJoin('product_attrs', 'products.id', '=', 'product_attrs.product_attr_product_id');
        $query = $query->where(['products.status' => 1]);
        $query = $query->where(['categories.category_slug' => $slug]);

        if ($sort == 'name') {
            $query = $query->orderBy('products.name', 'asc');
            $sort_txt = "Kết quả tìm kiếm theo tên";
        }

        if ($sort == 'date') {
            $query = $query->orderBy('products.id', 'desc');
            $sort_txt = "Kết quả tìm kiếm theo ngày";
        }

        if ($sort == 'price_desc') {
            $query = $query->orderBy('product_attrs.price', 'desc');
            $sort_txt = "Kết quả tìm kiếm theo giá giảm dần";
        }

        if ($sort == 'price_asc') {
            $query = $query->orderBy('product_attrs.price', 'asc');
            $sort_txt = "Kết quả tìm kiếm theo giá tăng dần";
        }

        if ($request->get('filter_price_start') !== null && $request->get('filter_price_end') !== null) {
            $filter_price_start = $request->get('filter_price_start');
            $filter_price_end = $request->get('filter_price_end');

            if ($filter_price_start > 0 && $filter_price_end > 0) {
                $query = $query->whereBetween('product_attrs.price', [$filter_price_start, $filter_price_end]);
            }
        }

        if ($request->get('cover_filter') !== null) {
            $cover_filter = $request->get('cover_filter');
            $query = $query->where(['product_attrs.product_attr_cover_id' => $request->get('cover_filter')]);
        }

        $query = $query->distinct()->select('products.*');
        $query = $query->get();
        $result['product'] = $query;

        foreach ($result['product'] as $list1) {
            $query1 = DB::table('product_attrs');
            $query1 = $query1->leftJoin('covers', 'covers.id', '=', 'product_attrs.product_attr_cover_id');
            $query1 = $query1->where(['product_attrs.product_attr_product_id' => $list1->id]);
            $query1 = $query1->get();
            $result['product_attr'][$list1->id] = $query1;
        }

        $result['covers'] = DB::table('covers')
            ->where(['status' => 1])
            ->get();

        $result['categories_left'] = DB::table('categories')
            ->where(['status' => 1])
            ->get();

        $result['slug'] = $slug;
        $result['sort'] = $sort;
        $result['sort_txt'] = $sort_txt;
        $result['filter_price_start'] = $filter_price_start;
        $result['filter_price_end'] = $filter_price_end;
        $result['cover_filter'] = $cover_filter;

        return view('front.category', $result);
    }

    public function add_to_cart(Request $request)
    {
        if (!Auth::user()) {
            $uid = getUserTempId();
            $user_type = "Not-Register";
        } else {
            $uid = Auth::user()->id;
            $user_type = "Register";
        }

        $cover_id = $request->post('cover_id');
        $pqty = $request->post('pqty');
        $product_id = $request->post('product_id');

        $result = DB::table('product_attrs')
            ->select('product_attrs.id')
            ->leftJoin('covers', 'covers.id', '=', 'product_attrs.product_attr_cover_id')
            ->where(['product_attr_product_id' => $product_id])
            ->where(['covers.cover_type' => $cover_id])
            ->get();
        $product_attr_id = $result[0]->id;

        $check_od = getAvailableQty($product_id, $product_attr_id);

        $attr_qty = DB::table('product_attrs')
            ->leftJoin('products', 'products.id', '=', 'product_attrs.product_attr_product_id')
            ->where(['product_attrs.product_attr_product_id' => $product_id])
            ->select('product_attrs.qty')
            ->get();

        $attr_qty = $attr_qty[0]->qty;

        if (count($check_od)) {
            $getAvailableQty = getAvailableQty($product_id, $product_attr_id);
            $finalAvailable = $getAvailableQty[0]->pqty - $getAvailableQty[0]->qty;

            if ($pqty > $finalAvailable) {
                return response()->json(['msg' => "not_Available", 'data' => "Chỉ còn $finalAvailable sản phẩm"]);
            }
        } else {
            if ($attr_qty < $pqty) {
                return response()->json(['msg' => "not_Available", 'data' => "Chỉ còn $attr_qty sản phẩm"]);
            }
        }

        $check = DB::table('carts')
            ->where(['cart_user_id' => $uid])
            ->where(['cart_user_type' => $user_type])
            ->where(['cart_product_id' => $product_id])
            ->where(['cart_product_attr_id' => $product_attr_id])
            ->get();

        if (isset($check[0])) {
            $update_id = $check[0]->id;

            if ($pqty == 0) {
                DB::table('carts')
                    ->where(['id' => $update_id])
                    ->delete();
                $msg = "Sản phẩm đã được bỏ ra khỏi giỏ hàng";
            } else {
                DB::table('carts')
                    ->where(['id' => $update_id])
                    ->update(['qty' => $pqty]);
                $msg = "Cập nhật sản phẩm thành công";
            }
        } else {
            $id = DB::table('carts')->insertGetId([
                'cart_user_id' => $uid,
                'cart_user_type' => $user_type,
                'cart_product_id' => $product_id,
                'cart_product_attr_id' => $product_attr_id,
                'qty' => $pqty,
                'added_on' => date('Y-m-d h:i:s')
            ]);

            $msg = "Đã thêm sản phẩm vào giỏ hàng";
        }

        $result = DB::table('carts')
            ->leftJoin('products', 'products.id', '=', 'carts.cart_product_id')
            ->leftJoin('product_attrs', 'product_attrs.id', '=', 'carts.cart_product_attr_id')
            ->leftJoin('covers', 'covers.id', '=', 'product_attrs.product_attr_cover_id')
            ->where(['cart_user_id' => $uid])
            ->where(['cart_user_type' => $user_type])
            ->select('carts.qty', 'products.name', 'products.image', 'covers.cover_type', 'product_attrs.price', 'products.slug', 'products.id as pid', 'product_attrs.id as attr_id')
            ->get();

        return response()->json(['msg' => $msg, 'data' => $result, 'totalItem' => count($result)]);
    }

    public function cart(Request $request)
    {
        if (!Auth::user()) {
            $uid = getUserTempId();
            $user_type = "Not-Register";
        } else {
            $uid = Auth::user()->id;
            $user_type = "Register";
        }

        $result['list'] = DB::table('carts')
            ->leftJoin('products', 'products.id', '=', 'carts.cart_product_id')
            ->leftJoin('product_attrs', 'product_attrs.id', '=', 'carts.cart_product_attr_id')
            ->leftJoin('covers', 'covers.id', '=', 'product_attrs.product_attr_cover_id')
            ->where(['cart_user_id' => $uid])
            ->where(['cart_user_type' => $user_type])
            ->select('carts.qty', 'products.name', 'products.image', 'covers.cover_type', 'product_attrs.price', 'products.slug', 'products.id as pid', 'product_attrs.id as attr_id')
            ->get();

        return view('front.cart', $result);
    }

    public function search(Request $request, $str)
    {
        $result['product'] =
            $query = DB::table('products');
        $query = $query->leftJoin('categories', 'categories.id', '=', 'products.product_category_id');
        $query = $query->leftJoin('product_attrs', 'products.id', '=', 'product_attrs.product_attr_product_id');
        $query = $query->where(['products.status' => 1]);
        $query = $query->where('name', 'like', "%$str%");
        $query = $query->orWhere('publisher', 'like', "%$str%");
        $query = $query->orWhere('short_desc', 'like', "%$str%");
        $query = $query->orWhere('desc', 'like', "%$str%");
        $query = $query->orWhere('keywords', 'like', "%$str%");
        $query = $query->orWhere('printing_info', 'like', "%$str%");
        $query = $query->distinct()->select('products.*');
        $query = $query->get();
        $result['product'] = $query;

        foreach ($result['product'] as $list1) {
            $query1 = DB::table('product_attrs');
            $query1 = $query1->leftJoin('covers', 'covers.id', '=', 'product_attrs.product_attr_cover_id');
            $query1 = $query1->where(['product_attrs.product_attr_product_id' => $list1->id]);
            $query1 = $query1->get();
            $result['product_attr'][$list1->id] = $query1;
        }

        return view('front.search', $result);
    }

    public function checkout(Request $request)
    {
        $result['cart_data'] = getAddToCartTotalItem();

        if (isset($result['cart_data'][0])) {

            if (Auth::user()) {
                $uid = Auth::user()->id;
                $user_info = DB::table('users')
                    ->where(['id' => $uid])
                    ->get();
                $result['users']['name'] = $user_info[0]->name;
                $result['users']['email'] = $user_info[0]->email;
                $result['users']['phone'] = $user_info[0]->phone;
                $result['users']['address'] = $user_info[0]->address;
            } else {
                $result['users']['name'] = '';
                $result['users']['email'] = '';
                $result['users']['phone'] = '';
                $result['users']['address'] = '';
            }

            return view('front.checkout', $result);
        } else {
            return redirect('/');
        }
    }

    public function apply_coupon_code(Request $request)
    {
        $arr = apply_coupon_code($request->coupon_code);
        $arr = json_decode($arr, true);

        return response()->json(['status' => $arr['status'], 'msg' => $arr['msg'], 'totalPrice' => $arr['totalPrice']]);
    }

    public function remove_coupon_code(Request $request)
    {
        $totalPrice = 0;
        $result = DB::table('coupons')
            ->where(['code' => $request->coupon_code])
            ->get();
        $getAddToCartTotalItem = getAddToCartTotalItem();
        $totalPrice = 0;
        foreach ($getAddToCartTotalItem as $list) {
            $totalPrice = $totalPrice + ($list->qty * $list->price);
        }

        return response()->json(['status' => 'success', 'msg' => 'Đã xóa mã giảm giá', 'totalPrice' => $totalPrice]);
    }

    public function place_order(Request $request)
    {
        $payment_url = '';
        $rand_id = rand(111111111, 999999999);

        if (Auth::user()) {
        } else {
            $valid = Validator::make($request->all(), [
                "email" => 'required|email|unique:users,email'
            ]);

            if (!$valid->passes()) {
                return response()->json(['status' => 'error', 'msg' => "Thông tin đã gửi đến Mail của bạn"]);
            } else {
                $arr = [
                    "name" => $request->name,
                    "email" => $request->email,
                    "phone" => $request->phone,
                    "address" => $request->address,
                    "status" => 1,
                    "is_verify" => 1,
                    'user_type' => 0,
                    "rand_id" => $rand_id,
                    "password" => Hash::make($rand_id),
                    "created_at" => date('Y-m-d h:i:s'),
                    "updated_at" => date('Y-m-d h:i:s'),
                ];

                $user_id = DB::table('users')->insertGetId($arr);

                $data = ['name' => $request->name, 'password' => $rand_id];
                $user['to'] = $request->email;
                Mail::send('front/password_send', $data, function ($messages) use ($user) {
                    $messages->to($user['to']);
                    $messages->subject('New Password');
                });

                $getUserTempId = getUserTempId();
                DB::table('carts')
                    ->where(['cart_user_id' => $getUserTempId, 'cart_user_type' => 'Not-Register'])
                    ->update(['cart_user_id' => $user_id, 'cart_user_type' => 'Register']);
            }
        }
        $coupon_value = 0;
        if ($request->coupon_code != '') {
            $arr = apply_coupon_code($request->coupon_code);
            $arr = json_decode($arr, true);
            if ($arr['status'] == 'success') {
                $coupon_value = $arr['coupon_code_value'];
            } else {
                return response()->json(['status' => 'false', 'msg' => $arr['msg']]);
            }
        }

        $uid = Auth::user()->id;
        $totalPrice = 0;
        $getAddToCartTotalItem = getAddToCartTotalItem();
        foreach ($getAddToCartTotalItem as $list) {
            $totalPrice = $totalPrice + ($list->qty * $list->price);
        }
        $arr = [
            "order_user_id" => $uid,
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "coupon_code" => $request->coupon_code,
            "coupon_value" => $coupon_value,
            "payment_type" => $request->payment_type,
            "payment_status" => "Đang giải quyết",
            "total_amt" => $totalPrice,
            "order_order_status_id" => 1,
            "added_on" => date('Y-m-d h:i:s')
        ];
        $order_id = DB::table('orders')->insertGetId($arr);

        if ($order_id > 0) {
            foreach ($getAddToCartTotalItem as $list) {
                $productDetailArr['order_detail_product_id'] = $list->pid;
                $productDetailArr['order_detail_product_attr_id'] = $list->attr_id;
                $productDetailArr['price'] = $list->price;
                $productDetailArr['qty'] = $list->qty;
                $productDetailArr['order_detail_order_id'] = $order_id;
                DB::table('order_details')->insert($productDetailArr);
            }

            DB::table('carts')->where(['cart_user_id' => $uid, 'cart_user_type' => 'Register'])->delete();
            $request->session()->put('ORDER_ID', $order_id);

            $status = "success";
            $msg = "Đặt hàng thành công";
        } else {
            $status = "false";
            $msg = "Vui lòng thử lại sau";
        }
        return response()->json(['status' => $status, 'msg' => $msg, 'payment_url' => $payment_url]);
    }

    public function order_placed(Request $request)
    {
        if ($request->session()->has('ORDER_ID')) {
            return view('front.order_placed');
        } else {
            return redirect('/');
        }
    }

    public function order(Request $request)
    {
        $result['orders'] = DB::table('orders')
            ->select('orders.*', 'order_statuses.order_status')
            ->leftJoin('order_statuses', 'order_statuses.id', '=', 'orders.order_order_status_id')
            ->where(['orders.order_user_id' => Auth::user()->id])
            ->get();
        return view('front.order', $result);
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
            ->where(['orders.order_user_id' => Auth::user()->id])
            ->get();
        if (!isset($result['order_details'][0])) {
            return redirect('/');
        }
        return view('front.order_detail', $result);
    }

    public function product_review_process(Request $request)
    {
        if (Auth::user()) {
            $uid = Auth::user()->id;

            $arr = [
                "rating" => $request->rating,
                "review" => $request->review,
                "product_review_product_id" => $request->product_id,
                "status" => 1,
                "product_review_user_id" => $uid,
                "added_on" => date('Y-m-d h:i:s')
            ];
            $query = DB::table('product_reviews')->insert($arr);
            $status = "success";
            $msg = "Cảm ơn bạn đã đánh giá sản phẩm";
        } else {
            $status = "error";
            $msg = "Vui lòng đăng nhập để đánh giá sản phẩm";
        }
        return response()->json(['status' => $status, 'msg' => $msg]);
    }
}
