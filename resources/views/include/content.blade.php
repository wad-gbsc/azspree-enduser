<div id="wrap" class="boxed ">
    <div class="container-p-75 ">
        <!-- Grey BG  -->
        <div class="page-section pt-100-b-30-cont">
            <div class="relative">
                <h5 class="widget-title" style="color: rgb(72, 99, 160); text-align: center">Categories</h5>
                <div class="row mb-30">
                    <div class="owl-clients-nav owl-carousel owl-arrows-bg">
                        <?php foreach ($categories as $category): ?>
                        <div class="text-center"><a href="/categories/{{ $category->inct_hash }}"
                                class="widget-title">{{ $category->cat_name }}<br><img
                                    src="/images/category/{{ $category->img_path }}" alt="img"></a></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CONTENT -->
{{-- <div class="page-section p-100-cont pb-30">
    <div class="relative container ">
        <div class="row"> --}}

            {{-- <div class="row mb-30" >
              <div class="owl-clients-auto owl-carousel"  >
                @foreach (File::glob(public_path('images/promotion/') . '/*') as $path)
                <div style="width: 230%; height: 300px; padding-right:80px;">
                        <img src="{{ str_replace(public_path(''), '', $path ) }}" alt="img">
                </div><br>
                @endforeach
              </div>
            </div> --}}

            {{-- <div class="row mb-30">
                <div class="owl-clients-auto owl-carousel">

                    <?php
                    $imagesDir = 'images/promotion/';
                    $images = glob($imagesDir . '*', GLOB_BRACE);
                    shuffle($images); // $images will be shuffled.
                    foreach ($images as $shuffleimage) {
                        echo '<div style="width: 230%; height: 300px; padding-right:80px;">
                                           <img src="' .
                            $shuffleimage .
                            '" />
                                        </div><br>';
                    }
                    ?>
                </div>
            </div>
        </div>
</div> --}}

<div id="wrap" class="boxed ">
  <div class="container-p-75 ">
<div class="page-section">
  {{-- <div class="page-section indent-header"> --}}
  <div class="relative">

    <!-- ITEMS GRID -->
    <ul class="port-grid port-grid-gut clearfix masonry" id="items-grid" style="position: relative; height: 502.162px;">
        
      <!-- Item 1 -->
      <li class="port-item mix" style="position: absolute; left: 0px; top: 0px;">
        <a href="shop-single.html">
          <div class="port-img-overlay"><img class="port-main-img" src="/HTML/images/shop/portfolio/projects-1.jpg" alt="img"></div>
        </a>
        <div class="port-overlay-cont">

            <div class="port-title-cont">
              <h3><a href="shop-single.html">MEN'S GLOVES</a></h3>
              <span><a href="#">men</a> / <a href="#">accessories</a></span>
            </div>
            <div class="port-btn-cont">
              <a href="/HTML/images/shop/portfolio/projects-2-big.jpg" class="lightbox mr-20"><div aria-hidden="true" class="icon_search"></div></a>
              <a href="shop-single.html"><div aria-hidden="true" class="icon_link"></div></a>
            </div>

        </div>
      </li>

      <!-- Item 2 -->
      <li class="port-item mix" style="position: absolute; left: 259px; top: 0px;">
        <a href="shop-single.html">
          <div class="port-img-overlay"><img class="port-main-img" src="/HTML/images/shop/portfolio/projects-2-big.jpg" alt="img"></div>
        </a>
        <div class="port-overlay-cont">
         
            <div class="port-title-cont">
              <h3><a href="shop-single.html">GREY SWEATER</a></h3>
              <span><a href="#">men</a> / <a href="#">clothing</a></span>
            </div>
            <div class="port-btn-cont">
              <a href="/HTML/images/shop/portfolio/projects-2-big.jpg" class="lightbox mr-20"><div aria-hidden="true" class="icon_search"></div></a>
              <a href="shop-single.html"><div aria-hidden="true" class="icon_link"></div></a>
            </div>
      
        </div>
      </li>
      
      <!-- Item 3 -->
      <li class="port-item mix" style="position: absolute; left: 519px; top: 0px;">
        <a href="shop-single.html">
          <div class="port-img-overlay"><img class="port-main-img" src="/HTML/images/shop/portfolio/projects-3-very-big.jpg" alt="img"></div>
        </a>
        <div class="port-overlay-cont">
      
            <div class="port-title-cont">
              <h3><a href="shop-single.html">VIOLET DRESS</a></h3>
              <span><a href="#">women</a> / <a href="#">clothing</a></span>
            </div>
            <div class="port-btn-cont">
              <a href="/HTML/images/shop/portfolio/projects-2-big.jpg" class="lightbox mr-20"><div aria-hidden="true" class="icon_search"></div></a>
              <a href="shop-single.html"><div aria-hidden="true" class="icon_link"></div></a>
            </div>
      
        </div>
      </li>
      
      <!-- Item 4 -->
      <li class="port-item mix" style="position: absolute; left: 779px; top: 0px;">
        <a href="shop-single.html">
          <div class="port-img-overlay"><img class="port-main-img" src="/HTML/images/shop/portfolio/projects-4-big.jpg" alt="img"></div>
        </a>
        <div class="port-overlay-cont">
         
            <div class="port-title-cont">
              <h3><a href="shop-single.html">LEATHER BAG</a></h3>
              <span><a href="#">women</a> / <a href="#">accessories</a></span>
            </div>
            <div class="port-btn-cont">
              <a href="/HTML/images/shop/portfolio/projects-2-big.jpg" class="lightbox mr-20"><div aria-hidden="true" class="icon_search"></div></a>
              <a href="shop-single.html"><div aria-hidden="true" class="icon_link"></div></a>
            </div>
      
        </div>
      </li>
      
      <!-- Item 5 -->
      <li class="port-item mix" style="position: absolute; left: 0px; top: 172px;">
        <a href="shop-single.html">
          <div class="port-img-overlay"><img class="port-main-img" src="/HTML/images/shop/portfolio/projects-5-big.jpg" alt="img"></div>
        </a>
        <div class="port-overlay-cont">
    
            <div class="port-title-cont">
              <h3><a href="shop-single.html">GREY SWEATER</a></h3>
              <span><a href="#">men</a> / <a href="#">shirts</a></span>
            </div>
            <div class="port-btn-cont">
              <a href="/HTML/images/shop/portfolio/projects-2-big.jpg" class="lightbox mr-20"><div aria-hidden="true" class="icon_search"></div></a>
              <a href="shop-single.html"><div aria-hidden="true" class="icon_link"></div></a>
            </div>
    
        </div>
      </li>
      
      <!-- Item 6 -->
      <li class="port-item mix" style="position: absolute; left: 259px; top: 329px;">
        <a href="shop-single.html">
          <div class="port-img-overlay"><img class="port-main-img" src="/HTML/images/shop/portfolio/projects-6.jpg" alt="img"></div>
        </a>
        <div class="port-overlay-cont">
       
            <div class="port-title-cont">
              <h3><a href="shop-single.html">BLACK BELT</a></h3>
              <span><a href="#">women</a> / <a href="#">accessories</a></span>
            </div>
            <div class="port-btn-cont">
              <a href="/HTML/images/shop/portfolio/projects-2-big.jpg" class="lightbox mr-20"><div aria-hidden="true" class="icon_search"></div></a>
              <a href="shop-single.html"><div aria-hidden="true" class="icon_link"></div></a>
            </div>
     
        </div>
      </li>
      
      <!-- Item 7 -->
      <li class="port-item mix" style="position: absolute; left: 779px; top: 329px;">
        <a href="shop-single.html">
          <div class="port-img-overlay"><img class="port-main-img" src="/HTML/images/shop/portfolio/projects-7.jpg" alt="img"></div>
        </a>
        <div class="port-overlay-cont">
       
            <div class="port-title-cont">
              <h3><a href="shop-single.html">GREY SWEATER</a></h3>
              <span><a href="#">men</a> / <a href="#">shirts</a></span>
            </div>
            <div class="port-btn-cont">
              <a href="/HTML/images/shop/portfolio/projects-2-big.jpg" class="lightbox mr-20"><div aria-hidden="true" class="icon_search"></div></a>
              <a href="shop-single.html"><div aria-hidden="true" class="icon_link"></div></a>
            </div>
  
        </div>
      </li>
       
    </ul>

  </div>
</div>
  </div></div>

    <div class="container">
        <div class="row">
            <!-- SHOP AD -->
            <div class="page-section"
                style="background-image: url('/brands_try/cabalen.jpg'); background-repeat: no-repeat; background-size: 100% 100%;">
                <div class="relative">
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
        </div></div>
        <div id="wrap" class="boxed ">
          <div class="container-p-75 ">
            <!-- CONTENT -->
            <div class="row mt-50">
                <div class="col-sm-9">
                    <div class="widget">
                        <form class="form-search widget-search-form" action="/search" method="get">
                            <input type="text" name="keyword" class="input-search-widget form-control"
                                placeholder="Search">
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
            <div class="row">
                <?php 
              if(count($content) > 0){
              foreach ($content as $products): ?>
                <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 pb-20 pt-20 ">
                    <div class="" style="min-height: 250px;  background-color:white; border-radius: 5px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <div class="shop-dep-item" style="overflow:hidden">
                            <a href="/productdetails/{{ $products->inmr_hash }}">
                                    <img class="center"
                                    style="height: 16vmax; object-fit: cover; padding-top:5px "
                                    src="/images/products/{{ $products->image_path }}"
                                    alt="{{ $products->product_name }}">
                            </a>
                        </div>

                        <div class="post-prev-title mb-5">
                            <h3 style="text-overflow: ellipsis;
                        white-space: nowrap;
                        overflow: hidden;"><a class="font-norm a-inv"
                                    href="/productdetails/{{ $products->inmr_hash }}">{{ $products->product_name }}</a>
                            </h3>
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
                            <strong style="text-overflow: ellipsis;
                          white-space: nowrap;
                          overflow: hidden;">&#8369; {{ number_format($minimum, 2) }}</strong>
                            <?php }else{ ?>
                            <strong style="text-overflow: ellipsis;
                          white-space: nowrap;
                          overflow: hidden;">&#8369; {{ number_format($maximum, 2) }} -
                                {{ number_format($minimum, 2) }}</strong>
                            <?php }?>
                            {{-- <strong>&#8369; {{ number_format($products->cost_amt, 2) }}</strong> --}}
                        </div>
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
                    {{ $content->links('pagination.pag_temp') }}
                </nav>
            </div>

        </div>
    </div>
</div>

@section('embeddedjs')
    <script type="text/javascript">
        setTimeout(function() {
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

            if (sortingMethod == 'l2h') {
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
