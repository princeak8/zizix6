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
                <a href="{{url('admin/blacklists')}}" style="color: blue;">Back to Blacklists</a>
                <h3 class="breadcrumb-header">
                    Blacklisted IP: {{$blacklist->IP}}
                </h3>
            </div>
            
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-lg-10 col-md-10">
                        <div class="panel-white stats-widget">
                            <div class="panel-body">
                                 @foreach($blacklist->blacklist_attempts as $attempt)
                                    <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <tbody>
                                            <tr>
                                                <td>PAGE</td>
                                                <td>{{$attempt->page}}</td>
                                            </tr>
                                            <tr>
                                                <td>Attempts</td>
                                                <td>{{$attempt->attempts}}</td>
                                            </tr>
                                            <tr>
                                                <td>Last Attempted On</td>
                                                <td>{{$attempt->updated_at}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div><!-- Row -->
                        
            </div><!-- Main Wrapper -->

@endsection