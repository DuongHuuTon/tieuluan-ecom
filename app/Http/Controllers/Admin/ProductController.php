<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Product::all();
        return view('admin/product', $result);
    }

    public function manage_product(Request $request, $id = '')
    {
        if ($id > 0) {
            $arr = Product::where(['id' => $id])->get();

            $result['category_id'] = $arr['0']->product_category_id;
            $result['tax_id'] = $arr['0']->product_tax_id;
            $result['name'] = $arr['0']->name;
            $result['slug'] = $arr['0']->slug;
            $result['publisher'] = $arr['0']->publisher;
            $result['image'] = $arr['0']->image;
            $result['printing_info'] = $arr['0']->printing_info;
            $result['keywords'] = $arr['0']->keywords;
            $result['short_desc'] = $arr['0']->short_desc;
            $result['desc'] = $arr['0']->desc;
            $result['warranty'] = $arr['0']->warranty;
            $result['endow'] = $arr['0']->endow;
            $result['is_promo'] = $arr['0']->is_promo;
            $result['is_featured'] = $arr['0']->is_featured;
            $result['is_discounted'] = $arr['0']->is_discounted;
            $result['is_trending'] = $arr['0']->is_trending;
            $result['status'] = $arr['0']->status;
            $result['id'] = $arr['0']->id;

            $result['productAttrArr'] = DB::table('product_attrs')->where(['product_attr_product_id' => $id])->get();

            $productImagesArr = DB::table('product_images')->where(['product_image_product_id' => $id])->get();

            if (!isset($productImagesArr[0])) {
                $result['productImagesArr']['0']['id'] = '';
                $result['productImagesArr']['0']['images'] = '';
            } else {
                $result['productImagesArr'] = $productImagesArr;
            }
        } else {
            $result['category_id'] = '';
            $result['tax_id'] = '';
            $result['name'] = '';
            $result['slug'] = '';
            $result['publisher'] = '';
            $result['image'] = '';
            $result['printing_info'] = '';
            $result['keywords'] = '';
            $result['short_desc'] = '';
            $result['desc'] = '';
            $result['warranty'] = '';
            $result['endow'] = '';
            $result['is_promo'] = '';
            $result['is_featured'] = '';
            $result['is_discounted'] = '';
            $result['is_trending'] = '';
            $result['status'] = '';
            $result['id'] = 0;

            $result['productAttrArr'][0]['id'] = '';
            $result['productAttrArr'][0]['product_attr_product_id'] = '';
            $result['productAttrArr'][0]['product_attr_cover_id'] = '';
            $result['productAttrArr'][0]['isbn'] = '';
            $result['productAttrArr'][0]['attr_image'] = '';
            $result['productAttrArr'][0]['price'] = '';
            $result['productAttrArr'][0]['mrp'] = '';
            $result['productAttrArr'][0]['qty'] = '';
            $result['productImagesArr']['0']['id'] = '';
            $result['productImagesArr']['0']['images'] = '';
        }

        $result['category'] = DB::table('categories')->where(['status' => 1])->get();

        $result['covers'] = DB::table('covers')->where(['status' => 1])->get();

        $result['publishers'] = DB::table('publishers')->where(['status' => 1])->get();

        $result['taxes'] = DB::table('taxes')->where(['status' => 1])->get();

        return view('admin/manage_product', $result);
    }

    public function manage_product_process(Request $request)
    {
        if ($request->post('id') > 0) {
            $image_validation = "mimes:jpeg,jpg,png";
        } else {
            $image_validation = "required|mimes:jpeg,jpg,png";
        }

        $request->validate([
            'name' => 'required',
            'image' => $image_validation,
            'slug' => 'required|unique:products,slug,' . $request->post('id'),
            'attr_image.*' => 'mimes:jpg,jpeg,png',
            'images.*' => 'mimes:jpg,jpeg,png'
        ]);

        $paidArr = $request->post('paid');
        $isbnArr = $request->post('isbn');
        $priceArr = $request->post('price');
        $mrpArr = $request->post('mrp');
        $qtyArr = $request->post('qty');
        $cover_idArr = $request->post('cover_id');

        foreach ($isbnArr as $key => $val) {
            $check = DB::table('product_attrs')->where('isbn', '=', $isbnArr[$key])->where('id', '!=', $paidArr[$key])->get();

            if (isset($check[0])) {
                $request->session()->flash('isbn_error', $isbnArr[$key] . 'Mã sản phẩm đã được sử dụng');

                return redirect(request()->headers->get('referer'));
            }
        }

        if ($request->post('id') > 0) {
            $model = Product::find($request->post('id'));
            $msg = "Cập nhật sản phẩm thành công!";
        } else {
            $model = new Product();
            $msg = "Thêm sản phẩm thành công!";
        }

        if ($request->hasFile('image')) {
            if ($request->post('id') > 0) {
                $arrImage = DB::table('products')->where(['id' => $request->post('id')])->get();

                if (Storage::exists('/public/media/product/' . $arrImage[0]->image)) {
                    Storage::delete('/public/media/product/' . $arrImage[0]->image);
                }
            }

            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time() . '.' . $ext;
            $image->storeAs('/public/media/product', $image_name);
            $model->image = $image_name;
        }

        $model->product_category_id = $request->post('category_id');
        $model->product_tax_id = $request->post('tax_id');
        $model->name = $request->post('name');
        $model->slug = $request->post('slug');
        $model->publisher = $request->post('publisher');
        $model->printing_info = $request->post('printing_info');
        $model->keywords = $request->post('keywords');
        $model->short_desc = $request->post('short_desc');
        $model->desc = $request->post('desc');
        $model->warranty = $request->post('warranty');
        $model->endow = $request->post('endow');
        $model->is_promo = $request->post('is_promo');
        $model->is_featured = $request->post('is_featured');
        $model->is_discounted = $request->post('is_discounted');
        $model->is_trending = $request->post('is_trending');
        $model->save();
        $pid = $model->id;

        /*Product Attr Start*/
        foreach ($isbnArr as $key => $val) {
            $productAttrArr = [];
            $productAttrArr['product_attr_product_id'] = $pid;
            $productAttrArr['isbn'] = $isbnArr[$key];
            $productAttrArr['price'] = (int)$priceArr[$key];
            $productAttrArr['mrp'] = (int)$mrpArr[$key];
            $productAttrArr['qty'] = (int)$qtyArr[$key];

            if ($cover_idArr[$key] == '') {
                $productAttrArr['product_attr_cover_id'] = 0;
            } else {
                $productAttrArr['product_attr_cover_id'] = $cover_idArr[$key];
            }

            if ($request->hasFile("attr_image.$key")) {
                if ($paidArr[$key] != '') {
                    $arrImage = DB::table('product_attrs')->where(['id' => $paidArr[$key]])->get();

                    if (Storage::exists('/public/media/product/' . $arrImage[0]->attr_image)) {
                        Storage::delete('/public/media/product/' . $arrImage[0]->attr_image);
                    }
                }

                $rand = rand('111111111', '999999999');
                $attr_image = $request->file("attr_image.$key");
                $ext = $attr_image->extension();
                $image_name = $rand . '.' . $ext;
                $request->file("attr_image.$key")->storeAs('/public/media/product/', $image_name);
                $productAttrArr['attr_image'] = $image_name;
            }

            if ($paidArr[$key] != '') {
                DB::table('product_attrs')->where(['id' => $paidArr[$key]])->update($productAttrArr);
            } else {
                DB::table('product_attrs')->insert($productAttrArr);
            }
        }
        /*Product Attr End*/

        /*Product Images Start*/
        $piidArr = $request->post('piid');

        foreach ($piidArr as $key => $val) {
            $productImageArr['product_image_product_id'] = $pid;

            if ($request->hasFile("images.$key")) {

                if ($piidArr[$key] != '') {
                    $arrImage = DB::table('product_images')->where(['id' => $piidArr[$key]])->get();

                    if (Storage::exists('/public/media/product/' . $arrImage[0]->images)) {
                        Storage::delete('/public/media/product/' . $arrImage[0]->images);
                    }
                }

                $rand = rand('111111111', '999999999');
                $images = $request->file("images.$key");
                $ext = $images->extension();
                $image_name = $rand . '.' . $ext;
                $request->file("images.$key")->storeAs('/public/media/product/', $image_name);
                $productImageArr['images'] = $image_name;

                if ($piidArr[$key] != '') {
                    DB::table('product_images')->where(['id' => $piidArr[$key]])->update($productImageArr);
                } else {
                    DB::table('product_images')->insert($productImageArr);
                }
            }
        }
        /*Product Images End*/

        $request->session()->flash('message', $msg);

        return redirect('admin/product');
    }

    public function delete(Request $request, $id)
    {
        $model = Product::find($id);

        if (Storage::exists('/public/media/product/' . $model->image)) {
            Storage::delete('/public/media/product/' . $model->image);
        }

        $arrAttrsImages = DB::table('product_attrs')->where(['product_attr_product_id' => $id])->get();

        foreach ($arrAttrsImages as $arrAttrsImage => $value) {
            if (Storage::exists('/public/media/product/' . $value->attr_image)) {
                Storage::delete('/public/media/product/' . $value->attr_image);
            }
        }

        DB::table('product_attrs')->where(['product_attr_product_id' => $id])->delete();

        $arrImages = DB::table('product_images')->where(['product_image_product_id' => $id])->get();

        foreach ($arrImages as $arrImage => $value) {
            if (Storage::exists('/public/media/product/' . $value->images)) {
                Storage::delete('/public/media/product/' . $value->images);
            }
        }

        DB::table('product_images')->where(['product_image_product_id' => $id])->delete();

        $model->delete();
        $request->session()->flash('message', 'Sản phẩm đã được xóa!');

        return redirect('admin/product');
    }

    public function product_attr_delete(Request $request, $paid, $pid)
    {
        $arrImage = DB::table('product_attrs')->where(['id' => $paid])->get();

        if (Storage::exists('/public/media/product/' . $arrImage[0]->attr_image)) {
            Storage::delete('/public/media/product/' . $arrImage[0]->attr_image);
        }

        DB::table('product_attrs')->where(['id' => $paid])->delete();

        return redirect('admin/product/manage_product/' . $pid);
    }

    public function product_images_delete(Request $request, $paid, $pid)
    {
        $arrImage = DB::table('product_images')->where(['id' => $paid])->get();

        if (Storage::exists('/public/media/product/' . $arrImage[0]->images)) {
            Storage::delete('/public/media/product/' . $arrImage[0]->images);
        }

        DB::table('product_images')->where(['id' => $paid])->delete();

        return redirect('admin/product/manage_product/' . $pid);
    }

    public function status(Request $request, $status, $id)
    {
        $model = Product::find($id);
        $model->status = $status;

        $model->save();
        $request->session()->flash('message', 'Đã cập nhật trạng thái sản phẩm!');

        return redirect('admin/product');
    }
}
