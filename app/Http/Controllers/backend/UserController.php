<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function dashboard(){
        $users = DB::table('users')
            ->where('status', 1)
            ->distinct()->get()->count();
        $cashOut = DB::table('accounting')
            ->where('date', date('y-m-d'))
            ->where('type', 'Cash Out')
            ->sum('amount');
        $cashIn = DB::table('accounting')
            ->where('date', date('y-m-d'))
            ->where('type', 'Cash In')
            ->sum('amount');
        $p_order = DB::table('v_assign')
            ->where('sales_date', date('y-m-d'))
            ->distinct()->get()->count();
        return view('backend.dashboard',
            [
                'users' => $users,
                'cashOut' => $cashOut,
                'cashIn' => $cashIn,
                'p_order' => $p_order,
            ]
        );
    }
    public function insertUserType(Request $request){
        try{
            if($request) {
                $rows = DB::table('user_type')->select('name')->where([
                    ['name', '=', $request->name]
                ])->where('status', 1)->distinct()->get()->count();
                if ($rows > 0) {
                    return back()->with('errorMessage', ' নতুন User Type ।');
                } else {
                    $result = DB::table('user_type')->insert([
                        'name' => $request->name,
                        'type' => $request->type
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
    public function selectUser_type(){
        try{
            $rows = DB::table('user_type')->where('status', 1)
                ->orderBy('id', 'DESC')->Paginate(10);
            return view('backend.user_type', ['user_types' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function selectUser(){
        try{
            $rows = DB::table('users')
                ->select('*','user_type.name as designation','users.name as name','users.id as u_id')
                ->join('user_type','users.user_type','=','user_type.id')
                ->orderBy('users.id', 'DESC')
                ->Paginate(10);
            return view('backend.user', ['users' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function selectUserFromUserPanel(Request  $request){
        try{
            if($request->userType =="All"){
                $rows = DB::table('users')
                    ->select('*','user_type.name as designation','users.name as name','users.id as u_id')
                    ->join('user_type','users.user_type','=','user_type.id')
                    ->orderBy('users.id', 'DESC')
                    ->Paginate(10);
            }
            else{
                $rows = DB::table('users')
                    ->select('*','user_type.name as designation','users.name as name','users.id as u_id')
                    ->join('user_type','users.user_type','=','user_type.id')
                    ->where('user_type', $request->userType)
                    ->orderBy('users.id', 'DESC')
                    ->Paginate(10);
            }

            return view('backend.user', ['users' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function getUserListByID(Request $request){
        try{
            $rows = DB::table('users')
                ->where('id', $request->id)
                ->get();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function insertUser(Request $request){
        try{
            //dd($request);
                if($request) {
                    if ($request->id){
                        $username = $request->name;
                        $email = $request->email;
                        $phone = $request->phone;
                        $password = Hash::make($request->password);
                        $address = $request->address;
                        $user_type = 2;
                        $result =DB::table('users')
                            ->where('id', $request->id)
                            ->update([
                                'name' => $username,
                                'email' => $email,
                                'password' => $password,
                                'phone' => $phone,
                                'address' => $address,
                                'status' => 1,
                            ]);
                        if ($result) {
                            return back()->with('successMessage', 'You have done successfully!!');
                        } else {
                            return back()->with('errorMessage', 'Please Try Again!!');
                        }
                    }
                    else{
                        $rows = DB::table('users')
                            ->where('phone', $request->phone)
                            ->orwhere('email', $request->email)
                            ->distinct()->get()->count();
                        if ($rows > 0) {
                            return back()->with('errorMessage', ' নতুন User ।');
                        } else {
                            $username = $request->name;
                            $email = $request->email;
                            $phone = $request->phone;
                            $password = Hash::make($request->password);
                            $address = $request->address;
                            $user_type = 2;
                            $result = DB::table('users')->insert([
                                'name' => $username,
                                'email' => $email,
                                'password' => $password,
                                'phone' => $phone,
                                'address' => $address,
                                'user_type' => $user_type,
                                'status' => 1,
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

    public function getAllUserType(Request $request){
        try{
            $rows = DB::table('user_type')
                ->where('status', 1)
                ->get();

            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function deleteUser(Request $request){
        try{

            if($request->id) {
                $result =DB::table('users')
                    ->where('id', $request->id)
                    ->update([
                        'status' =>  0,
                    ]);
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
    public function about_us(Request $request){
        try{
            $rows = DB::table('about_us')
                ->get();
            return view('backend.about_us', ['abouts' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function insertAboutUs(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('about_us')
                        ->where('id', $request->id)
                        ->update([
                            'about' => $request->name
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'You have done successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again!!');
                    }
                }
                else {
                    $rows = DB::table('about_us')->select('id')->distinct()->get()->count();
                    if ($rows > 0) {
                        return back()->with('errorMessage', ' About Us is only for changing not deletion.');
                    } else {
                        $result = DB::table('about_us')->insert([
                            'about' => $request->name,
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
    public function insertContactUs(Request $request){
        try{
            $result = DB::table('contact_us')->insert([
                'name' => $request->name,
                'phone' => $request->phone,
                'purpose' => $request->purpose,
            ]);
            if ($result) {
                return back()->with('successMessage', 'Thank You.Our agent will contact with you soon.');
            } else {
                return back()->with('errorMessage', 'Please Try Again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function getAboutUS(Request $request){
        try{
            $rows = DB::table('about_us')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function contact_us(Request $request){
        try{
            $rows = DB::table('contact_us')
                ->orderBy('id','desc')
                ->paginate();
            return view('backend.contact_us', ['lists' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function getContactUs(Request $request){
        try{
            $rows = DB::table('contact_us')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }

    public function myProductOrder(Request $request){
        try{
            $id = Cookie::get('user_id');
            $user= DB::table('users')->where('id', $id)->first();
            $order_details = DB::table('order_details')->where('user_id', $id)->orderBy('id','desc')->get();
            $i=0;
            $sum = 0;
            $orderArr = array();
            foreach($order_details as $order){
                $row = DB::table('v_assign')
                    ->where('pay_id', $order->tx_id)
                    ->orderBy('sales_date', 'Desc')
                    ->first();
                if ($row) {
                    $date = explode(' ',$order->created_at);
                    $orderArr[$i]['sales_date'] = $date[0];
                    $orderArr[$i]['name'] = $order->name;
                    $orderArr[$i]['address'] =  $order->address;
                    $orderArr[$i]['id'] = $order->id;
                    $orderArr[$i]['amount'] = $order->total;
                    $orderArr[$i]['user_id'] = $row->user_id;
                    $orderArr[$i]['status'] = $order->status;
                    $orderArr[$i]['sales_id'] = $order->tx_id;
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

            $stmt = DB::table('wishlist')
                ->select('*','wishlist.id AS w_id')
                ->leftJoin('products', 'products.id', '=', 'wishlist.product_id')
                ->where('wishlist.user_id',Cookie::get('user_id'))
                ->orderBy('products.id','Asc')
                ->get();
            if(count($stmt)>0){
                $count = 1;
            }
            else{
                $count = 0;
            }
            $stmtC = DB::table('compare')
                ->select('*','compare.id AS c_id')
                ->leftJoin('products', 'products.id', '=', 'compare.product_id')
                ->where('compare.user_id',Cookie::get('user_id'))
                ->orderBy('products.id','Asc')
                ->get();

            if(count($stmtC)>0){
                $countC = 1;
            }
            else{
                $countC = 0;
            }
            return view('frontend.myProductOrder', [
                'orders' => $paginatedItems,'sum' => $sum,'users' => $user,
                'products'=>$stmt,'count'=> $count,
                'productsC'=>$stmtC,'countC'=> $countC
            ]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function changeAddress(Request  $request){
        $result =DB::table('users')
            ->where('id', Cookie::get('user_id'))
            ->update([
                'address' => $request->address,
            ]);
        if($result){
            return back()->with('successMessage', 'You have done successfully!!');
        }
        else{
            return back()->with('errorMessage', 'Please Try Again!!');
        }
    }
    public function updateProfile(Request $request){
        if($request){
            $password = Hash::make($request->password);
            $result =DB::table('users')
                ->where('id', Cookie::get('user_id'))
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'password' => $password,
                ]);
            if($result){
                return redirect('myProductOrder')->with('successMessage', 'You have done successfully!!');
            }
            else{
                return back()->with('errorMessage', 'Please Try Again!!');
            }
        }
        else{
            return back()->with('errorMessage', 'Please fill up the form!!');
        }

    }
    public function getAllPagesText(Request $request){
        try{
            $rows = DB::table('page_settings')
                ->get();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function pageSettings(Request $request){
        try{
            return view('backend.pageSettings');
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function insertPrivacy(Request $request){
        try{
            if($request) {
                $result = DB::table('page_settings') ->where('id', $request->id)->update([
                    'pages' => $request->text,
                ]);
                if ($result) {
                    return back()->with('successMessage', 'Insert Successfully!!');
                } else {
                    return back()->with('errorMessage', 'Please Try Again!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Fill Up the Form');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function getPages($id){
        try{
            $result = DB::table('page_settings') ->where('id', $id)->first();
            return view('frontend.pages',['pages'=>$result]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
}
