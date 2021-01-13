@extends('pages.index')

@section('content')
    <div class="container-p-75 grey-bg" > <!-- Grey BG  -->	
       <div class="page-section indent-header">
        <div class="relative">
          <h5 class="widget-title" style="color: rgb(72, 99, 160);">ADDITION</h5>	
          <div class="row" >
            <?php 
              foreach ($data['addition'] as $add): ?>
                  <div class="col-md-3 pb-30 pt-30" style="border: solid 1px; text-align: center;">
                      <div >  
                      </div>
                      
                      <div class="post-prev-title mb-5" style="border-style: solid; border: 1px; text-align: center; ">
                        <h3>{{$add->number1}}</h3> + <h3>{{$add->number2}}</h3>
                        <br>
                       
                      </div>
                        
                      <div class="shop-price-cont" style="text-align: center">
                       <input type="number" class="form-control">
                      </div>
                  </div>
              
            <?php endforeach; ?>
            </div>
        </div>
        </div>
      </div>
  @stop