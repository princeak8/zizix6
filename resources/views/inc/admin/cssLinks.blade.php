 <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link href="{{asset('assets/admin/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/admin/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/admin/plugins/icomoon/style.css')}}" rel="stylesheet">
        @if($page!='home') 
        		<link href="{{asset('assets/admin/plugins/uniform/css/default.css')}}" rel="stylesheet"/>
        		<link href="{{asset('assets/admin/plugins/switchery/switchery.min.css')}}" rel="stylesheet"/>
        @endif
        @if($page=='albums')
                <link href="{{asset('assets/admin/plugins/datatables/css/jquery.datatables.min.css')}}" rel="stylesheet" type="text/css"/> 
                <link href="{{asset('assets/admin/plugins/datatables/css/jquery.datatables_themeroller.css')}}" rel="stylesheet" type="text/css"/> 
                <link href="{{asset('assets/admin/plugins/bootstrap-datepicker/css/datepicker3.css')}}" rel="stylesheet" type="text/css"/>
        @endif
        @if($page=='album')
          <link href="{{asset('assets/admin/plugins/gridgallery/css/component.css')}}" rel="stylesheet">
          <script src="{{asset('assets/adminplugins/gridgallery/js/modernizr.custom.js')}}"></script>
        @endif
        <!-- Theme Styles -->
        <link href="{{asset('assets/admin/css/ecaps.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/admin/css/custom.css')}}" rel="stylesheet">
        <script type="application/javascript" src="{{asset('assets/tinymce/tinymce.min.js')}}"></script>
    <!--<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>-->
   
<script type='text/javascript'>
var editor_config = {
    path_absolute : "/cinegrade/",
    selector: ".tinymce",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>
