<script 
	src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
	integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
	crossorigin="anonymous">
</script>
    <!-- Bootstrap 3.3.2 -->
<!-- Bootstrap 3.3.2 JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" type="text/javascript"></script> 
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
<link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />

<div style="height: 180px; width: 100%; background-color: #04026e; padding-left: 10px;">
	<img src="{{env('APP_STORAGE')}}images/logo.png" title="logo" height="100" width="130" />
	<h4 style="color: #FFF; margin-bottom: 0px; padding-bottom: 0px;">ZIZIX6 NIG LTD</h4>
	<p style="color: #FFEDB6">
		Powering Ideas and Interconnecting businnesses
	</p>
</div>

<hr/>

<div id="content" class="col-md-8 offset-md-2">
	<h2 style="text-align: center;">ZIZIX6 FEEDBACK</h2>

	<p>
        You have received a new contact message.
        <br/><br/>
    </p>

    <h2>FROM</h2>
    {{$name}}

    <h2>Email</h2>
    {{$email}}
	 
    <h2>Title</h2>
    {{$title}}

    <h2>Message</h2>
    {{$content}}
</div>
