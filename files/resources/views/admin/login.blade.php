@extends('layouts.adminAuth', ['page'=>'login'])
        
@section('content')
                <!-- Page Inner -->
                <div class="page-inner login-page">
                    <div id="main-wrapper" class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6 col-md-3 login-box">
                                <h4 class="login-title">Sign in to your account</h4>


                                {!! Form::open(['url' => 'admin/login', 'method'=>'post']) !!}
                                @include('inc.admin.errors')
                                    <div class="form-group">
                                        <label for="exampleInputUsername">Email</label>
                                        <input type="text" name="email" class="form-control" id="exampleInputUsername">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    {!! Form::submit('Login', ['class'=>'btn btn-primary']) !!}
                                    <!-- <a href="register.html" class="btn btn-default">Register</a><br>
                                    <a href="index.html" class="forgot-link">Forgot password?</a> -->
                                
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
            </div><!-- /Page Content -->
        </div><!-- /Page Container -->
        
        
        @endsection
   