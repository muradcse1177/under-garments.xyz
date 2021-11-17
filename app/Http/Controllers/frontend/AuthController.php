<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function verifyUsers(Request $request){
        try{
            $phone = $request->phone;
            $password = $request->password;
            $rows = DB::table('users')
                ->where('phone', $phone)
                ->orWhere('email', $phone)
                ->get()->count();
            if ($rows > 0) {
                $rows = DB::table('users')
                    ->where('phone', $phone)
                    ->orWhere('email', $phone)
                    ->first();
                if (Hash::check($password, $rows->password)) {
                    $role = $rows->user_type;
                    Session::put('user_info', $rows);
                    Cookie::queue('user', $rows->id, time()+31556926 ,'/');
                    Cookie::queue('user_id', $rows->id, time()+31556926 ,'/');
                    Cookie::queue('user_name', $rows->name, time()+31556926 ,'/');
                    Cookie::queue('user_type', $rows->user_type, time()+31556926 ,'/');
                    Cookie::queue('user_photo', $rows->photo, time()+31556926 ,'/');
                    if($role == 1){
                        Cookie::queue('admin', $rows->id, time()+31556926 ,'/');
                        return redirect()->to('dashboard');
                    }
                    elseif($role == 2){
                        Cookie::queue('buyer', $rows->id, time()+31556926 ,'/');
                        return redirect()->to('homepage');
                    }
                    else{
                        return redirect()->to('signup');
                    }
                }
                else{
                    return back()->with('errorMessage', 'Password is wrong!!');
                }
            } else {
                return back()->with('errorMessage', 'We do not get you. Try again!!');
            }

        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function verifyUserFromCheckout(Request $request){
        try{
            if($request->login == "login"){
                $phone = $request->phone;
                $password = $request->password;
                $rows = DB::table('users')
                    ->where('phone', $phone)
                    ->orWhere('email', $phone)
                    ->get()->count();
                if ($rows > 0) {
                    $rows = DB::table('users')
                        ->where('phone', $phone)
                        ->orWhere('email', $phone)
                        ->first();
                    $role = $rows->user_type;
                    if($role == 2){
                        Cookie::queue('buyer', $rows->id, time()+31556926 ,'/');
                        if (Hash::check($password, $rows->password)) {
                            Session::put('user_info', $rows);
                            Cookie::queue('user', $rows->id, time()+31556926 ,'/');
                            Cookie::queue('user_id', $rows->id, time()+31556926 ,'/');
                            Cookie::queue('user_name', $rows->name, time()+31556926 ,'/');
                            Cookie::queue('user_type', $rows->user_type, time()+31556926 ,'/');
                            Cookie::queue('user_photo', $rows->photo, time()+31556926 ,'/');
                            return redirect()->to('checkout');
                        }
                        else{
                            return back()->with('errorMessage', 'Password is wrong!!');
                        }
                    }
                    else{
                        return back()->with('errorMessage', 'Please login in as a buyer!!');
                    }
                } else {
                    return back()->with('errorMessage', 'User not exits. Please  try again!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please full up the form!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function logout(){
        Cookie::queue(Cookie::forget('user','/'));
        Cookie::queue(Cookie::forget('user_id','/'));
        Cookie::queue(Cookie::forget('user_name','/'));
        Cookie::queue(Cookie::forget('user_type','/'));
        Cookie::queue(Cookie::forget('user_photo','/'));
        Cookie::queue(Cookie::forget('admin','/'));
        Cookie::queue(Cookie::forget('buyer','/'));
        session()->forget('user_info');
        session()->flush();
        session()->save();
        return redirect()->to('homepage');
    }
    public function getAllUserTypeSignUp(Request $request){
        try{
            $rows = DB::table('user_type')
                ->where('type', 2)
                ->get();

            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function insertNewUser(Request $request){
        try{
            if($request) {
                $rows = DB::table('users')
                    ->where('phone', $request->phone)
                    ->orwhere('email', $request->email)
                    ->distinct()->get()->count();
                if ($rows > 0) {
                    return back()->with('errorMessage', 'Same user exit our database !!');
                } else {
                    $username = $request->name;
                    $email = $request->email;
                    $phone = $request->phone;
                    $password = Hash::make($request->password);
                    $user_type = 2;
                    $address =  $request->address;

                    $result = DB::table('users')->insert([
                        'name' => $username,
                        'email' => $email,
                        'password' => $password,
                        'phone' => $phone,
                        'user_type' => $user_type,
                        'status' => 1,
                        'address' =>$address,
                    ]);
                    if ($result) {
                        $rows = DB::table('users')
                            ->where('phone', $phone)
                            ->first();
                        $user = $rows->id;
                        $role = $rows->user_type;
                        Cookie::queue('user', $user, time()+31556926 ,'/');
                        Cookie::queue('role', $role, time()+31556926 ,'/');
                        return redirect()->to('signup');
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

    public function transaction(Request $request){
        try{
            $id= $request->id;
            $output = array('list'=>'');
            $order_details = DB::table('order_details')
                ->where('tx_id',$id)
                ->first();
            $customer = DB::table('users')
                ->where('id',Cookie::get('user_id'))
                ->first();
            $stmt= DB::table('v_assign')
                ->where('v_assign.pay_id', $id)
                ->first();
            if($stmt->user_id == 0){
                $stmt2= DB::table('details')
                    ->join('products', 'products.id', '=', 'details.product_id')
                    ->join('v_assign', 'v_assign.id', '=', 'details.sales_id')
                    ->where('details.sales_id', $stmt->id)
                    ->orderBy('products.id','Asc')
                    ->get();
            }
            else{
                $stmt2= DB::table('details')
                    ->join('products', 'products.id', '=', 'details.product_id')
                    ->join('v_assign', 'v_assign.id', '=', 'details.sales_id')
                    ->where('details.sales_id', $stmt->id)
                    ->orderBy('products.id','Asc')
                    ->get();
            }
            $data = json_decode($stmt2, true);
            $total = 0;
            foreach($data as $row){
                $output['transaction'] = $order_details->id;
                $output['date'] = date('M d, Y', strtotime($row['sales_date']));
                $quantity = $row['quantity'];
                if($stmt->user_id == 0){
                    $price =  $row['discount_price'];
                    $subtotal = $row['discount_price']*$quantity;
                }
                else{
                    $price  = $row['discount_price'];
                    $subtotal = $row['discount_price']*$quantity;
                }
                $total += $subtotal;
                $output['list'] .= "
                    <tr class='prepend_items'>
                        <td>".$row['name']."</td>
                        <td> ".(number_format($price, 2)).'/-'."</td>
                        <td>".($row['quantity'].$row['unit'])."</td>
                        <td> ".(number_format($row['discount'], 2)).'/-'."</td>
                        <td> ".(number_format($subtotal, 2)).'/-'."</td>
                    </tr>
                ";
            }

            $output['delivery_charge'] = '<b> '.(number_format($order_details->delivery_charge, 2)).'/-'.'<b>';
            $output['discount'] = '<b> '.(number_format($order_details->discount, 2)).'/-'.'<b>';
            $output['total'] = '<b> '.(number_format($order_details->total, 2)).'/-'.'<b>';
            $output['tax'] = '<b> '.(number_format($order_details->tax, 2)).'/-'.'<b>';
            $output['gateway'] = '<b> '.(number_format($order_details->gateway_charge, 2)).'/-'.'<b>';
            $output['paid'] = '<b> '.(number_format($order_details->paid, 2)).'/-'.'<b>';
            $output['due'] = '<b> '.(number_format($order_details->due, 2)).'/-'.'<b>';
            return response()->json(array('data'=>$output));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public static function en2bn($number) {
        $replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        $search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        $bn_number = str_replace($search_array, $replace_array, $number);
        return $bn_number;
    }
    public function forgotPasswordLink(){
        return view('frontend.forgotPassForm');
    }
    public function verificationCodeForm(){
        return view('frontend.verificationCodeForm');
    }
    public function nePasswordForm(){
        return view('frontend.nePasswordForm');
    }
    public function verifyEmail(Request $request){
        $rows = DB::table('users')->where('email', $request->email)->first();
        if(!empty($rows)){
            $email = $rows->email;
            $userName = $rows->name;
            $dataNum = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8/strlen($x)) )),1,8);
            $data = array(
                'userName'=> $userName,
                'data'=> $dataNum,
            );
            Mail::send('frontend.forgotPassEmailFormat',$data, function($message) use($email,$userName) {
                $message->to($email, $userName)->subject('Password recovery email.');
                $message->from('support@Under-Garments.Xyz','Under-Garments.Xyz');
            });
            if (Mail::failures()) {
                return back()->with('errorMessage', 'Please Try Again!!');
            }
            else{
                $result =DB::table('users')
                    ->where('id', $rows->id)
                    ->update([
                        'reset_code' => $dataNum,
                    ]);
                if($result){
                    return view('frontend.verificationCodeForm', ['id' =>  $rows->id]);
                }
                else{
                    return back()->with('errorMessage', 'Please Try Again!!');
                }
            }
        }
        else{
            return back()->with('errorMessage', 'User not exits!!');
        }
    }
    public function verifyForgetCode(Request $request){
        if($request->code){
            $rows = DB::table('users')->where('id', $request->id)->first();
            if($request->code == $rows->reset_code){
                return view('frontend.nePasswordForm', ['id' =>  $rows->id]);
            }
            else{
                return back()->with('errorMessage', 'Wrong Code!!');
            }
        }
        else{
            return back()->with('errorMessage', 'Please fill up the form!!');
        }

    }
    public function passwordUpdate(Request $request){
        if($request->password){
            $password = Hash::make($request->password);
            $result =DB::table('users')
                ->where('id', $request->id)
                ->update([
                    'password' => $password,
                ]);
            if($result){
                $result =DB::table('users')
                    ->where('id', $request->id)
                    ->update([
                        'reset_code' => '',
                    ]);
                if($result){
                    return view('frontend.login');
                }
                else{
                    return back()->with('errorMessage', 'Please Try Again!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Try Again!!');
            }
        }
        else{
            return back()->with('errorMessage', 'Please fill up the form!!');
        }

    }
    public  function roleAssign(){
        $result = DB::table('user_type')
            ->where('type', 1)->get();
        $attributes = DB::table('attribute')->get();
        $r_as = DB::table('role_assign')->get();
        return view('backend.roleAssignPage',['users' =>  $result,'attributes'=> $attributes,'r_as'=> $r_as]);
    }
    public function insertUserRole(Request $request){
        try{
            if($request) {
                $result =DB::table('role_assign')
                    ->where('user_type', $request->user)->get();
                if($result->count()>0){
                    return back()->with('errorMessage', 'User exits!! Please try again.');
                }
                else{
                    $result = DB::table('role_assign')->insert([
                        'user_type' => $request->user,
                        'role' => json_encode($request->role),
                    ]);
                    if($result){
                        return back()->with('successMessage', 'You have done successfully!!');
                    }
                    else{
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
    public function roleAssignEditPage(Request $request){
        try{
            $result = DB::table('user_type')
                ->where('type', 1)->get();
            $attributes = DB::table('attribute')->get();
            $r_as = DB::table('role_assign')->get();
            return view('backend.roleAssignEditPage', ['users' => $result, 'attributes' => $attributes, 'r_as' => $r_as]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function updateUserRole(Request $request){
        try{
            if($request->id) {
                $result = DB::table('role_assign') ->where('id',$request->id)
                    ->update([
                        'user_type' => $request->user,
                        'role' => json_encode($request->role),
                    ]);
                if($result){
                    return redirect('roleAssign')->with('successMessage', 'You have done successfully!!');
                }
                else{
                    return back()->with('errorMessage', 'Please Try Again!!');
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
}
