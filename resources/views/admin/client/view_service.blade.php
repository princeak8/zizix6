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
                    <a href="{{url('admin/clients/view/'.$clientService->client->id)}}" class="text-[#4b4bf3]">{{$clientService->client->name}}</a>
                    >
                    Client Service
                </h3>
            </div>
            
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="panel-white stats-widget">
                            <div class="panel-body px-12">

                                <p v-cloak v-if="success != ''" class="alert alert-success">@{{success}}</p>
                                <p v-cloak v-if="error != ''" class="alert alert-danger">@{{error}}</p>

                               <div class="my-6 w-full flex flex-row justify-between">
                                    <div class="flex flex-row w-full">
                                        <p class="text-2xl font-semibold w-[20%]">Name: </p>
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
                                        <p class="text-2xl font-semibold w-[20%]">Service: </p>
                                        <span v-cloak v-if="edit != 'service'">@{{service.name}}</span>
                                        <select v-cloak v-if="edit=='service'" v-model="service" class="form-control w-[20%]">
                                            <option value="">SELECT SERVICE</option>
                                            <option v-for="serv in services" :value="serv">@{{serv.name}}</option>
                                        </select>
                                    </div>
                                    <div>
                                        <button v-if="edit != 'service'" class="btn btn-primary" @click="setEdit('service')" :disabled="editing">Edit</button>
                                        <button v-cloak v-if="edit=='service'" class="btn btn-success" @click="save()" :disabled="editing">Save</button>
                                    </div>
                                </div>


                                <div class="my-6 w-full flex flex-row justify-between">
                                    <div class="flex flex-row w-full">
                                        <p class="text-2xl font-semibold w-[20%]">Expiry Date:</p>
                                        <span v-cloak v-if="edit != 'expiry'">@{{(expiry || expiry != "") ? expiry : "NIL"}}</span>
                                        <input v-cloak v-if="edit=='expiry'" type="date" v-model="expiry" class="form-control w-[20%] mr-[5%]" />
                                        <div v-cloak v-if="edit=='expiry'">
                                            <input type="checkbox" v-model="no_expiry" :checked="no_expiry" @click="toggle_no_expiry()" />
                                            No Expiry
                                        </div>
                                    </div>
                                    <div>
                                        <button v-if="edit != 'expiry'" class="btn btn-primary" @click="setEdit('expiry')" :disabled="editing">Edit</button>
                                        <button v-cloak v-if="edit=='expiry'" class="btn btn-success" @click="save()" :disabled="editing">Save</button>
                                    </div>
                                </div>


                                <div class="my-6 w-full flex flex-row justify-between">
                                    <div class="flex flex-row w-full">
                                        <p class="text-2xl font-semibold w-[20%]">Host: </p>
                                        <span v-cloak v-if="edit != 'host'">@{{(host || host != "") ? host : "NIL"}}</span>
                                        <input v-cloak v-if="edit=='host'" type="text" v-model="host" class="form-control w-[20%]" />
                                    </div>
                                    <div>
                                        <button v-if="edit != 'host'" class="btn btn-primary" @click="setEdit('host')" :disabled="editing">Edit</button>
                                        <button v-cloak v-if="edit=='host'" class="btn btn-success" @click="save()" :disabled="editing">Save</button>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div><!-- Row -->
                        
            </div><!-- Main Wrapper -->

@endsection

@section('js')

<script type="application/javascript">
    // const { createApp, ref, onMounted, computed }  = Vue;

    createApp({
        setup() {
            let name = ref('{{$clientService->name}}');
            let expiry = ref('{{$clientService->expiry_date}}');
            let no_expiry = ref(false);
            let host = ref('{{$clientService->host}}');
            let services = ref('');
            let service = ref({
                id: '{{$clientService->service->id}}',
                name: '{{$clientService->service->name}}',
            });

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
                    const packageServiceId = parseInt("{{$clientService->id}}");
                    const token = $('meta[name="csrf-token"]').attr('content');

                    let payload = {_token: token, package_service_id: packageServiceId};
                    const url = "{{env('APP_URL')}}/admin/package_service/update";
                    switch(edit.value) {
                        case 'name' : payload = {...payload, name: name.value}; break;
                        case 'expiry' : payload = {...payload, expiry_date: expiry.value}; break;
                        case 'host' : payload = {...payload, host: host.value}; break;
                        case 'service' : payload = {...payload, service_id: service.value.id}; break;
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

            function toggle_no_expiry()
            {
                no_expiry.value = !no_expiry.value;
                if(no_expiry.value) {
                    expiry.value = null;
                }
            }

            // check whether there is an expiry date
            function check_for_expiry_date()
            {
                if(expiry.value && expiry.value != "") {
                    no_expiry.value = false;
                }else{
                    no_expiry.value = true;
                }
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

            function getServices() {
                let url = "{{env('APP_URL')}}/api/services/all";
                axios.get(url)
                .then(res => {
                    console.log('res:',res.data);
                    if(res.data.statusCode == 200) {
                        services.value = res.data.data;
                    }else{
                        console.log('error', res.data.message);
                    }
                })
                .catch(error => {
                    console.log("error",error.message);
                    
                });
            }

            onMounted(() => {
                console.log("mounted");
                console.log("service", service.value);
                getServices();
                check_for_expiry_date();
            })

            return { name, expiry, host, service, services, edit, setEdit, editing, success, error, save, toggle_no_expiry };
        }
    }).mount('#main-wrapper');
</script>

@endsection