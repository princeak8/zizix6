@extends('layouts.admin', ['page'=>'posts'])
        
@section('content')
            
    <!-- Page Content -->
    <div class="page-content">
        <!-- Page Header -->
        <div class="page-header">

            @include('inc.admin.navbar')

        </div><!-- /Page Header -->
        <!-- Page Inner -->
        <div class="page-inner">
            <div class="page-title">
                <ol class="breadcrumb">
                    <li><a href="{{env('APP_URL')}}admin/messages"><i class="fa fa-dashboard"></i>Messages</a></li>
                    <li class="active">Message</li>
                </ol>
            </div>
            
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-md-10">
                    <table class="table table-responsive">
                        <tr>
                            <th>NAME:</th>
                            <td>{{$message->name}}</td>
                        </tr>
                        <tr>
                            <th>EMAIL:</th>
                            <td>{{$message->email}}</td>
                        </tr>
                        <tr>
                            <th>PHONE NUMBER:</th>
                            <td>{{$message->phone}}</td>
                        </tr>
                        <tr>
                            <th>TITLE:</th>
                            <td><b>{{$message->title}}</b></td>
                        </tr>
                        <tr>
                            <th>MESSAGE:</th>
                            <td>{{$message->message}}</td>
                        </tr>
                    </table>

                        <div style="clear: both;"></div>

                    </div>
                </div><!-- Row -->
                        
            </div><!-- Main Wrapper --> 

@endsection

@section('js')

<script type="application/javascript">
  $(document).ready(function() {
    $('.mark-read').click(function() {
      var btn = $(this);
      var id = $(this).data('id');
      var CSRF_TOKEN = $('input[name=_token]').val();
      //alert(CSRF_TOKEN);
      var postUrl = "{{url('admin/mark_read')}}";
      var postFields = {id: id, _token: CSRF_TOKEN};
      $.ajax({
        url:postUrl, 
        data:postFields, 
        type: "post", 
        async: false, 
        error: function(xhr, textStatus, errorThrown) {
            console.log(xhr.responseText);
          //alert(xhr.responseText);
        },
        success: function(json) { 
          //alert(data);
          console.log(json);
          alert(json.status);
          if(json.status == 1) {
            $('#message-'+id).removeAttr('style');
            btn.remove();
          }
        }
      })//ajax ends here
    })

  })
</script>

@endsection