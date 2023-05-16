<script src="{{env('APP_URL')}}js/jQuery-1.10.2.min.js"></script>
    <!-- Bootstrap 3.3.2 -->
<!-- Bootstrap 3.3.2 JS -->
<script src="{{env('APP_URL')}}js/bootstrap.js" type="text/javascript"></script> 
<link href="{{env('APP_URL')}}css/bootstrap.css" rel="stylesheet" type="text/css" />    


<!--<img src="{{env('APP_STORAGE')}}/images/logo.png" title="logo" />-->
<h1><b><i>PRINCEAK</i></b></h1>

<hr/>

<p>
 You are receiving this message because you want to reset/chnge your password.
 </p>
 <p>Click on the Link Below to change your password</p>
 <br/><br/>
 <a href="{{env('APP_URL')}}admin/change_password/{{$data->token}}" class="btn btn-success">CHANGE PASSWORD</a>

<p>THIS LINK CAN ONLY BE USED ONCE</p>