<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use App\Http\Resources\Reference;
use App\Models\Supplier;
use App\Models\Comment;
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


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::has('user_hash')){

            $srhr_hash = session('user_hash');
            $title = 'MyCart';

            $visit =  DB::table('cntr')->where('is_deleted', 0)->get();

            $data['mycart'] = CartDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'srln.inmr_hash')
            ->leftJoin('vrnt', 'vrnt.vrnt_hash', '=', 'srln.vrnt_hash')
            ->where('srln.srhr_hash', $srhr_hash)
            ->where('srln.status', 0)
            ->where('srln.is_deleted', 0)
            ->orderBy('srln.srhr_hash', 'desc')
            ->get();

            $data['comr'] = DB::table('comr')
            ->select('excess_kg_fee', 'max_kg')
            ->get();

            $data['supplier'] =  CartDetail::leftJoin('sumr', 'sumr.sumr_hash', '=', 'srln.sumr_hash')
            ->leftJoin('srhr', 'srhr.srhr_hash', '=', 'srln.srhr_hash')
            ->leftJoin('inmr', 'inmr.inmr_hash', '=', 'srln.inmr_hash')
            ->where('srln.srhr_hash', $srhr_hash)
            ->where('srln.status', 0)
            ->where('srln.is_deleted', 0)
            ->groupBy('srln.sumr_hash')
            ->orderBy('sumr.sumr_hash', 'desc')
            ->get();

        return view('pages.mycart', compact('visit'))->with('data', $data);
        // return view('pages.mycart')->with('data', $data);
    }else{
        // return view('pages.login');
        $visit =  DB::table('cntr')->where('is_deleted', 0)->get();
        return view('pages.login', compact('visit'));
        }
    }

    public function indexcheckout()
    {
        if(Session::has('user_hash')){

            $srhr_hash = session('user_hash');
            $check = DB::table('srln')
                ->select('*')
                ->where('srhr_hash', $srhr_hash)
                ->where('status', 0)
                ->where('is_selected', 1)
                ->where('is_deleted', 0)
                ->get();

            if($check[0]->is_selected == 1){
                $srhr_hash = session('user_hash');
                $title = 'checkout';
                $visit =  DB::table('cntr')->where('is_deleted', 0)->get();
    
                $data['comr'] = DB::table('comr')
                ->select('excess_kg_fee', 'max_kg')
                ->get();
    
                $data['mycart'] = CartDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'srln.inmr_hash')
                ->leftJoin('vrnt', 'vrnt.vrnt_hash', '=', 'srln.vrnt_hash')
                ->where('srln.is_selected', 1)
                ->where('srln.status', 0)
                ->where('srln.is_deleted', 0)
                ->orderBy('srln.srhr_hash', 'desc')
                ->get();
    
                $data['supplier'] =  CartDetail::leftJoin('sumr', 'sumr.sumr_hash', '=', 'srln.sumr_hash')
                ->leftJoin('vrnt', 'vrnt.vrnt_hash', '=', 'srln.vrnt_hash')
                ->leftJoin('srhr', 'srhr.srhr_hash', '=', 'srln.srhr_hash')
                ->where('srln.srhr_hash', $srhr_hash)
                ->where('srln.is_selected', 1)
                ->where('srln.status', 0)
                ->where('srln.is_deleted', 0)
                ->groupBy('srln.sumr_hash')
                ->orderBy('sumr.sumr_hash', 'desc')
                ->get();
        
                $data['tbl_region'] =  DB::table('regn')->get();
                $data['tbl_province'] =  DB::table('prov')->get();
                $data['tbl_city'] =  DB::table('city')->get();
                $data['tbl_brgy'] =  DB::table('brgy')->get();
    
                return view('pages.checkout', compact('visit'))->with('data', $data);
                // return view('pages.checkout')->with('data', $data);
            }else{
                if(Session::has('user_hash')){

                    $srhr_hash = session('user_hash');
                    $title = 'MyCart';
        
                    $visit =  DB::table('cntr')->where('is_deleted', 0)->get();

                    $data['mycart'] = CartDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'srln.inmr_hash')
                    ->leftJoin('vrnt', 'vrnt.vrnt_hash', '=', 'srln.vrnt_hash')
                    ->where('srln.srhr_hash', $srhr_hash)
                    ->where('srln.status', 0)
                    ->where('srln.is_deleted', 0)
                    ->orderBy('srln.srhr_hash', 'desc')
                    ->get();

                    $data['comr'] = DB::table('comr')
                    ->select('excess_kg_fee', 'max_kg')
                    ->get();

                    $data['supplier'] =  CartDetail::leftJoin('sumr', 'sumr.sumr_hash', '=', 'srln.sumr_hash')
                    ->leftJoin('srhr', 'srhr.srhr_hash', '=', 'srln.srhr_hash')
                    ->leftJoin('inmr', 'inmr.inmr_hash', '=', 'srln.inmr_hash')
                    ->where('srln.srhr_hash', $srhr_hash)
                    ->where('srln.status', 0)
                    ->where('srln.is_deleted', 0)
                    ->groupBy('srln.sumr_hash')
                    ->orderBy('sumr.sumr_hash', 'desc')
                    ->get();

                return view('pages.mycart', compact('visit'))->with('data', $data);
                // return view('pages.mycart')->with('data', $data);
            }else{
                // return view('pages.login');
                $visit =  DB::table('cntr')->where('is_deleted', 0)->get();
                return view('pages.login', compact('visit'));
                }
            }    
    }else{
        // return view('pages.login');
        $visit =  DB::table('cntr')->where('is_deleted', 0)->get();
        return view('pages.login', compact('visit'));
        }
    }

    public function getCityList($prov_hash)
    {
    $city =  DB::table('city')
    ->leftJoin('regn', 'regn.regn_hash', '=', 'city.regn_hash')
    ->leftJoin('prov', 'prov.prov_hash', '=', 'city.prov_hash')
    ->select('city_hash','city')
    ->where('city.prov_hash', $prov_hash )
    ->get();

    return response()->json($city);
    }

    public function getVariant($vrnt_hash)
    {

    $variant =  DB::table('vrnt')
            ->select('cost_amt' , 'available_qty')
            ->where('vrnt_hash', $vrnt_hash )
            ->get();
    return response()->json($variant);
    }

    public function getBarangayList($brgy_hash)
    { 

    $ursf = DB::table('brgy')
            ->select('shipping_fee')
            ->where('brgy_hash', $brgy_hash)
            ->get();
    return response()->json($ursf);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create(Request $request)
    {
        if(Session::has('user_hash')){
        $srhr_hash = session('user_hash');
        $title = 'MyCart';
        $data['mycart'] =  User::where('is_deleted', 0)->findOrFail($srhr_hash);
          
        $products =DB::table('vrnt')
        ->where('inmr_hash', $request['inmr_hash'])
        ->where('vrnt_hash', $request['variant'])
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
            $response['msg']='<b>Sorry, Low Available stock you can olny checkout '.$qty.' pieces</b>';
            echo json_encode($response);
        } else {
            $addcart = new CartDetail();
            $addcart->srhr_hash = $srhr_hash;
            $addcart->inmr_hash = $request['inmr_hash'];
            $addcart->sumr_hash = $request['sumr_hash'];
            $addcart->vrnt_hash = $request['variant'];
            $addcart->qty = $request->input('qty');
            // $addcart->dimension = $request['dimension'];
            // $addcart->weight = $request['weight'];
            $addcart->create_datetime = Carbon::now();
            $addcart->save();

            $response['stat']='success';
            $response['msg']='<b>Successfully Added To Cart.</b>';
            echo json_encode($response);
        }        
    }
}


        public function createmsg(Request $request)
            {
                if(Session::has('user_hash')){
                    $user_hash = session('user_hash');

                    Validator::make($request->all(),
                    [
                        'comment' => 'required'
                    ]
                    );
                
                    $addcart = new Comment();
                    $addcart->user_hash = $user_hash;
                    $addcart->inmr_hash = $request['inmr_hash'];
                    $addcart->sumr_hash = $request['sumr_hash'];
                    $addcart->comment = $request->input('comment');
                    $addcart->created_datetime = Carbon::now();
                    $addcart->save();

                    $email = DB::table('sumr')
                    ->select('email')
                    ->where('sumr_hash', $request['sumr_hash'])
                    ->get();

                    $product_name = DB::table('inmr')
                    ->select('product_name')
                    ->where('inmr_hash', $request['inmr_hash'])
                    ->get();

                    $seller_name = DB::table('sumr')
                    ->select('seller_name')
                    ->where('sumr_hash', $request['sumr_hash'])
                    ->get();

                    $data = array(
                        'sumr_hash' => $request['sumr_hash'],
                        'inmr_hash' => $request['inmr_hash'],
                        'seller_name' => $seller_name[0]->seller_name
                        
                        );
            
                        Mail::send([], [], function ($message) use ($data, $email, $product_name ) {
                            $message->to($email[0]->email)
                                ->subject('New Comment')
                                ->setBody('Someone gave a comment on your product '. $product_name[0]->product_name. ' Check Now https://azspree.com/productdetails/'.$data['inmr_hash'] .' Reply using your Merchant Account http://azspree.com:81/#/shop/Comments' , 'text/html'); // for HTML rich messages
                        });

                    $response['stat']='success';
                    $response['msg']='<b>Your comment has been posted.</b>';
                    echo json_encode($response);
                }        
            }


        public function placeorder(Request $request)
        {
            if(Session::has('user_hash')){
            $user_hash = session('user_hash');
            $title = 'MyOrder';
            $data['oder'] =  User::where('is_deleted', 0)->findOrFail($user_hash);

            $validator= Validator::make($request->all(),
            [
                'fullname' => 'required|regex:/^[a-zA-Z\s]+$/',
                'contact_no' => 'required|regex:/(09)[0-9]{9}$/'
            ]);
            
            $ursf = DB::table('brgy')
            ->select('shipping_fee')
            ->where('brgy_hash', $request->input('barangay'))
            // ->where('sumr_sumr', $request->input('city'))
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

                $unit_total = 0; 
                $order_subtotal = 0; 
                $total_qty = 0; 
                $shipping = 0; 
                $shipping_extra = 0;
                $total_excess_fee = 0;
                $total_excess_kg = 0;
                $xk = 0;
                $xkf = 0;
                $shipping_city = 0; 
                $order_total = 0; 
                $cart_subtotal = 0; 
                $total_shipping = 0; 
                $total_payment = 0;
                $dimension = 0;
                $weight = 0;
                $total_kg = 0;
                $max_kg = $comr[0]->max_kg;
                $excess_kg_fee = $comr[0]->excess_kg_fee;
                $azspree_percent = $comr[0]->azspree;
                $dh_percent = $comr[0]->dh;
                $azspree = 0;
                $dh = 0;
                $sub_1 = 0;
                $sub_2 = 0;
                $sub_3 = 0;
                $sub_4 = 0;
                $sub_5 = 0;


                $order = new OrderHeader();
                $order->order_no = date('Ymd').'-';
                $order->order_date = date("Y-m-d");
                $order->co_no = '01';
                $order->regn_hash = $request->input('region');
                $order->prov_hash = $request->input('province');
                $order->city_hash = $request->input('city');
                $order->brgy_hash = $request->input('barangay');
                $order->address = $request->input('address');
                $order->user_hash = $user_hash;
                $order->fullname = ucwords($request->input('fullname'));
                $order->contact_no = $request->input('contact_no');
                $order->sumr_hash = $supplier[$i]->sumr_hash;
                $order->payment_method = $request->input('payment_method');
                $order->create_datetime = Carbon::now();
                // $order->expire_cancel_datetime = Carbon::now()->addHours(5);
                $order->save();

                $sohr_hash = $order->sohr_hash;

                $line_no = 1;
                for ($a=0; $a < count($mycart); $a++) { 
                    if($supplier[$i]->sumr_hash == $mycart[$a]->sumr_hash){

                        $unit_total =$mycart[$a]->cost_amt * $mycart[$a]->qty; 
                        $order_subtotal += $unit_total;
                        $total_qty += $mycart[$a]->qty;

                        // $city_sumr_hash= $ursf[0]->sumr_hash;
                        $shipping_city= $ursf[0]->shipping_fee;
                        $dimension = $mycart[$a]->dimension;
                        $weight = $mycart[$a]->weight;

                        if ($dimension > $weight){
                            if ($dimension > $max_kg){
                                $sub_1= ($dimension - $max_kg);
                                $xkf= (($sub_1 * $mycart[$a]->qty) * $excess_kg_fee);
                                $xk= ($sub_1 * $mycart[$a]->qty);
                                $sub_2 = ($sub_1 * $excess_kg_fee );
                                $total_kg = ($sub_2 * $mycart[$a]->qty );
                            }else{
                                if($mycart[$a]->qty > 1){
                                    $sub_3 = ($dimension * $mycart[$a]->qty );
                                    $sub_4 = (round($sub_3) - $max_kg);
                                    $sub_5 = ($sub_4 * $excess_kg_fee );
                                    $total_kg = $sub_5;
                                  }else{
                                    $total_kg = 0;
                                  }
                                }
                        }else if($dimension = $weight){
                            if ($weight > $max_kg){
                                $sub_1= ($weight - $max_kg);
                                $xkf= (($sub_1 * $mycart[$a]->qty) * $excess_kg_fee);
                                $xk= ($sub_1 * $mycart[$a]->qty);
                                $sub_2 = ($sub_1 * $excess_kg_fee );
                                $total_kg = ($sub_2 * $mycart[$a]->qty );
                            }else{
                                if($mycart[$a]->qty > 1){
                                    $sub_3 = ($weight * $mycart[$a]->qty );
                                    $sub_4 = (round($sub_3) - $max_kg);
                                    $sub_5 = ($sub_4 * $excess_kg_fee );
                                    $total_kg = $sub_5;
                                  }else{
                                    $total_kg = 0;
                                  }
                            }
                        }else{
                            if ($weight > $max_kg){
                                $sub_1= ($weight - $max_kg);
                                $xkf= (($sub_1 * $mycart[$a]->qty) * $excess_kg_fee);
                                $xk= ($sub_1 * $mycart[$a]->qty);
                                $sub_2 = ($sub_1 * $excess_kg_fee);
                                $total_kg = ($sub_2 * $mycart[$a ]->qty );
                            }else{
                                if($weight >= 1){
                                    $total_kg = $weight;
                                }else{
                                    if($mycart[$a]->qty > 1){
                                        $sub_3 = ($weight * $mycart[$a]->qty );
                                        $sub_4 = (round($sub_3) - $max_kg);
                                        $sub_5 = ($sub_4 * $excess_kg_fee );
                                        $total_kg = $sub_5;
                                      }else{
                                        $total_kg = 0;
                                      }
                                }
                            }
                        }
                        $shipping_extra += $total_kg;
                        $total_excess_kg += $xk;
                        $total_excess_fee += $xkf;
                        $shipping = $shipping_extra + $shipping_city;
                        $order_total = $order_subtotal+$shipping; 
                        $azspree = $order_total * $azspree_percent;
                        $dh = $order_total * $dh_percent;


                        $orderdetail = new OrderDetail();
                        $orderdetail->sohr_hash = $sohr_hash;
                        $orderdetail->inmr_hash = $mycart[$a]->inmr_hash;
                        $orderdetail->vrnt_hash = $mycart[$a]->vrnt_hash;
                        $orderdetail->qty = $mycart[$a]->qty;
                        $orderdetail->line_no = $line_no++;
                        $orderdetail->unit_price = $mycart[$a]->cost_amt;
                        $orderdetail->dimension = $mycart[$a]->dimension;
                        $orderdetail->weight = $mycart[$a]->weight;
                        $orderdetail->excess_fee = $sub_2;
                        $orderdetail->excess_kg = $sub_1;
                        $orderdetail->create_datetime = Carbon::now();
                        $orderdetail->save();


                        DB::table('srln')->where('srln_hash', $mycart[$a]->srln_hash)->update(['status' => '1']);   
                        DB::table('vrnt')->where('vrnt_hash', $mycart[$a]->vrnt_hash)
                        ->where('inmr_hash', $mycart[$a]->inmr_hash)
                        ->decrement('available_qty',$orderdetail->qty);
           
                    }   

                }
                // sleep(60);

                $order = OrderHeader::findOrFail($sohr_hash);
                $order->order_no = date('Ymd').'-'.$sohr_hash;
                $order->total_qty = $total_qty;
                $order->order_subtotal = $order_subtotal;
                $order->shipping_fee = $shipping;
                // $order->city_sumr_hash = $city_sumr_hash;
                $order->total_excess_fee = $total_excess_fee;
                $order->total_excess_kg = $total_excess_kg;
                $order->disc_amt = 0;
                $order->order_total = $order_total;
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
        
                    Mail::send([], [], function ($message) use ($data, $seller_name, $email ) {
                        $message->to($email[0]->email)
                            ->subject('New Order from AZSpree')
                            ->setBody('Hi ' .$seller_name[0]->seller_name.', You have a new order, Order No. '.$data['order_no']. ' Check Now https://azspree.com:81 ', 'text/html'); // for HTML rich messages
                      });
                      
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
        }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        $search = Product::select('product_name')->findOrFail($id);

        $variant = DB::table('vrnt')
        ->select('vrnt.*')
        ->leftJoin('inmr', 'inmr.inmr_hash', '=', 'vrnt.inmr_hash')
        ->where('inmr.is_deleted', 0)
        ->where('inmr.is_verified', 1)
        ->where('vrnt.is_deleted', 0)
        ->where('vrnt.inmr_hash', $id)
        ->get();

        $data['var_max'] = Product::leftJoin('vrnt', 'vrnt.inmr_hash', '=', 'inmr.inmr_hash')
        ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'inmr.sumr_hash')
        ->where('inmr.is_deleted', 0)
        ->orderBy('vrnt.cost_amt','desc')
        ->findOrFail($id);

        $data['var_min'] = Product::leftJoin('vrnt', 'vrnt.inmr_hash', '=', 'inmr.inmr_hash')
        ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'inmr.sumr_hash')
        ->where('inmr.is_deleted', 0)
        ->orderBy('vrnt.cost_amt','asc')
        ->findOrFail($id);

        $data['products'] = Product::leftJoin('inct', 'inct.inct_hash', '=', 'inmr.inct_hash')
        ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'inmr.sumr_hash')
        ->where('inmr.is_deleted', 0)
        ->where('inmr.is_verified', 1)
        ->groupBy('inmr.sumr_hash')
        ->findOrFail($id);

        $data['comment'] = Comment::leftJoin('inmr', 'inmr.inmr_hash', '=', 'cmnt.inmr_hash')
        ->leftJoin('user', 'user.user_hash', '=', 'cmnt.user_hash')
        ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'cmnt.sumr_hash')
        ->where('cmnt.inmr_hash',$id)
        ->orderBy('cmnt.cmnt_hash','desc')
        ->paginate(3);

        $data['order'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->leftJoin('user', 'user.user_hash', '=', 'sohr.user_hash')
            ->where('soln.status_ratings', 1)
            ->where('soln.inmr_hash',$id)
            // ->where('soln.inmr_hash',$id)
            // ->orderBy('soln.sohr_hash', 'desc')
            ->paginate(5);
            

            $var_max = Product::leftJoin('vrnt', 'vrnt.inmr_hash', '=', 'inmr.inmr_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'inmr.sumr_hash')
            ->where('inmr.is_verified', 1)
            ->where('inmr.is_deleted', 0)
            ->orderBy('vrnt.cost_amt','desc')
            ->get();

            $var_min = Product::leftJoin('vrnt', 'vrnt.inmr_hash', '=', 'inmr.inmr_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'inmr.sumr_hash')
            ->where('inmr.is_verified', 1)
            ->where('inmr.is_deleted', 0)
            ->orderBy('vrnt.cost_amt','asc')
            ->get();

            $string = $data['products']->product_name;

            // split on 1+ whitespace & ignore empty (eg. trailing space)
            $searchValues = preg_split('/\s+/', $string, -1, PREG_SPLIT_NO_EMPTY); 
            
            $content =  DB::table('inmr')
            ->leftJoin('inct', 'inct.inct_hash', '=', 'inmr.inct_hash')
            ->where('inmr.is_deleted', 0)
            ->where('inmr.is_verified', 1)
            ->where('inct.inct_hash', $data['products']->inct_hash)
            ->where(function ($q) use ($searchValues) {
              foreach ($searchValues as $value) {
                $q->orWhere('inmr.product_name', 'like', "%{$value}%");
              }
            })
            ->inRandomOrder()
            ->paginate(16);

            
            $shop =  DB::table('inmr')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'inmr.sumr_hash')
            ->where('inmr.is_deleted', 0)
            ->where('inmr.is_verified', 1)
            ->where('sumr.sumr_hash', $data['products']->sumr_hash)
            ->inRandomOrder()
            ->paginate(16);
        
        $visit =  DB::table('cntr')->where('is_deleted', 0)->get();
            return view('pages/productdetails', compact('visit', 'content' , 'shop', 'variant', 'var_min', 'var_max'))->with('data', $data);
        
        // return view('pages.productdetails')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {       
            
        
            $srhr_hash = session('user_hash');
            $title = 'MyCart';
            $data['mycart'] =  User::where('is_deleted', 0)->findOrFail($srhr_hash);

            $addcart = CartDetail::findOrFail($id);
            $addcart->srhr_hash = $srhr_hash;
            $addcart->qty = $request->input('qty');
            $addcart->update_datetime = Carbon::now();
            $addcart->save();

            // return redirect('/mycart')->with('successMsg', ' Successfully updated!');

    }

    public function updatecart(Request $request)
    {       

            $id = $request->srln_hash;
            
            $updatecart = CartDetail::findOrFail($id);
            $updatecart->is_selected = $request->is_selected;
            $updatecart->save();

    }   
    
    
    public function updateqty(Request $request)
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
        //  )->validate();

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

    public function delete($id)
    {   
        $addcart = CartDetail::findOrFail($id);

        $addcart->is_deleted = 1;
        $addcart->update_datetime = Carbon::now();
        $addcart->save();

        // return redirect('/mycart')->with($response['stat']='success', $response['msg']='<b>Successfully Deleted.</b>');
        return redirect('/mycart')->with('successMsg', ' Successfully Deleted!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
