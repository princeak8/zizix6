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
                <h3 class="breadcrumb-header">
                    MESSAGES
                </h3>
            </div>
            
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-md-10">

                        <div id="messages" style="margin-top: 30px; margin-bottom: 30px;">
                        @if(count($messages) == 0) 
                          <p style="text-align: center;">There are no messages</p>
                        @else
                            <table id="example1" class="table table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>S/N</th>
                                  <th>NAME</th>
                                  <th>TITLE</th>
                                  <th>IP Address</th>
                                  <th>SENT AT</th>
                                  <th>ACTION</th>
                                </tr> 
                              </thead>
                              <tbody>
                                @foreach($messages as $key=>$message)
                              <?php ++$key; ?>
                                <tr id="message-{{$message->id}}" @if($message->unread==1) style="font-weight: bold;" @endif>
                                  <td>{{$key}}</td>
                                  <td>{{$message->name}}</td>
                                  <td>@if(empty($message->title)) Untitled @else {{$message->title}} @endif</td>
                                  <td>{{$message->IP}}</td>
                                  <td>{{$message->created_at->diffForHumans()}}</td>
                                  <td>
                                    <a href="{{env('APP_URL')}}admin/message/{{$message->id}}" class="btn btn-primary">VIEW</a>
                                  @if($message->unread==1)
                                    <button type="button" class="btn btn-warning mark-read" data-id="{{$message->id}}">MARK AS READ</button>
                                  @endif
                                    <a href="{{env('APP_URL')}}admin/blacklist_message/{{$message->id}}" class="btn btn-danger" onclick="return confirm('Are You Sure You Want to Backlist This Message?')">BLACKLIST</a>

                                    <a href="{{env('APP_URL')}}admin/delete_message/{{$message->id}}" class="btn btn-danger" onclick="return confirm('Are You Sure You Want to Delete This Message?')">DELETE</a>
                                  </td>
                                </tr>
                              @endforeach
                              </tbody>
                            </table>
                        @endif
                        </div>

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
         // alert(json.status);
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