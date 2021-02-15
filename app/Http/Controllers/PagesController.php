<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\VisitorCounter;
use App\Models\OrderDetail;
use Session;
use DB;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Azspree';
        $categories =  DB::table('inct')->where('is_deleted', 0)->orderBy('cat_name','asc')->get();
        $content =  DB::table('inmr')->where('is_deleted', 0)->where('is_verified', 1)->orderBy('inmr_hash','desc')->paginate(24);

        $visitcount =  DB::table('cntr')->where('is_deleted', 0)->where('ip_address', $request->ip())->get();
        $visit =  DB::table('cntr')->where('is_deleted', 0)->get();
        // $content =  DB::table('inmr')->where('is_deleted', 0)->where('is_verified', 1)->inRandomOrder()->paginate(24);
        return view('welcome', compact('categories','content','visitcount', 'visit'));
    }
    public function login(){
        if(Session::has('user_hash')){
            $user_hash = session('user_hash');
            $title = 'Profile';
            $data['profile'] =  User::where('is_deleted', 0)->findOrFail($user_hash);

            $visit =  DB::table('cntr')->where('is_deleted', 0)->get();

            $data['order_no'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->groupBy('sohr.order_no')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['order'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['to_ship'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '2')
            ->groupBy('sohr.order_no')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['ship'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '2')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['to_receive'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
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
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '3')
            ->orwhere('sohr.status_user', '4')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['all_completed'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '5')
            ->groupBy('sohr.order_no')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['completed'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '5')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['all_cancel'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '6')
            ->groupBy('sohr.order_no')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['cancelled'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '6')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['reason'] =  DB::table('urfc')->get();


            return view('pages.profile', compact('visit'))->with('data', $data);
            // return view('pages.profile')->with('data', $data);
        }else{
            // return view('pages.login');
            $visit =  DB::table('cntr')->where('is_deleted', 0)->get();
            return view('pages.login', compact('visit'));
        }
    }
    

    public function update(Request $request){
        // $ip = $this->server->get('REMOTE_ADDR');

        // $visitcount = $request->visit_count;
        
        // //     // DB::table('cntr')->where('cntr_hash', '1')->update(['times' => $visitcount ]);
        //     DB::table('cntr')->where('cntr_hash', '1')->update(['times' => $request->visit_count ]);

        // // $cntr_hash = 1;
        $check_if_exists = DB::table('cntr')->where('ip_address', $request->ip())->first();

        if(!$check_if_exists)
        {
            $visitcount = new VisitorCounter;
            $visitcount->times = 1;
            $visitcount->ip_address = $request->ip();
            $visitcount->save();
        }else{
            DB::table('cntr')->where('ip_address', $request->ip())->increment('times');
        }


        
        // $visitcount = new VisitorCounter;
        // $visitcount->times = $request->visit_count;

        // $visitcount->save();
        
    } 

    public function signup(){
        if(Session::has('user_hash')){
            $user_hash = session('user_hash');
            $title = 'Profile';
            $data['profile'] =  User::where('is_deleted', 0)->findOrFail($user_hash);

            $visit =  DB::table('cntr')->where('is_deleted', 0)->get();

            $data['order_no'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->groupBy('sohr.order_no')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['order'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['to_ship'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '2')
            ->groupBy('sohr.order_no')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['ship'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '2')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['to_receive'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
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
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '3')
            ->orwhere('sohr.status_user', '4')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['all_completed'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '5')
            ->groupBy('sohr.order_no')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['completed'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '5')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['all_cancel'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '6')
            ->groupBy('sohr.order_no')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['cancelled'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'sohr.sumr_hash')
            ->leftJoin('oust', 'oust.oust_hash', '=', 'sohr.status_user')
            ->where('sohr.user_hash', $user_hash)
            ->where('sohr.status_user', '6')
            ->orderBy('sohr.sohr_hash', 'desc')
            ->get(); 

            $data['reason'] =  DB::table('urfc')->get();


            return view('pages.profile', compact('visit'))->with('data', $data);
            // return view('pages.profile')->with('data', $data);
        }else{
           // return view('pages/signup');
            $visit =  DB::table('cntr')->where('is_deleted', 0)->get();
            return view('pages/signup', compact('visit'));
        }
    }

    public function try()
    {
        $data['addition'] =  DB::table('add')->where('is_deleted', 0)->inRandomOrder()->get();
        return view ('pages.try')->with('data', $data);
    }

    public function checkout(){
        if(Session::has('user_hash')){
            // return view('pages/checkout');
            $visit =  DB::table('cntr')->where('is_deleted', 0)->get();
            return view('pages/checkout', compact('visit'));
        }else{
            // return view('pages/login');
            $visit =  DB::table('cntr')->where('is_deleted', 0)->get();
            return view('pages/login', compact('visit'));
        }
    }

    public function payment(){
        if(Session::has('user_hash')){
            // return view('pages/payment');
            $visit =  DB::table('cntr')->where('is_deleted', 0)->get();
            return view('pages/payment', compact('visit'));
        }else{
            // return view('pages/login');
            $visit =  DB::table('cntr')->where('is_deleted', 0)->get();
            return view('pages/login', compact('visit'));
        }
    }

    

    public function mycart()
    {
        $data['products'] = Product::where('is_deleted', 0)->get();
        $visit =  DB::table('cntr')->where('is_deleted', 0)->get();
            return view('pages/mycart', compact('visit'))->with('data', $data);
        // return view('pages.mycart')->with('data', $data);
    }

    public function verify()
    {
        return view('pages.verify');
    }

    public function search(Request $request)
    {

        $search = $request->keyword;

        $visit =  DB::table('cntr')->where('is_deleted', 0)->get();
        $categories =  DB::table('inct')->where('is_deleted', 0)->get();

        $content=  DB::table('inmr')->select('*')
        ->leftJoin('inct', 'inct.inct_hash', '=', 'inmr.inct_hash')
        ->leftJoin('insc', 'insc.insc_hash', '=', 'inmr.insc_hash')
        ->where('inmr.is_deleted', 0)
        ->where('inmr.is_verified', 1)
        ->where(function($query) use($search){
            $query->where('inmr.product_name','like',"%".$search."%")
            ->orwhere('inmr.product_details','like',"%".$search."%")
            ->orwhere('inct.cat_name','like',"%".$search."%")
            ->orwhere('insc.subcat_name','like',"%".$search."%");
        })
        ->paginate(24);

        return view ('welcome',compact('categories','content', 'visit'));
    }

    public function sortbyprice(Request $request)
    {
        $sortbyprice = $request->sortbyprice;

        $visit =  DB::table('cntr')->where('is_deleted', 0)->get();
        $categories =  DB::table('inct')->where('is_deleted', 0)->orderBy('cat_name','asc')->get();

         if ($sortbyprice == 'asc'){
            $content = DB::table('inmr')->where('inmr.is_deleted', 0)->where('is_verified', 1)->orderBy('cost_amt','asc')->paginate(24);
            } else {
            $content = DB::table('inmr')->where('inmr.is_deleted', 0)->where('is_verified', 1)->orderBy('cost_amt','desc')->paginate(24);
            }

        return view ('welcome',compact('categories','content', 'visit' ));
    }

    public function sortbypricebycat(Request $request)
    {

        $visit =  DB::table('cntr')->where('is_deleted', 0)->get();
        $sortbypricebycat = $request->sortbypricebycat;
        $id = $request->category;

        $cat =  DB::table('inct')
        ->where('is_deleted', 0)
        ->where('inct_hash', $id)
        ->groupBy('cat_name')
        ->get();

        $cathash =  DB::table('inct')
        ->where('is_deleted', 0)
        ->where('inct_hash', $id)
        ->groupBy('cat_name')
        ->get();
    
        $category =  DB::table('inct')->where('is_deleted', 0)->orderBy('cat_name','asc')->get();

        if ($sortbypricebycat == 'asc'){
            $content = DB::table('inmr')->where('inmr.is_deleted', 0)->where('is_verified', 1)->where('inmr.inct_hash', $id)->orderBy('cost_amt','asc')->paginate(24);
            } else {
            $content = DB::table('inmr')->where('inmr.is_deleted', 0)->where('is_verified', 1)->where('inmr.inct_hash', $id)->orderBy('cost_amt','desc')->paginate(24);
            }

        return view ('pages.categories',compact('category','content','cat', 'cathash', 'visit'));
    }
    public function show($id)
    {
        $content =  DB::table('inmr')
        ->leftJoin('inct', 'inct.inct_hash', '=', 'inmr.inct_hash')
        ->where('inmr.is_deleted', 0)
        ->where('inmr.is_verified', 1)
        ->where('inmr.inct_hash', $id)
        ->paginate(24);

        $cat =  DB::table('inct')
        ->where('is_deleted', 0)
        ->where('inct_hash', $id)
        ->groupBy('cat_name')
        ->get();

        $cathash =  DB::table('inct')
        ->where('is_deleted', 0)
        ->where('inct_hash', $id)
        ->groupBy('cat_name')
        ->get();
    
        $visit =  DB::table('cntr')->where('is_deleted', 0)->get();
        $category =  DB::table('inct')->where('is_deleted', 0)->orderBy('cat_name','asc')->get();

        return view ('pages.categories',compact('category','content','cat', 'cathash', 'visit'));
    }

    public function searchcat(Request $request)
    {

        $search = $request->keyword;
        $id = $request->category;

        $content =  DB::table('inmr')
        ->leftJoin('inct', 'inct.inct_hash', '=', 'inmr.inct_hash')
        ->leftJoin('insc', 'insc.insc_hash', '=', 'inmr.insc_hash')
        ->where('inmr.is_deleted', 0)
        ->where('inmr.is_verified', 1)
        ->where('inmr.inct_hash', $id)
        ->where(function($query) use($search){
            $query->where('inmr.product_name','like',"%".$search."%")
            ->orwhere('inmr.product_details','like',"%".$search."%")
            ->orwhere('inct.cat_name','like',"%".$search."%")
            ->orwhere('insc.subcat_name','like',"%".$search."%");
        })
        ->paginate(24);

        $cat =  DB::table('inct')
        ->where('is_deleted', 0)
        ->where('inct_hash', $id)
        ->groupBy('cat_name')
        ->get();

        $cathash =  DB::table('inct')
        ->where('is_deleted', 0)
        ->where('inct_hash', $id)
        ->groupBy('cat_name')
        ->get();
    
        $category =  DB::table('inct')->where('is_deleted', 0)->orderBy('cat_name','asc')->get();
        $visit =  DB::table('cntr')->where('is_deleted', 0)->get();

        return view ('pages.categories',compact('category','content','cat', 'cathash', 'visit'));
    }
  

    public function profile()
    {
        // return view ('pages.profile');
        $visit =  DB::table('cntr')->where('is_deleted', 0)->get();
            return view('pages.profile', compact('visit'));
    }

    public function waybill()
    {
        return view ('pages.waybill');
    }

    public function delivery()
    {
        return view ('pages.delivery');
    }

    public function welcomeseller()
    {
        // return view ('pages.welcomeseller');
        $visit =  DB::table('cntr')->where('is_deleted', 0)->get();
        return view ('pages.welcomeseller', compact('visit'));
    }

}