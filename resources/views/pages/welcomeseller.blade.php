@extends('pages.index')

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

@section('content')

<div class="sm-img-bg pt-180" style="background-image: url(/brands_try/gif.gif); background-repeat: no-repeat; background-position:50% 0; background-size: 100% 100%;">
  <div class="container sm-content-cont">
    <div class="sm-cont-middle">

      <!-- OPACITY container -->
      <div class="opacity-scroll2">

        <!-- LAYER NR. 1 -->
        <div class="font-white light-72-wide sm-mb-15 sm-mt-20" >
        </div>

        <!-- LAYER NR. 2 -->
        <div class="font-white norm-16-wide hide-0-736 sm-mb-50">
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
        </div>

        <!-- LAYER NR. 3 -->
        <div class="center-0-478">
          &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
          <a href="https://forms.gle/UfJ6y8Hprq6YGv847"><img class="beat" src="/brands_try/btn_bemerchant.png" style="height: 35%; width: 35%;" alt="img"></a>
        </div>

      </div>

    </div>
  </div>
</div>	
    <!-- PAGE TITLE LARGE IMG -->
    {{-- <div class="page-title-cont page-title-large page-title-img grey-dark-bg pt-250" style="background-image: url(/brands_try/gif.gif);  background-repeat: no-repeat; background-position:50% 0; background-size: 100% 100%;">
        <div class="relative container align-left">
          <div class="row">
             
            <div class="col-md-8">
              <h1 class="page-title">WELCOME TO AZSPREE</h1>
              <div class="page-sub-title">
                Sell on azspree now! 
              </div>
            </div>
             
            <div class="col-md-4 text-center">
              <div class="breadcrumbs">
                    <a class="button medium thin gray" href="#">REGISTER NOW</a>
              </div>
            </div>
            
          </div>
        </div>
      </div>			 --}}
      <!-- FLEX SLIDER -->
    {{-- <div class="indent-header">
      <div class="slider-1 clearfix">
       
        <div class="flex-container">
          <div class="flexslider loading">
            <ul class="slides">

              <li style="background: url(/brands_try/gif.gif); background-repeat: no-repeat; background-position:50% 0; background-size: contain;">
                <div class="container">
                  <div class="contain">
                  </div>
                </div><!-- End Container -->
              </li><!-- End item -->

            </ul>
          </div>
        </div>
         
      </div><!-- End slider -->		
  </div> --}}
	
  
  <!-- BLOG 1 -->
  <div id="blog-link" class="page-section pt-110-b-30-cont">
    <div class="container">
      <center><h2>SELLING PROCESS IN JUST 4 EASY AND SIMPLE STEPS!</h2></center>
      <div class="row">
        
        <!-- Post Item 1 -->
        <div class="col-sm-6 col-md-3 col-lg-3 wow fadeIn pb-70" >
            
          <div class="post-prev-img">
            <img src="/brands_try/step1.png" alt="Step1">
          </div>
            
          <div class="post-prev-title">
            {{-- <h3 style="text-align: center;"> STEP 1</h3> --}}
          </div>
        
        </div>
        
        <!-- Post Item 2 -->
        <div class="col-sm-6 col-md-3 col-lg-3 wow fadeIn pb-70" >
            
          <div class="post-prev-img">
            <img src="/brands_try/step2.png" alt="Step2">
          </div>
            
          <div class="post-prev-title">
            {{-- <h3 style="text-align: center;"> STEP 2</h3> --}}
          </div>
        
        </div>

        <!-- Post Item 3 -->
        <div class="col-sm-6 col-md-3 col-lg-3 wow fadeIn pb-70" >
            
          <div class="post-prev-img">
            <img src="/brands_try/step3.png" alt="Step3">
          </div>
            
          <div class="post-prev-title">
            {{-- <h3 style="text-align: center;"> STEP 3</h3> --}}
          </div>
        
        </div>

        <!-- Post Item 4 -->
        <div class="col-sm-6 col-md-3 col-lg-3 wow fadeIn pb-70" >
            
          <div class="post-prev-img">
            <img src="/brands_try/step4.png" alt="Step4">
          </div>
            
          <div class="post-prev-title">
            {{-- <h3 style="text-align: center;"> STEP 4</h3> --}}
          </div>
        
        </div>
        
      </div>
      </div>
      <center><h2>WHY SELL ON AZSPREE</h2></center>
      <div class="shop-info ">
        <div class="container">
        <img src="/brands_try/wcmrchnt.jpg" alt="img">
        </div>
      </div>
      {{-- <div class="container">
        <center><h2>SELLER SUPPORT</h2></center>
        <div class="row">
          
          <!-- Post Item 1 -->
          <div class="col-sm-6 col-md-4 col-lg-4 wow fadeIn pb-70" >
              
            <div class="post-prev-img">
              <a href="#"><img src="HTML/images/blog/constr1.jpg" alt="img"></a>
            </div>
              
            <div class="post-prev-title">
              <h3><a href="#">HELP CENTER</a></h3>
            </div>
              
            <div class="post-prev-info">
              Lorem ipsum dolor
            </div>
              
            <div class="post-prev-text no-border">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, nostrum, cumque culpa provident aliquam commodi assumenda laudantium magnam illo nostrum. 
            </div>
          
          </div>
          
          <!-- Post Item 2 -->
          <div class="col-sm-6 col-md-4 col-lg-4 wow fadeIn pb-70" data-wow-delay="200ms" >
              
            <div class="post-prev-img">
              <a href="#"><img src="HTML/images/blog/post-prev-1.jpg" alt="img"></a>
            </div>
              
            <div class="post-prev-title">
              <h3><a href="#">UNIVERSITY</a></h3>
            </div>
              
            <div class="post-prev-info">
              LOREM IPSUM DOLOR 
            </div>
              
            <div class="post-prev-text no-border">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, nostrum, cumque culpa provident aliquam commodi assumenda laudantium magnam illo nostrum. 
            </div>
          
          </div>
          
          <!-- Post Item 3 -->
          <div class="col-sm-6 col-md-4 col-lg-4 wow fadeIn pb-70" data-wow-delay="400ms" >
              
            <div class="post-prev-img">
              <a href="#"><img src="HTML/images/blog/constr3.jpg" alt="img"></a>
            </div>
              
            <div class="post-prev-title">
              <h3><a href="#">MANAGEMENT</a></h3>
            </div>
              
            <div class="post-prev-info">
              LOREM IPSUM DOLOR 
            </div>
              
            <div class="post-prev-text no-border">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, nostrum, cumque culpa provident aliquam commodi assumenda laudantium magnam illo nostrum. 
            </div>
          
          </div>
          
        </div>
        </div> --}}
      
    </div>
  </div>
 <!-- DIVIDER -->
 <hr class="mt-0 mb-0">
  <!-- CALL TO ACTION 2 -->
  <div class="page-section pt-10-b-50-cont"> 
    <div class="container">
      <a href="https://forms.gle/UfJ6y8Hprq6YGv847"><img class="beat" src="/brands_try/btnclick.png" alt="img"></a>
      <div class="row">
        
        <div class="col-md-12 text-center">
          &emsp;
        </div>
        
      </div>    
    </div>    
  </div> 
  
         
          @stop