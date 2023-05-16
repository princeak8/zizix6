@extends('layouts.admin', ['page'=>'client'])

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
                    <a href="{{url('admin/clients/view/'.$package->client->id)}}" class="text-[#4b4bf3]">{{$package->client->name}}</a>
                    > 
                    Client Package
                </h3>
            </div>

            <div id="main-wrapper">
                <div id="main-content" class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="panel-white stats-widget">
                            <div class="panel-body w-full">
                                
                                <p v-cloak v-if="success != ''" class="alert alert-success">@{{success}}</p>
                                <p v-cloak v-if="error != ''" class="alert alert-danger">@{{error}}</p>
                                
                                <div class="my-6">
                                    <h3 class="flex flex-row">
                                        <b class="text-base font-semibold text-gray-600 w-[10%]">Client: </b>
                                        <span>{{$package->client->name}}</span>
                                    </h3>
                                </div>

                                <div class="my-6 w-full flex flex-row justify-between">
                                    <div class="flex flex-row w-full">
                                            <b class="text-base font-semibold text-gray-600 w-[10%]">Name: </b>
                                            <span v-cloak v-if="edit != 'name'">@{{name}}</span>
                                            <input v-cloak v-if="edit=='name'" type="text" v-model="name" class="form-control w-[20%]" />
                                    </div>
                                    <div>
                                        <button v-if="edit != 'name'" class="btn btn-primary" @click="setEdit('name')" :disabled="editing">Edit</button>
                                        <button v-cloak v-if="edit=='name'" class="btn btn-success" @click="save()" :disabled="editing">Save</button>
                                    </div>
                                </div>

                                <div class="my-6 w-full flex flex-row justify-between">
                                    <div class="flex flex-row w-full">
                                        <b class="text-base font-semibold text-gray-600 w-[10%]">Email: </b>
                                        <span v-cloak v-if="edit != 'email'">@{{email}}</span>
                                        <input v-cloak v-if="edit=='email'" type="text" v-model="email" class="form-control w-[20%]" />
                                    </div>
                                    <div>
                                        <button v-if="edit != 'email'" class="btn btn-primary" @click="setEdit('email')" :disabled="editing">Edit</button>
                                        <button v-cloak v-if="edit=='email'" class="btn btn-success" @click="save()" :disabled="editing">Save</button>
                                    </div>
                                </div>

                                <div class="my-6 w-full flex flex-row justify-between">
                                    <div class="flex flex-row w-full">
                                        <b class="text-base font-semibold text-gray-600 w-[10%]">Phone Number: </b>
                                        <span v-cloak v-if="edit != 'phone_number'">@{{phone_number}}</span>
                                        <input v-cloak v-if="edit=='phone_number'" type="text" v-model="phone_number" class="form-control w-[20%]" />
                                    </div>
                                    <div>
                                        <button v-if="edit != 'phone_number'" class="btn btn-primary" @click="setEdit('phone_number')" :disabled="editing">Edit</button>
                                        <button v-cloak v-if="edit=='phone_number'" class="btn btn-success" @click="save()" :disabled="editing">Save</button>
                                    </div>
                                </div>

                                <hr/>
                                <div class="mt-4">
                                    <h2 class="text-xl font-bold my-4">
                                        SERVICES
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#serviceModal">+</button>
                                    </h2>
                                    @if($package->services->count() == 0)
                                        <p>There are no services in this package yet</p>
                                    @else
                                        <table class="table">
                                            <thead>
                                                <th>NAME</th>
                                                <th>EXPIRATION</th>
                                                <th>status</th>
                                                <th>LAST CORRESPONDENCE</th>
                                                <th>ACTION</th>
                                            </thead>
                                            <tbody>
                                                @foreach($package->services as $clientService)
                                                    <tr>
                                                        <td>
                                                            {{$clientService->service->name}}
                                                            @if($clientService->name != "")
                                                                - {{$clientService->name}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($clientService->expiry_date == "")
                                                                -
                                                            @else
                                                                {{$clientService->expiry_date}}
                                                            @endif
                                                        </td>
                                                        <td><span class="alert alert-success">ACTIVE</span></td>
                                                        <td>-</td>
                                                        <td>
                                                            <a href="{{url('admin/package_service/view/'.$clientService->id)}}" class="btn btn-primary">View</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        
                                    @endif
                               </div>

                            </div>
                        </div>
                    </div>
                </div><!-- Row -->

                <!-- Add Service Modal -->
                @include('inc.admin.client.new_service_modal', ['package' => $package, 'services' => $services])
                
                        
            </div><!-- Main Wrapper -->


            @endsection

@section('js')

<script type="application/javascript">
    
    
    createApp({
        setup() {
            let name = ref('{{$package->name}}');
            let email = ref('{{$package->email}}');
            let phone_number = ref('{{$package->phone_number}}');

            let edit = ref('');
            let success = ref('');
            let error = ref('');
            let editing = ref(false);
            

            function setEdit(val)
            {
                edit.value = val;
            }

            function save()
            {
                try{
                    editing.value = true;
                    const packageId = parseInt("{{$package->id}}");
                    const token = $('meta[name="csrf-token"]').attr('content');

                    let payload = {_token: token, package_id: packageId};
                    const url = "{{env('APP_URL')}}/admin/package/update";
                    switch(edit.value) {
                        case 'name' : payload = {...payload, name: name.value}; break;
                        case 'email' : payload = {...payload, email: email.value}; break;
                        case 'phone_number' : payload = {...payload, phone_number: phone_number.value}; break;
                    }
                    console.log("payload:", payload);
                    axios.post(url, payload)
                    .then(res => {
                        console.log('res:',res);
                        if(res.data.statusCode == 200) {
                            displaySuccess("Updated Successfully");
                            setEdit('');
                        }else{
                            console.log('error', res.data);
                            displayError(res.data);
                        }
                    })
                    .catch(error => {
                        // console.log("error2",error.response.data);
                        displayError(error.response.data);
                    });
                }catch(err) {
                    console.log("caught Error:", err);
                }
                editing.value = false;
            }

            function displaySuccess(message) {
                success.value = message;
                setTimeout(() => {
                    success.value = '';
                }, 5000);
            }

            function displayError(data) {
                let errorMsg = '';
                if(data.statusCode == 422) {
                    console.log('data errors', data.errors);
                    const keys = Object.keys(data.errors);
                    keys.forEach((key) => {
                        errorMsg += data.errors[key]+'<br/>';
                    });
                }else{
                    errorMsg = data.message;
                }
                error.value = errorMsg;
                setTimeout(() => {
                    error.value = '';
                }, 5000);
            }

            onMounted(() => {
                console.log("mounted");
            })

            return { name, email, phone_number, edit, setEdit, editing, success, error, save };
        }
    }).mount('#main-content');
</script>

@endsection