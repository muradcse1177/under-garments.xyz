<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class SmsController extends Controller
{
    public function datascrap( Request $request)
    {
//        $rowss = DB::table('products')->where('cat_id', 29)->where('sub_cat_id', 108)->get();
//        foreach ($rowss as $rows){
//            $upload_by = $rows->upload_by;
//            $name = $rows->name;
//            $cat_id = $rows->cat_id;
//            $sub_cat_id = 115;
//            $type = $rows->type;
//            $description = $rows->description;
//            $specification = $rows->description;
//            $price = $rows->price;
//            $discount_price = $rows->discount_price;
//            $unit = $rows->unit;
//            $minqty = $rows->minqty;
//            $photo = $rows->photo;
//            $slider = $rows->slider;
//            $status = 1;
//            $slug = $rows->slug;
//            $meta_description = $rows->meta_description;
//            $meta_key = $rows->meta_key;
//            $sku = $rows->sku;
//            $result = DB::table('products')->insert([
//                'upload_by' => $upload_by,
//                'name' =>  $name,
//                'cat_id' => $cat_id,
//                'sub_cat_id' => $sub_cat_id,
//                'company' => '',
//                'type' => $type,
//                'description' => $description,
//                'specification' => $description,
//                'price' => $price,
//                'discount_price' => $discount_price,
//                'unit' => $unit,
//                'minqty' => $minqty,
//                'photo' => $photo,
//                'slider' => $slider,
//                'status' => '1',
//                'slug' => $slug,
//                'meta_description' => $description,
//                'meta_key' => $meta_key,
//                'sku' => $sku,
//            ]);
//        }
//        dd($rows);
        require 'simple_html_dom.php';
        $url = $request->url;
        $slug = basename($url);

        $html = file_get_html($url);

        $description = $html->find( "meta[name=description]" );
        $description = $description[0]->content;

        $key = $html->find( "meta[name=keywords]" );
        $key = $key[0]->content;

        $image_url = $html->find("meta[property=og:image]" );
        $image_name =  basename($image_url[0]->content);
        $url =  $image_url[0]->content;
        $content = file_get_contents($url);
        file_put_contents('public/asset/images/'.$image_name, $content);
        $image       = 'public/asset/images/'.$image_name;
        $filename    = 'thumbnail'.'.'.$image_name;
        $image_resize = Image::make('public/asset/images/'.$image_name);
        $image_resize->resize(300, 338);
        $image_resize->save(public_path('/asset/images/'.$filename));

        $category = 40;

        $subcategory = 107;

        $uploadedby = 1;

        $unit = 'pc';

        $minqty = 1;

        $photo = 'public/asset/images/'.$filename;

        $type = "Condom";

        $slider = 'public/asset/images/'.$image_name.',';

        $product_name_array = $html->find("h1[class=product-title product_title entry-title]");
        $product_name = $product_name_array[0]->plaintext;

        $sku = $product_name;

        $product_price_array_1 = $html->find('p[class=price product-page-price price-on-sale]');
        if(@$product_price_array_1[0])
            $original_price_text = $product_price_array_1[0]->plaintext;
        else{
            $product_price_array_1 = $html->find('p[class=price product-page-price price-on-sale price-not-in-stock]');
            $original_price_text = $product_price_array_1[0]->plaintext;
        }
        $original_price_array = explode(' ',$original_price_text);
        if(@$original_price_array[2]) {
            $hazar_array = explode(',', $original_price_array[2]);
            if(@$hazar_array[1]){
                $original_price =  (int)($hazar_array[0].$hazar_array[1]);
            }
            else
                $original_price = (int)$original_price_array[2];
        }
        else
            $original_price = 500;

        if(@$original_price_array[5]) {
            $hazar_array = explode(',', $original_price_array[5]);
            if (@$hazar_array[1]) {
                $discounted_price = (int)($hazar_array[0] . $hazar_array[1]);
            }
            else
                $discounted_price = (int)$original_price_array[5];
        }
        else
            $discounted_price = $original_price;

        $result = DB::table('products')->insert([
            'upload_by' => $uploadedby,
            'name' =>  $product_name,
            'cat_id' => $category,
            'sub_cat_id' => $subcategory,
            'company' => '',
            'type' => $type,
            'description' => $description,
            'specification' => $description,
            'price' => $original_price,
            'discount_price' => $discounted_price,
            'unit' => $unit,
            'minqty' => $minqty,
            'photo' => $photo,
            'slider' => json_encode($slider),
            'status' => '1',
            'slug' => $slug,
            'meta_description' => $description,
            'meta_key' => $key,
            'sku' => $sku,
        ]);
        if($result){
            return back()->with('successMessage', 'You have done successfully!!');
        }
        else{
            return back()->with('errorMessage', 'Please Try Again!!');
        }
    }
    public function datascrapForm(){
        return view('backend.datascrapForm');
    }
    public function sms(){
        return view('backend.sms');
    }
    public function smsSend(Request $request){
        $url = "http://66.45.237.70/api.php";
        $number=$request->phone;
        $text=$request->msg;
        $data= array(
            'username'=>"01929877307",
            'password'=>"murad1107053",
            'number'=>"$number",
            'message'=>"$text"
        );

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        $p = explode("|",$smsresult);
        $sendstatus = $p[0];
        if($sendstatus){
            $phones = explode(',',$request->phone);
            foreach ($phones as $phone){
                $result = DB::table('smslog')->insert([
                    'number' => $phone,
                    'msg' => $request->msg,
                ]);
            }
            if ($result) {
                return back()->with('successMessage', 'You have done successfully!!');
            } else {
                return back()->with('errorMessage', 'Please Try Again!!');
            }
        }
    }
}
