

<div id="wrap" class="boxed ">
  <div class="container-p-75 grey-bg" > <!-- Grey BG  -->	
     <div class="page-section">
      <div class="relative">
        <h5 class="widget-title" style="color: rgb(72, 99, 160);">Categories</h5>	
        <div class="row mb-30" >
          <div class="owl-clients-nav owl-carousel owl-arrows-bg" >
            <?php foreach ($categories as $category): ?> 
            <div class="item m-bot-0 text-center"><a href="/categories/{{$category->inct_hash}}" class="widget-title">{{$category->cat_name}}<br><img src="/images/category/{{$category->img_path}}" alt="img"></a></div>
             <?php endforeach; ?>
          </div>
        </div>
      </div>
      </div>
    </div>
</div>  

<!-- CONTENT -->
<div class="page-section p-100-cont pb-30" >
  <div class="container">
    <div class="row">
{{-- 
      <div class="row mb-30" >
        <div class="owl-clients-auto owl-carousel"  >
          <div style="width: 230%; height: 300px; padding-right:80px;"><img src="/brands_try/ads1.jpg" ></div><br>
          <div style="width: 230%; height: 300px; padding-right:80px;"><img src="/brands_try/ads2.jpg" ></div><br>
          <div style="width: 230%; height: 300px; padding-right:80px;"><img src="/brands_try/ads1.jpg" ></div><br>
          <div style="width: 230%; height: 300px; padding-right:80px;"><img src="/brands_try/ads2.jpg" ></div><br>
        </div>
      </div> --}}
      <div class="row mb-30" >
        <div class="owl-clients-auto owl-carousel"  >
          @foreach(File::glob(public_path('images/promotion/').'/*') as $path)
          <div style="width: 230%; height: 300px; padding-right:80px;">
                  <img src="{{ str_replace(public_path(''), '', $path ) }}" alt="img">
          </div><br>
          @endforeach
        </div>
      </div>
      <!-- SHOP AD -->
      <div class="page-section" style="background-image: url('/brands_try/cabalen.jpg'); background-repeat: no-repeat; background-size: 100% 100%;">
        <div class="container">
          <div class="row">
          
            <div class="col-md-6 col-sm-6 p-40">
              <div class="equal-height">
                <div class="text-middle block-center-x-767">
                  {{-- <h3 class="light-34 m-0">HEY<br><span class="bold">GOOD DAY!</span></h3> --}}
                  {{-- <h3 class="light-34 m-0">NEW 2018 <br><span class="bold">COLLECTION</span></h3> --}}
                </div>
              </div>
            </div>
            
            <div class="col-md-6 col-sm-6 text-center pt-40 pb-40 equal-height">
              <div class="equal-height">
                <div class="text-middle block-center-x-767">
                  {{-- <h3 class="light-34 m-0"><span class="bold">NOW</span> IN STORE</h3> --}}
                </div>
              </div>
            </div>
          </div>            
        </div>            
      </div>

      
        <!-- CONTENT -->
        <div class="row mt-50">
          <div class="col-sm-9">
            <div class="widget">
              <form class="form-search widget-search-form" action="/search" method="get">
                <input type="text" name="keyword" class="input-search-widget" placeholder="Search">
                <button class="" type="submit" title="Start Search">
                  <span aria-hidden="true" class="icon_search"></span>
                </button>
              </form>
            </div>
          </div>
          
          <div class="col-sm-3">
            <div class=" widget right">
                <form method="get" action="/sortbyprice" class="form">
                    <select class="select-md form" name="sortbyprice" onchange="this.form.submit()">
                        <option selected disabled="disabled" selected="selected">Sort by Price</option>
                        <option value="desc">Price: High to Low</option>
                        <option value="asc">Price: Low to High</option>
                    </select>
                </form>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            {{-- <form id="count" method="POST" action="/visitorcount" class="form">
          </form> --}}
          </div>
        </div>

            <!-- SHOP Item -->
            <div class="row" >
            <?php 
              if(count($content) > 0){
              foreach ($content as $products): ?>
                  <div class="col-md-3 pb-30 pt-30" style="min-height: 250px;">
                      <div >  
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
                        {{-- <strong>&#8369; {{ number_format($products->cost_amt, 2) }}</strong> --}}
                        
                      </div>
                    
                  </div>
              
            <?php endforeach; ?>
            </div>
            <?php }else{ ?>
              <div class="row">
                  <div class="col-md-12 mb-50">
                    <img src="/brands_try/sorry1.jpg" alt="img">
                  </div>
                  {{-- <div class="col-md-12 mb-110">
                  </div>
                  <div class="col-md-12 mb-110">
                  </div> --}}
              </div>
            <?php }?>   
            
            <!-- PAGINATION -->
        <div class="row mt-0" style="float: right;">
          <nav>
            {{ $content->links() }}
          </nav> 
        </div>

    </div> 
  </div>
</div>
        
@section('embeddedjs')
<script type="text/javascript">

setTimeout(function(){
  // let visitCount = document.getElementById('visit_count').value;
  // let visitCountPlusOne = parseInt(visitCount) + 1;

  // document.getElementById('visit_count').value = visitCountPlusOne;
  var $formvar = $('#');

  $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      
      return $.ajax({
      url: '/visitorcount',
      type: "PUT",
      dataType: $formvar.serialize()
      });

}, 10);

$(document).on("change", ".control", function() {
  var sortingMethod = $(this).val();
  
  if(sortingMethod == 'l2h') {
    sortProductsPriceAscending();
  } else if (sortingMethod == 'h2l') {
    sortProductsPriceDescending();
  }
});

function sortProductsPriceAscending() {
  var gridItems = $('.grid-item');

  gridItems.sort(function(a, b) {
    return $('.shop-price-cont', a).data("price") - $('.shop-price-cont', b).data("price");
  });

  $(".isotope-grid").append(gridItems);
}

function sortProductsPriceDescending() {
  var gridItems = $('.grid-item');

  gridItems.sort(function(a, b) {
    return $('.shop-price-cont', b).data("price") - $('.shop-price-cont', a).data("price");
  });

  $(".isotope-grid").append(gridItems);
}
   
</script>
@endsection
