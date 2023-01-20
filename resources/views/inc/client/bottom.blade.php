<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<link rel="stylesheet" href="{{env('APP_URL')}}/assets/client/css/vroom.css">
<script type="text/javascript" src="{{env('APP_URL')}}/assets/client/js/vroom.js"></script>
<script type="text/javascript" src="{{env('APP_URL')}}/assets/client/js/TweenLite.min.js"></script>
<script type="text/javascript" src="{{env('APP_URL')}}/assets/client/js/CSSPlugin.min.js"></script>
<script src="{{env('APP_URL')}}/assets/client/js/jquery.nicescroll.js"></script>
<script src="{{env('APP_URL')}}/assets/client/js/scripts.js"></script>

<!-- Bootstrap Core JavaScript -->
   <script src="{{env('APP_URL')}}/assets/client/js/bootstrap.min.js"></script>
</body>
</html>