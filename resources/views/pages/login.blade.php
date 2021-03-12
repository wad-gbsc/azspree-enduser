@extends('pages.index')

@section('content')
<div class="white-bg clearfix" >    
    <!-- COTENT CONTAINER -->
    <div class="container mt-80 mb-10 " >
      <div class="row">
        <div class="col-md-12">
          <br>
          &nbsp;
          <br>
        </div>
      </div>

      <div class="col-md-3" style="float: center">
      </div>
          <div class="col-md-6" style="float: center">
            <div class="relative">
              <div class="col-md-12  white-bg" style="align-content: center;">
                  <div class="mt-20 mb-10">
                    <!-- TITLE -->
                    <br><br>
                    <div style="text-align: center">
                      <img src="/brands_try/azspreelogo.png" class="" alt="Azspree">
                    </div>
                    <div class="mb-10">
                      <h2 class="bold" style="color:rgb(57, 57, 199); padding-left: 50px">LOG <span style="color:black">IN</span> </h2>
                      <span style="padding-left: 50px">Hello, Welcome to your account.</span>
                    </div>      
                    <!-- LOGIN FORM -->
                    <div>
                      <div class="mb-60" style="text-align: center">
                        <br><br>
                        <a href="{{ url('auth/facebook') }}" class="btn btn-primary" style="width: 80%" ><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
                        <br>&nbsp;
                          <!-- DIVIDER -->
                          <hr class="mt-0 mb-10">
                          <br>&nbsp;
                          <a href="{{ url('auth/google') }}" class="btn btn-danger" style="width: 80%" ><i class="fa fa-google" aria-hidden="true"></i> Gmail
                          {{-- <img src="/brands_try/azspree_logo.png" class="" alt="Azspree"> --}}
                        </a>
                        <br><br>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <div class="col-md-3" style="float: center">
          </div>

          <div class="row">
            <div class="col-md-12">
              <br>
              &nbsp;
              <br>
            </div>
          </div>
    </div>
</div>
@stop
  
@section('embeddedjs')
<script type="text/javascript">

function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

  var initializeControls = function(){
    $('.row-error').hide();
    $('.row-success').hide();
  }();

  var validateUser=(function(){
    var _data={email : $('input[name="email"]').val() , password : $('input[name="password"]').val()};    
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    return $.ajax({
        "dataType":"json",
        "type":"POST",
        "url":"{{ url('/validatelogin') }}",
        "data" : _data
    });
  });

  var validateRequiredFields=function(f){
    var stat=true;

        $('.row-error').hide();
        $('div.form-group').removeClass('has-error');
        $('div.fg-line').removeClass('has-error');
        $('input[required],textarea[required],select[required]',f).each(function(){

                if($(this).is('select')){
                if($(this).val()==0 || $(this).val()==null){
                    $('.row-error').fadeIn(400);
                    $(this).focus();
                    stat=false;
                    return false;
                }
            
                }else{
                if($(this).val()==""){
                    $('.row-error').fadeIn(400);
                    $(this).closest('.fg-line').addClass('has-error');
                    $(this).focus();
                    stat=false;
                    return false;
                }
            }
            
        });

        return stat;
  };


  $('#btnlogin').click(function(){

    if(validateRequiredFields($('#login_form'))){
      validateUser().done(function(response){
        
          if(response.stat=="success"){
              $('.row-success').fadeIn(200);
              setTimeout(function(){
                  window.location.href = "/profile";
              },600);
          }else if (response.stat=="verify") {
            $('.row-verify').fadeIn(200);
              setTimeout(function(){
                  window.location.href = "/verify";
              },600);
          }else{
            $('.msg').html(response.msg);
            $('.row-error').fadeIn(200);
          }
      });
    }

  });

 
  $('input').keypress(function(evt){

    if(evt.keyCode==13){ $('#btnlogin').click(); }

  });

</script>
@endsection