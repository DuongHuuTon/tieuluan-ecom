<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] =
            DB::table('product_reviews')
            ->leftJoin('users', 'users.id', '=', 'product_reviews.product_review_user_id')
            ->leftJoin('products', 'products.id', '=', 'product_reviews.product_review_product_id')
            ->orderBy('product_reviews.added_on', 'desc')
            ->select('product_reviews.id', 'product_reviews.rating', 'product_reviews.review', 'product_reviews.added_on', 'users.name', 'products.name as pname', 'product_reviews.status')
            ->get();

        return view('admin.product_review', $result);
    }

    public function update_product_review_status(Request $request, $status, $id)
    {
        DB::table('product_reviews')
            ->where(['id' => $id])
            ->update(['status' => $status]);

        return redirect('/admin/product_review/');
    }
}
