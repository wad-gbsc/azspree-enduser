@extends('pages.index')

@section('embeddedcss')
@endsection

@section('content')
<div id="wrap" class="boxed ">
    <div class="grey-bg">

        <!-- CONTENT -->
        <div class="page-section p-140-cont">
            <div class="container">
                <div class="row">
                    <div class="">
                    <!-- ITEM PHOTO -->
                    <div class="col-md-4 col-sm-12 mb-50">

                        <div class="post-prev-img popup-gallery">
                            <a style="height: 430px; width: 472px;" href="/images/products/{{$data['products']->image_path}}">
                                <img id="ProdImg" style="height: 430px; width: 472px;" src="/images/products/{{$data['products']->image_path}}"
                                    alt="{{$data['products']->product_name}}"></a>
                        </div>

                        {{-- <div class="sale-label-cont">
                            <span class="sale-label label-danger bg-red">SALE</span>
                        </div> --}}

                        <div class="row">
                            <div class="popup-gallery"  >
                                @foreach(File::glob(public_path('images/products/'.$data['products']->sumr_hash).'/'.$data['products']->inmr_hash.'/*') as $path)
                                <div class="col-xs-4 post-prev-img" >
                                    <a href="{{ str_replace(public_path(''), '', $path) }}">
                                        <img style="height: 150px; width: 100px;" src="{{ str_replace(public_path(''), '', $path ) }}" alt="{{$data['products']->product_name}}">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    <!-- CONTENT -->
                    <div class="col-md-7 col-sm-12 col-md-offset-1 mb-50">
                        <form id="add-form" autocomplete="off">
                            
                            <h3><label class="mt-0 mb-30">{{ $data['products']->product_name }}</label></h3>
                            <input type="hidden" name="inmr_hash" id="inmr_hash" value="{{ $data['products']->inmr_hash }}" />
                            <input type="hidden" name="sumr_hash" id="sumr_hash" value="{{ $data['products']->sumr_hash }}" />
                            <input type="hidden" name="dimension" id="dimension" value="{{ $data['products']->dimension }}" />
                            <input type="hidden" name="weight" id="weight" value="{{ $data['products']->weight }}" />
                            <hr class="mt-0 mb-30">
                            <div class="row">

                                <div class="col-xs-5  mt-0 mb-30">
                                    {{-- <del>$130.00</del>
                                    --}}
                                    <?php if ($data['var_min']->cost_amt == $data['var_max']->cost_amt){ ?> 
                                        <strong><span name="cost_amt" class="item-price">&#8369; {{ number_format($data['var_max']->cost_amt, 2) }}</span></strong>
                                        <input type="hidden" name="cost_amt" value="{{ $data['products']->cost_amt }}" />
                                    <?php }else{ ?> 
                                        <strong><span name="cost_amt" class="item-price">&#8369; {{ number_format($data['var_min']->cost_amt, 2) }} - {{ number_format($data['var_max']->cost_amt, 2) }}</span></strong>
                                        <input type="hidden" name="cost_amt" value="{{ $data['products']->cost_amt }}" />
                                    <?php }?>
                                    
                                </div>

                                <div class="col-xs-7 text-right">
                                    <?php 
                                    $sales = 0;
                                    foreach ($variant as $var): 
                                    $sales += $var->sales;
                                    ?> 
                                    <?php endforeach; ?>
                                    <label style="color:rgb(72, 99, 160); font-size: 18px" >
                                        {{$sales}} <span
                                        class="display-none-767">Sold</span>
                                        <span class="slash-divider">/</span> 
                                    </label>
                                    <?php 
                                    if ($data['products']->total_ratings > 0 && $data['products']->number_ratings > 0) {
                                        $total_ratings = $data['products']->total_ratings; 
                                        $number_ratings = $data['products']->number_ratings; 

                                        $total_star = $total_ratings / $number_ratings; 
                                    ?>
                                    <label style="color:rgb(72, 99, 160); font-size: 18px">
                                        {{ number_format($total_star, 1) }}
                                        <span >
                                            <?php
                                                for( $x = 0; $x < 5; $x++ )
                                                {
                                                    if( floor($total_star)-$x >= 1 )
                                                    { echo '<i class="fa fa-star"></i>'; }
                                                    elseif( $total_star-$x > 0 )
                                                    { echo '<i class="fa fa-star-half-o"></i>'; }
                                                    else
                                                    { echo '<i class="fa fa-star-o"></i>'; }
                                                }
                                            ?>
                                          </span>
                                    </label>
                                    <?php }else{ ?>
                                    <label style="color:rgb(72, 99, 160); font-size: 18px">
                                        0
                                        <span>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </span>
                                    </label>
                                    <?php }?>
                                        
                                    <label style="color:rgb(72, 99, 160); font-size: 18px" ><span class="slash-divider">/</span>{{$data['products']->number_ratings}} <span
                                            class="display-none-767">Reviews</span>
                                    </label>
                                </div>

                            </div>

                            <div class="font-14 lh-20 mb-30">
                                {{-- <div>Brand: <label style="color:black; bold"></label></div> --}}
                                <div style="color: black;" ><b>Shop: </b><label style="color:rgb(72, 99, 160); font-size: 18px" >{{ $data['products']->shop_name }}</label></div>
                                <div><b style="color: black">Category:</b> <label><a style="color:rgb(72, 99, 160); font-size: 18px" href="/categories/{{$data['products']->inct_hash}}"> {{ $data['products']->cat_name }}</a></label>
                                     {{-- <label style="color:black">{{ $data['products']->subcat_name }}</label> --}}
                                </div>
                                <?php 
                                $available = 0;
                                foreach ($variant as $var): 
                                $available += $var->available_qty;
                                ?> 
                               
                                <?php endforeach; ?>
                                <?php if ($available <= '0'){ ?> 
                                    <div style="font-size:14px" class="label label-danger">Out of Stocks.</div> 
                                <?php }else{ ?> 
                                    <div><b style="color: black">Available:</b> <label name="qty" style="color:rgb(72, 99, 160); font-size: 18px">{{$available}}</label></div>
                                <?php }?>
                                
                                {{-- <div>Tags: <a class="a-dark" href="#">WOMEN'S
                                        SHOES</a>, <a class="a-dark" href="#">blue shirt</a>,
                                    <a class="a-dark" href="#">men</a></div>
                                <div>SKU: 8084</div> --}}
                            </div>

                            <hr class="mt-0 mb-30">

                            <div class="row">
                                <div class="col-sm-3 mb-30" ><b style="color: black">Variant:</b></div>
                            </div>
                            <div class="row">
                                <?php foreach ($variant as $var): ?> 
                                <div class="col-sm-4 mb-30" >
                                    <button type="button" style="width: 190px; text-overflow: ellipsis;
                                    white-space: nowrap;
                                    overflow: hidden;" 
                                    class="btn btn-lg btn-info btn_variant" 
                                    value="{{$var->vrnt_hash}}"
                                    >{{$var->var_name}}</button>
                                </div>
                                <?php endforeach; ?>
                                <input type="hidden" name="variant" data-msg-required="PLEASE SELECT VARIANT" required>
                                <div id="div_var" style="display:none;">
                                  </div>
                            </div>

                            <hr class="mt-0 mb-30">

                            <div class="mb-30" style="color: black">
                                <span style="display: block; white-space: pre-line;">{{ $data['products']->product_details }}</span><br>
                                <span>Length: {{ $data['products']->lengthsize }}</span><br>
                                <span>Width: {{ $data['products']->width }}</span><br>
                                <span>Height: {{ $data['products']->height }}</span><br>
                                <span>Weight: {{ $data['products']->weight }}</span><br>
                                {{-- Product Description --}}
                            </div>

                            <hr class="mt-0 mb-30">

                            <!-- ADD TO CART -->
                            <div class="row mb-30">
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
                                {{-- <form method="post" action="#" class="form">
                                    --}}
                            
                                        <div class="col-xs-4 col-sm-2 col-md-2 ">
                                             <input type="number" pattern=" 0+\.[0-9]*[1-9][0-9]*$" 
                                             style="<?php if ($available == '0'){ ?> cursor: no-drop; <?php } ?>"
                                             <?php if ($available == '0'){ ?> disabled <?php   } ?>
                                             onkeypress="return event.charCode >= 48 && event.charCode <= 57" data-msg-required="Please enter Quantity"
                                             min="1" max="100" class="input-border" name="qty" id="qty" value="1" required>
                                        </div>
                                        <div class="col-xs-8 col-sm-10 col-md-6">
                                            <div class="post-prev-more-cont clearfix">
                                                <div class="shop-add-btn-cont">
                                                    <button type="button" id="btnadd" data-user-id="<?php echo session('user_hash'); ?>" 
                                                        <?php if ($available == '0'){ ?> disabled <?php   } ?> 
                                                        class="btn btn-lg btn-primary">
                                                        <span class=""></span> <label class="btnadd_label">ADD TO CART</label>
                                                    </button>
                                                </div>
                                                {{-- <div class="shop-sub-btn-cont">
                                                    <a href="#" class="post-prev-count"><span aria-hidden="true"
                                                            class="icon_heart_alt"></span></a>
                                                </div> --}}
                                            </div>
                                        </div>
                        
                            </div>
                        </form>

                    </div>

                </div>
                </div>
            </div>

            <hr class="mt-0 mb-40">

    <div class="container mb-40">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row" >&nbsp;
                <h5 class="widget-title label label-primary" style="color: white">Product Reviews</h5>&nbsp;<br><br>
                    <table class="table">
                        <?php 
                        if(count($data['order']) > 0){
                        foreach ($data['order'] as $review): 
                        ?>
                        <tbody>
                            <tr >
                                <td colspan="5">  
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row" >
                                            <div class="col-md-6">
                                            <b>{{$review->fullname}}</b><br>
                                            <span>Product: </span><span>{{$review->product_name}}</span>
                                            </div>
                                            <div class="col-md-6">
                                            <span style="color:rgb(72, 99, 160); float: right; font-size:20px">
                                                <?php 
                                                if ($review->rating == '1') {
                                                ?>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <?php }?>
                                                <?php 
                                                if ($review->rating == '2') {
                                                ?>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <?php }?>
                                                <?php 
                                                if ( $review->rating == '3') {
                                                ?>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <?php }?>
                                                <?php 
                                                if ($review->rating == '4') {
                                                ?>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <?php }?>
                                                <?php 
                                                if ($review->rating == '5') {
                                                ?>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <?php }?>
                                                
                                            </span><br>
                                            </div>
                                        </div>
                                        <br><hr class="mt-0 mb-10">
                                        <div class="row">
                                        <div class="col-md-12" style="color:black;">
                                            {{$review->remarks}}
                                        </div>
                                    </div>
                                </div>
                                </div>    
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php }else{ ?>
                            <tr>
                                <td colspan="5">
                                <center>No Reviews Yet</center>
                                <br>
                                </td>
                            </tr>
                        </tbody>
                        <?php }?>
                    </table>
                </div>
            </div>
            <!-- PAGINATION -->
            <div class="mt-0" style="padding-left: 10px;">
                <nav>
                {{ $data['order']->links() }}
                </nav> 
            </div>
        </div>
    </div>

            <div class="container mb-40">
                <div class="row row-success2">
                    <div class="col-md-12">
                            <div class="alert alert-success animated fadeIn">
                                <strong>Success!</strong>
                                <span class="success_msg"></span>
                            </div>
                    </div>
                </div>

                  <div class="row row-error2">
                    <div class="col-md-12" >
                        <div class="alert alert-danger animated shake contactError">
                            <strong>Error!</strong>
                            <span class="error_msg"></span>
                        </div>
                    </div>
                  </div>
                <div>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row" >
                                <div class="mb-30">&nbsp;
                                    <h5 class="widget-title label label-primary" style="color: white">question(s)</h5>	
                                    <br>
                                <ul class="media-list text comment-list">
                                    <li>
                                        <div class="contact-form-container">
                                            <form id="msg-form" autocomplete="off">
                                                <?php if(Session::has('user_hash')){ ?>
                                                <div class="row">
                                                    <input type="hidden" name="inmr_hash" id="inmr_hash" value="{{ $data['products']->inmr_hash }}" />
                                                    <input type="hidden" name="sumr_hash" id="sumr_hash" value="{{ $data['products']->sumr_hash }}" />
                                                </div>
                                                
                                                <div class="row">
                                                    <div>
                                                    <div class="col-md-12 mb-40" >
                                                        <div class="col-md-12" >
                                                        <br>
                                                            <textarea style="resize: none; width: 100%; float: center;" maxlength="5000" data-msg-required="Please enter your message" rows="10" class="form-control" name="comment" id="comment" placeholder="ENTER YOUR QUESTION(S) HERE" required=""></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row-md-12">
                                                    <div class="col-md-12">
                                                        &emsp;
                                                        <button type="button" id="btnmsg" data-user-id="<?php echo session('user_hash'); ?>" 
                                                            class="button medium blue">
                                                            <span class=""></span> <label class="btnmsg_label">SEND QUESTION</label>
                                                        </button>
                                                    {{-- &nbsp;&nbsp;<input type="button" id="btnmsg" value="SEND QUESTION"  class="button medium blue" > --}}
                                                    </div>
                                                </div>
                                                <?php }else{?>
                                                    <div class="row-md-12">
                                                        <div class="col-md-12">
                                                            &nbsp;<a style="color:rgb(57, 57, 199)" href="/login">Login/Register</a> to ask questions
                                                        </div>
                                                    </div>
                                                <?php }?>
                                            </form>	
                                        </div>
                                    </li>

                                    <?php 
                                    if(count($data['comment']) > 0){
                                    foreach ($data['comment'] as $com): 
                                    ?>
                                    <!-- Comment Item -->
                                    <div class="row-md-12">
                                        <div class="col-md-12">
                                            <li class="media comment-item">
                                                <span style="text-align: center" class="label label-primary pull-left"><i class="icon_question_alt2"></i> QUESTION</span>&nbsp;
                                                    <div class="media-body">
                                                        <div class="comment-item-title">
                                                            <div class="comment-author">
                                                                {{$com->fullname}}
                                                                <span class="slash-divider">-</span><span class="comment-date" >{{ date('F d, Y', strtotime($com->created_datetime))}} at {{ date('g:ia')}} </span>
                                                            </div>
                                                        <p class="pb-30">{{$com->comment}}</p>
                                                        </div>
                                                    </div>
                                                <?php if($com->answer_status == '1'){ ?> 
                                                <span style="text-align: center" class="label label-success pull-left"><i class="icon_check_alt2"></i>ANSWER</span>&nbsp;
                                                    <div class="media-body">
                                                        <div class="comment-item-title">
                                                            <div class="comment-author">
                                                                {{$com->seller_name}}
                                                                <span class="slash-divider">-</span><span class="comment-date" >{{$com->updated_datetime}}</span>
                                                            </div>
                                                        <p class="pb-30">{{$com->answer}}</p>
                                                        </div>
                                                    </div>
                                                <?php }?> 
                                            </li>
                                        </div>
                                    </div>
                                    <!-- End Comment Item -->
                                    <?php endforeach; ?>
                                    <?php }else{ ?>
                                    <li><center>No Comment Yet</center></li>
                                    <?php }?>
                                </ul>
                                </div>
                            </div>
                        </div>
                        <!-- PAGINATION -->
                        <div class="mt-0" style="padding-left: 10px;">
                            <nav>
                            {{ $data['comment']->links() }}
                            </nav> 
                        </div>
                    </div>
                        <!-- End Add Review -->
                      </div>
                </div>
                <!-- END tabs  -->

                <!-- SAME SHOP -->
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h4 class="blog-page-title mt-0 mb-40">From The Same Shop</h4>
              </div>
                <div class="owl-3items-nav owl-carousel owl-arrows-bg" >
                    <?php 
                    foreach ($shop as $products): ?>
                    <div class="item mb-0 text-center">
                        <!-- SHOP Item 1 -->
                        <div>
                        <div class="shop-dep-item">
                            <a href="/productdetails/{{$products->inmr_hash}}" ><img style="height: 370px; width: 472px; " src="/images/products/{{$products->image_path}}" alt="img"></a>
                        </div>
        
                        <div class="post-prev-title mb-5">
                            <h3 style="text-overflow: ellipsis;
                            white-space: nowrap;
                            overflow: hidden;" ><a class="font-norm a-inv" href="/productdetails/{{$products->inmr_hash}}">{{$products->product_name}}</a></h3>
                          </div>
                          <?php 
                            $minimum = 0;
                            foreach ($var_min as $min):
                            if($products->inmr_hash == $min->inmr_hash)
                            {
                            $minimum = $min->cost_amt; 
                            ?>
                            <?php } ?>
                            <?php endforeach; ?>
                    
                            <?php 
                            $maximum = 0;
                            foreach ($var_max as $max):
                            if($products->inmr_hash == $max->inmr_hash)
                            {
                                $maximum = $max->cost_amt; 
                            ?>
                            <?php } ?>
                            <?php endforeach; ?>
                            
                        <div class="shop-price-cont">
                            <?php if ($minimum === $maximum){ ?> 
                                <strong>&#8369; {{ number_format($minimum, 2) }}</strong>
                            <?php }else{ ?> 
                                <strong>&#8369; {{ number_format($maximum, 2) }} - {{ number_format($minimum, 2) }}</strong>
                            <?php }?>
                        </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
          </div>
          <br>


                <!-- RELATED PRODUCTS -->
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h4 class="blog-page-title mt-0 mb-40">RELATED PRODUCTS</h4>
              </div>
                <div class="owl-3items-nav owl-carousel owl-arrows-bg" >
                    <?php 
                    foreach ($content as $products): ?>
                    <div class="item mb-0 text-center">
                        <!-- SHOP Item 1 -->
                        <div>
                        <div class="shop-dep-item">
                            <a href="/productdetails/{{$products->inmr_hash}}" ><img style="height: 370px; width: 472px; " src="/images/products/{{$products->image_path}}" alt="img"></a>
                        </div>
        
                        <div class="post-prev-title mb-5">
                            <h3 style="text-overflow: ellipsis;
                            white-space: nowrap;
                            overflow: hidden;" ><a class="font-norm a-inv" href="/productdetails/{{$products->inmr_hash}}">{{$products->product_name}}</a></h3>
                          </div>
                          <?php 
                          foreach ($var_min as $min):
                          if($products->inmr_hash == $min->inmr_hash)
                          {
                          $minimum = $min->cost_amt; 
                          ?>
                          <?php } ?>
                          <?php endforeach; ?>
                  
                          <?php 
                          foreach ($var_max as $max):
                          if($products->inmr_hash == $max->inmr_hash)
                          {
                              $maximum = $max->cost_amt; 
                          ?>
                          <?php } ?>
                          <?php endforeach; ?>
                        <div class="shop-price-cont">
                            <?php if ($minimum === $maximum){ ?> 
                                <strong>&#8369; {{ number_format($minimum, 2) }}</strong>
                            <?php }else{ ?> 
                                <strong>&#8369; {{ number_format($maximum, 2) }} - {{ number_format($minimum, 2) }}</strong>
                            <?php }?>
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
</div>
@stop


@section('embeddedjs')
<script src="/formatter/accounting.js"></script>
<script type="text/javascript">
    var initializeControls = function() {
        $('.row-error').hide();
        $('.row-success').hide();
        $('.div_success').hide();
    }();

    var initializeControls = function() {
        $('.row-error2').hide();
        $('.row-success2').hide();
    }();

    var validateRequiredFields = function(f) {
        var stat = true;

        $('.row-error').hide();
        $('div.form-group').removeClass('has-error');
        $('div.fg-line').removeClass('has-error');
        $('input[required],textarea[required],select[required]', f).each(function() {

            if ($(this).is('select')) {
                if ($(this).val() == 0 || $(this).val() == null) {
                    $('.error_msg').html($(this).data('msg-required'));
                    $('.row-error').fadeIn(400);
                    $(this).focus();
                    stat = false;
                    return false;
                }
            } else {
                if ($(this).val() == 0 || $(this).val() == "") {
                // if ($(this).val() == "") {
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

    var validateRequiredFields2 = function(f) {
        var stat = true;

        $('.row-error2').hide();
        $('div.form-group').removeClass('has-error');
        $('div.fg-line').removeClass('has-error');
        $('input[required],textarea[required],select[required]', f).each(function() {

                if ($(this).val() == 0 || $(this).val() == "") {
                // if ($(this).val() == "") {
                    $('.error_msg').html($(this).data('msg-required'));
                    $('.row-error2').fadeIn(400);
                    $(this).closest('.fg-line').addClass('has-error');
                    $(this).focus();
                    stat = false;
                    return false;
                }

        });

        return stat;
    };

    $('.btn_variant').click(function() {
    var clicked_button = $(this).val();
    // alert(clicked_button);

    $('input[name="variant"]').val(clicked_button);

    if(clicked_button) {
    $.ajax({
    url: '/variant/'+encodeURI(clicked_button),
    type: "GET",
    dataType: "json",
    success:function(data) {
    // console.log(data);
        $.each(data, function(key, value) {
        // $('span[name="shipping"]').trigger("change");
        var cost_amt = parseFloat(value.cost_amt);
        
        $('span[name="cost_amt"]').html('&#8369; '+ accounting.formatNumber(cost_amt,2));

        var available_qty = parseFloat(value.available_qty);

       // $('label[name="qty"]').html(available_qty);
        if (available_qty <= 0){
            $('label[name="qty"]').html("Out of Stocks.").addClass('label label-danger').css({"color": "white","font-size":"14px"});
        }else{
            $('label[name="qty"]').html(available_qty).removeClass('label label-danger').css({"color":"rgb(72, 99, 160)","font-size": "18px"});
        }
        });
    }
    });
    }

    });

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
            "url": "{{ url('/cart/create') }}",
            "data": _data
        });
    });

    $('#btnadd').click(function() {
        
        var user_hash = $(this).attr("data-user-id");

        if(user_hash == "" || null){
            window.location.href = "/login";
        }else{
            if (validateRequiredFields($('#add-form'))) {
            $(this).toggleClass('disabled');
            $(this).find('span').toggleClass('fa fa-spinner fa-spin');
            $('.btnadd_label').html('ADDING TO CART');  

            var variant = $('input[name="variant"]').val();
            
            if(variant == ""){
                $('.error_msg').html($(this).data('msg-required'));
                $('.row-error').fadeIn(400);

            }else{

            AddCart().done(function(response) {

                if (response.stat == "success") {
                    $('.div_success').show();
                    $('.success_msg').html(response.msg);
                    $('.row-success').fadeIn(400);
                    setTimeout(function() {
                        window.location.href = "/mycart";
                    },1000);
                } else {
                    $('.row-error').show();
                    $('.error_msg').html(response.msg);
                    $('.row-error').fadeIn(400);
                }
            })
            .always(function() {
                $('#btnadd').toggleClass('disabled');
                $('#btnadd').find('span').toggleClass('fa fa-spinner fa-spin');
                $('.btnadd_label').html('ADD TO CART');  
            });
            }

            }
        }

    });


    var AddMsg = (function() {
        var _data = $('#msg-form').serializeArray();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        return $.ajax({
            "dataType": "json",
            "type": "POST",
            "url": "{{ url('/cart/createmsg') }}",
            "data": _data
        });
    });

    $('#btnmsg').click(function() {
        
        var user_hash = $(this).attr("data-user");

        if(user_hash == "" || null){
            window.location.href = "/login";
        }else{
            if (validateRequiredFields2($('#msg-form'))) {
                $(this).toggleClass('disabled');
                $(this).find('span').toggleClass('fa fa-spinner fa-spin');
                $('.btnmsg_label').html('SENDING QUESTION');

            AddMsg().done(function(response) {

                if (response.stat == "success") {
                    $('.row-success2').show();
                    $('.success_msg').html(response.msg);
                    $('.row-success2').fadeIn(400);
                    setTimeout(function() {
                        window.location.href ='/productdetails/{{$data['products']->inmr_hash}}';
                    },1000);
                } else {
                    $('.row-error2').show();
                    $('.error_msg').html(response.msg);
                    $('.row-error2').fadeIn(400);
                }
            })
            }
        }

    });

    $('input').keypress(function(evt) {

        if (evt.keyCode == 13) {
            $('#btnadd').click();
        }

    });


    
</script>
@endsection

