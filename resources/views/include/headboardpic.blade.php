{{-- 
   
      <div class="page-title-cont page-title-large page-title-img grey-dark-bg pt-250" style="background-image: url(brands_try/gray.jpg)">
        <div class="relative container align-left">
        <div class="row">
           
          <div class="col-md-8">
            <h1 class="page-title">WELCOME TO AZSPREE</h1>
            <div class="page-sub-title">
            SHOP NOW!
            </div>
          </div>
           
          <div class="col-md-4">
            <div class="breadcrumbs">
            
            </div>
          </div>
          
        </div>
      </div>
    </div> --}}
    @section('embeddedcss')
    <style scoped>
     @keyframes heartbeat
    {
      0%
      {
        transform: scale( .75 );
      }
      20%
      {
        transform: scale( 1 );
      }
      40%
      {
        transform: scale( .75 );
      }
      60%
      {
        transform: scale( 1 );
      }
      80%
      {
        transform: scale( .75 );
      }
      100%
      {
        transform: scale( .75 );
      }
    }
    
    .beat
    {
      animation: heartbeat 3s infinite;
    }
    </style>
    @endsection
    
    {{-- <div id="wrap" class="boxed ">
			<div class="container-p-75 grey-bg"> <!-- Grey BG  -->	
				
    <!-- FLEX SLIDER -->
    <div class="indent-header">
      <div class="slider-1 clearfix">
       
        <div class="flex-container">
          <div class="flexslider loading">
            <ul class="slides">
            
              <!-- SLIDE 1 -->
              <li style="background: url(/brands_try/header_app.jpg); background-repeat: no-repeat; background-position:50% 0; background-size:contain;">
                <div class="container">
                  <div class="contain">
                  </div>
                </div><!-- End Container -->
              </li><!-- End item -->
              
              <li style="background: url(/brands_try/header_app.jpg); background-repeat: no-repeat; background-position:50% 0; background-size: 100% 100%;">
                <div class="container">
                  <div class="contain">
                  </div>
                </div><!-- End Container -->
              </li><!-- End item -->

            </ul>
          </div>
        </div>
         
      </div><!-- End slider -->		
  </div>	
    </div>	
      </div>
    </div> --}}

    <div class="slider-1 clearfix pt-75">
           
      <div class="flex-container">
        <div class="flexslider">
          <ul class="slides">
          
            <!-- SLIDE 1 -->
            <li style="background: url(/brands_try/app_head_real_3.jpg); background-repeat: no-repeat; background-position:50% 0; background-size: 100% 100%; float: left; margin-right: -100%; opacity: 0.837956; display: block; z-index: 2;" class="flex-active-slide">
            
              <div class="container">
                <div class="contain">
                 {{-- <h2 data-toptitle="15%" class="light-100 flex-top-bot" style="top: 35%; left: 0px; opacity: 0;">2018</h2> --}}
                  <p data-bottomtext="5%" class="light flex-bot-top " style="bottom: -50%; left: 0px; opacity: 0;"><a href="{{ url('download/azspreeMobileApp') }}"><span class="bold"><img src="/brands_try/btn_click_here.png" width="270vw" ></span></a></p>
                </div>
              </div><!-- End Container -->
            
            </li><!-- End item -->
            
            <!-- SLIDE 2 -->  
            <li style="background: url(/brands_try/new_cover.jpg); background-repeat: no-repeat; background-position:50% 0; background-size: 100% 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;" class="">
              
              <div class="container">
                <div class="sixteen columns contain">
                  <h2 data-bottomtext="31%" class="norm-50-wide text-center font-white bot-34-767 bot-30-480-767 flex-bot-top" style="bottom: -50%; left: 15px; opacity: 0;"><span class="slider-caption-border no-border-959" style="background-color:rgb(249, 91, 90); ">FREE SHIPPING MONTH!!</span></h2>
                </div>
              </div><!-- End Container -->
              
            </li><!-- End item -->
          </ul>
        </div>
      <ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="#"></a></li><li class="flex-nav-next"><a class="flex-next" href="#"></a></li></ul></div>
       
    </div>
    