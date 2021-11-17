<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{
    function en2bn($number) {
        $replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        $search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        $bn_number = str_replace($search_array, $replace_array, $number);
        return $bn_number;
    }
    public function salesReport (Request $request){
        try {
            $order_details = DB::table('order_details')->orderBy('id','desc')->get();
            $i=0;
            $sum = 0;
            $paidSum = 0;
            $dueSum = 0;
            $taxSum = 0;
            $discountSum = 0;
            $gatewaySum = 0;
            $orderArr = array();
            foreach($order_details as $order){
                if($order->user_id == 0){
                    $orderArr[$i]['user_id'] = 0;
                }
                else {
                    $row = DB::table('v_assign')
                        ->where('pay_id', $order->tx_id)
                        ->orderBy('sales_date', 'Desc')
                        ->first();
                    if ($row) {
                        $orderArr[$i]['user_id'] = $row->user_id;

                    }
                }
                $date = explode(' ',$order->created_at);
                $orderArr[$i]['sales_date'] = $date[0];
                $orderArr[$i]['name'] = $order->name;
                $orderArr[$i]['phone'] = $order->phone;
                $orderArr[$i]['address'] = $order->address;
                $orderArr[$i]['payment_method'] = $order->payment_method;
                $orderArr[$i]['payment_number'] = $order->payment_number;
                $orderArr[$i]['pay_id'] = $order->payment_tx;
                $orderArr[$i]['amount'] =  $order->total;
                $orderArr[$i]['status'] = @$order->status;
                $orderArr[$i]['sales_id'] = $order->tx_id;
                $orderArr[$i]['id'] = $order->id;
                $orderArr[$i]['order_notes'] = $order->order_notes;
                $orderArr[$i]['discount'] = $order->discount;
                $orderArr[$i]['gateway_charge'] = $order->gateway_charge;
                $orderArr[$i]['tax'] = $order->tax;
                $orderArr[$i]['paid'] = $order->paid;
                $orderArr[$i]['due'] = $order->due;
                $sum  += $orderArr[$i]['amount'];
                $paidSum  += $orderArr[$i]['paid'];
                $dueSum  += $orderArr[$i]['due'];
                $taxSum  += $orderArr[$i]['tax'];
                $discountSum  += $orderArr[$i]['discount'];
                $gatewaySum  += $orderArr[$i]['gateway_charge'];
                $i++;
            }
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($orderArr);
            $perPage = 20;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
            $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
            $paginatedItems->setPath($request->url());
            return view('backend.sales', ['orders' => $paginatedItems,'sum' => $sum,'paidSum' => $paidSum,'dueSum' => $dueSum,'taxSum' => $taxSum,'discountSum' => $discountSum,'gatewaySum' => $gatewaySum]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function changeOrderStatus(Request $request){
        try{
            if($request->id) {
                $id = explode('&',$request->id);
                $result =DB::table('order_details')
                    ->where('tx_id', $id[1])
                    ->update([
                        'status' =>  $id[0],
                    ]);
                if ($result) {
                    Session::flash('successMessage', 'You have done successfully!!');
                    return response()->json(array('data'=>$result));
                } else {
                    Session::flash('errorMessage', 'Please Try Again!!');
                    return response()->json(array('data'=>$result));
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
    public function changeCustomOrderStatus(Request $request){
        try{
            if($request->id) {
                $id = explode('&',$request->id);
                if($id[0] == 'Delivered'){
                    $result =DB::table('custom_order_booking')
                        ->where('id', $id[1])
                        ->update([
                            'status' =>  $id[0],
                        ]);
                }
                else{
                    $result =DB::table('custom_order_booking')
                        ->where('id', $id[1])
                        ->update([
                            'status' =>  $id[0],
                        ]);
                }

                if ($result) {
                    Session::flash('successMessage', 'You have done successfully!!');
                    return response()->json(array('data'=>$result));
                } else {
                    Session::flash('errorMessage', 'Please Try Again!!');
                    return response()->json(array('data'=>$result));
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
    public function getProductSalesOrderListByDate (Request $request){
        try{
            $order_details = DB::table('order_details') ->whereBetween('created_at',array($request->from_date,$request->to_date))->orderBy('id','desc')->get();
            $i=0;
            $sum = 0;
            $orderArr = array();
            foreach($order_details as $order){
                if($order->user_id == 0){
                    $date = explode(' ',$order->created_at);
                    $orderArr[$i]['sales_date'] = $date[0];
                    $orderArr[$i]['name'] = $order->name;
                    $orderArr[$i]['phone'] = $order->phone;
                    $orderArr[$i]['address'] = $order->address;
                    $orderArr[$i]['pay_id'] = $order->tx_id;
                    $orderArr[$i]['amount'] =  $order->total;
                    $orderArr[$i]['user_id'] = 0;
                    $orderArr[$i]['status'] = @$order->status;
                    $orderArr[$i]['sales_id'] = $order->tx_id;
                }
                else {
                    $row = DB::table('v_assign')
                        ->where('pay_id', $order->tx_id)
                        ->orderBy('sales_date', 'Desc')
                        ->first();
                    if ($row) {
                        $date = explode(' ',$order->created_at);
                        $orderArr[$i]['sales_date'] = $date[0];
                        $orderArr[$i]['name'] = $order->name;
                        $orderArr[$i]['phone'] = $order->phone;
                        $orderArr[$i]['address'] = $order->address;
                        $orderArr[$i]['pay_id'] = $order->tx_id;
                        $orderArr[$i]['amount'] = $order->total;
                        $orderArr[$i]['user_id'] = $row->user_id;
                        $orderArr[$i]['status'] = $order->status;
                        $orderArr[$i]['sales_id'] = $order->tx_id;
                    }
                }
                $sum  += $orderArr[$i]['amount'];
                $i++;
            }
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($orderArr);
            $perPage = 20;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
            $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
            $paginatedItems->setPath($request->url());
            return view('backend.sales', ['orders' => $paginatedItems,'sum' => $this->en2bn($sum).'/-','from_date'=>$request->from_date,'to_date'=>$request->to_date]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function productur(Request  $request){
        try{
            $rows = DB::table('products')
                ->select('*','products.id as p_id','products.name as p_name','users.name as u_name')
                ->join('users','users.id','=','products.upload_by')
                ->where('users.user_type',4)
                ->paginate(50);
            return view('backend.productur',['products' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function accountName (){
        try{
            $row = DB::table('account_name')
                ->paginate(20);
            return view('backend.accountName', ['accountings' => $row]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function accountHead (){
        try{
            $row = DB::table('account_head')
                ->select('*','account_head.id as h_id')
                ->join('account_name','account_name.id','=','account_head.name_id')
                ->paginate(20);
            $name = DB::table('account_name')
                ->get();
            return view('backend.accountHead', ['accountings' => $row,'names' => $name]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function insertAccountName(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('account_name')
                        ->where('id', $request->id)
                        ->update([
                            'name' => $request->name,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'You have done successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again!!');
                    }
                }
                else {
                    $rows = DB::table('account_name')
                        ->select('id')
                        ->where([
                            ['name', '=', $request->name],
                        ])
                        ->distinct()->get()->count();
                    if ($rows > 0) {
                        return back()->with('errorMessage', 'Data Already Exits!!');
                    } else {
                        $result = DB::table('account_name')->insert([
                            'name' => $request->name,
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
    public function insertAccountHead(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('account_head')
                        ->where('id', $request->id)
                        ->update([
                            'name_id' => $request->name_id,
                            'head' => $request->head,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'You have done successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again!!');
                    }
                }
                else {
                    $rows = DB::table('account_head')
                        ->select('id')
                        ->where([
                            ['head', '=', $request->head],
                        ])
                        ->distinct()->get()->count();
                    if ($rows > 0) {
                        return back()->with('errorMessage', ' Data already Exits!!');
                    } else {
                        $result = DB::table('account_head')->insert([
                            'name_id' => $request->name_id,
                            'head' => $request->head,
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
    public function getAccountingNameListById(Request $request){
        try{
            $rows = DB::table('account_name')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function getAccountingHeadListById(Request $request){
        try{
            $rows = DB::table('account_head')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function accounting (){
        try{
            $name = DB::table('account_name')
                ->get();
            $row = DB::table('accounting')
                ->select('*','accounting.id as acc_id')
                ->join('account_name','account_name.id','=','accounting.ac_name_id')
                ->join('account_head','account_head.id','=','accounting.acc_head_id')
                ->orderBy('date','desc')
                ->paginate(30);
            return view('backend.accounting', ['accountings' => $row,'names' => $name]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function getAccountHeadListAll(Request $request){
        try{
            $rows = DB::table('account_head')
                ->where('name_id', $request->id)
                ->get();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function insertAccounting(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('accounting')
                        ->where('id', $request->id)
                        ->update([
                            'ac_name_id' => $request->name_id,
                            'acc_head_id' => $request->head_id,
                            'type' => $request->type,
                            'purpose' => $request->purpose,
                            'amount' => $request->amount,
                            'amount1' => $request->amount1,
                            'amount2' => $request->amount2,
                            'date' => $request->date,
                            'person' => $request->person,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'You have done successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again!!');
                    }
                }
                else {
                    $result = DB::table('accounting')->insert([
                        'ac_name_id' => $request->name_id,
                        'acc_head_id' => $request->head_id,
                        'type' => $request->type,
                        'purpose' => $request->purpose,
                        'amount' => $request->amount,
                        'amount1' => $request->amount1,
                        'amount2' => $request->amount2,
                        'date' => $request->date,
                        'person' => $request->person,
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
    public function getAccountingReportByDate (Request $request){
        $name = DB::table('account_name')
            ->get();
        $row = DB::table('accounting')
            ->select('*','accounting.id as acc_id')
            ->join('account_name','account_name.id','=','accounting.ac_name_id')
            ->join('account_head','account_head.id','=','accounting.acc_head_id')
            ->whereBetween('date',array($request->from_date,$request->to_date))
            ->orderBy('date', 'Desc')->paginate(20);
        return view('backend.accounting', ['accountings' => $row,'names' => $name,'from_date'=>$request->from_date,'to_date'=>$request->to_date]);
    }
    public function getAccountingListById(Request $request){
        try{
            $rows = DB::table('accounting')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function approvalChange(Request  $request){
        try{
            if($request->id) {
                $status =DB::table('products')->where('id', $request->id)->first();
                if($status->approval == 1)
                    $approval = 0;
                else
                    $approval = 1;
                $result =DB::table('products')
                    ->where('id', $request->id)
                    ->update([
                        'approval' =>  $approval,
                    ]);
                if ($result) {
                    return response()->json(array('data'=>'ok'));
                } else {
                    return response()->json(array('data'=>'ok'));
                }
            }
            else{
                return response()->json(array('data'=>'ok'));
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function posSale (Request $request){
        $products = DB::table('products')
            ->where('status', 1)
            ->get()->take(50);
        return view('backend.posSale',['products' => $products]);
    }
    public function getPOSProductSearch(Request $request){
        try{
            if($request->val){
                $products = DB::table('products')
                    ->where('id', 'like', '%' . $request->val . '%')
                    ->orWhere('name', 'like', '%' . $request->val . '%')
                    ->where('status', 1)
                    ->get()->take(50);
                if($products->count() > 0){
                    $products = DB::table('products')
                        ->where('id', 'like', '%' . $request->val . '%')
                        ->orWhere('name', 'like', '%' . $request->val . '%')
                        ->where('status', 1)
                        ->get()->take(20);
                }
                else{
                    $products = 0;
                }
            }
            else{
                $products = 0;
            }
            return response()->json(array('data'=>$products));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function getPOSProductAdd(Request $request){
        try{
            $product = DB::table('products')
                ->where('id', $request->val)
                ->first();
            return response()->json(array('data'=>$product));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function insertPOSSale(Request $request){
        try{
            $name = $request->name;
            $phone = $request->phone;
            $email = $request->email;
            $address = $request->address;
            $payment_type = $request->payment_type;
            $order_notes = $request->notes;
            $date = $request->date;
            $sale_discount = $request->sale_discount;
            $total_tax = $request->total_tax;
            $shipping_cost = $request->shipping_cost;
            $g_total = $request->g_total;
            $paid_amount = $request->paid_amount;
            $due_amount = $request->due_amount;
            $product_id = $request->p_id;
            $product_qty = $request->p_quantity;
            $p_discount = $request->p_discount;
            $price = $request->p_total_price;
            $tx_id = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(16/strlen($x)) )),1,16);
            $i = 0;
            $result = DB::table('v_assign')->insert([
                'user_id' => 0,
                'pay_id' => $tx_id,
                'sales_date' => $date
            ]);
            $salesid = DB::getPdo()->lastInsertId();
            foreach ($product_id as $p_id){
                $result = DB::table('details')->insert([
                    'sales_id' => $salesid,
                    'product_id' => $p_id,
                    'quantity' => $product_qty[$i],
                    'discount' => $p_discount[$i],
                    'price' => $price[$i]
                ]);
                $i++;
            }
            //dd($request);
            $data = [
                [   'user_id' => 0,
                    'tx_id' => $tx_id,
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                    'order_notes' => $order_notes,
                    'user_type' => 2,
                    'total' => (int)$g_total,
                    'discount' => (int)$sale_discount,
                    'delivery_charge' => (int)$shipping_cost,
                    'gateway_charge' => 0,
                    'payment_method' => $payment_type,
                    'paid' => $paid_amount,
                    'due' => $due_amount,
                    'tax' => $total_tax,
                ],
            ];
            $result = DB::table('order_details')->insert($data);
            if ($result) {
                return back()->with('successMessage', 'You have done successfully!!');
            } else {
                return back()->with('errorMessage', 'Please Try Again!!');
            }

        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
}
