<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Middleware\courier;
use App\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use smasif\ShurjopayLaravelPackage\ShurjopayService;

class FrontController extends Controller
{
    public function homepageManager(Request $request){
        try{
            $slide= DB::table('slide')
                ->orderBy('id', 'DESC')
                ->take(10)->get();
            $product_cat = DB::table('categories')
                ->where('type','1')
                ->where('status','1')
                ->orWhere('type','3')
                ->where('status','1')
                ->orderBy('id', 'ASC')->get();
            return view('frontend.n_index',
                [
                    'pro_categories' => $product_cat,
                    'slides' => $slide,
                ]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function shop(Request $request){
        try{
            $slide= DB::table('slide')
                ->orderBy('id', 'DESC')
                ->take(10)->get();
            $product_cat = DB::table('categories')
                ->where('type', 1)
                ->where('status', 1)
                ->orderBy('id', 'ASC')->get();
            $dealer_product_1 = DB::table('products')
                ->where('status', 1)
                ->inRandomOrder()->get()->take(60);

            //dd($dealer_product_1);
            return view('frontend.shop',
                [
                    'pro_categories' => $product_cat,
                    'slides' => $slide,
                    'products' => $dealer_product_1 ,
                ]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function productById($id){
        try{
            $category = DB::table('products')
                ->where('id',$id)
                ->first();
                $dealer_product_1 = DB::table('products')
                    ->where('products.id', $id)->first();
                $related_product = DB::table('products')
                    ->where('products.cat_id', $category->cat_id)
                    ->where('products.status', 1)
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
                $related_product_desc = DB::table('products')
                    ->where('products.cat_id', $category->cat_id)
                    ->where('products.status', 1)
                    ->inRandomOrder()
                    ->take(10)
                    ->get();

            return view('frontend.singleProduct',
                [
                    'products' => $dealer_product_1 ,
                    'rel_products' => $related_product ,
                    'rel_products_desc' => $related_product_desc ,
                    'cat_id' =>$category->cat_id,
                ]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function nextproducts($id){
        try{
            $category = DB::table('products')
                ->where('id',$id)
                ->first();
            $dealer_product_1 = DB::table('products')
              ->where('id', '>', $id)->first();
            $related_product = DB::table('products')
                ->where('products.cat_id', $category->cat_id)
                ->where('products.status', 1)
                ->inRandomOrder()
                ->take(10)
                ->get();
            $related_product_desc = DB::table('products')
                ->where('products.cat_id', $category->cat_id)
                ->where('products.status', 1)
                ->inRandomOrder()
                ->take(10)
                ->get();
            return view('frontend.singleProduct',
                [
                    'products' => $dealer_product_1 ,
                    'rel_products' => $related_product ,
                    'rel_products_desc' => $related_product_desc ,
                    'cat_id' =>$category->cat_id,
                ]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function beforeproducts($id){
        try{
            $category = DB::table('products')
                ->where('id',$id)
                ->first();
            $dealer_product_1 = DB::table('products')
              ->where('id', '<', $id)->first();
            $related_product = DB::table('products')
                ->where('products.cat_id', $category->cat_id)
                ->where('products.status', 1)
                ->inRandomOrder()
                ->take(10)
                ->get();
            $related_product_desc = DB::table('products')
                ->where('products.cat_id', $category->cat_id)
                ->where('products.status', 1)
                ->inRandomOrder()
                ->take(10)
                ->get();
            return view('frontend.singleProduct',
                [
                    'products' => $dealer_product_1 ,
                    'rel_products' => $related_product ,
                    'rel_products_desc' => $related_product_desc ,
                    'cat_id' =>$category->cat_id,
                ]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function getProductByCatId($id,  Request $request){
        try{
            $slide= DB::table('slide')
                ->orderBy('id', 'DESC')
                ->take(10)->get();
            $product_cat = DB::table('categories')
                ->where('type', 1)
                ->where('status', 1)
                ->orderBy('id', 'ASC')->get();
            $sub_cat = DB::table('subcategories')
                ->where('cat_id', $id)
                ->where('status', 1)
                ->orderBy('id', 'Asc')->get();
            if($sub_cat->count()>0){
                return view('frontend.subcategorypage',
                    [
                        'pro_categories' => $product_cat,
                        'sub_categories' => $sub_cat,
                        'slides' => $slide,

                    ]);
            }
            $dealer_product = DB::table('products')
                ->where('cat_id', $id)
                ->where('status', 1)
                ->get()->take(100);
            return view('frontend.shop',
                [
                    'products' => $dealer_product ,
                    'pro_categories' => $product_cat,
                    'slides' => $slide,
                ]);

        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function shopBySubCat(Request $request){
        try{
            $slide= DB::table('slide')
                ->orderBy('id', 'DESC')
                ->take(10)->get();
            $product_cat = DB::table('categories')
                ->where('type', 1)
                ->where('status', 1)
                ->orderBy('id', 'ASC')->get();
            $dealer_product = DB::table('products')
                ->where('products.sub_cat_id', $request->sub_cat_id)
                ->where('status', 1)
                ->inRandomOrder()->paginate(100);
            return view('frontend.shop',
                [
                    'slides' => $slide,
                    'products' => $dealer_product ,
                    'pro_categories' => $product_cat,
                ]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function shopByPrice($id){
        try{
            $slide= DB::table('slide')
                ->orderBy('id', 'DESC')
                ->take(10)->get();
            $get_price  = explode('-',$id);
            $min_price = (int)$get_price[0];
            $max_price = (int)$get_price[1];
            if($max_price == 'un')
                $max_price = 10000000;
            $product_cat = DB::table('categories')
                ->where('type', 1)
                ->where('status', 1)
                ->orderBy('id', 'ASC')->get();
            $dealer_product = DB::table('products')
                ->whereBetween('products.price',[$min_price, $max_price])
                ->where('status', 1)
                ->inRandomOrder()->paginate(100);

        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
        return view('frontend.shop',
            [
                'slides' => $slide,
                'products' => $dealer_product ,
                'pro_categories' => $product_cat,
            ]);
    }
    public function getProductBySubCatId($id, Request  $request){
        try{
            $slide= DB::table('slide')
                ->orderBy('id', 'DESC')
                ->take(10)->get();
            $product_cat = DB::table('categories')
                ->where('type', 1)
                ->where('status', 1)
                ->orderBy('id', 'ASC')->get();
            $sub_cat = DB::table('subcategories')
                ->where('id', $id)
                ->where('status', 1)
                ->orderBy('id', 'Desc')->first();
            $dealer_product = DB::table('products')
                ->where('cat_id', $sub_cat->cat_id)
                ->where('sub_cat_id', $id)
                ->where('status', 1)
                ->inRandomOrder()->paginate(100);
            return view('frontend.shop',
                [
                    'slides' => $slide,
                    'products' => $dealer_product ,
                    'pro_categories' => $product_cat,
                ]);

        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function cart(){
        try{
            if(Cookie::get('user_id') != null ) {
                $id =Cookie::get('user_id');
                $rowsCount = DB::table('carts')
                    ->where('user_id', $id)
                    ->distinct()->get()->count();
            }
            else{
                $cart_item = Session::get('cart_item');
                if(count($cart_item)>0){
                    $rowsCount = count($cart_item);
                }
                else{
                    $rowsCount =0;
                }
            }
            return view('frontend.cart', ['count' => $rowsCount]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function couponCheck(Request $request){
        if($request->coupon_code){
            $output = array();
            $total_arr = array();
            $item = array();
            $i =0;
            $c_count = 0;
            $coupon = DB::table('coupon')
                ->where('name',$request->coupon_code)
                ->whereDate('start_date', '<=', Date('y-m-d'))
                ->whereDate('end_date', '>=', Date('y-m-d'))
                ->first();
            if($coupon){
                $discount = $coupon->discount;
                if(Cookie::get('user_id') != null ) {
                    $id =Cookie::get('user_id');
                    $rowsCount = DB::table('carts')
                        ->where('user_id', $id)
                        ->distinct()->get()->count();
                    if($rowsCount > 0){
                        $user = DB::table('users')
                            ->where('id',Cookie::get('user_id'))
                            ->first();
                        if(Session::has('cart_item')){
                            foreach(Session::get('cart_item') as $row){
                                $rowsCount = DB::table('carts')
                                    ->where('user_id', Cookie::get('user_id'))
                                    ->where('product_id', $row['productid'])
                                    ->distinct()->get()->count();
                                if($rowsCount < 1){
                                    $result = DB::table('carts')->insert([
                                        'user_id' => Cookie::get('user_id'),
                                        'product_id' => $row['productid'],
                                        'quantity' => $row['quantity']
                                    ]);
                                }
                                else{
                                    $result =DB::table('carts')
                                        ->where('user_id',  Cookie::get('user_id'))
                                        ->where('product_id', $row['productid'])
                                        ->update([
                                            'quantity' => $row['quantity'],
                                        ]);
                                }
                            }
                            session()->forget('cart_item');
                        }
                        try{
                            $total = 0;
                            $customer = DB::table('users')
                                ->where('id',Cookie::get('user_id'))
                                ->first();
                            $stmt = DB::table('carts')
                                ->select('*','carts.id AS cartid')
                                ->leftJoin('products', 'products.id', '=', 'carts.product_id')
                                ->where('carts.user_id',Cookie::get('user_id'))
                                ->orderBy('products.id','Asc')
                                ->get();
                            $c_count = $stmt->count();
                            if($stmt->count() > 0) {
                                foreach ($stmt as $row) {
                                    $quantity =$row->quantity / $row->minqty;
                                    $subtotal = $row->discount_price * $quantity;
                                    $total += $subtotal;
                                    $item[] = $row->name;
                                    $item[] = $subtotal;
                                    $item[] = $quantity;
                                    $output[$i] = $item;
                                    $i++;
                                    $item = array();
                                }
                                $rows = DB::table('delivery_charges')
                                    ->where('lower','<=', $total)
                                    ->where('higher','>=', $total)
                                    ->first();
                                $delivery_charge = $rows->charge;
                                $total_arr['delivery'] = number_format($delivery_charge, 2);
                                $total_arr['s_total'] = number_format($total, 2);
                                $total_arr['g_discount'] = number_format($discount, 2);
                                $total_arr['g_total'] = number_format($total + $delivery_charge - $discount, 2);
                                Session::put('discount',$total_arr['g_discount']);
                                Session::save();
                                return view('frontend.checkout',['output'=>$output,'total' => $total_arr,'user'=>$user,'address'=>$user->address,'count'=>$c_count]);
                            }
                            else{
                                return redirect()->to('checkout')->with('errorMessage','Your Cart is empty.');
                            }

                        }
                        catch(\Illuminate\Database\QueryException $ex){
                            return back()->with('errorMessage', $ex->getMessage());
                        }
                    }
                    else{
                        return redirect()->to('checkout')->with('errorMessage','Your Cart is empty.');
                    }
                }
                else{
                    $cart_item = Session::get('cart_item');
                    if(count($cart_item) > 0){
                        $address = array();
                        $user = array();
                        $total = 0;
                        $c_count = count($cart_item);
                        foreach (Session::get('cart_item') as $row) {
                            $product = DB::table('products')
                                ->where('id', $row['productid'])
                                ->first();
                            $quantity = $row['quantity'] / $product->minqty;
                            $price = $product->discount_price;
                            $subtotal = $price * $quantity;
                            $total += $subtotal;
                            $bprice = $this->en2bn($price);
                            $item[] = $product->name;
                            $item[] = $subtotal;
                            $item[] = $quantity;
                            $output[$i] = $item;
                            $i++;
                            $item = array();
                        }
                        $rows = DB::table('delivery_charges')
                            ->where('lower','<=', $total)
                            ->where('higher','>=', $total)
                            ->first();
                        $delivery_charge = $rows->charge;
                        $total_arr['delivery'] = number_format($delivery_charge, 2);
                        $total_arr['s_total'] = number_format($total, 2);
                        $total_arr['g_discount'] = number_format($discount, 2);
                        $total_arr['g_total'] = number_format($total + $delivery_charge - $discount, 2);
                        Session::put('discount',$total_arr['g_discount']);
                        Session::save();
                        return view('frontend.checkout',['output'=>$output,'total' => $total_arr,'user'=>$user,'address'=>$address,'count'=>$c_count]);
                    }
                    else{
                        return back()->with('errorMessage','Your Cart is empty.');
                    }
                }
            }
            else{
                return back()->with('errorMessage','Coupon is expired or not found.');
            }
        }
        else{
            return back()->with('errorMessage','Coupon code not found.');
        }
    }
    public function checkout(){
        if(Cookie::get('user_id')){
            $user = DB::table('users')
                ->where('id',Cookie::get('user_id'))
                ->first();
        }
        else{
            $address = array();
            $user = array();
        }
        $output = array();
        $total_arr = array();
        $item = array();
        $i =0;
        $c_count = 0;
        if(Cookie::get('user_id') != null ){
            if(Session::has('cart_item')){
                foreach(Session::get('cart_item') as $row){
                    $rowsCount = DB::table('carts')
                        ->where('user_id', Cookie::get('user_id'))
                        ->where('product_id', $row['productid'])
                        ->distinct()->get()->count();
                    if($rowsCount < 1){
                        $result = DB::table('carts')->insert([
                            'user_id' => Cookie::get('user_id'),
                            'product_id' => $row['productid'],
                            'quantity' => $row['quantity']
                        ]);
                    }
                    else{
                        $result =DB::table('carts')
                            ->where('user_id',  Cookie::get('user_id'))
                            ->where('product_id', $row['productid'])
                            ->update([
                                'quantity' => $row['quantity'],
                            ]);
                    }
                }
                session()->forget('cart_item');
            }
            try{
                $total = 0;
                $customer = DB::table('users')
                    ->where('id',Cookie::get('user_id'))
                    ->first();
                $stmt = DB::table('carts')
                    ->select('*','carts.id AS cartid')
                    ->leftJoin('products', 'products.id', '=', 'carts.product_id')
                    ->where('carts.user_id',Cookie::get('user_id'))
                    ->orderBy('products.id','Asc')
                    ->get();
                $c_count = $stmt->count();
                if($stmt->count() > 0) {
                    foreach ($stmt as $row) {
                        $quantity =$row->quantity;
                        $subtotal = $row->discount_price * $quantity;
                        $total += $subtotal;
                        $item[] = $row->name;
                        $item[] = $subtotal;
                        $item[] = $quantity;
                        $output[$i] = $item;
                        $i++;
                        $item = array();
                    }
                    $rows = DB::table('delivery_charges')
                        ->where('lower','<=', $total)
                        ->where('higher','>=', $total)
                        ->first();
                    $delivery_charge = $rows->charge;
                    $total_arr['delivery'] = number_format($delivery_charge, 2,'.','');
                    $total_arr['s_total'] = number_format($total, 2,'.','');
                    $total_arr['g_total'] = number_format(($total + $delivery_charge), 2,'.','');
                }
                else{
                    $total_arr['delivery'] = number_format(0, 2,'.','');
                    $total_arr['s_total'] = number_format(0, 2,'.','');
                    $total_arr['g_total'] = number_format(0, 2,'.','');
                }

            }
            catch(\Illuminate\Database\QueryException $ex){
                return back()->with('errorMessage', $ex->getMessage());
            }
        }
        else {
            if(Session::get('cart_item')){
                $count= count(Session::get('cart_item'));
                $c_count = $count;
                if ($count > 0) {
                    $total = 0;
                    foreach (Session::get('cart_item') as $row) {
                        $product = DB::table('products')
                            ->where('id', $row['productid'])
                            ->first();
                        $quantity = $row['quantity'] / $product->minqty;
                        $price = $product->discount_price;
                        $subtotal = $price * $quantity;
                        $total += $subtotal;
                        $bprice = $price;
                        $item[] = $product->name;
                        $item[] = $subtotal;
                        $item[] = $quantity;
                        $output[$i] = $item;
                        $i++;
                        $item = array();
                    }
                    $rows = DB::table('delivery_charges')
                        ->where('lower','<=', $total)
                        ->where('higher','>=', $total)
                        ->first();
                    $delivery_charge = $rows->charge;
                    $total_arr['delivery'] = number_format($delivery_charge, 2,'.','');
                    $total_arr['s_total'] = number_format($total, 2,'.','');
                    $total_arr['g_total'] = number_format($total + $delivery_charge, 2,'.','');
                }
                else{

                    $total_arr['delivery'] = number_format(0, 2,'.','');
                    $total_arr['s_total'] = number_format(0, 2,'.','');
                    $total_arr['g_total'] = number_format(0, 2,'.','');
                }
            }
            else{
                $total_arr['delivery'] = number_format(0, 2,'.','');
                $total_arr['s_total'] = number_format(0, 2,'.','');
                $total_arr['g_total'] = number_format(0, 2,'.','');
            }
        }

        return view('frontend.checkout',['output'=>$output,'total' => $total_arr,'user'=>$user,'count'=>$c_count]);
    }
    public function getProductMiqty(Request $request){
        try{
            $rows = DB::table('products')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('products'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function cart_add(Request $request){
        try{
            $id = $request->id;
            $quantity = $request->quantity;
            $size = $request->size;
            if(Cookie::get('user_id') != null){
                $rowsCount = DB::table('carts')
                    ->where('user_id', Cookie::get('user_id'))
                    ->where('product_id', $id)
                    ->distinct()->get()->count();
                if($rowsCount == 0){
                    try{
                        $result = DB::table('carts')->insert([
                            'user_id' => Cookie::get('user_id'),
                            'product_id' => $id,
                            'quantity' =>$quantity,
                            'size' =>$size
                        ]);
                        if(@$request->fromWishlist == 1){
                            $result =DB::table('wishlist')
                                ->where('user_id',  Cookie::get('user_id'))
                                ->where('product_id', $request->id)
                                ->delete();
                        }
                        if(@$request->fromCompareList == 1){
                            $result =DB::table('compare')
                                ->where('user_id',  Cookie::get('user_id'))
                                ->where('product_id', $request->id)
                                ->delete();
                        }
                        $output['message'] = 'Item added to cart';

                    }
                    catch(\Illuminate\Database\QueryException $ex){
                        return back()->with('errorMessage', $ex->getMessage());
                    }
                }
                else{
                    $output['error'] = true;
                    $output['message'] = 'Product already in cart';
                }
            }
            else {
                if (!Session::has('cart_item')) {
                    Session::put('cart_item', array());
                }
                $exist = array();
                foreach (Session::get('cart_item') as $row) {
                    array_push($exist, $row['productid']);
                }
                if (in_array($id, $exist)) {
                    $output['error'] = true;
                    $output['message'] = 'Product already in cart';
                }
                else {
                    $data['productid'] = $id;
                    $data['quantity'] = $quantity;
                    $data['size'] = $size;
                    $item = Session::get('cart_item');
                    if (array_push($item, $data)) {
                        Session::put('cart_item', $item);
                        $output['message'] = 'Item added to cart';
                    }
                    else {
                        $output['error'] = true;
                        $output['message'] = 'Cannot add item to cart';
                    }
                }
            }
            return response()->json(array('output'=>$output));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public static function en2bn($number) {
        $replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        $search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        $bn_number = str_replace($search_array, $replace_array, $number);
        return $bn_number;
    }
    public function cart_fetch(Request $request){
        try{
            $output = array('list'=>'','count'=>0);
            $m_output =array();
            if(Cookie::get('user_id') != null){
                try{
                    $url = url('/') . '/';
                    $customer = DB::table('users')
                        ->where('id',Cookie::get('user_id'))
                        ->first();
                        $stmt = DB::table('carts')
                            ->select('*', 'products.name AS prodname','products.id as id')
                            ->leftJoin('products', 'products.id', '=', 'carts.product_id')
                            ->where('carts.user_id', Cookie::get('user_id'))
                            ->orderBy('products.id', 'Asc')
                            ->get();
                        $total=0;
                        foreach ($stmt as $row) {
                            $output['count']++;
                            $image = (!empty($row->photo)) ? $row->photo : 'public/asset/no_image.jpg';

                            $quantity = $row->quantity / $row->minqty;
                            $bprice = $row->discount_price;
                            $bquantity = $quantity;
                            $bsum = $row->discount_price * $quantity;
                            $total += $bsum;
                            $url = url('/') . '/';
                            $output['list'] .= '
                            <div class="product product-cart">
                                    <div class="product-detail">
                                        <a href="'.url('products/'.$row->product_id.'/'.$row->slug) .'" class="product-name">'.$row->name.'<br></a>
                                        <div class="price-box">
                                            <span class="product-quantity">'.$bquantity.'</span>
                                            <span class="product-price">'.number_format($bprice,2).'</span>
                                        </div>
                                    </div>
                                    <figure class="product-media">
                                        <a href="'.url('products/'.$row->product_id.'/'.$row->slug) .'">
                                            <img src="'. $url . $image .'" alt="product" height="84"
                                                 width="94" />
                                        </a>
                                    </figure>
                                    <button class="btn btn-link btn-close cart_delete" data-id="'.$row->product_id.'">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                        ';
                        }
                        $m_output = '
                            <div class="cart-total">
                                <label>Grand Total:</label>
                                <span class="price">'.number_format($total,2).'/-'.'</span>
                            </div>
                         ';

                }
                catch(\Illuminate\Database\QueryException $ex){
                    return back()->with('errorMessage', $ex->getMessage());
                }
            }
            else {
                if (!Session::has('cart_item')) {
                    $cart_item = array();
                    Session::put('cart_item', $cart_item);
                    $cart_item = Session::get('cart_item');
                }
                if (Session::has('cart_item') == null) {
                    $output['count'] = 0;
                }
                else {
                    $cart_item = Session::get('cart_item');
                    foreach ($cart_item as $key => $row) {
                        if ($row['productid'] == $request->id) {
                            $cart_item['quantity'] = $request->quantity;
                            $output['message'] = 'Cart Item Updated';
                            break;
                        }
                        else{
                            $output['message'] = 'Cart Item Not Updated';
                        }
                    }
                    $total=0;
                    $cart_item = Session::get('cart_item');
                    foreach ($cart_item as $row) {
                        $output['count']++;
                        $product = DB::table('products')
                            ->where('id', $row['productid'])
                            ->first();
                        $image = (!empty($product->photo)) ? $product->photo : 'public/asset/no_image.jpg';

                        $quantity = $row['quantity']/$product->minqty;
                        $bprice = $product->discount_price;
                        $bquantity = $quantity;
                        if (strpos($product->discount_price, '৳') !== false) {
                            $priceArr = explode("৳",$product->discount_price);
                            $price = (int)$priceArr[1];
                        }
                        else{
                            $price=$product->discount_price;
                        }

                        $bsum = $price * $quantity;
                        $url = url('/') . '/';
                        $total += $bsum;
                        $output['list'] .= '
                            <div class="product product-cart">
                                    <div class="product-detail">
                                        <a href="'.url('products/'.$product->id.'/'.$product->slug) .'" class="product-name">'.$product->name.'<br></a>
                                        <div class="price-box">
                                            <span class="product-quantity">'.$bquantity.'</span>
                                            <span class="product-price">'.number_format($bprice,2).'/-'.'</span>
                                        </div>
                                    </div>
                                    <figure class="product-media">
                                        <a href="'.url('products/'.$product->id.'/'.$product->slug) .'">
                                            <img src="'. $url . $image .'" alt="product" height="84"
                                                 width="94" />
                                        </a>
                                    </figure>
                                    <button class="btn btn-link btn-close cart_delete" data-id="'.$product->id.'">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                        ';
                    }
                    $m_output = '
                            <div class="cart-total">
                                <label>Grand Total:</label>
                                <span class="price">'.number_format($total,2).'/-'.'</span>
                            </div>
                         ';
                }
            }
            return response()->json(array('output'=>$output,'m_output' => $m_output));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function cart_view(Request $request){
        try{
            if(Cookie::get('user_id') != null ) {
                $id =Cookie::get('user_id');
            }else{
                $id = '';
            }
            $rowsCount = DB::table('carts')
                ->where('user_id', $id)
                ->distinct()->get()->count();

            return view('frontend.cartView', ['count' => $rowsCount]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function productQuantityChange(Request $request){
        if(Cookie::get('user_id')){
            $result =DB::table('carts')
                ->where('user_id',  Cookie::get('user_id'))
                ->where('product_id', $request->id)
                ->update([
                    'quantity' => $request->quantity,
                ]);
            $output="";
            if($result){
                $output="ok";
            }
            else{
                $output="Not ok";
            }
        }
        else{
            $cart_item = Session::get('cart_item');
            foreach ($cart_item as $key => $row) {
                if ($row['productid'] == $request->id) {
                    $cart_item[$key]['productid'] =$request->id;
                    $cart_item[$key]['quantity'] =$request->quantity;
                    $output['message'] = 'Cart Item Updated';
                    break;
                }
                else{
                    $output['message'] = 'Cart Item Not Updated';
                }
            }
            Session::put('cart_item', $cart_item);
            Session::save();
        }
        if($request->donateValue == 1){
            Session::put('donate_value', 1);
        }
        return response()->json(array('output'=>$output));
    }
    public function cart_details(Request $request){
        try{

            $output = "";
            $url =url('/').'/';
            $total_arr = array();
            if(Cookie::get('user_id') != null ){
                if(Session::has('cart_item')){
                    foreach(Session::get('cart_item') as $row){
                        $rowsCount = DB::table('carts')
                            ->where('user_id', Cookie::get('user_id'))
                            ->where('product_id', $row['productid'])
                            ->distinct()->get()->count();
                        if($rowsCount < 1){
                            $result = DB::table('carts')->insert([
                                'user_id' => Cookie::get('user_id'),
                                'product_id' => $row['productid'],
                                'quantity' => $row['quantity']
                            ]);
                            $result1 = DB::table('donate_carts')->insert([
                                'user_id' => Cookie::get('user_id'),
                                'product_id' => $row['productid'],
                                'quantity' => $row['quantity']
                            ]);
                        }
                        else{
                            $result =DB::table('carts')
                                ->where('user_id',  Cookie::get('user_id'))
                                ->where('product_id', $row['productid'])
                                ->update([
                                    'quantity' => $row['quantity'],
                                ]);
                        }
                    }
                    session()->forget('cart_item');
                }
                try{
                    $total = 0;
                    $customer = DB::table('users')
                        ->where('id',Cookie::get('user_id'))
                        ->first();
                    $stmt = DB::table('carts')
                        ->select('*','carts.id AS cartid')
                        ->leftJoin('products', 'products.id', '=', 'carts.product_id')
                        ->where('carts.user_id',Cookie::get('user_id'))
                        ->orderBy('products.id','Asc')
                        ->get();
                    if($stmt->count() > 0) {
                        foreach ($stmt as $row) {
                            $image = (!empty($row->photo)) ? $url . $row->photo : $url . 'public/asset/no_image.jpg';
                            $quantity = $row->quantity / $row->minqty;
                            $subtotal = $row->discount_price * $quantity;
                            $total += $subtotal;
                            $output .= '
                                <tr>
                                    <td class="product-thumbnail">
                                        <div class="p-relative">
                                            <a href="'.url('products/'.$row->product_id.'/'.$row->slug).'">
                                                <figure>
                                                    <img src="'.$image.'" alt="product"
                                                         width="300" height="338">
                                                </figure>
                                            </a>
                                            <button type="submit" data-id="' . $row->product_id . '" class="btn btn-close cart_delete"><i
                                                    class="fas fa-times"></i></button>
                                        </div>
                                    </td>
                                    <td class="product-name">
                                        <a href="'.url('products/'.$row->product_id.'/'.$row->slug).'">
                                            '.$row->name.'
                                        </a>
                                    </td>
                                    <td class="product-price"><span class="amount">'.number_format($row->discount_price, 2).'</span></td>
                                    <td class="product-quantity">
                                        <div class="input-group">
                                            <input name="quantity" class="form-control" data-id="'.$row->product_id.'q'.'" id="'.$row->product_id.'q'.'" type="number" min="1" max="1000" value="'.$row->quantity.'" readonly>
                                            <button id="add" class="quantity-plus w-icon-plus" data-id="'.$row->product_id.'"></button>
                                            <button id="minus" class="quantity-minus w-icon-minus" data-id="'.$row->product_id.'"></button>
                                        </div>
                                    </td>
                                    <td class="product-subtotal">
                                        <span class="amount">'.number_format($subtotal, 2).'</span>
                                    </td>
                                </tr>
                        ';
                        }
                        $total_arr['g_total'] =number_format($total, 2, '.', '');
                    }
                    else{
                        $output .= '
                        <tr>
                            <td class="product-subtotal" colspan="7" align="center">Shopping cart empty</td>
                        <tr>
                    ';
                        $total_arr['g_total'] =number_format(0, 2, '.', '');
                    }

                }
                catch(\Illuminate\Database\QueryException $ex){
                    return back()->with('errorMessage', $ex->getMessage());
                }
            }
            else {
                if(Session::get('cart_item')){
                    $count = count(Session::get('cart_item'));
                    if ($count > 0) {
                        $total = 0;
                        foreach (Session::get('cart_item') as $row) {
                            $product = DB::table('products')
                                ->where('id', $row['productid'])
                                ->first();
                            $image = (!empty($product->photo)) ? $url . $product->photo : $url . 'public/asset/no_image.jpg';
                            $quantity = $row['quantity'] / $product->minqty;
                            $price = $product->discount_price;
                            $subtotal = $price * $quantity;
                            $total += $subtotal;
                            $bprice = $price;
                            $output .= '
                                <tr>
                                    <td class="product-thumbnail">
                                        <div class="p-relative">
                                            <a href="' . url('products/'.$product->id.'/'.$product->slug) . '">
                                                <figure>
                                                    <img src="' . $image . '" alt="product"
                                                         width="300" height="338">
                                                </figure>
                                            </a>
                                            <button type="submit" data-id="' . $product->id . '" class="btn btn-close cart_delete"><i
                                                    class="fas fa-times"></i></button>
                                        </div>
                                    </td>
                                    <td class="product-name">
                                        <a href="' . url('products/'.$product->id.'/'.$product->slug) . '">
                                            ' . $product->name . '
                                        </a>
                                    </td>
                                    <td class="product-price"><span class="amount">' . number_format($product->discount_price, 2) . '</span></td>
                                    <td class="product-quantity">
                                        <div class="input-group">
                                            <input name="quantity" class="form-control" data-id="'.$product->id.'q'.'" id="'.$product->id.'q'.'" type="number" min="1" max="100000" value="' . $row['quantity']. '" readonly>
                                            <button class="quantity-plus w-icon-plus" data-id="'.$product->id.'"></button>
                                            <button class="quantity-minus w-icon-minus" data-id="'.$product->id.'"></button>
                                        </div>
                                    </td>
                                    <td class="product-subtotal">
                                        <span class="amount">' . number_format($subtotal, 2)  . '</span>
                                    </td>
                                </tr>
                        ';
                        }
                        $total_arr['g_total'] =number_format($total, 2, '.', '');
                    }
                    else{
                        $output .= '
                            <tr>
                                <td class="product-subtotal" colspan="7" align="center">Shopping cart empty</td>
                            <tr>
                        ';

                        $total_arr['g_total'] =number_format(0, 2, '.', '');
                    }
                }
                else{
                    $output .= '
                        <tr>
                            <td class="product-subtotal" colspan="7" align="center">Shopping cart empty</td>
                        <tr>
                    ';
                    $total_arr['g_total'] =number_format(0, 2, '.', '');
                }
            }
            Session::put('total_bill', $total_arr['g_total']);
            Session::save();
            return response()->json(array('output'=>$output, 'total'=>$total_arr));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function cart_delete(Request $request){
        try{
            $output = array('error'=>false);
            $id = $request->id;
            if(Cookie::get('user_id') != null ){
                try{
                    $results = DB::table('carts')->where('user_id', Cookie::get('user_id'))->where('product_id', $id)->delete();
                    if($results){
                        $output['message'] = 'Cart Item Deleted';
                    }
                    else{
                        $output['message'] = 'Cart Item Not Deleted';
                    }
                }
                catch(\Illuminate\Database\QueryException $ex){
                    return back()->with('errorMessage', $ex->getMessage());
                }
            }
            else {
                $cart_item = Session::get('cart_item');
                foreach ($cart_item as $key => $row) {
                    if ($row['productid'] == $id) {
                        unset($cart_item[$key]);
                        $output['message'] = 'Cart Item Deleted';
                    }
                    else{
                        $output['message'] = 'Cart Item Not Deleted';
                    }
                }
                Session::put('cart_item', $cart_item);
            }
            return response()->json(array('output' => $output));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function clear_cart(Request $request){
        try{
            $output = array('error'=>false);
            $id = $request->value;
            if(Cookie::get('user_id') != null ){
                try{
                    $results = DB::table('carts')->where('user_id', Cookie::get('user_id'))->delete();
                    if($results){
                        $output['message'] = 'Cart Item Cleared';
                    }
                    else{
                        $output['message'] = 'Cart Item Not Cleared';
                    }
                }
                catch(\Illuminate\Database\QueryException $ex){
                    return back()->with('errorMessage', $ex->getMessage());
                }
            }
            else {
                $cart_item = Session::get('cart_item');
                Session::forget('cart_item');
                Session::flush();
                Session::save();
                $output['message'] = 'Cart Item Cleared';
            }
            return response()->json(array('output' => $output));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function sales(Request $request){
        try{
            $phone = $request->phone;
            $email = $request->eeemail;
            $rows = DB::table('users')
                ->where('phone', $phone)
                ->orWhere('email', $email)
                ->get()->count();
            if ($rows > 0) {
                return redirect('checkout')->with('errorMessage', 'User Already Exits. Please Log In!');
            }
            if(Session::get('discount'))
                $discount = Session::get('discount');
            else
                $discount = 0;
            $order_details = Session::get('order_details');
            $dif_add = @$request->dif_add;
            $name = @$request->name;
            $phone = @$request->phone;
            $email = @$request->eeemail;
            $password = @$request->password;
            $address = @$request->address;
            $order_notes = @$request->order_notes;
            $total = 0;
            $date = date('Y-m-d');
            $tx_id = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(16/strlen($x)) )),1,16);
            if($request->bkash ==  'Bkash'){
                $payment_method = $request->bkash;
                $payment_number = $request->phone1;
                $payment_tx = $request->bkashTx;
            }
            elseif($request->rocket == "Rocket"){
                $payment_method = $request->rocket;
                $payment_number = $request->phone2;
                $payment_tx = $request->rocketTx;
            }
            elseif($request->nagad == 'Nagad'){
                $payment_method = $request->nagad;
                $payment_number = $request->phone3;
                $payment_tx = $request->nagadTx;
            }
            else{
                $payment_method = 'cash';
                $payment_number = 'cash';
                $payment_tx = 'cash';
            }
            if(Cookie::get('user_id')){
                $user_info = DB::table('users')
                    ->select('*')
                    ->where('id', Cookie::get('user_id'))
                    ->first();
                if($dif_add){
                    $name = @$order_details['name'];
                    $phone = @$order_details['phone'];
                    $email = @$order_details['eeemail'];
                    $address = @$order_details['address'];
                }
                else{
                    $name = $user_info->name;
                    $email = $user_info->email;
                    $phone = $user_info->phone;
                    $address = $user_info->address;
                }
                $result = DB::table('v_assign')->insert([
                    'user_id' => Cookie::get('user_id'),
                    'pay_id' => $tx_id,
                    'sales_date' => $date
                ]);
                $salesid = DB::getPdo()->lastInsertId();
                $stmt = DB::table('carts')
                    ->select('*','carts.id AS cartid','carts.size as c_size')
                    ->leftJoin('products', 'products.id', '=', 'carts.product_id')
                    ->where('carts.user_id',Cookie::get('user_id'))
                    ->orderBy('products.id','Asc')
                    ->get();

                foreach($stmt as $row){
                    $result = DB::table('details')->insert([
                        'sales_id' => $salesid,
                        'product_id' => $row->product_id,
                        'quantity' => $row->quantity,
                        'price' => $row->discount_price,
                        'size' => $row->c_size
                    ]);
                    $total = $total + (int)$row->discount_price;
                }
                $product_cart = DB::table('carts')
                    ->select('*')
                    ->where('user_id', Cookie::get('user_id'))
                    ->first();
                DB::table('carts')->where('user_id',  Cookie::get('user_id'))->delete();
                $user_type = 2;
                $data = array(
                    'userName'=> $user_info->name,
                    'data' => $stmt,
                    'tx_id' => $tx_id,
                );
                $salesEmail = 'sales@under-garments.xyz';
                $emails = [$email];
//                Mail::send('frontend.salesEmailFormat',$data, function($message) use($emails,$salesEmail,$name,$phone) {
//                    $message->to($emails)->subject('Order List From Under-garments.xyz by '.$name.' ('.$phone. ' )');
//                    $message->from(''.$salesEmail.'','Under-garments.xyz');
//                });
                $rows = DB::table('delivery_charges')
                    ->where('lower','<=', $total)
                    ->where('higher','>=', $total)
                    ->first();
                $delivery_charge = $rows->charge;
                $data = [
                    [   'user_id' => Cookie::get('user_id'),
                        'tx_id' => $tx_id,
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                        'address' => $address,
                        'd_address' => $request->d_address,
                        'order_notes' => $order_notes,
                        'user_type' => 2,
                        'total' => ((int)$total  + (int)$delivery_charge - (int)$discount)+((int)$total  + (int)$delivery_charge - (int)$discount)*.02,
                        'discount' => (int)$discount,
                        'delivery_charge' => (int)$delivery_charge,
                        'gateway_charge' => ((int)$total  + (int)$delivery_charge - (int)$discount)*.02,
                        'payment_method' => $payment_method,
                        'payment_number' => $payment_number,
                        'payment_tx' => $payment_tx,
                        'paid' => ((int)$total  + (int)$delivery_charge - (int)$discount),
                    ],
                ];
                $result = DB::table('order_details')->insert($data);
                if($result){
                    Session::forget('discount');
                    Session::save();
                    return redirect()->to('myProductOrder')->with('successMessage', 'Your Order is received and processing.');
                }
                else{
                    return redirect()->to('myProductOrder')->with('errorMessage', 'Please Try Again!!');
                }

            }
            else {
                $result = DB::table('v_assign')->insert([
                    'user_id' => 0,
                    'pay_id' => $tx_id,
                    'sales_date' => $date
                ]);
                $salesid = DB::getPdo()->lastInsertId();
                $total = 0;
                foreach (Session::get('cart_item') as $row) {
                    $product = DB::table('products')
                        ->where('id', $row['productid'])
                        ->first();
                    $quantity = $row['quantity'] / $product->minqty;
                    $price = $product->discount_price;
                    $subtotal = $price * $quantity;
                    $total += $subtotal;
                    $result = DB::table('details')->insert([
                        'sales_id' => $salesid,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $product->discount_price,
                        'size' =>$row['size']
                    ]);
                }
                $rows = DB::table('delivery_charges')
                    ->where('lower','<=', $total)
                    ->where('higher','>=', $total)
                    ->first();
                $delivery_charge = $rows->charge;
                $total = $total + $delivery_charge;
                $data = [
                    [   'user_id' => 0,
                        'tx_id' => $tx_id,
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                        'address' => $address,
                        'd_address' => $request->d_address,
                        'order_notes' => $order_notes,
                        'user_type' => 2,
                        'total' => $total + $total*.02,
                        'discount' => 0,
                        'delivery_charge' => $delivery_charge,
                        'gateway_charge' => $total*.02,
                        'payment_method' => $payment_method,
                        'payment_number' => $payment_number,
                        'payment_tx' => $payment_tx,
                        'paid' => ((int)$total  + (int)$delivery_charge - (int)$discount),
                    ],
                ];
                $result = DB::table('order_details')->insert($data);
                $password = Hash::make($password);
                $result = DB::table('users')->insert([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'phone' => $phone,
                    'user_type' => 2,
                    'status' => 1,
                    'address' =>$address,
                ]);
                if($result){
//                    $data = array(
//                        'userName'=> $name,
//                        'data' => $stmt,
//                        'tx_id' => $tx_id,
//                    );
//                    $salesEmail = 'sales@under-garments.xyz';
//                    $emails = [$email];
//                    Mail::send('frontend.salesEmailFormat',$data, function($message) use($emails,$salesEmail,$name,$phone) {
//                        $message->to($emails)->subject('Order List From Under-garments.xyz by '.$name.' ('.$phone. ' )');
//                        $message->from(''.$salesEmail.'','Under-garments.xyz');
//                    });
                    Session::forget('cart_item');
                    Session::save();
                    return view('frontend.orderComplete');
                }
                else{
                    return redirect()->to('homepage')->with('errorMessage', 'Please Try Again!!');
                }
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function getAllSaleCategory(Request $request){
        try{
            $rows = DB::table('categories')
                ->where('id', 6)
                ->get();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function searchProduct(Request $request){
        try{
            $slide= DB::table('slide')
                ->orderBy('id', 'DESC')
                ->take(10)->get();
            if($request->search)
                $search = $request->search;
            if($request->mbSearch)
                $search = $request->mbSearch;
            $service_cat = DB::table('categories')
                ->where('type', 2)
                ->where('status', 1)
                ->orderBy('id', 'DESC')->get();
            $product_cat = DB::table('categories')
                ->where('type', 1)
                ->where('status', 1)
                ->orderBy('id', 'ASC')->get();
            $dealer_product = DB::table('products')
                ->where('name', 'LIKE','%'.$search.'%')
                ->where('status', 1)
                ->orderBy('id', 'ASC')->paginate(100);
            if($dealer_product->count()>0){
                $dealer_status['status'] = 0;
                return view('frontend.shop', ['products' => $dealer_product,'slides' => $slide,'pro_categories' => $product_cat, 'ser_categories' => $service_cat]);
            }
            else{
                return redirect()->to('shop')->with('errorMessage', 'No Product Found.');
            }


        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function getProductSearchByName(Request $request){
        try{
            if($request->val){
                $products = DB::table('products')
                    ->where('name', 'like', '%' . $request->val . '%')
                    ->where('status', 1)
                    ->get();
                if($products->count() > 0){
                    $output = '<ul class="menu" style="display:block; margin-top: -30px;>';
                    foreach ($products as $row) {
                        $output .= '
                   <li><a href="#">' . $row->name . '</a></li>
                   ';
                    }
                    $output .= '</ul>';
                }
                else{
                    $output = '';
                }
            }
            else{
                $output = '';
            }
            return response()->json(array('data'=>$output));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function getProductSearchDesktopByName(Request $request){
        try{
            $output = array();
            if($request->val){
                $products = DB::table('products')
                    ->where('name', 'like', '%' . $request->val . '%')
                    ->where('status', 1)
                    ->get();
                if($products->count() > 0){
                    foreach ($products as $row) {
                        $output[] = $row->name;
                    }
                }
                else{
                    $output[] = "No item found!";
                }
            }
            else{
                $output[] = "No item found!";
            }
            return response()->json(array('data'=>$output));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function  getSubcategoryByCat(Request $request){
        try{

            $rows = DB::table('subcategories')->where('cat_id', $request->id)->get();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function  wishlist(Request $request){
        try{
            if(Cookie::get('user_id')){
                $stmt = DB::table('wishlist')
                    ->select('*','wishlist.id AS w_id')
                    ->leftJoin('products', 'products.id', '=', 'wishlist.product_id')
                    ->where('wishlist.user_id',Cookie::get('user_id'))
                    ->orderBy('products.id','Asc')
                    ->get();
                if(count($stmt)>0){
                    $count = 1;
                    return view('frontend.wishlist',['products'=>$stmt,'count'=> $count]);
                }
                else{
                    $count = 0;
                    return view('frontend.wishlist',['products'=>$stmt,'count'=> $count]);
                }
            }
            else{
                return redirect('signup');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function  compare(Request $request){
        try{
            if(Cookie::get('user_id')){
                $stmt = DB::table('compare')
                    ->select('*','compare.id AS c_id')
                    ->leftJoin('products', 'products.id', '=', 'compare.product_id')
                    ->where('compare.user_id',Cookie::get('user_id'))
                    ->orderBy('products.id','Asc')
                    ->get();
                if(count($stmt)>0){
                    $count = 1;
                    return view('frontend.compare',['products'=>$stmt,'count'=> $count]);
                }
                else{
                    $count = 0;
                    return view('frontend.compare',['products'=>$stmt,'count'=> $count]);
                }
            }
            else{
                return redirect('signup');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function  add_wishlist(Request $request){
        try{
            if(Cookie::get('user_id')){
                $id = $request->id;
                $rowsCount = DB::table('wishlist')
                    ->where('user_id', Cookie::get('user_id'))
                    ->where('product_id', $id)
                    ->distinct()->get()->count();
                if($rowsCount < 1){
                    try{
                        $result = DB::table('wishlist')->insert([
                            'user_id' => Cookie::get('user_id'),
                            'product_id' => $id,
                        ]);
                        $data = 1;
                        return response()->json(array('data'=>$data));
                    }
                    catch(\Illuminate\Database\QueryException $ex){
                        return back()->with('errorMessage', $ex->getMessage());
                    }
                }
                else{
                    $data = 2;
                    return response()->json(array('data'=>$data));
                }
            }
            else{
                $data = 0;
                return response()->json(array('data'=>$data));
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function  add_comparelist(Request $request){
        try{
            if(Cookie::get('user_id')){
                $id = $request->id;
                $rowsCount = DB::table('compare')
                    ->where('user_id', Cookie::get('user_id'))
                    ->where('product_id', $id)
                    ->distinct()->get()->count();
                if($rowsCount < 1){
                    try{
                        $result = DB::table('compare')->insert([
                            'user_id' => Cookie::get('user_id'),
                            'product_id' => $id,
                        ]);
                        $data = 1;
                        return response()->json(array('data'=>$data));
                    }
                    catch(\Illuminate\Database\QueryException $ex){
                        return back()->with('errorMessage', $ex->getMessage());
                    }
                }
                else{
                    $data = 2;
                    return response()->json(array('data'=>$data));
                }
            }
            else{
                $data = 0;
                return response()->json(array('data'=>$data));
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function clear_cart_wishlist(Request $request){
        try{
            try{
                $results = DB::table('wishlist')->where('user_id', Cookie::get('user_id'))->delete();
                if($results){
                    $output['message'] = 'Wishlist Item Cleared';
                }
                else{
                    $output['message'] = 'Wishlist Item Not Cleared';
                }
            }
            catch(\Illuminate\Database\QueryException $ex){
                return back()->with('errorMessage', $ex->getMessage());
            }
            return response()->json(array('output' => $output));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function clear_cart_compare(Request $request){
        try{
            try{
                $results = DB::table('compare')->where('user_id', Cookie::get('user_id'))->delete();
                if($results){
                    $output['message'] = 'Compare Item Cleared';
                }
                else{
                    $output['message'] = 'Compare Item Not Cleared';
                }
            }
            catch(\Illuminate\Database\QueryException $ex){
                return back()->with('errorMessage', $ex->getMessage());
            }
            return response()->json(array('output' => $output));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function wishlist_delete(Request $request){
        try{
            $output = array('error'=>false);
            $id = $request->id;
            if(Cookie::get('user_id') != null ){
                try{
                    $results = DB::table('wishlist')->where('user_id', Cookie::get('user_id'))->where('product_id', $id)->delete();
                    if($results){
                        $output['message'] = 'Wishlist Item Deleted';
                    }
                    else{
                        $output['message'] = 'Wishlist Item Not Deleted';
                    }
                }
                catch(\Illuminate\Database\QueryException $ex){
                    return back()->with('errorMessage', $ex->getMessage());
                }
            }
            return response()->json(array('output' => $output));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function compare_delete(Request $request){
        try{
            $output = array('error'=>false);
            $id = $request->id;
            if(Cookie::get('user_id') != null ){
                try{
                    $results = DB::table('compare')->where('user_id', Cookie::get('user_id'))->where('product_id', $id)->delete();
                    if($results){
                        $output['message'] = 'Compare Item Deleted';
                    }
                    else{
                        $output['message'] = 'Compare Item Not Deleted';
                    }
                }
                catch(\Illuminate\Database\QueryException $ex){
                    return back()->with('errorMessage', $ex->getMessage());
                }
            }
            return response()->json(array('output' => $output));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function  newsletter_email_insert(Request $request){
        try{
            try{
                $email = $request->id;
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $data = 3;
                    return response()->json(array('data'=>$data));
                }
                $rowsCount = DB::table('newsletter_email')
                    ->where('email', $request->id)
                    ->distinct()->get()->count();
                if($rowsCount<1){
                    $result = DB::table('newsletter_email')->insert([
                        'email' => $request->id,
                    ]);
                    if($result){
                        $data = 1;
                    }
                    else{
                        $data=0;
                    }
                }
                else{
                    $data=2;
                }
                return response()->json(array('data'=>$data));
            }
            catch(\Illuminate\Database\QueryException $ex){
                return back()->with('errorMessage', $ex->getMessage());
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function getProductOnScroll(Request $request){
        try{
            try{
                $id = $request->id;
                $in_id = $id*10;
                if($request->part4 == 'shop'){
                    $results = DB::table('products')->skip($in_id)->take(10)->get();
                }
                if($request->part4 == 'shop-by-cat'){
                    $results = DB::table('products')->where('cat_id', $request->part5)->skip($in_id)->take(10)->get();
                }
                if($request->part4 == 'shop-by-subCat'){
                    $sub_cat = DB::table('subcategories')
                        ->where('id', $request->part5)
                        ->where('status', 1)
                        ->orderBy('id', 'Desc')->first();
                    $results = DB::table('products')
                        ->where('cat_id', $sub_cat->cat_id)
                        ->where('sub_cat_id', $request->part5)
                        ->where('status', 1)
                        ->skip($in_id)->take(10)->get();
                }
                return response()->json(array('data'=>$results,'id' =>$id));
            }
            catch(\Illuminate\Database\QueryException $ex){
                return back()->with('errorMessage', $ex->getMessage());
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
}
