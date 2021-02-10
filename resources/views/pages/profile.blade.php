@extends('pages.index')

@section('embeddedcss')
<style scoped>
  .star-rating {
  font-size: 0;
  white-space: nowrap;
  display: inline-block;
  width: 250px;
  height: 50px;
  overflow: hidden;
  position: relative;
  background: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjREREREREIiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');
  background-size: 50px;
}
.star-rating i {
  opacity: 0;
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  width: 20%;
  z-index: 1;
  background: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjRkZERjg4IiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');
  background-size: 50px;
}
.star-rating input {
  -moz-appearance: none;
  -webkit-appearance: none;
  opacity: 0;
  display: inline-block;
  width: 20%;
  height: 100%;
  margin: 0;
  padding: 0;
  z-index: 2;
  position: relative;
}
.star-rating input:hover + i,
.star-rating input:checked + i {
  opacity: 1;
}
.star-rating i ~ i {
  width: 40%;
}
.star-rating i ~ i ~ i {
  width: 60%;
}
.star-rating i ~ i ~ i ~ i {
  width: 80%;
}
.star-rating i ~ i ~ i ~ i ~ i {
  width: 100%;
}
::after,
::before {
  height: 100%;
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  text-align: center;
  vertical-align: middle;
}
.myacc:hover, .mypur:hover{
   color:rgb(60, 204, 190);;
}
</style>
@endsection

@section('content')
    <div class="container p-140-cont">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body"> 
                        <center> <b style="color:rgb(72, 99, 160);" >Hi</b> <b style="color:black">{{ $data['profile']->fullname }}</b> </center>
                        <hr style="margin:0;padding:0px;">
                        <br>
                        <button class="mypur" style="border: none; border-color: transparent; background-color: white; font-weight: bold;"><img src="/brands_try/Purchase.png" class="logo-img" alt="img" style="font-size: 5px">&nbsp;PURCHASE</button><br>
                        <button class="myacc" style="border: none; border-color: transparent; background-color: white; font-weight: bold;"><img src="/brands_try/User.png" class="logo-img" alt="img" style="font-size: 5px">&nbsp;ACCOUNT</button><br>
                        &nbsp; <img src="/brands_try/Coins.png" class="logo-img" alt="img" style="font-size: 5px">&nbsp;<span style="font-weight: bold;" >AZ POUCH</span>&nbsp;<b style="color:black">{{ $data['profile']->az_pouch }}</b>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-9">
              @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
              @endif
              @if (session('error'))
                <div class="alert alert-danger animated shake">
                    {{ session('error') }}
                </div>
              @endif
              <div id="MyPurchase" style="display: block;">
              <div class="panel panel-default">
                
                <div class="panel-heading">
                    <center><label>MY PURCHASE</label></center>
                </div>
                <div class="panel-body">
                  <div id="tabs" class="mb-0 bs-docs-section">
                  <div class="row">
                  <div class="col-md-12">
                    <ul id="myTab2" class="nav nav-pills bootstrap-tabs">
                      <li class="active"><a href="#all" class="button medium cyan" style="width: 150px; text-align: center;" data-toggle="tab" aria-expanded="true">ALL</a></li>
                      <li><a href="#toship" class="button medium cyan" style="width: 150px; text-align: center;" data-toggle="tab">TO SHIP</a></li>
                      <li><a href="#toreceive" class="button medium cyan" style="width: 150px; text-align: center;" data-toggle="tab">TO RECEIVE</a></li>
                      <li><a href="#completed" class="button medium cyan" style="width: 150px; text-align: center;" data-toggle="tab">COMPLETED</a></li>
                      <li><a href="#cancelled" class="button medium cyan" style="width: 150px; text-align: center;" data-toggle="tab">CANCELLED</a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane fade active in" id="all">
                        <?php 
                        if(count($data['order']) > 0){
                        foreach ($data['order_no'] as $order_no): ?>
                        <div class="panel panel-default">
                          <div class="panel-body">
                              <div class="row" >
                                  <div class="col-md-6">
                                    <label class="label label-primary" style="color:white; font-size:15px">Order Number {{ $order_no->order_no }}</label><br>
                                  </div>
                                  <div class="col-md-6">
                                    <b style="color:rgb(72, 99, 160); float: right;"> {{ $order_no->order_name }}</b><br>
                                  </div>
                              </div>
                              <br><hr class="mt-0 mb-10">
                              <?php 
                              foreach ($data['order'] as $order):
                              if($order->order_no == $order_no->order_no){
                              ?>
                              <div class="row">
                                <div class="col-md-2">
                                  {{-- <a href="/productdetails/{{$order->inmr_hash}}"><img src="/HTML/images/shop/recent/1.jpg" alt="img"></a> --}}
                                  <img style="height: 60px; width: 45px;" src="/images/products/{{$order->image_path}}" alt="img">
                                </div>
                                <div class="col-md-6">
                                  <b style="color:black">{{ $order->product_name }}</b>
                                  <br>
                                  <label style="color:black"> x {{ $order->qty }} </label>
                                  <br>
                                  <br>
                                </div>
                                <div class="col-md-4">
                                  <br>
                                  <label style="font-size:16px; color:rgb(72, 99, 160); float: right;">  &#8369; {{ number_format($order->unit_price, 2) }} </label><br>
                                  
                                </div>
                                <div class="row">
                                {{-- SHOW ONCED RECEIVED ORDER --}}
                                <?php 
                                if($order_no->order_name == 'COMPLETED'){
                                ?> 
                                <div class="col-md-12" >
                                  <div style="float: right" >
                                    <?php if($order->status_ratings == '0') { ?> 
                                      <a href="" data-toggle="modal" data-target="#ModalReview{{$order->inmr_hash}}" class="button medium blue w-100-100">RATE NOW</a>
                                      <span class="slash-divider"></span>
                                    <?php }?>
                                      <a href="/productdetails/{{$order->inmr_hash}}" class="button medium blue w-100-100">BUY AGAIN</a>
                                      <span class="slash-divider"></span>
                                  </div>
                                </div>
                                <?php }?>
                                </div>
                            </div><br>
                            
                            <!-- DIVIDER -->
                            <hr class="mt-0 mb-10">     

                            <?php }?> {{-- END OF SAME SELLER/SUPLIER --}}
                            <?php endforeach; ?> {{-- END OF CART --}}
                              <div class="row">
                                <div class="col-md-4" >
                                  <label style="font-size:16px; color:black; ">Shop:
                                  <label style="font-size:18px; color:rgb(72, 99, 160);">{{ $order_no->shop_name }} </label></label><br>
                              </div>
                                <div class="col-md-8 text-right" >
                                    <label style="font-size:16px; color:black; float:right;">Order Total:
                                    <label style="font-size:18px; color:rgb(72, 99, 160);">&#8369; {{ number_format($order_no->order_total, 2) }} </label></label><br>
                                </div>
                              </div>
                              {{-- SHOW WHEN PENDING ORDER TO CANCEL--}}
                              <?php 
                              $current_date = date("Y-m-d");
                              if($order_no->order_name == 'PENDING' && $order_no->order_date == $current_date){
                              ?> 
                              <div class="row">
                              <div class="col-md-12" >
                                <div style="float: right" >
                                  <a href="" data-toggle="modal" data-target="#ModalCancel{{$order_no->sohr_hash}}" class="button medium blue w-100-100">CANCEL ORDER</a>
                                </div>
                              </div>
                              </div>
                              <?php }?> 
                              {{-- SHOW WHEN ORDER DELIVERED--}}
                              <?php 
                              if($order_no->order_name == 'DELIVERED'){
                              ?> 
                              <div class="row">
                              <div class="col-md-12" >
                                <div style="float: right" >
                                  <a href="" data-toggle="modal" data-target="#ModalReceive{{$order_no->sohr_hash}}" class="button medium blue w-100-100">RECEIVE ORDER</a>
                                </div>
                              </div>
                              </div>
                              <?php }?> 
                        </div>
                      </div> 
                        <?php endforeach; ?> {{-- END OF SUPPLIER --}}
                        <?php }else{ ?>
                        <div>
                        <center>No Purchase Yet</center>
                        </div>
                        <?php }?>
                      </div>
                      <div class="tab-pane fade" id="toship">
                        <?php 
                        if(count($data['ship']) > 0){
                        foreach ($data['to_ship'] as $order_no): ?>
                        <div class="panel panel-default">
                          <div class="panel-body">
                              <div class="row" >
                                  <div class="col-md-6">
                                    <label class="label label-primary" style="color:white; font-size:15px">Order Number {{ $order_no->order_no }}</label><br>
                                  </div>
                                  <div class="col-md-6">
                                    <b style="color:rgb(72, 99, 160); float: right;"> {{ $order_no->order_name }}</b><br>
                                  </div>
                              </div>
                              <br><hr class="mt-0 mb-10">
                              <?php 
                              foreach ($data['ship'] as $order):
                              if($order->order_no == $order_no->order_no){
                              ?>
                              <div class="row">
                                <div class="col-md-2">
                                  {{-- <a href="/productdetails/{{$order->inmr_hash}}"><img src="/HTML/images/shop/recent/1.jpg" alt="img"></a> --}}
                                  <img style="height: 60px; width: 45px;" src="/images/products/{{$order->image_path}}" alt="img">
                                </div>
                                <div class="col-md-6">
                                  <b style="color:black">{{ $order->product_name }}</b>
                                  <br>
                                  <label style="color:black"> x {{ $order->qty }} </label>
                                  <br>
                                  <br>
                                </div>
                                <div class="col-md-4">
                                  <br>
                                  <label style="font-size:16px; color:rgb(72, 99, 160); float: right;">  &#8369; {{ number_format($order->unit_price, 2) }} </label><br>
                                  
                                </div>
                            </div><br>
                            <!-- DIVIDER -->
                            <hr class="mt-0 mb-10">     

                            <?php }?> {{-- END OF SAME SELLER/SUPLIER --}}
                            <?php endforeach; ?> {{-- END OF CART --}}
                              <div class="row">
                                <div class="col-md-4" >
                                  <label style="font-size:16px; color:black; ">Shop:
                                  <label style="font-size:18px; color:rgb(72, 99, 160);">{{ $order_no->shop_name }} </label></label><br>
                              </div>
                                <div class="col-md-8 text-right" >
                                    <label style="font-size:16px; color:black; float:right;">Order Total:
                                    <label style="font-size:18px; color:rgb(72, 99, 160);">&#8369; {{ number_format($order_no->order_total, 2) }} </label></label><br>
                                </div>
                              </div>
                        </div>
                      </div> 
                        <?php endforeach; ?> {{-- END OF SUPPLIER --}}
                        <?php }else{ ?>
                        <div>
                        <center>No Purchase Yet</center>
                        </div>
                        <?php }?>
                      </div>
                      <div class="tab-pane fade" id="toreceive">
                        <?php 
                        if(count($data['delivered']) > 0){
                        foreach ($data['to_receive'] as $order_no): ?>
                        <div class="panel panel-default">
                          <div class="panel-body">
                              <div class="row" >
                                  <div class="col-md-6">
                                    <label class="label label-primary" style="color:white; font-size:15px">Order Number {{ $order_no->order_no }}</label><br>
                                  </div>
                                  <div class="col-md-6">
                                    <b style="color:rgb(72, 99, 160); float: right;"> {{ $order_no->order_name }}</b><br>
                                  </div>
                              </div>
                              <br><hr class="mt-0 mb-10">
                              <?php 
                              foreach ($data['delivered'] as $order):
                              if($order->order_no == $order_no->order_no){
                              ?>
                              <div class="row">
                                <div class="col-md-2">
                                  {{-- <a href="/productdetails/{{$order->inmr_hash}}"><img src="/HTML/images/shop/recent/1.jpg" alt="img"></a> --}}
                                  <img style="height: 60px; width: 45px;" src="/images/products/{{$order->image_path}}" alt="img">
                                </div>
                                <div class="col-md-6">
                                  <b style="color:black">{{ $order->product_name }}</b>
                                  <br>
                                  <label style="color:black"> x {{ $order->qty }} </label>
                                  <br>
                                  <br>
                                </div>
                                <div class="col-md-4">
                                  <br>
                                  <label style="font-size:16px; color:rgb(72, 99, 160); float: right;">  &#8369; {{ number_format($order->unit_price, 2) }} </label><br>
                                  
                                </div>
                            </div><br>
                            
                            <!-- DIVIDER -->
                            <hr class="mt-0 mb-10">     

                            <?php }?> {{-- END OF SAME SELLER/SUPLIER --}}
                            <?php endforeach; ?> {{-- END OF CART --}}
                              <div class="row">
                                <div class="col-md-4" >
                                  <label style="font-size:16px; color:black; ">Shop:
                                  <label style="font-size:18px; color:rgb(72, 99, 160);">{{ $order_no->shop_name }} </label></label><br>
                              </div>
                                <div class="col-md-8 text-right" >
                                    <label style="font-size:16px; color:black; float:right;">Order Total:
                                    <label style="font-size:18px; color:rgb(72, 99, 160);">&#8369; {{ number_format($order_no->order_total, 2) }} </label></label><br>
                                </div>
                              </div>
                              {{-- SHOW WHEN ORDER DELIVERED--}}
                              <?php 
                              if($order_no->order_name == 'DELIVERED'){
                              ?> 
                              <div class="row">
                              <div class="col-md-12" >
                                <div style="float: right" >
                                  <a href="" data-toggle="modal" data-target="#ModalReceive{{$order_no->sohr_hash}}" class="button medium blue w-100-100">RECEIVE ORDER</a>
                                </div>
                              </div>
                              </div>
                              <?php }?> 
                        </div>
                      </div> 
                        <?php endforeach; ?> {{-- END OF SUPPLIER --}}
                        <?php }else{ ?>
                        <div>
                        <center>No Purchase Yet</center>
                        </div>
                        <?php }?>
                      </div>
                      <div class="tab-pane fade" id="completed">
                        <?php 
                        if(count($data['completed']) > 0){
                        foreach ($data['all_completed'] as $order_no): ?>
                        <div class="panel panel-default">
                          <div class="panel-body">
                              <div class="row" >
                                  <div class="col-md-6">
                                    <label class="label label-primary" style="color:white; font-size:15px">Order Number {{ $order_no->order_no }}</label><br>
                                  </div>
                                  <div class="col-md-6">
                                    <b style="color:rgb(72, 99, 160); float: right;"> {{ $order_no->order_name }}</b><br>
                                  </div>
                              </div>
                              <br><hr class="mt-0 mb-10">
                              <?php 
                              foreach ($data['completed'] as $order):
                              if($order->order_no == $order_no->order_no){
                              ?>
                              <div class="row">
                                <div class="col-md-2">
                                  {{-- <a href="/productdetails/{{$order->inmr_hash}}"><img src="/HTML/images/shop/recent/1.jpg" alt="img"></a> --}}
                                  <img style="height: 60px; width: 45px;" src="/images/products/{{$order->image_path}}" alt="img">
                                </div>
                                <div class="col-md-6">
                                  <b style="color:black">{{ $order->product_name }}</b>
                                  <br>
                                  <label style="color:black"> x {{ $order->qty }} </label>
                                  <br>
                                  <br>
                                </div>
                                <div class="col-md-4">
                                  <br>
                                  <label style="font-size:16px; color:rgb(72, 99, 160); float: right;">  &#8369; {{ number_format($order->unit_price, 2) }} </label><br>
                                  
                                </div>
                                <div class="row">
                                  {{-- SHOW ONCED RECEIVED ORDER --}}
                                  <?php 
                                  if($order_no->order_name == 'COMPLETED'){
                                  ?> 
                                  <div class="col-md-12" >
                                    <div style="float: right" >
                                      <?php if($order->status_ratings == '0') { ?> 
                                        <a href="" data-toggle="modal" data-target="#ModalReview{{$order->inmr_hash}}" class="button medium blue w-100-100">RATE NOW</a>
                                        <span class="slash-divider"></span>
                                      <?php }?>
                                        <a href="/productdetails/{{$order->inmr_hash}}" class="button medium blue w-100-100">BUY AGAIN</a>
                                        <span class="slash-divider"></span>
                                    </div>
                                  </div>
                                  <?php }?>
                                  </div>
                            </div><br>
                            
                            <!-- DIVIDER -->
                            <hr class="mt-0 mb-10">     

                            <?php }?> {{-- END OF SAME SELLER/SUPLIER --}}
                            <?php endforeach; ?> {{-- END OF CART --}}
                              <div class="row">
                                <div class="col-md-4" >
                                  <label style="font-size:16px; color:black; ">Shop:
                                  <label style="font-size:18px; color:rgb(72, 99, 160);">{{ $order_no->shop_name }} </label></label><br>
                              </div>
                                <div class="col-md-8 text-right" >
                                    <label style="font-size:16px; color:black; float:right;">Order Total:
                                    <label style="font-size:18px; color:rgb(72, 99, 160);">&#8369; {{ number_format($order_no->order_total, 2) }} </label></label><br>
                                </div>
                              </div>
                        </div>
                      </div> 
                        <?php endforeach; ?> {{-- END OF SUPPLIER --}}
                        <?php }else{ ?>
                        <div>
                        <center>No Purchase Yet</center>
                        </div>
                        <?php }?>
                      </div>
                      <div class="tab-pane fade" id="cancelled">
                        <?php 
                        if(count($data['cancelled']) > 0){
                        foreach ($data['all_cancel'] as $order_no): ?>
                        <div class="panel panel-default">
                          <div class="panel-body">
                              <div class="row" >
                                  <div class="col-md-6">
                                    <label class="label label-primary" style="color:white; ">Order Number {{ $order_no->order_no }}</label><br>
                                  </div>
                                  <div class="col-md-6">
                                    <b style="color:rgb(72, 99, 160); float: right;"> {{ $order_no->order_name }}</b><br>
                                  </div>
                              </div>
                              <br><hr class="mt-0 mb-10">
                              <?php 
                              foreach ($data['cancelled'] as $order):
                              if($order->order_no == $order_no->order_no){
                              ?>
                              <div class="row">
                                <div class="col-md-2">
                                  {{-- <a href="/productdetails/{{$order->inmr_hash}}"><img src="/HTML/images/shop/recent/1.jpg" alt="img"></a> --}}
                                  <img style="height: 60px; width: 45px;" src="/images/products/{{$order->image_path}}" alt="img">
                                </div>
                                <div class="col-md-6">
                                  <b style="color:black">{{ $order->product_name }}</b>
                                  <br>
                                  <label style="color:black"> x {{ $order->qty }} </label>
                                  <br>
                                  <br>
                                </div>
                                <div class="col-md-4">
                                  <br>
                                  <label style="font-size:16px; color:rgb(72, 99, 160); float: right;">  &#8369; {{ number_format($order->unit_price, 2) }} </label><br>
                                  
                                </div>
                            </div><br>
                            
                            <!-- DIVIDER -->
                            <hr class="mt-0 mb-10">     

                            <?php }?> {{-- END OF SAME SELLER/SUPLIER --}}
                            <?php endforeach; ?> {{-- END OF CART --}}
                              <div class="row">
                                <div class="col-md-4" >
                                  <label style="font-size:16px; color:black; ">Shop:
                                  <label style="font-size:18px; color:rgb(72, 99, 160);">{{ $order_no->shop_name }} </label></label><br>
                              </div>
                                <div class="col-md-8 text-right" >
                                    <label style="font-size:16px; color:black; float:right;">Order Total:
                                    <label style="font-size:18px; color:rgb(72, 99, 160);">&#8369; {{ number_format($order_no->order_total, 2) }} </label></label><br>
                                </div>
                              </div>
                        </div>
                      </div> 
                        <?php endforeach; ?> {{-- END OF SUPPLIER --}}
                        <?php }else{ ?>
                        <div>
                        <center>No Purchase Yet</center>
                        </div>
                        <?php }?>
                      </div>
                    </div>

                    <div class="col-md-6 mb-30">
                      <!-- Button trigger modal -->

                      <?php 
                      foreach ($data['order'] as $order):
                      ?>
                      <!-- Modal 1-->
                      <div class="modal fade bootstrap-modal" id="ModalReview{{$order->inmr_hash}}" tabindex="-1" role="dialog" aria-labelledby="ModalReviewLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-body">
                            <form method="get" action="/review/{{$order->soln_hash}}" class="form">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h5 class="modal-title" style="text-align: center; color: rgb(72, 99, 160); font-weight: bold;" id="ModalReviewLabel">PRODUCT REVIEW</h5>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-2">
                                    <img style="height: 80px; width: 70px;" src="/images/products/{{$order->image_path}}" alt="img">
                                  </div>
                                  <div class="col-md-10">
                                    <b style="color: rgb(72, 99, 160)">{{ $order->product_name }}</b>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12 star" style="text-align: center">
                                    <span class="star-rating">
                                      <input type="radio" name="rating" value="1"><i></i>
                                      <input type="radio" name="rating" value="2"><i></i>
                                      <input type="radio" name="rating" value="3"><i></i>
                                      <input type="radio" name="rating" value="4"><i></i>
                                      <input type="radio" name="rating" value="5" checked><i></i>
                                    </span>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12" style="text-align: center">
                                    <textarea maxlength="1000" data-msg-required="Please enter your message" class="form-control" name="remarks" id="remarks" placeholder="ENTER YOUR PRODUCT REVIEW HERE"></textarea>
                                  </div>
                                </div>
                                <input type="hidden" name="inmr_hash" value={{ $order->inmr_hash }}>
                                <input type="hidden" name="no" value="1">
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit Review</button>
                                <button type="button" class="btn btn-default btn-close" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </form>
                          </div>
                        </div>
                      </div>
                      <?php endforeach; ?> 

                      <?php 
                      foreach ($data['order_no'] as $order_no):
                      ?>
                       <!-- Modal RECEIVE ORDER -->
                       <div class="modal fade bootstrap-modal" id="ModalReceive{{$order_no->sohr_hash}}" tabindex="-1" role="dialog" aria-labelledby="ModalReceiveLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-body">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h5 class="modal-title" style="text-align: center; color: rgb(72, 99, 160); font-weight: bold;" id="ModalReceiveLabel">RECEIVE ORDER</h5>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-12" style="text-align: center; color:black">
                                    <Strong>THANK YOU FOR CONFIRMING YOUR ORDER!</Strong>
                                    <label>your payment will release to the merchant.</label>
                                  </div>
                                </div>
                                <br>
                                <?php 
                                foreach ($data['order'] as $order):
                                if($order->sohr_hash == $order_no->sohr_hash){
                                ?>
                                <div class="row" >
                                  <div class="col-md-2">
                                    <img style="height: 80px; width: 70px;" src="/images/products/{{$order->image_path}}" alt="img">
                                  </div>
                                  <div class="col-md-10">
                                    <b style="color: rgb(72, 99, 160)">{{ $order->product_name }}</b>
                                  </div>
                                </div>
                                <?php } ?>
                                <?php endforeach; ?>
                              </div>
                              <div class="modal-footer">
                                <a href="/updatestatus/{{ $order_no->sohr_hash }}" type="button" class="btn btn-primary">Confirm Now</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php endforeach; ?>

                      <?php 
                      foreach ($data['order_no'] as $order_no):
                      ?>
                       <!-- Modal RECEIVE ORDER -->
                       <div class="modal fade bootstrap-modal" id="ModalCancel{{$order_no->sohr_hash}}" tabindex="-1" role="dialog" aria-labelledby="ModalCancelLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-body">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h5 class="modal-title" style="text-align: center; color: rgb(72, 99, 160); font-weight: bold;" id="ModalCancelLabel">CANCEL ORDER</h5>
                              </div>
                              <div class="modal-body">
                                <form method="get" action="/updatecancel/{{ $order_no->sohr_hash }}" class="form">
                                <div class="row">
                                  <div class="col-md-12" style="text-align: center; color:black">
                                    <Strong>ARE YOU SURE YOU WANT TO CANCEL YOUR ORDER?</Strong>
                                  </div>
                                </div>
                                <br>
                                <?php 
                                foreach ($data['order'] as $order):
                                if($order->sohr_hash == $order_no->sohr_hash){
                                ?>
                                <div class="row" >
                                  <div class="col-md-2">
                                    <img style="height: 80px; width: 70px;" src="/images/products/{{$order->image_path}}" alt="img">
                                  </div>
                                  <div class="col-md-10">
                                    <b style="color: rgb(72, 99, 160)">{{ $order->product_name }}</b>
                                  </div>
                                  <input type="hidden" value="{{$order->soln_hash}}">
                                </div>
                                <?php } ?>
                                <?php endforeach; ?>
                                <center><Strong style="text-align: center; color:black">SELECT CANCELLATION REASON</Strong></center>

                                <div class="mb-20">
                                 
                                  <select class="form-control region" name="reason" id="reason" data-msg-required="PLEASE SELECT REASON" required>
                                    {{-- <option selected disabled="disabled" selected="selected" value="0" class="default">SELECT REASON</option> --}}
                                    <?php foreach ($data['reason'] as $reasons): ?>
                                    <option value="{{$reasons->urfc_hash}}">{{$reasons->reason_name}}</option>
                                    <?php endforeach; ?> 
                                  </select>
                               
                                </div>
                              
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Cancel Order</button>
                                {{-- <a href="/updatecancel/{{ $order_no->sohr_hash }}" type="button" class="btn btn-primary">Cancel Order</a> --}}
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                  </div>
                  </div>
                </div>
              </div>
                {{-- <!-- PAGINATION -->
                <div class="mt-0">
                  <nav class="blog-pag">
                    {{ $data['order']->links() }}
                  </nav> 
                </div> --}}
              </div>

              <div id="MyAccount" style="display:none;">
              {{-- <div id="MyAccount"> --}}
                <div class="panel panel-default">
                  <div class="panel-heading">
                      <center><label>MY ACCOUNT</label></center>
                  </div>
                    <div class="panel-body">
                      <div id="tabs" class="mb-0 bs-docs-section">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="row">
                              <div class="col-md-4">
                                <img src="/brands_try/User.png" class="logo-img" alt="img">&nbsp;Full Name&nbsp;<br><b style="color:black">{{ $data['profile']->fullname }}</b>
                              </div>
                              <div class="col-md-4">
                                <?php if ($data['profile']->barangay == 0 ) { ?>
                                  <img src="/brands_try/Address.png" class="logo-img" alt="img">&nbsp;Address&nbsp;<br>
                                    <b style="color:black">No Address</b>
                                  <?php }else{ ?>
                                    <img src="/brands_try/Address.png" class="logo-img" alt="img">&nbsp;Address&nbsp;<br>
                                    <b style="color:black">{{ $data['profile']->address}},
                                      &nbsp;{{ $data['profile']->barangay}},
                                      &nbsp;{{ $data['profile']->city}},
                                      &nbsp;{{ $data['profile']->province}},
                                      &nbsp;{{ $data['profile']->region}}
                                    </b>
                                  <?php }?>
                              </div>
                              <div class="col-md-4">
                                <?php if ($data['profile']->contact_no == 0 ) { ?>
                                  <img src="/brands_try/Address.png" class="logo-img" alt="img">&nbsp;Contact No.&nbsp;<br>
                                    <b style="color:black">No Contact No.</b>
                                  <?php }else{ ?>
                                    <img src="/brands_try/Address.png" class="logo-img" alt="img">&nbsp;Contact No.&nbsp;<br>
                                    <b style="color:black">{{ $data['profile']->contact_no }}
                                    </b>
                                  <?php }?>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="row">
                              <div class="col-md-4">
                               
                              </div>
                              <div class="col-md-4">
                                
                              </div>
                              <div class="col-md-4 mt-100">
                                {{-- <button type="button" id="change"  data-toggle="modal" data-target="#ModalEdit{{$data['profile']->user_hash}}"
                                  class="button medium cyan"> <label class="change_label">EDIT PROFILE</label>
                              </button> --}}
                              </div>
                            </div>
                          </div>
                        </div>

                      <?php foreach ($data['prof'] as $profile): ?>
                       <!-- Modal Edit -->
                       <div class="modal fade bootstrap-modal" id="ModalEdit{{$profile->user_hash}}" tabindex="-1" role="dialog" aria-labelledby="ModalEditLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-body">
                            <div class="row row-error">
                              <div class="col-md-12">
                                  <div class="alert alert-danger animated shake">
                                      <span aria-hidden="true" class="alert-icon icon_blocked"></span>
                                      <span class="error_msg"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="row div_success">
                              <div class="col-md-12" style="align-content: center;">
                                  <div class="row row-success">
                                      <div class="col-md-12">
                                          <div class="alert alert-success animated fadeIn">
                                              <span aria-hidden="true" class="alert-icon icon_like"></span>
                                              <span class="success_msg"></span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h5 class="modal-title" style="text-align: center; color: rgb(72, 99, 160); font-weight: bold;" id="ModalEditLabel">EDIT PROFILE</h5>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-12" style="color:black">
                                    <label>Full Name</label>
                                    <input type="text" name="fullname" 
                                    data-msg-required="PLEASE ENTER FULL NAME" maxlength="30"
                                    style="text-transform:uppercase" placeholder="FULL NAME"
                                    class="form-control" id="fullname" value="{{$profile->fullname}}"  required>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12" style="color:black">
                                    <label>Address</label>
                                    
                                    <div class="mb-20">
                                      <select class="form-control region" name="region" id="region" data-msg-required="PLEASE SELECT REGION" required>
                                        <option selected disabled="disabled" selected="selected" value="0" class="default">PLEASE SELECT REGION</option>
                                        <?php foreach ($data['tbl_region'] as $region): ?>
                                        <option value="{{$region->regn_hash}}">{{$region->region}}</option>
                                        <?php endforeach; ?> 
                                      </select>
                                    </div>
                                    <div class="mb-20">
                                      <select class="form-control location" name="province" id="province"  data-msg-required="PLEASE SELECT PROVINCE" required>
                                        <option selected disabled="disabled" selected="selected" value="0" class="default">PLEASE SELECT PROVINCE</option>
                                        <?php foreach ($data['tbl_province'] as $province): ?>
                                        <option value="{{$province->prov_hash}}" data-region="{{$province->regn_hash}}">{{$province->province}}</option>
                                        <?php endforeach; ?> 
                                      </select>
                                    </div>
                                    <div class="mb-20">
                                      <select class="form-control location" name="city" id="city" data-msg-required="PLEASE SELECT CITY" required>
                                        <option selected disabled="disabled" selected="selected" value="0" class="default">PLEASE SELECT CITY</option>
                                        <?php foreach ($data['tbl_city'] as $city): ?>
                                        <option value="{{$city->city_hash}}" data-province="{{$city->prov_hash}}">{{$city->city}}</option>
                                        <?php endforeach; ?> 
                                        </select>
                                    </div>
                                    <div class="mb-20">
                                      <select class="form-control location" name="barangay" id="barangay" data-msg-required="PLEASE SELECT BARANGAY" required>
                                        <option selected  disabled="disabled" selected="selected" value="0" class="default">PLEASE SELECT BARANGAY</option>
                                        <?php foreach ($data['tbl_brgy'] as $brgy): ?>
                                        <option value="{{$brgy->brgy_hash}}" data-city="{{$brgy->city_hash}}">{{$brgy->barangay}}</option>
                                        <?php endforeach; ?> 
                                      </select>
                                    </div>
                                    <div class="mb-20">
                                      <input type="text" data-msg-required="HOUSE NO, STREET, BLDG NO, ETC"
                                      maxlength="100" class="form-control" name="address" id="address" placeholder="HOUSE NO, STREET, BLDG NO, ETC"
                                      required>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12" style="color:black">
                                    <label>Contact No.</label>
                                    <input type="number" placeholder="CONTACT NO."
                                    data-msg-required="PLEASE ENTER CONTACT NO."
                                    class="form-control" name="contact_no"
                                    id="contact_no" value="{{$profile->contact_no}}" required>
                                  </div>
                                </div>
                                <br>
                              </div>
                              <div class="modal-footer">
                                {{-- <button type="button" id="btnedit" class="button medium blue">
                                  <span class=""></span> <label class="btnedit_label">Save</label>
                                </button> --}}
                                <a href="/editprofile/{{$profile->user_hash }}" type="button" class="btn btn-primary">Save</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php endforeach; ?> 

                      </div>
                    </div>
                </div>
              </div>

            </div>
        </div>
    </div>
@stop

@section('embeddedjs')
<script type="text/javascript">

$('.myacc').click(function() {

    var x = document.getElementById("MyPurchase");
    var y = document.getElementById("MyAccount");
  if (y.style.display === "none") {
    y.style.display = "block";
    x.style.display = "none";
  } 
});

$('.mypur').click(function() {

var x = document.getElementById("MyPurchase");
var y = document.getElementById("MyAccount");
if (x.style.display === "none") {
x.style.display = "block";
y.style.display = "none";
} 
});

var changeLocation = function(){

$('select.location').prop('disabled', true);

var region=$('#region option:selected').val();

if(region!=0){
    $('#province').prop('disabled', false);
}else{
    $('#province').prop('disabled', true);
}

// Province
$('#province option').each(function(){
    $(this).removeClass('hidden');
    var p_region = $(this).data('region');
    if(p_region!=region){
        if($(this).hasClass('default')){
            return;
        }else{  
            $(this).addClass('hidden');
        }
    }
});

var prov_id = $('#province').find("option:not(.hidden):eq(0)").val();
$('#province').val(prov_id).trigger("change");

// City
$('#city option').each(function(){
    $(this).removeClass('hidden');
    var c_province = $(this).data('province');
    if(c_province!=prov_id){
        if($(this).hasClass('default')){
            return;
        }else{  
            $(this).addClass('hidden');
        }
    }
});

var cit_id = $('#city').find("option:not(.hidden):eq(0)").val();
$('#city').val(cit_id).trigger("change");

// Barangay
$('#barangay option').each(function(){
    $(this).removeClass('hidden');
    var b_city = $(this).data('city');
    if(b_city!=cit_id){
        if($(this).hasClass('default')){
            return;
        }else{  
            $(this).addClass('hidden');
        }
    }
});

var brngy_id = $('#barangay').find("option:not(.hidden):eq(0)").val();
$('#barangay').val(brngy_id).trigger("change");      


};

$('#region').on("change", function(){
changeLocation();                
}); 

changeLocation();     


$('#province').on("change", function(){

var prov_id = $(this).val();

if(prov_id!=0){
    $('#city').prop('disabled', false);
}else{
    $('#city').prop('disabled', true);
}

// City
$('#city option').each(function(){
    $(this).removeClass('hidden');
    var c_province = $(this).data('province');
    if(c_province!=prov_id){
        if($(this).hasClass('default')){
            return;
        }else{  
            $(this).addClass('hidden');
        }
    }
});

var cit_id = $('#city').find("option:not(.hidden):eq(0)").val();
$('#city').val(cit_id).trigger("change");

// Barangay
$('#barangay option').each(function(){
    $(this).removeClass('hidden');
    var b_city = $(this).data('city');
    if(b_city!=cit_id){
        if($(this).hasClass('default')){
            return;
        }else{  
            $(this).addClass('hidden');
        }
    }
});

var brngy_id = $('#barangay').find("option:not(.hidden):eq(0)").val();
$('#barangay').val(brngy_id).trigger("change");               
});      

$('#city').on("change", function(){
var cit_id = $(this).val();

if(cit_id!=0){
    $('#barangay').prop('disabled', false);
}else{
    $('#barangay').prop('disabled', true);
}

// Barangay
$('#barangay option').each(function(){
    $(this).removeClass('hidden');
    var b_city = $(this).data('city');
    if(b_city!=cit_id){
        if($(this).hasClass('default')){
            return;
        }else{  
            $(this).addClass('hidden');
        }
    }
});
}); 

var initializeControls = function() {
        $('.row-error').hide();
        $('.row-success').hide();
        $('.div_success').hide();
    }();


    var validateRequiredFields = function(f) {
        var stat = true;

        $('.row-error').hide();
        $('div.form-group').removeClass('has-error');
        $('div.fg-line').removeClass('has-error');
        $('input[required],textarea[required],select[required]', f).each(function() {

            if ($(this).is('select')) {
                if ($(this).val() == null || $(this).val() == "") {
                    $('.error_msg').html($(this).data('msg-required'));
                    $('.row-error').fadeIn(400);
                    $(this).focus();
                    stat = false;
                    return false;
                }
            } else {
                if ($(this).val() == 0 || $(this).val() == "") {
                    $('.error_msg').html($(this).data('msg-required'));
                    $('.row-error').fadeIn(400);
                    $(this).closest('.fg-line').addClass('has-error');
                    $(this).focus();
                    stat = false;
                    return false;
                }
            }

        });

        return stat;
    };

    var Edit = (function() {
        var _data = $('#edit-form').serializeArray();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        return $.ajax({
            "dataType": "json",
            "type": "POST",
            "url": "{{ url('/editprofile/') }}",
            "data": _data
        });
    });

    $('#btnedit').click(function() {
     
            if (validateRequiredFields($('#edit-form'))) {
              Edit().done(function(response) {

              if (response.stat == "success") {
                  $('.div_success').show();
                  $('.div_sign_up').hide();
                  $('.success_msg').html(response.msg);
                  $('.row-success').fadeIn(400);
                  setTimeout(function() {
                      window.location.href = "/profile";
                  },1000);
              } else {
                    $('.row-error').show();
                    $('.error_msg').html(response.msg.fullname);
                    $('.error_msg').html(response.msg.contact_no);
                    $('.row-error').fadeIn(400);
                }
              })
            }

    });
</script>
@endsection