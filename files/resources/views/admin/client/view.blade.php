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
                    <a href="{{url('admin/clients')}}" class="text-[#4b4bf3]">Clients</a>  >  Client Page
                </h3>
            </div>
            
            <div id="main-wrapper">
                <div id="main-row" class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="panel-white stats-widget">
                            <div class="panel-body w-full">
                                <h2 class="text-xl font-bold my-4">BASIC INFORMATION</h2>
                                
                                <p v-cloak v-if="success != ''" class="alert alert-success">@{{success}}</p>
                                <p v-cloak v-if="error != ''" class="alert alert-danger">@{{error}}</p>

                                <div class="my-6 w-full flex flex-row justify-between">
                                    <div class="flex flex-row w-full">
                                        <b class="text-base font-bold text-gray-600 w-[10%]">Name: </b>
                                        <span v-cloak v-if="edit != 'name'">@{{name}}</span>
                                        <input v-cloak v-if="edit=='name'" type="text" v-model="firstname" class="form-control w-[20%]" />
                                        <input v-cloak v-if="edit=='name'" type="text" v-model="lastname" class="form-control w-[20%]" />
                                    </div>
                                    <div>
                                        <button v-if="edit != 'name'" class="btn btn-primary" @click="setEdit('name')" :disabled="editing">Edit</button>
                                        <button v-cloak v-if="edit=='name'" class="btn btn-success" @click="save()" :disabled="editing">Save</button>
                                    </div>
                                </div>
                                <div class="my-6 w-full flex flex-row justify-between">
                                    <div class="flex flex-row w-full">
                                        <b class="text-base font-bold text-gray-600 w-[10%]">Email: </b>
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
                                        <b class="text-base font-bold text-gray-600 w-[10%]">Phone Number: </b>
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
                                    <h4 class="text-center">
                                        <u>PACKAGES</u>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#addPackageModal">+</button>
                                    </h4>
                                    @if($client->packages->count() == 0)
                                        <p>No package for this client</p>
                                    @else
                                        @foreach($client->packages as $package)
                                            <h4 class="my-8 text-bold">
                                                Package Name: <a href="{{url('admin/package/view/'.$package->id)}}" class="text-[#4b4bf3]">{{$package->name}}</a>
                                            </h4>

                                            <hr/>

                                            <div class="ml-4">
                                                <h4 class="my-3">
                                                    <b>Services</b>
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#serviceModal">+</button>
                                                </h4>
                                                <div class="ml-4">
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
                                            <hr class="h-8 w-full"/>
                                        @endforeach
                                    @endif
                               </div>
                            </div>
                        </div>
                    </div>
                </div><!-- Row -->

                <!-- Add Service Modal -->
                @include('inc.admin.client.add_package_modal', ['client' => $client])
                <!-- @include('inc.admin.client.new_service_modal', ['package' => $package, 'services' => $services]) -->
                        
            </div><!-- Main Wrapper -->

@endsection

@section('js')

<script type="application/javascript">
    
    
    createApp({
        setup() {
            let firstname = ref("{{$client->firstname}}");
            let lastname = ref("{{$client->lastname}}");
            let name = `${firstname.value} ${lastname.value}`;
            let email = ref("{{$client->email}}");
            let phone_number = ref("{{$client->phone_number}}");

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
                    const clientId = parseInt("{{$client->id}}");
                    const token = $('meta[name="csrf-token"]').attr('content');

                    let payload = {_token: token, client_id: clientId};
                    const url = "{{env('APP_URL')}}/admin/clients/update";
                    switch(edit.value) {
                        case 'name' : payload = {...payload, firstname: firstname.value, lastname: lastname.value}; break;
                        case 'email' : payload = {...payload, email: email.value}; break;
                        case 'phone_number' : payload = {...payload, phone_number: phone_number.value}; break;
                    }
                    console.log("payload:", payload);
                    axios.patch(url, payload)
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

            return { firstname, lastname, name, email, phone_number, edit, setEdit, editing, success, error, save };
        }
    }).mount('#main-row');

</script>

@endsection