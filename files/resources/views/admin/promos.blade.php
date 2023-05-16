@extends('layouts.admin', ['page'=>'promos'])
        
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
                    Promotions
                    <button class="btn btn-sm btn-primary" data-open="0" id="add-button"><i class="fa fa-plus"></i> Add New</button>
        
                    <div id="add-form" style="min-height: 90px; display: none;"> 
                        {!! Form::open(['route' => 'promos.store', 'method'=>'post']) !!}

                            <div class="form-group">
                                <div class="col-sm-6">
                                    {!! Form::label('name', 'Name *') !!}
                                    {!! Form::text('name', null, ['placeholder'=>'Name', 'class'=>'form-control', 'required']) !!}
                                </div>
                                <div class="col-sm-6">
                                    {!! Form::label('discount', 'Discount') !!}
                                    {!! Form::number('discount', null, ['placeholder'=>'Discount', 'class'=>'form-control']) !!}
                                </div>
                                <div class="col-sm-6">
                                    {!! Form::label('duration', 'Duration') !!}
                                    {!! Form::number('duration', null, ['placeholder'=>'Duration', 'class'=>'form-control']) !!}
                                </div>
                                <div class="col-sm-6">
                                    {!! Form::label('description', 'Description *') !!}
                                    <textarea name="description" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6 col-sm-offset-3" style="margin-top: 10px;">
                                {!! Form::submit('Submit', ['class'=>'btn btn-primary form-control']) !!}
                            </div>

                        {!! Form::close() !!}
                    </div>
                </h3>
            </div>
            
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="panel-white stats-widget">
                            <div class="panel-body">
                                @if(count($promos) !== 0)
                                    <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th style="text-align: center;">NAME</th>
                                                <th style="text-align: center;">CREATED AT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $n = 0; ?>
                                        @foreach($promos as $promo) <?php $n++; ?>
                                            <tr>
                                                <td>{{$n}}</td>
                                                <td style="text-align: center;">{{$promo->name}}</td>
                                                <td style="text-align: center;">{{$promo->created_at}}</td>
                                                <td>
                                                  <a class="btn btn-primary" href="{{ route('promos.show', $promo->id) }}">
                                                        View
                                                    </a>
                                                    {!! Form::open(['route' => ['promos.destroy', $promo->id], 'class' => 'deletepromo', 'method'=>'delete']) !!}
                                                        <button type="submit" name="submit" class="btn btn-xs btn-danger">Delete</button>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p class="text-center h4">There are no promotions Yet</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div><!-- Row -->
                        
            </div><!-- Main Wrapper -->

@endsection

@section('js')
    <script type="application/javascript">
        $('#add-button').click(function(e) {
            var open = $(this).data('open');
            if(open==0) {
                $('#add-form').css('display', 'block');
                $(this).data('open', '1');
                $(this).html('CLOSE');
            }else{
                $('#add-form').css('display', 'none');
                $(this).data('open', '0');
                $(this).html('<i class="fa fa-plus"></i> Add New');
            }
        })
        
        $('.deletepromo').submit(function(e){
            // e.preventDefault();
            if(confirm('Are you sure, you want to delete this promo')) {
                return true;
            } else {
                return false;
            }
        })
    </script>
@endsection