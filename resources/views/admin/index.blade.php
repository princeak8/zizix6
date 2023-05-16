@extends('layouts.admin', ['page'=>'home'])
        
@section('content')
            
            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="search-form">
                        <form action="#" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control search-input" placeholder="Type something...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" id="close-search" type="button"><i class="icon-close"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>
                    @include('inc.admin.navbar')
                </div><!-- /Page Header -->
                <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Dashboard</h3>
                    </div>
                    <div id="main-wrapper">
                        <div class="row">
                            <div class="col-lg-2 col-md-4">
                                <div class="panel panel-white stats-widget">
                                    <a href="{{ url('admin/services') }}">
                                        <div class="panel-body">
                                            <div class="pull-left">
                                                <span class="stats-number"></span>
                                                <p class="stats-info">Services</p>
                                            </div>
                                            <!-- <div class="pull-right">
                                                <i class="icon-arrow_upward stats-icon"></i>
                                            </div> -->
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <div class="panel panel-white stats-widget">
                                    <a href="{{ url('admin/clients') }}">
                                        <div class="panel-body">
                                            <div class="pull-left">
                                                <span class="stats-number">0</span>
                                                <p class="stats-info">Clients</p>
                                            </div>
                                            <!-- <div class="pull-right">
                                                <i class="icon-arrow_downward stats-icon"></i>
                                            </div> -->
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <div class="panel panel-white stats-widget">
                                    <a href="{{url('admin/messages/')}}">
                                        <div class="panel-body">
                                            <div class="pull-left">
                                                <span class="stats-number">0</span>
                                                <p class="stats-info">Contact Messages</p>
                                            </div>
                                            <!-- <div class="pull-right">
                                                <i class="icon-arrow_upward stats-icon"></i>
                                            </div> -->
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <div class="panel panel-white stats-widget">
                                    <a href="{{ url('admin/promos') }}">
                                        <div class="panel-body">
                                            <div class="pull-left">
                                                <span class="stats-number">0</span>
                                                <p class="stats-info">Expiry Services</p>
                                            </div>
                                            <!-- <div class="pull-right">
                                                <i class="icon-arrow_upward stats-icon"></i>
                                            </div> -->
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <div class="panel panel-white stats-widget">
                                    <a href="{{url('admin/blacklists/')}}">
                                        <div class="panel-body">
                                            <div class="pull-left">
                                                <span class="stats-number">0</span>
                                                <p class="stats-info">Blacklists</p>
                                            </div>
                                            <!-- <div class="pull-right">
                                                <i class="icon-arrow_upward stats-icon"></i>
                                            </div> -->
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div><!-- Row -->
                        
                    </div><!-- Main Wrapper -->

@endsection