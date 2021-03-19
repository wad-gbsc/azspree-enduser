@extends('pages.index')

@section('content')
  
      
<!-- CONTENT -->
<div class="page-section p-140-cont">
  <div class="container">
    
        <!-- SHIPPING INFO -->
        <div id="shipping_info">
              <div >
                <h3 class="mt-0 mb-50">SHIPPING INFORMATION</h3>
              </div>
            <div class="row">
              <form id="add-form" autocomplete="off">
              <div class="col-sm-6">

                
                <div class=" shipping-address">
                  {{-- <div class="row mb-40">
                  </div> --}}
                  <h4 class="blog-page-title mt-5 mb-25">CONTACTS</h4>

                    <div class="mb-20">
                      <input type="text" name="fullname"
                        placeholder="FULL NAME"
                        data-msg-required="Please enter your Full Name" maxlength="30"
                        style="text-transform:capitalize"
                        class="controled" id="fullname" required>
                    </div>

                    <div class="mb-20">
                      <input type="number"
                          data-msg-required="Please enter your Contact Number"
                          placeholder="FORMAT MUST BE (09XXXXXXXXX)"
                          class="controled" name="contact_no"
                          id="contact_no" required>
                    </div>


                  <h4 class="blog-page-title mt-5 mb-25">SHIPPING ADDRESS</h4>

                    <div class="mb-20">
                      <select class="controled region" name="region" id="region" data-msg-required="PLEASE SELECT REGION" required>
                        <option selected disabled="disabled" selected="selected" value="0" class="default">SELECT REGION</option>
                        <?php foreach ($data['tbl_region'] as $region): ?>
                        <option value="{{$region->regn_hash}}">{{$region->region}}</option>
                        <?php endforeach; ?> 
                      </select>
                    </div>

                    <div class="mb-20">
                      <select class="controled location" name="province" id="province"  data-msg-required="PLEASE SELECT PROVINCE" required>
                        <option selected disabled="disabled" selected="selected" value="0" class="default">SELECT PROVINCE</option>
                        <?php foreach ($data['tbl_province'] as $province): ?>
                        <option value="{{$province->prov_hash}}" data-region="{{$province->regn_hash}}">{{$province->province}}</option>
                        <?php endforeach; ?> 
                      </select>
                    </div>

                    <div class="row">
                      <div class="col-sm-6 mb-20">
                        <select class="controled location" name="city" id="city" data-msg-required="PLEASE SELECT CITY" required>
                          <option selected disabled="disabled" selected="selected" value="0" class="default">SELECT CITY</option>
                          <?php foreach ($data['tbl_city'] as $city): ?>
                          <option value="{{$city->city_hash}}" data-province="{{$city->prov_hash}}">{{$city->city}}</option>
                          {{-- <input type="text" value="{{ $city->sumr_hash }}" name="sumr_hash" /> --}}
                          <?php endforeach; ?> 
                          </select>
                      </div>

                      <div class="col-sm-6 mb-20">
                        <select class="controled location" name="barangay" id="barangay" data-msg-required="PLEASE SELECT BARANGAY" required>
                          <option selected  disabled="disabled" selected="selected" value="0" class="default">SELECT BARANGAY</option>
                          <?php foreach ($data['tbl_brgy'] as $brgy): ?>
                          <option value="{{$brgy->brgy_hash}}" data-city="{{$brgy->city_hash}}">{{$brgy->barangay}}</option>
                          <?php endforeach; ?> 
                        </select>
                      </div>
                    </div>

                    <div class="mb-20">
                      <input type="text" data-msg-required="HOUSE NO, STREET, BLDG NO, ETC"
                        maxlength="100" class="controled" name="address" id="address" placeholder="HOUSE NO, STREET, BLDG NO, ETC"
                        required>
                        {{-- <input placeholder="HOUSE NO, STREET, BLDG NO, ETC" class=" controled" type="text" pattern=".{3,100}"> --}}
                      </div>

                        <!-- DIVIDER -->
                      <hr class="mt-0 mb-10">
                      
                      <h4 class="blog-page-title mt-40 mb-25">PAYMENT METHOD</h4>

                      <div class="mb-20">
                        <div class="row">
                          <div class="col-sm-4 mb-20">
                            <input type="button" class="btn btn-lg btn-primary btn_cod"
                            style="width: 100%;" value="COD" name="cod" data-msg-required="PLEASE CHOOSE PAYMENT METHOD" required>
                          </div>

                          
                          
                          </div>
                      </div>

                        <div id="divCOD" style="display:none;">
                          CASH ON DELIVERY.
                        </div>
                
                </div>
              </div>
              
                    

                <div class="col-sm-6 col-md-offset ">
                  
                  <?php 
                  
                    $cart_subtotal = 0; 
                    $total_shipping = 0; 
                    $total_payment = 0;

                    if(count($data['mycart']) > 0){
                      
                    foreach ($data['supplier'] as $sumr): 
                  ?>
                  <label>{{$sumr->shop_name}}</label>
                      <?php 
                        $unit_total = 0; 
                        $order_subtotal = 0; 
                        $total_qty = 0; 
                        $shipping_fee = 0; 
                        $shipping = 0;
                        $order_total = 0; 
                        $shipping_extra = 0;
                        $shipping_city = 0; 
                        $dimension = 0;
                        $weight = 0;
                        $total_kg = 0;
                        $total_dimension = 0;
                        $total_weight = 0;
                        $sub_1 = 0;
                        $sub_2 = 0;
                        $sub_3 = 0;
                        $sub_4 = 0;
                        $sub_5 = 0;
                      ?>
                      <?php
                      foreach ($data['comr'] as $comr): 
                      $max_kg = $comr->max_kg;
                      $excess_kg_fee = $comr->excess_kg_fee;
                      ?>
                      <?php endforeach; ?> 
                          <?php 
                            foreach ($data['mycart'] as $addcart):
                            if($addcart->sumr_hash == $sumr->sumr_hash)
                            {
                            $unit_total =$addcart->cost_amt * $addcart->qty; 
                            $order_subtotal += $unit_total;
                            $total_qty += $addcart->qty;

                            $shipping_city= $shipping_fee;
                            $dimension = $addcart->dimension * $addcart->qty;
                            $total_dimension += $dimension;

                            $weight = $addcart->weight * $addcart->qty;
                            $total_weight += $weight;

                            if ($total_dimension > $total_weight){
                                if ($total_dimension > $max_kg){
                                    $sub_1 = ($total_dimension - $max_kg);
                                    $total_kg = ($sub_1 * $excess_kg_fee);
                                }else{
                                  if($addcart->qty > 1){
                                    $sub_3 = ($total_dimension * $addcart->qty );
                                    $sub_4 = (round($sub_3) - $max_kg);
                                    $total_kg = ($sub_4 * $excess_kg_fee );
                                  }else{
                                    $total_kg = 0;
                                  }
                                }
                            }else if($total_weight == $total_dimension){
                                if ($total_weight > $max_kg){
                                    $sub_1 = ($total_weight - $max_kg);
                                    $total_kg = ($sub_1 * $excess_kg_fee);
                                }else{
                                  if($addcart->qty > 1){
                                    $sub_3 = ($total_weight * $addcart->qty );
                                    $sub_4 = (round($sub_3) - $max_kg);
                                    $total_kg = ($sub_4 * $excess_kg_fee );
                                  }else{
                                    $total_kg = 0;
                                  }
                                }
                            }else{
                                if ($total_weight > $max_kg){
                                    $sub_1 = ($total_weight - $max_kg);
                                    $total_kg = ($sub_1 * $excess_kg_fee);
                                }else{
                                  if($addcart->qty > 1){
                                    $sub_3 = ($total_weight * $addcart->qty );
                                    $sub_4 = (round($sub_3) - $max_kg);
                                    $total_kg = ($sub_4 * $excess_kg_fee );
                                  }else{
                                    $total_kg = 0;
                                  }
                                }
                            }
                            $shipping_extra = $total_kg;
                            $shipping = $shipping_extra + $shipping_city;
                            $order_total = $order_subtotal+$shipping; 
                          ?>

                                  <div class="row">
                                      <div class="col-md-2">  
                                        <input type="hidden" value="{{ $addcart->srln_hash }}" name="srln_hash" />
                                        <input type="hidden" value="{{ $addcart->sumr_hash }}" name="sumr_hash" />
                                        <input type="hidden" value="{{ $addcart->inmr_hash }}" name="inmr_hash[]" id="items"/>
                                        <img style="height: 60px; width: 45px;" src="/images/products/{{$addcart->image_path}}" alt="img">
                                      </div>
                                      <div class="col-md-8">  
                                      {{ $addcart->product_name }}<br>
                                      <small>{{ $addcart->var_name }}</small><br>
                                      {{ $addcart->qty }} x {{ number_format($addcart->cost_amt, 2) }}
                                      <input type="hidden" value="{{ $addcart->dimension }}" name="dimension[]" id="items" />
                                      <input type="hidden" value="{{ $addcart->weight }}" name="weight[]" id="items" />
                                      <input type="hidden" value="{{ $addcart->qty }}" name="qty[]" id="items" />
                                      <input type="hidden" value="{{ $addcart->cost_amt }}" name="cost_amt[]" id="items"/>
                                      

                                      </div>
                                      <div class="col-md-2">  
                                        {{ number_format($unit_total, 2) }}
                                      </div>
                                   </div>

                                <!-- DIVIDER -->
                                <hr class="mt-0 mb-10">
          
                          <?php }?> {{-- END OF SAME SELLER/SUPPLIER --}}
                      <?php 
                    
                    endforeach; ?> {{-- END OF CART --}}
                                <div class="row">
                                  <div class="col-md-6" style="float: right">  
                                    {{-- <input type="hidden" value="{{ $total_qty }}" name="total_qty" >
                                    <input type="hidden" value="{{ $order_subtotal }}" name="order_subtotal" >
                                    <input type="hidden" value="{{ $shipping }}" name="shipping" >
                                    <input type="hidden" value="{{ $order_total }}" name="order_total" > --}}
                                    
                                    <input type="hidden" name="payment_method" data-msg-required="PLEASE CHECK PAYMENT METHOD" required>
                                    <input type="hidden" value="{{ $shipping_extra}}" class="shipping_extra_{{ $sumr->sumr_hash }}"/>
                                    <input type="hidden" value="{{ $order_subtotal }}" class="order_subtotal_{{ $sumr->sumr_hash }}" >
                                    {{-- <span class="font-norm1" >EXTRA FEE:</span> <strong>&#8369; {{ number_format($shipping_extra, 2) }} </strong><br> --}}
                                    <span class="font-norm1" >SHIPPING:</span> <strong>&#8369; <span name="shipping" data-sumr_hash="{{ $sumr->sumr_hash }}" class="shipping_{{ $sumr->sumr_hash }}"> 0.00</span> </strong><br>
                                    <span class="font-norm1">ORDER TOTAL:</span> <strong>&#8369; <span name="order_total" class="order_total_{{ $sumr->sumr_hash }}"> {{ number_format($order_subtotal,2) }}</span> </strong>
                                  </div>
                                </div>
                                
                  <?php
                  
                    $cart_subtotal += $order_subtotal; 
                    $total_shipping += $shipping; 
                    $total_payment = $cart_subtotal + $total_shipping;

                    endforeach; ?> {{-- END OF SUPPLIER --}}

                  <h5 class="mt-60 mb-10" >
                    <span class="font-norm1">CART SUBTOTAL:</span> <strong style="font-size:20px" >&#8369; <span id="total_cart_subtotal">{{ number_format($cart_subtotal, 2) }}</span> </strong>
                  </h5> 
                  
                  <h5 class="mt-10 mb-10">
                    {{-- <span class="font-norm1">TOTAL SHIPPING:</span> <strong style="font-size:20px">&#8369; <span id="total_shipping">{{ number_format($total_shipping, 2) }}</span></strong> --}}
                    <span class="font-norm1">TOTAL SHIPPING:</span> <strong style="font-size:20px">&#8369; <span id="total_shipping"> 0.00 </span></strong>
                  </h5>
                  
                  <!-- DIVIDER -->
                  <hr class="mt-0 mb-10">

                  <h3 class="mt-10 mb-30">
                    <span class="font-norm1">TOTAL PAYMENT:</span> <strong style="font-size:22px">&#8369; <span name="total_payment"> {{ number_format($cart_subtotal, 2) }} </span> </strong>
                  </h3>
                  <?php }?>
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
                  <div class="mb-0" style="text-align: right">
                    {{-- <a href="/payment" class="button medium blue w-100-767">CONFIRM ORDER</a>  --}}
                    <button type="button" id="btnpayment" class="button medium blue">
                      <span class=""></span> <label class="btnpayment_label">CONFIRM ORDER</label>
                    </button>
                  </div>
                </div>
              </form>
            </div>
      </div>
          <br>

              <!-- DIVIDER -->
          <hr class="mt-0 mb-60">

  </div>
</div>
   
@stop

@section('embeddedjs')
<script src="/formatter/accounting.js"></script>
<script type="text/javascript">

$(document).ready(function() {

  $('select[name="barangay"]').on('change', function() {
      var brgy_hash = $('select[name="barangay"]').val();

      if(brgy_hash) {
      $.ajax({
      url: '/get-barangay-list/'+encodeURI(brgy_hash),
      type: "GET",
      dataType: "json",
      success:function(data) {
        // console.log(data);
          $.each(data, function(key, value) {
          // $('span[name="shipping"]').trigger("change");
          var shipping_fee = parseFloat(value.shipping_fee);

          $('span[name="shipping"]').each(function(){
            sumr_hash = $(this).data('sumr_hash');

            var extra_fee = accounting.unformat($('.shipping_extra_'+sumr_hash).val());
            var total_shipping_fee = shipping_fee + extra_fee;

            $('.shipping_'+sumr_hash).html(accounting.formatNumber(total_shipping_fee,2));

            var order_subtotal = accounting.unformat($('.order_subtotal_'+sumr_hash).val());
            var grand_order_subtotal = order_subtotal + total_shipping_fee;

            $('.order_total_'+sumr_hash).html(accounting.formatNumber(grand_order_subtotal,2));
          });

          var total_shipping = 0;
          var total_shipping_extra = 0;

            $('span[name="shipping"]').each(function(){
              total_shipping += accounting.unformat($(this).html());
            });

            $('.shipping_extra').each(function(){
              total_shipping_extra += parseFloat($(this).val());
            });
          
          var grand_total_shipping = total_shipping + total_shipping_extra;
          $('#total_shipping').html(accounting.formatNumber(grand_total_shipping,2));

          var total_cart_subtotal = accounting.unformat($('#total_cart_subtotal').html());
          var grand_total = total_cart_subtotal + grand_total_shipping;
 
          $('span[name="total_payment"]').html(accounting.formatNumber(grand_total,2));
          });
        }
        });
      // }else{
      // $('span[name="shipping"]').empty();
      }
  });
  
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
var brngy_id = $('#barangay').find("option:not(.hidden):eq(0)").val();
$('#barangay').val(brngy_id).trigger("change");  
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

    var AddCart = (function() {
        var _data = $('#add-form').serializeArray();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        return $.ajax({
            "dataType": "json",
            "type": "POST",
            "url": "{{ url('/placeorder/create') }}",
            "data": _data
        });
    });

    $('#btnpayment').click(function() {
     
            if (validateRequiredFields($('#add-form'))) {
            $(this).toggleClass('disabled');
            $(this).find('span').toggleClass('fa fa-spinner fa-spin');
            $('.btnpayment_label').html('CONFIRM ORDER');

            var payment_method = $('input[name="payment_method"]').val();
            
            if(payment_method == ""){
                $('.error_msg').html($(this).data('msg-required'));
                $('.row-error').fadeIn(400);

            }else{
              AddCart().done(function(response) {

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
              .always(function() {
              $(this).toggleClass('disabled');
              $(this).find('span').toggleClass('fa fa-spinner fa-spin');
              });
            }

            }

    });

$('.btn_cod').click(function() {
    var clicked_button = $(this).val();
    // alert(clicked_button);

    $('input[name="payment_method"]').val(clicked_button);

    var x = document.getElementById("divCOD");
  if (x.style.display == "none") {
    x.style.display = "block";
  }
});

// $(".city").change(function(){
// 	var dataType=$(this).dataType();
// 	$(".barangay option").hide();
//   $(".barangay").dataType("");
// 	$(".barangay option[value='city"+dataType+"']").show();
//   $(".barangay").change();
// });

    // $('input').keypress(function(evt) {

    //     if (evt.keyCode == 13) {
    //         $('#btnpayment').click();
    //     }

    // });
 


  </script>
  @endsection