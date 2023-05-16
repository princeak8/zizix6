@extends('layouts.admin', ['page'=>'clients'])
        
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
                    Clients <a class="btn btn-primary" href="clients/add_client">+</a>
                </h3>
            </div>
            
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="panel-white stats-widget">
                            <div class="panel-body">
                                @include('inc.errors')
                                @if(isset($clients) && $clients->count() > 0)
                                    <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">NAME</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Packages</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $n = 0; ?>
                                        @foreach($clients as $client) <?php $n++; ?>
                                            <tr>
                                                <td class="text-center">{{$n}}</td>
                                                <td class="text-center">{{$client->name}}</td>
                                                <td class="text-center">{{$client->email}}</td>
                                                <td class="text-center">{{$client->packages->count()}}</td>
                                                <td>
                                                  <a class="btn btn-primary" href="clients/view/{{$client->id}}">
                                                        View
                                                    </a>
                                                </td>
                                                <td>
                                                        <button type="submit" name="submit" class="btn btn-xs btn-danger">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p class="text-center h4">There are no clients Yet</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div><!-- Row -->
                        
            </div><!-- Main Wrapper -->

@endsection

@section('js')
    <script type="application/javascript">
    // $(document).ready(function(){

    //     $('.deleteclient').submit(function(e){
    //         // e.preventDefault();
    //         if(confirm('Are you sure, you want to delete this client')) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     })

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
        
    //     $('.active_inactive').click(function(){
            
    //         var button = $(this).find('button');

    //         var span = $(this).find('span');
    //         var client = $(this).data('client');
    //         var status = $(this).data('status');

    //         showLoading(button, span);
    //         var visible  = Number();
    //         status === 1 ? visible = 0 : visible = 1;
    //         $.ajax({
    //             type:'POST',
    //             data: {client_id: client.id, visible: visible},
    //             url:"",
    //             success:function(data) {
                    
    //                 status === 1 ? status = 0 : status = 1;
    //                 if(data !== 'failed') {
    //                     if(status === 1) {
    //                         button.addClass('btn-warning');
    //                         button.html('Make in-active');
    //                         button.removeClass('btn-success')
    //                     } else {
    //                         button.addClass('btn-success');
    //                         button.html('Make active');
    //                         button.removeClass('btn-warning');
    //                     }
    //                 } else {
    //                     alert('Operation was not successful, please reload page and try again')
    //                 }
                    
    //             }
    //         })
    //         .done(function(){ 
    //             button.parent().data('status',visible);
    //             hideLoading(button, span);
    //         });
    //     });

    //     function showLoading(button, span) {
    //         button.hide();
    //         span.css('display','inline');
    //     }
    //     function hideLoading(button, span) {
    //         button.show();
    //         span.css('display','none');
    //     }
    // })
    </script>
@endsection