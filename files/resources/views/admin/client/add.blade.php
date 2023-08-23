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
                    Add a New Client
                </h3>
            </div>
            
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="panel-white stats-widget">
                            <form @submit.prevent="save()" class="panel-body flex flex-col justify-center">
                                <p class="alert alert-danger hidden" id="submit-error"></p>
                                <!-- Client Info -->
                                <div class="w-2/3 py-10 flex flex-col self-center">
                                    <h2 class="my-2 text-xl font-semibold" style="font-weight: 500px;">Add Client Information</h2>
                                    <!-- name Field -->
                                    <div class="mb-5 mt-4 flex flex-row w-2/3">
                                        <div class="mr-2">
                                            <p>Firstname</p>
                                            <input type="text" name="firstname" class="form-control" v-model="firstname" required />
                                        </div>
                                        <div>
                                            <p>Lastname</p>
                                            <input type="text" name="lastname" class="form-control" v-model="lastname" />
                                        </div>
                                    </div>
                                    <!-- email field -->
                                    <div class="mb-5 w-2/3">
                                        <p>Email</p>
                                        <input type="email" name="email" class="form-control" v-model="email" required />
                                    </div>
                                    <!-- phone number field -->
                                    <div class="mb-5 w-2/3">
                                        <p>Phone Number</p>
                                        <input type="text" name="phone_number" class="form-control" v-model="phoneNumber" required />
                                    </div>
                                </div>

                                <!-- client Packages -->
                                <div class="w-2/3 py-10 flex flex-col self-center">
                                    <div v-if="packages.length > 0">
                                        <div v-for="(package, i) in packages" class="mb-5 flex flex-col pb-6" style="border-bottom: solid thin #D1D5DB">
                                            <p class="alert alert-danger hidden" :id="`package-error-${i}`"></p>
                                            <div>
                                                <p>Package Name</p>
                                                <input type="text" v-model="package.name" class="form-control" />
                                            </div>
                                            <div>
                                                <p>Email</p>
                                                <input type="text" v-model="package.email" class="form-control" />
                                            </div>
                                            <div>
                                                <p>Phone Number</p>
                                                <input type="text" v-model="package.phoneNumber" class="form-control" />
                                            </div>
                                            <!-- services -->
                                            <h2 class="my-2 text-xl font-semibold" style="font-weight: 500px;">Services</h2>
                                            <div v-for="(service, serviceIndex) in package.services" class="w-2/3 ml-2 mb-5 flex flex-col pb-6" style="border-bottom: solid thin #D1D5DB">
                                                <p class="alert alert-danger hidden" :id="`service-error-${serviceIndex}`"></p>
                                                <div>
                                                    <p>Service Name</p>
                                                    <input type="text" v-model="service.name" class="form-control" />
                                                </div>
                                                <div>
                                                    <p>Service</p>
                                                    <select v-model="service.id" class="form-control">
                                                        <option value="">SELECT SERVICE</option>
                                                        <option v-for="serv in services" :value="serv.id">@{{serv.name}}</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <p>Host:</p>
                                                    <input type="text" v-model="service.host" class="form-control" />
                                                </div>
                                                <div>
                                                    <p>Expiry Date:</p>
                                                    <input type="date" v-model="service.expiry" class="form-control" />
                                                </div>
                                                <button v-if="serviceIndex > 0" class="btn btn-danger w-1/4" @click="removeService(i, serviceIndex)">Remove</button>
                                            </div>
                                            <button class="btn btn-primary w-1/4 self-end" @click="addService(i)">Add Service</button>
                                            <button v-if="i > 0" class="btn btn-danger w-1/4" @click="removePackage(i)">Remove Package</button>
                                        </div>
                                        
                                    </div>
                                    <button class="btn btn-primary w-1/2" @click="addPackage()">Add Package</button>
                                </div>

                                <input type="submit" class="btn btn-success" value="SAVE" />
                            </div>
                        </div>
                    </div>
                </div><!-- Row -->
                        
            </div><!-- Main Wrapper -->

@endsection

@section('js')
    <script type="application/javascript">
    //     const { ref, onMounted, computed }  = Vue;

    // const { createApp } = Vue

    createApp({
        setup() {
            let firstname = ref('');
            let lastname = ref('');
            let email = ref('');
            let phoneNumber = ref('');
            let packages = ref([
                {
                    name: "UniqSeed",
                    email: "",
                    phoneNumber: "",
                    expiry: "",
                    services: []
                }
            ]);
            let services = ref('');

            function save() {
                setProjectExpiry();
                const errorExists = checkError();
                if(!errorExists) {
                    console.log('submit form');
                    var token = $('meta[name="csrf-token"]').attr('content');
                    let formData = {
                        _token: token, firstname: firstname.value, lastname: lastname.value, email: email.value, phone_number: phoneNumber.value, packages: packages.value
                    }
                    console.log(formData);
                    let url = "{{env('APP_URL')}}/admin/clients/save";
                    axios.post(url, formData)
                    .then(res => {
                        console.log('res:',res.data);
                        if(res.data.statusCode == 200) {
                            window.location.href = "{{env('APP_URL')}}/admin/clients";
                        }else{
                            console.log('error', res.data);
                            displaySubmitError(res.data);
                        }
                    })
                    .catch(error => {
                        // console.log("error2",error.response.data);
                        displaySubmitError(error.response.data);
                    });
                }else{
                    console.log('error exists')
                }
            }

            function setProjectExpiry() {
                let packagesData = packages.value
                packagesData.forEach((package) => {
                    let expiryArr = [];
                    package.services.forEach((service) => {
                        if(service.expiry != "") expiryArr.push(new Date(service.expiry));
                    });
                    console.log(expiryArr);
                    if(expiryArr.length > 0) {
                        let dateFormat = new Date(Math.min.apply(null, expiryArr));
                        package.expiry = dateFormat.getFullYear()+'-'+(dateFormat.getMonth()+1)+'-'+dateFormat.getDate();
                    }
                })
            }

            function checkError() {
                let packagesData = packages.value
                let errorExists = false;
                packagesData.forEach((package, packageIndex) => {
                    let packageError = '';
                    if(package.name == '') {
                        packageError = 'Package Name is required<br/>'; 
                        errorExists = true;
                    }
                    if(packageError != '') {
                        $('#package-error-'+packageIndex).removeClass('hidden');
                        $('#package-error-'+packageIndex).html(packageError);
                        setTimeout(() => {
                            $('#package-error-'+packageIndex).html('');
                            $('#package-error-'+packageIndex).addClass('hidden');
                        }, 5000);
                    }
                    package.services.forEach((service, serviceIndex) => {
                        let serviceError = '';
                        if(service.name == '') {
                            serviceError = 'Name is required<br/>'; 
                            errorExists = true;
                        }
                        if(service.id == '') {
                            serviceError += 'Please Choose a service<br/>';
                            errorExists = true;
                        }
                        console.log('error', serviceError);
                        console.log('service id:', service.id);
                        if(serviceError != '') {
                            $('#service-error-'+serviceIndex).removeClass('hidden');
                            $('#service-error-'+serviceIndex).html(serviceError);
                            setTimeout(() => {
                                $('#service-error-'+serviceIndex).html('');
                                $('#service-error-'+serviceIndex).addClass('hidden');
                            }, 5000);
                        }
                    });
                })
                return errorExists;
            }

            function displaySubmitError(data) {
                let error = '';
                if(data.statusCode == 422) {
                    console.log('data errors', data.errors);
                    const keys = Object.keys(data.errors);
                    keys.forEach((key) => {
                        error += data.errors[key]+'<br/>';
                    });
                    $('#submit-error').removeClass('hidden');
                    $('#submit-error').html(error);
                    setTimeout(() => {
                        $('#submit-error').html('');
                        $('#submit-error').addClass('hidden');
                    }, 9000);
                }else{
                    $('#submit-error').removeClass('hidden');
                    $('#submit-error').html(data.message);
                    setTimeout(() => {
                        $('#submit-error').html('');
                        $('#submit-error').addClass('hidden');
                    }, 5000);
                }
            }

            function addPackage() {
                packages.value.push(
                    {
                        name: "",
                        services: [
                            {
                                name: "",
                                id: "",
                                host: "",
                                expiry: ""
                            }
                        ]
                    }
                )
            }

            function removePackage(index) {
                if(window.confirm('Are you Sure you want to remove this package?')) {
                    packages.value.splice(index, 1);
                }
            }

            function addService(index) {
                // console.log(packages.value[index]);
                packages.value[index].services.push({
                    name: "",
                    id: "",
                    host: "",
                    expiry: ""
                })
            }

            function removeService(packageIndex, serviceIndex) {
                if(window.confirm('Are you Sure you want to remove this service?')) {
                    packages.value[packageIndex].services.splice(serviceIndex, 1);
                }
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
                getServices();
            })
            return { firstname, lastname, email, phoneNumber, packages, services, addPackage, removePackage, addService, removeService, save }
        }
    }).mount('#main-wrapper')
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