<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use smasif\ShurjopayLaravelPackage\ShurjopayService;

class PaymentController extends Controller
{
   public function getPaymentCartView(Request $request){
       $phone = $request->phone;
       $email = $request->eeemail;
       $rows = DB::table('users')
           ->where('phone', $phone)
           ->orWhere('email', $email)
           ->get()->count();
       if ($rows > 0) {
           return redirect('cart')->with('errorMessage', 'User Already Exits. Please Try Again!!');
       }
       Session::put('order_details',$request->all());
       if($request->cash == 'cash' || $request->bank == 'bank') {
           if($request->cash == 'cash')
               $method = $request->cash;
           if($request->bank == 'bank')
               $method = $request->bank;
           return redirect('sales?status='.$method);
       }
       if(Cookie::get('user_id')){
           $customer = DB::table('users')
               ->where('id',Cookie::get('user_id'))
               ->first();
           $stmt = DB::table('carts')
               ->select('*','carts.id AS cartid')
               ->leftJoin('products', 'products.id', '=', 'carts.product_id')
               ->where('carts.user_id',Cookie::get('user_id'))
               ->orderBy('products.id','Asc')
               ->get();
           $total =0;
           if($stmt->count() > 0) {
               foreach ($stmt as $row) {
                   $quantity = $row->quantity / $row->minqty;
                   $subtotal = $row->price * $quantity;
                   $total += $subtotal;
               }
           }
           $rows = DB::table('delivery_charges')
               ->where('lower','<=', $total)
               ->where('higher','>=', $total)
               ->first();
           $delivery_charge = $rows->charge;
           $Total = $total+$delivery_charge;

       }
       else{
           return redirect('sales?status=temp_user');
       }
       $shurjopay_service = new ShurjopayService();
       $tx_id = $shurjopay_service->generateTxId();
       $success_route = url('sales');
       $shurjopay_service->sendPayment($Total, $success_route);
   }
}
