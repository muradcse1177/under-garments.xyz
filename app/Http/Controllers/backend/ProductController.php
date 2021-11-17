<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    public function mainSlide(){
        try{
            $rows = DB::table('slide')->orderBy('id','desc')->paginate(20);
            return view('backend.mainSlide', ['slides' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function insertMainSlide (Request $request){
        try{
            if($request) {
                if ($request->id) {
                    if($request->hasFile('slide')) {
                        $image       = $request->file('slide');
                        $filename    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(950, 550);
                        $image_resize->save(public_path('asset/images/' .$filename));
                    }
                    $result =DB::table('slide')
                        ->where('id', $request->id)
                        ->update([
                            'slide' => $filename,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'You have done successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again!!');
                    }
                }
                else{
                    if($request->hasFile('slide')) {
                        $image       = $request->file('slide');
                        $filename    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(950, 550);
                        $image_resize->save(public_path('asset/images/' .$filename));
                    }
                    $result = DB::table('slide')->insert([
                        'slide' => $filename,
                    ]);
                    if ($result) {
                        return back()->with('successMessage', 'You have done successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again!!');
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please Try Again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function getMainSlideById(Request $request){
        try{
            $rows = DB::table('slide')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function deleteSlideList(Request $request){
        try{

            if($request->id) {
                $result =DB::table('slide')
                    ->where('id', $request->id)
                    ->delete();
                if ($result) {
                    return back()->with('successMessage', 'Data Delete Successfully.');
                } else {
                    return back()->with('errorMessage', 'Please Try Again.');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Try Again.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function selectCategory(Request $request){
        try{

            $rows = DB::table('categories')->where('status', 1)
                ->orderBy('id', 'DESC')->Paginate(10);
            return view('backend.category', ['categories' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function insertCategory(Request $request){
        try{
            if($request) {
                $cat = DB::table('categories')->where('id', $request->id)->where('status', 1)->first();
                if($request->id) {
                    if($request->hasFile('image')) {
                        $targetFolder = 'public/asset/images/';
                        $image       = $request->file('image');
                        $filename    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(190, 190);
                        $image_resize->save(public_path('asset/images/' .$filename));
                        $photo = $targetFolder.$filename;
                    }
                    else{
                        $photo = $cat->image;
                    }
                    $result =DB::table('categories')
                        ->where('id', $request->id)
                        ->update([
                            'name' =>  $request->name,
                            'type' => $request->cat_type,
                            'image' => $photo
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'You have done successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again!!');
                    }
                }
                else{
                    $photo ="";
                    if($request->hasFile('image')) {
                        $targetFolder = 'public/asset/images/';
                        $image       = $request->file('image');
                        $filename    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(190, 190);
                        $image_resize->save(public_path('asset/images/' .$filename));
                        $photo = $targetFolder.$filename;
                    }
                    $rows = DB::table('categories')->select('name')->where([
                        ['name', '=', $request->name]
                        ])->where('status', 1)->distinct()->get()->count();
                    if ($rows > 0) {
                        return back()->with('errorMessage', 'Insert New Category।');
                    } else {
                        $result = DB::table('categories')->insert([
                            'name' => $request->name,
                            'type' => $request->cat_type,
                            'image' => $photo
                        ]);
                        if ($result) {
                            return back()->with('successMessage', 'You have done successfully!!');
                        } else {
                            return back()->with('errorMessage', 'Please Try Again!!');
                        }
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please fill up the form!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function getCategoryList(Request $request){
        try{
            $rows = DB::table('categories')->where('id', $request->id)->first();

            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function deleteCategory(Request $request){
        try{

            if($request->id) {
                $result =DB::table('categories')
                    ->where('id', $request->id)
                    ->delete();
                if ($result) {
                    return back()->with('successMessage', 'You have done successfully!!');
                } else {
                    return back()->with('errorMessage', 'Please Try Again!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Try Again!!');
            }

        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function selectSubCategory(Request $request){
        try{
            $rows = DB::table('subcategories')
                ->select('subcategories.image','categories.name as catName', 'subcategories.id', 'subcategories.name','subcategories.type')
                ->join('categories', 'categories.id', '=', 'subcategories.cat_id')
                ->where('subcategories.status', 1)
                ->orderBy('subcategories.id', 'DESC')->Paginate(10);

            return view('backend.subcategory', ['subcategories' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function getCategoryListAll(Request $request){
        try{
            $rows = DB::table('categories')
                ->where('type', $request->id)
                ->where('status', 1)
                ->get();

            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function insertSubcategory(Request $request){
        try{
            if($request) {
                $photo = "";
                if($request->id) {
                    if($request->hasFile('image')) {
                        $targetFolder = 'public/asset/images/';
                        $image       = $request->file('image');
                        $filename    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(190, 190);
                        $image_resize->save(public_path('/asset/images/' .$filename));
                        $photo = $targetFolder.$filename;
                    }
                    else{
                        $s_cat =DB::table('subcategories')
                            ->where('id', $request->id)->first();
                        $photo = $s_cat->image;
                    }
                    $result =DB::table('subcategories')
                        ->where('id', $request->id)
                        ->update([
                            'name' =>  $request->name,
                            'cat_id' => $request->catId,
                            'type' => $request->cat_type,
                            'image' =>$photo
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'You have done successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again!!');
                    }
                }
                else{
                    $rows = DB::table('subcategories')->select('name')->where([
                        ['name', '=', $request->name]
                    ])->where('status', 1)->distinct()->get()->count();
                    if ($rows > 0) {
                        return back()->with('errorMessage', 'Please Insert New.');
                    } else {
                        if($request->hasFile('image')) {
                            $targetFolder = 'public/asset/images/';
                            $image       = $request->file('image');
                            $filename    = time() . '.' .$image->getClientOriginalName();
                            $image_resize = Image::make($image->getRealPath());
                            $image_resize->resize(190, 190);
                            $image_resize->save(public_path('/asset/images/' .$filename));
                            $photo = $targetFolder.$filename;
                        }
                        $result = DB::table('subcategories')->insert([
                            'name' => $request->name,
                            'cat_id' => $request->catId,
                            'type' => $request->cat_type,
                            'image' => $photo
                        ]);
                        if ($result) {
                            return back()->with('successMessage', 'You have done successfully!!');
                        } else {
                            return back()->with('errorMessage', 'Please Try Again!!');
                        }
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please fill up the form!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function getSubCategoryList(Request $request){
        try{
            $rows = DB::table('subcategories')->where('id', $request->id)->first();

            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function deleteSubCategory(Request $request){
        try{

            if($request->id) {
                $result =DB::table('subcategories')
                    ->where('id', $request->id)
                    ->delete();
                if ($result) {
                    return back()->with('successMessage', 'You have done successfully!!');
                } else {
                    return back()->with('errorMessage', 'Please Try Again!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Try Again!!');
            }

        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function selectProduct(Request $request){
        try{

            $rows = DB::table('products')->where('status', 1)
                ->orderBy('id', 'DESC')->Paginate(20);
            return view('backend.product', ['products' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function productSearchFromAdmin(Request $request){
        try{
            if($request->proSearch == null){
                $rows = DB::table('products')
                    ->where('status', 1)
                    ->orderBy('id', 'DESC')
                    ->Paginate(20);
            }
            else{
                $rows = DB::table('products')
                    ->where('status', 1)
                    ->where('name', 'LIKE','%'.$request->proSearch.'%')
                    ->orderBy('id', 'DESC')
                    ->Paginate(20);
            }
            return view('backend.product', ['products' => $rows, "key"=>$request->proSearch]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function getAllCategory(Request $request){
        try{
            $rows = DB::table('categories')
                ->where('status', 1)
                ->where('type', 1)
                ->get();

            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function getSubCategoryListAll(Request $request){
        try{
            $rows = DB::table('subcategories')
                ->where('cat_id', $request->id)
                ->where('status', 1)
                ->get();

            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function getProductList(Request $request){
        try{
            $rows = DB::table('products')
                ->where('id', $request->id)
                ->first();

            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function delivery_charge(Request $request){
        try{
            $rows = DB::table('delivery_charges')->get();
            return view('backend.delivery_charge', ['delivery_charges' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function getDeliveryCharge(Request $request){
        try{
            $rows = DB::table('delivery_charges')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function insertDeliveryCharge(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('delivery_charges')
                        ->where('id', $request->id)
                        ->update([
                            'lower' =>  $request->lower,
                            'higher' =>  $request->higher,
                            'charge' =>  $request->name,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'You have done successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again!!');
                    }
                }
                else{
                    $result =DB::table('delivery_charges')->insert([
                            'lower' =>  $request->lower,
                            'higher' =>  $request->higher,
                            'charge' =>  $request->name,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'You have done successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again!!');
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please fill up the form!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function insertProducts(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $photo = '';
                    $slider = '';
                    $row =DB::table('products')
                        ->where('id', $request->id)
                        ->first();
                    if ($request->hasFile('product_photo')) {
                        $targetFolder = 'public/asset/images/';
                        $file = $request->file('product_photo');
                        $pname = time(). '.' . $file->getClientOriginalName();
                        $image['filePath'] = $pname;
                        $file->move($targetFolder, $pname);
                        $photo = $targetFolder . $pname;
                    }
                    else{
                        $photo =  $row->photo;
                    }
                    if ($request->hasFile('slider')) {
                        $files = $request->file('slider');
                        foreach ($files as $file) {
                            $targetFolder = 'public/asset/images/';
                            $pname = time(). '.' . $file->getClientOriginalName();
                            $image['filePath'] = $pname;
                            $file->move($targetFolder, $pname);
                            $slider .= $targetFolder . $pname.',';
                        }
                        $slider = json_encode($slider);
                    }
                    else{
                        $slider =  $row->slider;
                    }
                    $result =DB::table('products')
                        ->where('id', $request->id)
                        ->update([
                            'name' =>  $request->name,
                            'cat_id' => $request->catId,
                            'sub_cat_id' => $request->subcat_name,
                            'company' => $request->company,
                            'type' => $request->type,
                            'description' => $request->description,
                            'specification' => $request->specification,
                            'price' => $request->price,
                            'discount_price' => $request->dis_price,
                            'unit' => $request->unit,
                            'minqty' => $request->minqty,
                            'photo' => $photo,
                            'slider' => $slider,
                            'status' => $request->status,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'You have done successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again!!');
                    }
                }
                else{
                    $slider = '';
                    if ($request->hasFile('product_photo')) {
                        $targetFolder = 'public/asset/images/';
                        $file = $request->file('product_photo');
                        $pname = time() . '.' . $file->getClientOriginalName();
                        $image['filePath'] = $pname;
                        $file->move($targetFolder, $pname);
                        $photo = $targetFolder . $pname;
                    }
                    else{
                        $photo ="";
                    }
                    if ($request->hasFile('slider')) {
                        $files = $request->file('slider');

                        foreach ($files as $file) {
                            $targetFolder = 'public/asset/images/';
                            $pname = time() . '.' . $file->getClientOriginalName();
                            $image['filePath'] = $pname;
                            $file->move($targetFolder, $pname);
                            $slider .= $targetFolder . $pname.',';
                        }
                    }
                    $result = DB::table('products')->insert([
                        'upload_by' =>  Cookie::get('user_id'),
                        'name' =>  $request->name,
                        'cat_id' => $request->catId,
                        'sub_cat_id' => $request->subcat_name,
                        'company' => $request->company,
                        'discount_price' => $request->dis_price,
                        'type' => $request->type,
                        'description' => $request->description,
                        'specification' => $request->specification,
                        'price' => $request->price,
                        'unit' => $request->unit,
                        'minqty' => $request->minqty,
                        'photo' => $photo,
                        'slider' => json_encode($slider),
                        'status' => $request->status,
                    ]);
                    if ($result) {
                        return back()->with('successMessage', 'You have done successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again!!');
                    }
                }
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function deleteProduct(Request $request){
        try{
            if($request->id) {
                $result =DB::table('products')
                    ->where('id', $request->id)
                    ->delete();
                if ($result) {
                    return back()->with('successMessage', 'You have done successfully!!');
                } else {
                    return back()->with('errorMessage', 'Please Try Again!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Try Again!!');
            }

        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function coupon(Request $request){
        try{

            $rows = DB::table('coupon')
                ->orderBy('id','desc')->paginate(20);
            return view('backend.coupon', ['coupons' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function insertCoupon(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('coupon')
                        ->where('id', $request->id)
                        ->update([
                            'name' =>  $request->name,
                            'discount' => $request->discount,
                            'start_date' => $request->start_date,
                            'end_date' => $request->end_date,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'You have done successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again!!');
                    }
                }
                else{
                    $rows = DB::table('coupon')
                        ->where('name', $request->name)
                        ->distinct()->get()->count();
                    if ($rows > 0) {
                        return back()->with('errorMessage', 'Data Already Exits!!');
                    }
                    else {
                        $result = DB::table('coupon')->insert([
                            'name' =>  $request->name,
                            'discount' => $request->discount,
                            'start_date' => $request->start_date,
                            'end_date' => $request->end_date,
                        ]);
                        if ($result) {
                            return back()->with('successMessage', 'You have done successfully!!');
                        } else {
                            return back()->with('errorMessage', 'Please Try Again!!');
                        }
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please fill up the form!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function getCouponList(Request $request){
        try{
            $rows = DB::table('coupon')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function deleteCoupon(Request $request){
        try{

            if($request->id) {
                $result =DB::table('coupon')
                    ->where('id', $request->id)
                    ->delete();
                if ($result) {
                    return back()->with('successMessage', 'You have done successfully!!');
                } else {
                    return back()->with('errorMessage', 'Please Try Again!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Try Again!!');
            }

        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }


}
