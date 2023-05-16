@extends('layouts.admin', ['page'=>'blacklists'])
        
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
                    Blacklists
                </h3>
            </div>
            
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-lg-10 col-md-10">
                        <div class="panel-white stats-widget">
                            <div class="panel-body">
                                    <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>IP Address</th>
                                                <th>Attempts</th>
                                                <th>blacklisted On</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $n = 0; ?>
                                        @foreach($blacklists as $blacklist) <?php $n++; ?>
                                            <tr>
                                                <td>{{$n}}</td>
                                                <td style="text-align: center;">{{$blacklist->IP}}</td>
                                                <td>{{$blacklist->attempts()}}</td>
                                                <td>{{$blacklist->created_at}}</td>
                                                <td>
                                                   <a class="btn btn-primary" href="{{url('admin/blacklist/'.$blacklist->id)}}">
                                                        View
                                                    </a>
                                                    <a class="btn btn-danger" href="{{url('admin/delete_blacklist/'.$blacklist->id)}}" onclick="return confirm('Are you sure that you want to Delete this Blacklist?')">   Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div><!-- Row -->
                        
            </div><!-- Main Wrapper -->

@endsection