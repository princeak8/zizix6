 <!-- Javascripts -->
        <script src="{{asset('assets/admin/plugins/jquery/jquery-3.1.0.min.js')}}"></script>
        <script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('assets/admin/plugins/uniform/js/jquery.uniform.standalone.js')}}"></script>
        @if($page!='home') <script src="{{asset('assets/admin/plugins/switchery/switchery.min.js')}}"></script> @endif
        @if($page=='albums')
        	<script src="{{asset('assets/admin/plugins/switchery/switchery.min.js')}}"></script>
	        <script src="{{asset('assets/admin/plugins/datatables/js/jquery.datatables.min.js')}}"></script>
	        <script src="{{asset('assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
	        <script src="{{asset('assets/admin/js/ecaps.min.js')}}"></script>
	        <script src="{{asset('assets/admin/js/pages/table-data.js')}}"></script>
        @endif
        @if($page=='album')
                <script src="{{asset('assets/admin/plugins/gridgallery/js/imagesloaded.pkgd.min.js')}}"></script>
                <script src="{{asset('assets/admin/plugins/gridgallery/js/masonry.pkgd.min.js')}}"></script>
                <script src="{{asset('assets/admin/plugins/gridgallery/js/classie.js')}}"></script>
                <script src="{{asset('assets/admin/plugins/gridgallery/js/cbpgridgallery.js')}}"></script>
                <script src="{{asset('assets/admin/js/pages/gallery.js')}}"></script>
                
        @endif
        <script src="{{asset('assets/admin/js/ecaps.min.js')}}"></script>

        
        <!-- <script src="assets/js/pages/dashboard.js"></script> -->
       