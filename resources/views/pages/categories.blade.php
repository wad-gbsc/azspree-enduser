@extends('pages.index')

@section('content')
@include('include.headboardpic')
<div id="wrap" class="boxed ">
  <div class="container-p-75 grey-bg"> <!-- Grey BG  -->	
     <div class="page-section">
      <div class="relative">
        <h5 class="widget-title">Categories</h5>	
        <div class="row mb-30" >
          <div class="owl-clients-nav owl-carousel owl-arrows-bg" >
            <?php foreach ($category as $categories): ?> 
            <div class="item m-bot-0 text-center"><a href="/categories/{{$categories->inct_hash}}" class="widget-title">{{$categories->cat_name}}<br><img src="/images/category/{{$categories->img_path}}" alt="img"></a></div>
             <?php endforeach; ?>
          </div>
        </div>
      </div>
      </div>
    </div>
</div>  

<!-- CONTENT -->
<div class="page-section p-100-cont">
  <div class="container">
    <div class="row">
      
      <!-- CONTENT -->
      <div class="row">
        <?php foreach ($cathash as $cat_hash): ?>
      <div class="col-sm-9">
        <div class="clearfix mb-0">
          <!-- SEARCH -->
        <div class="widget">
          {{-- <form class="form-search widget-search-form" action="/categories/{{$cat_hash->inct_hash}}/search" method="get"> --}}
            <form class="form-search widget-search-form" action="/searchcat" method="get">
            <input type="hidden" name="category" value={{$cat_hash->inct_hash}}>
            <input type="text" name="keyword" class="input-search-widget" placeholder="Search">
            <button class="" type="submit" title="Start Search">
              <span aria-hidden="true" class="icon_search"></span>
            </button>
          </form>
          </div>
        </div>
      </div>
          
      <form method="get" action="/sortbypricebycat" class="form">
        <div class="col-sm3">
          <div class="right">
            <input type="hidden" name="category" value={{$cat_hash->inct_hash}}>
                <select class="select-md form" name="sortbypricebycat" onchange="this.form.submit()">
                    <option selected disabled="disabled" selected="selected">Sort by Price</option>
                    <option value="desc">Price: High to Low</option>
                    <option value="asc">Price: Low to High</option>
                </select>
          </div>
        </div>
      <form>
      <?php endforeach; ?>

       
        </div>
        <?php
              foreach ($cat as $cat): 
             ?>
        <div>
          <center>
            <h1 class="widget-title">{{$cat->cat_name}}</h1>	
        </center>
        </div><br><br>
        <?php endforeach; ?> 

        
          <!-- SHOP Item -->
          <div class="row">
          <?php
          if(count($content) > 0){
          foreach ($content as $products):
          ?>
            <div class="col-md-3 col-lg-3 pb-80 card" >
              <div class="post-prev-img">  
                <a href="/productdetails/{{$products->inmr_hash}}"><img style="height: 370px; width: 472px;" src="/images/products/{{$products->image_path}}" alt="img"></a>
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
                {{-- <strong>&#8369; {{ number_format($products->cost_amt, 2) }}</strong> --}}
                
              </div>
            </div>
          <?php endforeach; ?>   
          </div>
          <?php }else{ ?>
            <div>
              <h3>
                <img src="/brands_try/sorry1.jpg" alt="img">
              </h3>
            </div>
            <?php }?>      
        </div>
                        
        <!-- PAGINATION -->
        <div class="row mt-0" style="float: right;">
          <nav>
            {{ $content->links() }}
          </nav> 
        </div>
      
    </div>
  </div>
</div>
@stop
