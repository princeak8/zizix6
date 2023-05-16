@extends('layouts.admin', ['page'=>'services'])
        
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
                    Services <button class="btn btn-primary mt-4" data-toggle="modal" data-target="#createServiceModal">+</button>
                </h3>
            </div>
            
            <div id="main-wrapper">
                <!-- <p v-cloak>@{{message}}</p> -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="panel-white stats-widget">
                        <div class="panel-body">
                                <p id="message" class="alert d-none"></p>
                                @if(isset($services) && $services->count() > 0)
                                    <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>NAME</th>
                                                <th>DESCRIPTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $n = 0; ?>
                                        @foreach($services as $service) <?php $n++; ?>
                                            <tr id="service-{{$service->id}}">
                                                <td>{{$n}}</td>
                                                <td>{{$service->name}}</td>
                                                <td>{{$service->description}}</td>
                                                <td class="flex flex-row">
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#editServiceModal-{{$service->id}}">
                                                        Edit
                                                    </button>
                                                    <!-- {!! Form::open(['route' => ['adminServices.destroy', $service->id], 'class' => 'deleteOrder', 'method'=>'delete']) !!} -->
                                                        <button name="submit" class="btn btn-danger" @click="deleteService({{$service->id}})">Delete</button>
                                                    <!-- {!! Form::close() !!} -->
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p class="text-center h4">There are no Services Yet</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div><!-- Row -->
                        
            </div><!-- Main Wrapper -->

            <!-- Update Service Modal -->
    @if(isset($services) && $services->count() > 0)
        @foreach($services as $service)
            <div class="modal fade" id="editServiceModal-{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="editServiceModal-{{$service->id}}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header flex flex-row">
                            <h5 class="modal-title" style="width:50%; display:inline">Edit Service</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['url' => ['admin/services/update'], 'method'=>'patch']) !!}
                                <div>
                                    <input type="text" placeholder="name of service" name="name" class="form-control" value="{{$service->name}}" required />
                                </div>
                                <div class="mt-4" style="margin-top:1rem">
                                    <textarea name="description" class="form-control" placeholder="description of service">{{$service->description}}</textarea>
                                </div>
                                <div class="mt-4">
                                    <input type="checkbox" name="expiry" value="1" @if($service->expiry==1) checked @endif />Expiry Service?
                                </div>
                                <div class="mt-2" style="margin-top:1rem;">
                                    <input type="submit" value="UPDATE" class="btn btn-primary" />
                                </div> 
                                <input type="hidden" name="service_id" value="{{$service->id}}" />   
                            </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

<!-- Create Service Modal -->
    <div class="modal fade" id="createServiceModal" tabindex="-1" role="dialog" aria-labelledby="createServiceModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header flex flex-row">
                    <h5 class="modal-title" style="width:50%; display:inline">Create a new Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => ['admin/services/save'], 'method'=>'post']) !!}
                        <div>
                            <input type="text" placeholder="name of service" name="name" class="form-control" required />
                        </div>
                        <div class="mt-4" style="margin-top:1rem">
                            <textarea name="description" class="form-control" placeholder="description of service"></textarea>
                        </div>
                        <div class="mt-4">
                            <input type="checkbox" name="expiry" value="1" />Expiry Service?
                        </div>
                        <div class="mt-2" style="margin-top:1rem; margin-bottom:1rem">
                            <input type="submit" value="SUBMIT" class="btn btn-primary" />
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        const { ref }  = Vue;

        const { createApp } = Vue

        createApp({
            setup() {
                let message = ref('Hello Vue!');
                function deleteService(id) {
                    if(window.confirm('Are you sure you want to delete this service?')) {
                        // console.log('here'+id);
                        let url = "{{env('APP_URL')}}/admin/services/delete/"+id;
                        // console.log('#service-'+id);
                        $('#service-'+id).remove();
                        axios.delete(url)
                        .then(res => {
                            console.log('res:',res.data);
                            if(res.data.statusCode == 200) {
                                $('#service-'+id).remove();
                                displayMessage("Service deleted successfuly");
                            }else{
                                console.log('error', res.data.message);
                                displayMessage("Oops! error occured while attempting to delete service", false);
                            }
                        })
                        .catch(error => {
                            console.log("error",error.message);
                            displayMessage('An error occured, could not delete service', false);
                            
                        });

                    }
                }
                function displayMessage(message, success=true) {
                    (success) ? $('#message').addClass('alert-success') : $('#message').addClass('alert-danger');
                    $('#message').html(message);
                    setTimeout(() => {
                        (success) ? $('#message').removeClass('alert-success'): $('#message').removeClass('alert-danger');
                        $('#message').html('');
                    }, 5000)
                }
                return { message, deleteService }
            }
        }).mount('#main-wrapper')
    </script>
    <script type="application/javascript">
        $('.deleteOrder').submit(function(e){
            // e.preventDefault();
            if(confirm('Are you sure, you want to delete this order')) {
                return true;
            } else {
                return false;
            }
        })
    </script>
@endsection