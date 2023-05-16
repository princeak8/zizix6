<script src="{{env('APP_URL')}}js/jQuery-1.10.2.min.js"></script>
    <!-- Bootstrap 3.3.2 -->
<!-- Bootstrap 3.3.2 JS -->
<script src="{{env('APP_URL')}}js/bootstrap.js" type="text/javascript"></script> 
<link href="{{env('APP_URL')}}css/bootstrap.css" rel="stylesheet" type="text/css" />    


<!--<img src="{{env('APP_STORAGE')}}/images/logo.png" title="logo" />-->
<h1><b><i>PRINCEAK</i></b></h1>

<hr/>

<p>
 <b>{{$data['name']}},</b> Just made a comment on {{$data['post']['title']}}. 
 <br/><br/>

 <h2>Message</h2>
{{$data['comment']}}
</p> 