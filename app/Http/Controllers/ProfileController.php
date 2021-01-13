<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OrderHeader;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Mpdf\Mpdf;
use Carbon\Carbon;
use Session;
use DB;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::has('user_hash')){
            $user_hash = session('user_hash');
            $title = 'Profile';

            $visit =  DB::table('cntr')->where('is_deleted', 0)->get();
            
            $data['profile'] =  User::where('is_deleted', 0) 
            ->leftJoin('regn', 'regn.regn_hash', '=', 'user.regn_hash')
            ->leftJoin('prov', 'prov.prov_hash', '=', 'user.prov_hash')
            ->leftJoin('city', 'city.city_hash', '=', 'user.city_hash')
            ->leftJoin('brgy', 'brgy.brgy_hash', '=', 'user.brgy_hash')
            ->findOrFail($user_hash);

            $data['prof'] =  User::where('is_deleted', 0) 
            ->leftJoin('regn', 'regn.regn_hash', '=', 'user.regn_hash')
            ->leftJoin('prov', 'prov.prov_hash', '=', 'user.prov_hash')
            ->leftJoin('city', 'city.city_hash', '=', 'user.city_hash')
            ->leftJoin('brgy', 'brgy.brgy_hash', '=', 'user.brgy_hash')
            ->where('user.user_hash', $user_hash)
            ->get();

            $data['tbl_region'] =  DB::table('regn')->get();
            $data['tbl_province'] =  DB::table('prov')->get();
            $data['tbl_city'] =  DB::table('city')->get();
            $data['tbl_brgy'] =  DB::table('brgy')->get();
            // SHOW ALL THE ORDERS OF 1 USER
            // $data['order'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            // ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            // ->where('sohr.user_hash', $user_hash)
            // ->get(); 

            $data['order_no'] = OrderHeader::leftJoin('user', 'user.user_hash', '=', 'sohr.user_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->groupBy('sohr.order_no')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['order'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->where('sohr.user_hash', $user_hash)
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['to_ship'] = OrderHeader::leftJoin('user', 'user.user_hash', '=', 'sohr.user_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '2')
            ->groupBy('sohr.order_no')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['ship'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '2')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 


            $data['to_receive'] = OrderHeader::leftJoin('user', 'user.user_hash', '=', 'sohr.user_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '3')
            ->orwhere('sohr.status_user', '4')
            ->groupBy('sohr.order_no')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['delivered'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '3')
            ->orwhere('sohr.status_user', '4')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 


            $data['all_completed'] = OrderHeader::leftJoin('user', 'user.user_hash', '=', 'sohr.user_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '5')
            ->groupBy('sohr.order_no')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['completed'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '5')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get();  

            $data['all_cancel'] = OrderHeader::leftJoin('user', 'user.user_hash', '=', 'sohr.user_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '6')
            ->groupBy('sohr.order_no')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['cancelled'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '6')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get();  

            $data['reason'] =  DB::table('urfc')->get();


        // return view('pages.profile', compact('visit'))->with('data', $data);
        return view('pages.profile')->with('data', $data);
    }else{
        // $visit =  DB::table('cntr')->where('is_deleted', 0)->get();
        // return view('pages.login', compact('visit'));
        return view('pages.login');
        }
    }

    public function updatestatus($id)
    {       
            
            $order = OrderHeader::findOrFail($id);
            $order->status_user = '5';
            $order->is_comp = '1';
            $order->save();

            // $points = $order->order_total / 100;
            // DB::table('user')->where('user_hash', $order->user_hash)->increment('az_pouch',$points);

            return redirect('/profile');
    } 

    public function updatecancel(Request $request,$id)
    {       

        $check = OrderHeader::select('order_stat')
        ->where('sohr_hash', $id)
        ->where('order_stat', '>', '1')
        ->get(); 

        if (count ($check) > 0){
            // return redirect('/profile');
            return redirect('/profile')->with('error', 'Sorry, This order cannot be cancelled anymore.');
        }else{
            $order = OrderHeader::findOrFail($id);
            $order->order_stat = '9';
            $order->status_user = '6';
            $order->is_cancel = '1';
            $order->user_reason_decline = $request['reason'];
            $order->user_decline_datetime = Carbon::now();
            $order->save();

                $myorder = OrderDetail::select('inmr_hash', 'qty')
                ->where('soln.sohr_hash', $id)
                ->get(); 
            
                foreach ($myorder as $order)
                {
                    DB::table('inmr')->where('inmr_hash', $order->inmr_hash)->increment('available_qty',$order->qty);
                }
                return redirect('/profile')->with('status', 'Success, This order has been cancelled.');
        }

                    
    } 
   
    public function review(Request $request, $id)
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

            return redirect('/profile');
    }  
    
    public function editprofile(Request $request, $id)
    {       

        $validator= Validator::make($request->all(),
            [
                'fullname' => 'required|regex:/^[a-zA-Z\s]+$/',
                'contact_no' => 'required|regex:/(09)[0-9]{9}$/'
            ]
        );
        if($validator->fails()){
            return redirect('/profile')->with('status', 'Required.');
        } else {

            $profile = User::where('is_deleted', 0)->findOrFail($id);
            $profile->fullname = $request->input('fullname');
            $profile->contact_no = $request->input('contact_no');
            $profile->save(); 

            return redirect('/profile')->with('status', 'else to.');
        }
    }  


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
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
        //
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

    public function waybill()
    {
        $mpdf = new Mpdf();
       
        $content = view('pages.waybill');
        // Write some HTML code:
        $mpdf->WriteHTML($content);
        // Output a PDF file directly to the browser
        $mpdf->Output();
    }

    public function logs()
    {
        $mpdf = new Mpdf();
       
        $content = view('pages.logs');
        // Write some HTML code:
        $mpdf->WriteHTML($content);
        // Output a PDF file directly to the browser
        $mpdf->Output();
    }
}
