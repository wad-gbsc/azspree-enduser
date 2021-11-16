<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OrderHeader;
use App\Models\OrderDetail;
use App\Models\CartHeader;
use App\Models\CartDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Session;
use DB;
use Mail;


class AndroidController extends Controller
{
    //For Android Use
    public function loginAndroid(Request $request)
    {
        Validator::make($request->all(),
            [
                'email' => 'required',
            ]
        )->validate();
        
        $email = $request->input('email');
        //$password = $request->input('password');

        $result = User::select('*')
                    ->where('email', $email)
                    ->where('type', 'US')
                    ->where('status', 'A')
                    ->get();
        

        if(count($result) > 0){

            $response['stat']='success';
            $response['msg']='Login Successfully.';

        }else{
            Validator::make($request->all(),
            [
                'email' => 'required',
                'fullname' => 'required',
                'id' => 'required'
            ]
            )->validate();

            $newUser = new User();
            $newUser->fullname = $request->input('fullname');
            $newUser->email = $request->input('email');
            $newUser->type = 'US';
            $newUser->status = 'A';
            $newUser->google_id = $request->input('id');
            $newUser->create_datetime = Carbon::now();
            $newUser->save();

            DB::table('user')->where('user_hash', $newUser->user_hash)->update(['is_verified' => '1']); 

            //For SRHR
            $srhr = new CartHeader();
            $srhr->co_no = '01';
            $srhr->user_hash = $newUser->user_hash;
            $srhr->create_datetime = Carbon::now();
            $srhr->save();

            if(count($result) > 0){

                session()->put('user_hash', $result[0]->user_hash);
                session()->put('fullname', $result[0]->fullname);
                session()->save();

            }

            $response['stat']='succes';
            $response['msg']='Register Successfully';
        }

        echo json_encode($response);
    }

    public function editprofile(Request $request)
    {       
        $user_hash = $request->input('user_hash');
        
        $validator= Validator::make($request->all(),
            [
                'fullname' => 'required|regex:/^[a-zA-Z\s]+$/',
                'contact_no' => 'required|regex:/(09)[0-9]{9}$/',
            ]
        );

        if($validator->fails()){
            $response['stat']='error';
            $response['msg'] =$validator->errors();
            echo json_encode($response);
        } else {
            DB::table('user')->where('user_hash', $user_hash)
            ->update([
                'fullname' => ucwords($request['fullname']), 
                'contact_no' => $request['contact_no'],
                'regn_hash' => $request->input('region'),
                'prov_hash' => $request->input('province'),
                'city_hash' => $request->input('city'),
                'brgy_hash' => $request->input('barangay'),
                'address' => $request->input('address'),
                'update_datetime' => Carbon::now()
                    ]);

                $response['stat']='success';
                $response['msg']='<b>UPDATE SUCCESSFUL.</b>';
                echo json_encode($response);
        }
    } 

    public function AddToCart(Request $request)
    {
        $srhr_hash = $request->input('user_hash');
          
        $products =DB::table('vrnt')
        ->where('inmr_hash', $request->input('inmr_hash'))
        ->where('vrnt_hash', $request->input('vrnt_hash'))
        ->get();
   
        $qty = $products[0]->available_qty;

        $validator = Validator::make($request->all(),
        [
            'qty' => 'required|numeric|min:1|max:'.$qty
        ]
        );
        // )->validate();
        

        if($validator->fails()){
            $response['stat']='error';
            $response['msg']='Sorry, Low Available stock you can olny checkout '.$qty.' pieces';  
            echo json_encode($response);
        } else {
            $addcart = new CartDetail();
            $addcart->srhr_hash = $srhr_hash;
            $addcart->inmr_hash = $request->input('inmr_hash');
            $addcart->sumr_hash =$request->input('sumr_hash');
            $addcart->vrnt_hash = $request->input('vrnt_hash');
            $addcart->qty = $request->input('qty');
            $addcart->create_datetime = Carbon::now();
            $addcart->save();

            $response['stat']='success';
            $response['msg']='Successfully Added To Cart.';
            echo json_encode($response);
            }        
    }

    public function getCartList($user_hash)
    {
            // $mycart = CartDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'srln.inmr_hash')
            // ->leftJoin('vrnt', 'vrnt.vrnt_hash', '=', 'srln.vrnt_hash')
            // ->where('srln.srhr_hash', $user_hash)
            // ->where('srln.status', 0)
            // ->where('srln.is_deleted', 0)
            // ->orderBy('srln.srhr_hash', 'desc')
            // ->get();

            $mycart =  CartDetail::leftJoin('sumr', 'sumr.sumr_hash', '=', 'srln.sumr_hash')
            ->leftJoin('srhr', 'srhr.srhr_hash', '=', 'srln.srhr_hash')
            ->leftJoin('inmr', 'inmr.inmr_hash', '=', 'srln.inmr_hash')
            ->leftJoin('vrnt', 'vrnt.vrnt_hash', '=', 'srln.vrnt_hash')
            ->where('srln.srhr_hash', $user_hash)
            ->where('srln.status', 0)
            ->where('srln.is_deleted', 0)
            ->orderBy('srln.srln_hash', 'desc')
            ->get();

            // echo json_encode(count($mycart));
            echo json_encode($mycart);
    }

    public function getComr()
    {
            $comr = DB::table('comr')
            ->select('excess_kg_fee', 'max_kg')
            ->get();

            echo json_encode($comr);
    }

    public function updateCartQty(Request $request)
    {       

            $products = Product::
            leftJoin('vrnt', 'vrnt.inmr_hash', '=', 'inmr.inmr_hash')
            ->where('vrnt.inmr_hash', $request['inmr_hash'])
            ->where('vrnt.vrnt_hash', $request['vrnt_hash'])
            ->firstOrFail();
            
            $qty = $products->available_qty;
            $id = $request->srln_hash;
            
            $updatecart = CartDetail::findOrFail($id);
            $validator = Validator::make($request->all(),
            [
                'qty' => 'required|numeric|min:1|max:'.$qty
            ]
        );

         if($validator->fails()){
            $response['stat']='error';
            $response['msg']='<b style="color:red">Sorry, Low stock available you can olny checkout '.$qty.' pieces</b>';
            $response['qty']=$qty;
        } else {
            $updatecart->qty = $request->qty;
            $updatecart->save();

            $response['stat']='success';
            $response['msg']='<b>Ready to Checkout</b>';
        }   

        echo json_encode($response);
            
    }   

    public function updateSelected(Request $request)
    {       

            $id = $request->srln_hash;
            
            $updatecart = CartDetail::findOrFail($id);
            $updatecart->is_selected = $request->is_selected;
            $updatecart->save();

    }   

    public function placeOrder(Request $request)
    {
        
        $user_hash = $request->input('user_hash');
        $data['oder'] =  User::where('is_deleted', 0)->findOrFail($user_hash);

        $validator= Validator::make($request->all(),
        [
            'fullname' => 'required|regex:/^[a-zA-Z\s]+$/',
            'contact_no' => 'required|regex:/(09)[0-9]{9}$/'
        ]);
        
        $ursf = DB::table('brgy')
        ->select('shipping_fee')
        ->where('brgy_hash', $request->input('barangay'))
        ->get();

        $comr = DB::table('comr')
        ->select('excess_kg_fee', 'max_kg', 'azspree', 'dh')
        ->get();
    
        $mycart = CartDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'srln.inmr_hash')
        ->leftJoin('vrnt', 'vrnt.vrnt_hash', '=', 'srln.vrnt_hash')
        ->where('srln.srhr_hash', $user_hash)
        ->where('srln.is_selected', 1)
        ->where('srln.status', 0)
        ->where('srln.is_deleted', 0)
        ->orderBy('srln.srhr_hash', 'desc')
        ->get();

        $supplier =  CartDetail::leftJoin('sumr', 'sumr.sumr_hash', '=', 'srln.sumr_hash')
        ->leftJoin('vrnt', 'vrnt.vrnt_hash', '=', 'srln.vrnt_hash')
        ->leftJoin('srhr', 'srhr.srhr_hash', '=', 'srln.srhr_hash')
        ->where('srln.srhr_hash', $user_hash)
        ->where('srln.is_selected', 1)
        ->where('srln.status', 0)
        ->where('srln.is_deleted', 0)
        ->groupBy('srln.sumr_hash')
        ->orderBy('sumr.sumr_hash', 'desc')
        ->get();


        if($validator->fails()){
            $response['stat']='error';
            $response['msg'] =$validator->errors();
            echo json_encode($response);
        } else {
        for ($i=0; $i < count($supplier); $i++) { 

            $azspree_percent = $comr[0]->azspree;
            $dh_percent = $comr[0]->dh;
            $azspree = 0;
            $dh = 0;

            $order = new OrderHeader();
            $order->order_no = date('Ymd').'-';
            $order->order_date = date("Y-m-d");
            $order->co_no = '01';
            $order->regn_hash = $request->input('regn_hash');
            $order->prov_hash = $request->input('prov_hash');
            $order->city_hash = $request->input('city_hash');
            $order->brgy_hash = $request->input('brgy_hash');
            $order->address = $request->input('address');
            $order->user_hash = $user_hash;
            $order->fullname = ucwords($request->input('fullname'));
            $order->contact_no = $request->input('contact_no');
            $order->sumr_hash = $supplier[$i]->sumr_hash;
            // $order->payment_method = $request->input('payment_method');
            $order->create_datetime = Carbon::now();
            // $order->expire_cancel_datetime = Carbon::now()->addHours(5);
            $order->save();

            $sohr_hash = $order->sohr_hash;

            $line_no = 1;
            for ($a=0; $a < count($mycart); $a++) { 
                if($supplier[$i]->sumr_hash == $mycart[$a]->sumr_hash){

                    $azspree = $request->input('order_total') * $azspree_percent;
                    $dh = $request->input('order_total') * $dh_percent;


                    $orderdetail = new OrderDetail();
                    $orderdetail->sohr_hash = $sohr_hash;
                    $orderdetail->inmr_hash = $mycart[$a]->inmr_hash;
                    $orderdetail->vrnt_hash = $mycart[$a]->vrnt_hash;
                    $orderdetail->qty = $mycart[$a]->qty;
                    $orderdetail->line_no = $line_no++;
                    $orderdetail->unit_price = $mycart[$a]->cost_amt;
                    $orderdetail->dimension = $mycart[$a]->dimension;
                    $orderdetail->weight = $mycart[$a]->weight;
                    $orderdetail->create_datetime = Carbon::now();
                    $orderdetail->save();


                    // DB::table('srln')->where('srln_hash', $mycart[$a]->srln_hash)->update(['status' => '1']);   
                    // DB::table('vrnt')->where('vrnt_hash', $mycart[$a]->vrnt_hash)
                    // ->where('inmr_hash', $mycart[$a]->inmr_hash)
                    // ->decrement('available_qty',$orderdetail->qty);
        
                }   

            }
            // sleep(60);

            $order = OrderHeader::findOrFail($sohr_hash);
            $order->order_no = date('Ymd').'-'.$sohr_hash;
            $order->total_qty = $request->input('total_qty');
            $order->order_subtotal = $request->input('order_subtotal');
            $order->shipping_fee = $request->input('shipping_fee');
            $order->total_excess_fee = $request->input('total_excess_fee');
            $order->total_excess_kg = $request->input('total_excess_kg');
            $order->disc_amt = 0;
            $order->order_total = $request->input('order_total');
            $order->azspree = $azspree;
            $order->dh = $dh;
            $order->save();

            $email = DB::table('sumr')
            ->select('email')
            ->where('sumr_hash', $order->sumr_hash)
            ->get();

            $seller_name = DB::table('sumr')
            ->select('seller_name')
            ->where('sumr_hash', $order->sumr_hash)
            ->get();

            $data = array(
                'order_no' => $order->order_no,
                'sumr_hash' =>  $order->sumr_hash
                );
    
                // Mail::send([], [], function ($message) use ($data, $seller_name, $email ) {
                //     $message->to($email[0]->email)
                //         ->subject('New Order from AZSpree')
                //         ->setBody('Hi ' .$seller_name[0]->seller_name.', You have a new order, Order No. '.$data['order_no']. ' Check Now https://azspree.com:81 ', 'text/html'); // for HTML rich messages
                //   });
                    
        }

        // $check = User::select('contact_no')
        // ->where('user_hash', $user_hash)
        // ->where('contact_no', null )
        // ->get(); 

        // if (count ($check) > 0){
        //     $response['stat']='success';
            
        // }else{
        //     DB::table('user')->where('user_hash', $user_hash)->update(['contact_no' => $request->input('contact_no')]);  
            
        // }

        $response['stat']='success';
            $response['msg']='<b>ORDER PLACED SUCCESSFULLY.</b>';
            echo json_encode($response);
        
    }
    }

    public function getCategories(){
        $categories =  DB::table('inct')->where('is_deleted', 0)->orderBy('cat_name','asc')->get();
        echo json_encode($categories);
    }

    public function removeItem($id)
    {   
        $addcart = CartDetail::findOrFail($id);

        $addcart->is_deleted = 1;
        $addcart->update_datetime = Carbon::now();
        $addcart->save();

        $response['msg']='Successfully deleted';
        echo json_encode($response);
    }
    
    public function getProducts(){
        //$content =  DB::table('inmr')->where('is_deleted', 0)->where('is_verified', 1)->orderBy('inmr_hash','desc')->get();
        $variant =  DB::table('vrnt')
        ->leftJoin('inmr', 'inmr.inmr_hash', '=', 'vrnt.inmr_hash')
        ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'inmr.sumr_hash')
        ->leftJoin('inct', 'inct.inct_hash', '=', 'inmr.inct_hash')
        ->where('inmr.is_verified', 1)
        ->where('inmr.is_deleted', 0)
        ->groupBy('inmr.inmr_hash')
        ->orderBy('inmr.inmr_hash','desc')
        ->get();
        echo json_encode($variant);
    }


    public function getProfile($email)
    {
        $profile =  User::where('is_deleted', 0) 
        ->leftJoin('regn', 'regn.regn_hash', '=', 'user.regn_hash')
        ->leftJoin('prov', 'prov.prov_hash', '=', 'user.prov_hash')
        ->leftJoin('city', 'city.city_hash', '=', 'user.city_hash')
        ->leftJoin('brgy', 'brgy.brgy_hash', '=', 'user.brgy_hash')
        ->where('user.email', $email)
        ->get();

        echo json_encode($profile);
    }

    public function getOrders($user_hash)
    {
        $orders =  OrderDetail::leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
        ->leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
        ->leftJoin('vrnt', 'vrnt.vrnt_hash', '=', 'soln.vrnt_hash')
        ->leftJoin('user', 'user.user_hash', '=', 'sohr.user_hash')
        ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
        ->leftJoin('inct', 'inct.inct_hash', '=', 'inmr.inct_hash')
        ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
        ->where('sohr.user_hash', $user_hash)
        ->where('user.is_deleted', 0) 
        //->groupBy('sohr.order_no')
        ->orderBy('sohr.sohr_hash', 'desc')
        ->get();

        echo json_encode($orders);
    }

    public function getVariant($id){
        $variant =  DB::table('vrnt')
        ->leftJoin('inmr', 'inmr.inmr_hash', '=', 'vrnt.inmr_hash')
        ->where('inmr.is_verified', 1)
        ->where('inmr.is_deleted', 0)
        ->where('inmr.inmr_hash',$id)
        ->orderBy('vrnt.cost_amt','asc')
        ->get();
        echo json_encode($variant);
    }

    public function getReviews($id)
    {
        $order = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
        ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
        ->leftJoin('user', 'user.user_hash', '=', 'sohr.user_hash')
        ->where('soln.status_ratings', 1)
        ->where('soln.inmr_hash',$id)
        // ->where('soln.inmr_hash',$id)
        // ->orderBy('soln.sohr_hash', 'desc')
        ->get();
        echo json_encode($order);
    }

    function getQuestions($id)
    {
        $comment = Comment::leftJoin('inmr', 'inmr.inmr_hash', '=', 'cmnt.inmr_hash')
        ->leftJoin('user', 'user.user_hash', '=', 'cmnt.user_hash')
        ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'cmnt.sumr_hash')
        ->where('cmnt.inmr_hash',$id)
        ->orderBy('cmnt.cmnt_hash','desc')
        ->get();
        echo json_encode($comment);
    }

    public function updatestatusOR($id)
    {       
            
        $order = OrderHeader::findOrFail($id);
        $order->status_user = '5';
        $order->is_comp = '1';
        $order->save();

        $email = DB::table('sumr')
        ->select('email')
        ->where('sumr_hash', $order->sumr_hash)
        ->get();

        $seller_name = DB::table('sumr')
        ->select('seller_name')
        ->where('sumr_hash', $order->sumr_hash)
        ->get();

        $data = array(
            'order_no' => $order->order_no,
            'sumr_hash' =>  $order->sumr_hash
            );

            Mail::send([], [], function ($message) use ($data, $seller_name, $email ) {
                $message->to($email[0]->email)
                    ->subject('The buyer has receive your parcel')
                    ->setBody('Hi ' .$seller_name[0]->seller_name.', The buyer has receive your parcel, Order No. '.$data['order_no'] , 'text/html'); // for HTML rich messages
                });

        $response['stat']='success';
        $response['msg']='Success';
    } 

    public function updateReview(Request $request, $id)
    {       
        $order = OrderDetail::findOrFail($id);
        $order->rating = $request->rating;
        $order->remarks = $request->remarks;
        $order->status_ratings = 1;
        $order->inmr_hash = $request['inmr_hash'];
        $order->save();

            DB::table('inmr')->where('inmr_hash', $order->inmr_hash)->increment('total_ratings', $order->rating);    
            Product::where('inmr_hash', $order->inmr_hash)->update(['number_ratings' => DB::raw('number_ratings + 1')]);
        //  DB::table('sohr')->where('sohr_hash', $order->sohr_hash)->update(['status' => 'COMPLETED']);  
        
        $email = DB::table('soln')
        ->select('email')
        ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
        ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
        ->where('soln_hash', $order->soln_hash)
        ->get();

        $data = array(
            'inmr_hash' => $order->inmr_hash,
            'rating' => $order->rating);

        Mail::send([], [], function ($message) use ($data, $email) {
            $message->to($email[0]->email)
                ->subject('You have a ' .$data['rating']. ' star rating')
                ->setBody('You have a ' .$data['rating']. ' star rating on your product https://azspree.com/productdetails/'.$data['inmr_hash'] , 'text/html'); // for HTML rich messages
        });

        $response['stat']='success';
        $response['msg']='Success';
    }

    public function getRegion()
    {
        $tbl_region =  DB::table('regn')->get();
        echo json_encode($tbl_region);
    }

    public function getProvince()
    {
        $tbl_province =  DB::table('prov')->get();
        echo json_encode($tbl_province);
    }

    public function getCity()
    {
        $tbl_city =  DB::table('city')->get();
        echo json_encode($tbl_city);
    }

    public function getBrgy()
    {
        $tbl_brgy =  DB::table('brgy')->get();
        echo json_encode($tbl_brgy);
    }
}
