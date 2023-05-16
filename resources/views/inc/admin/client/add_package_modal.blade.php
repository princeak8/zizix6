<div class="modal fade w-full" id="addPackageModal" tabindex="-1" role="dialog" aria-labelledby="addPackageModalLabel" aria-hidden="true">
    <div class="modal-dialog w-2/3" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="addPackageModalLabel">Add New Package</h5>
            </div>
            <div id="add-package-modal-content" class="modal-body pb-6">
                
                <form @submit.prevent="save()" class="panel-body flex flex-col justify-center">
                    <div class="w-full py-10 flex flex-col self-center">
                        <div>
                            <div class="mb-5 flex flex-col pb-6" style="border-bottom: solid thin #D1D5DB">
                                <p v-cloak v-if="errors.length > 0" class="alert alert-danger">
                                    <span v-for="error in errors">@{{error}}<br/></span>
                                </p>
                                <div>
                                    <p>Package Name @{{name}}</p>
                                    <input type="text" v-model="name" class="form-control" required />
                                </div>
                                <div>
                                    <p>Email</p>
                                    <input type="text" v-model="email" class="form-control" />
                                </div>
                                <div>
                                    <p>Phone Number</p>
                                    <input type="text" v-model="phoneNumber" class="form-control" />
                                </div>
                                <!-- services -->
                                <h2 class="my-2 text-xl font-semibold" style="font-weight: 500px;">Services</h2>
                                <div v-for="(service, serviceIndex) in packageServices" class="w-2/3 ml-2 mb-5 flex flex-col pb-6" style="border-bottom: solid thin #D1D5DB">
                                    <p class="alert alert-danger hidden" :id="`service-error-${serviceIndex}`"></p>
                                    <div>
                                        <p>Service Name</p>
                                        <input type="text" v-model="service.name" class="form-control" />
                                    </div>
                                    <div>
                                        <p>Service</p>
                                        <select v-model="service.service_id" class="form-control">
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
                                    <button type="button" v-if="serviceIndex > 0" class="btn btn-danger w-1/4" @click="removeService(serviceIndex)">Remove</button>
                                </div>
                                <button type="button" class="btn btn-primary w-1/4 self-end" @click="addService()">Add Service</button>
                            </div>
                            
                        </div>
                    </div>
                    
                    <input type="submit" class="btn btn-primary" value="SUBMIT" />
                </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>
    
    <script type="application/javascript">
        // const { ref, onMounted, computed }  = Vue;

        // const { createApp } = Vue

    createApp({
        setup() {
            let name = ref('hello');
            let email = ref('');
            let phoneNumber = ref('');
            let packageServices = ref([
                        {
                            name: "",
                            service_id: "",
                            host: "",
                            expiry: ""
                        }
            ]);
            let services = ref("");
            let errors = ref([]);

            function save() {
                const errorExists = checkError();
                if(!errorExists) {
                    console.log('submit form');
                    let token = $('meta[name="csrf-token"]').attr('content');
                    let client_id = parseInt("{{$client->id}}");
                    let formData = {
                        _token: token, client_id, name: name.value, email: email.value, phone_number: phoneNumber.value, services: packageServices.value
                    }
                    // console.log(formData);
                    let url = "{{env('APP_URL')}}/admin/package/save";
                    axios.post(url, formData)
                    .then(res => {
                        console.log('res:',res.data);
                        if(res.data.statusCode == 200) {
                            window.location.reload();
                        }else{
                            console.log('error', res.data);
                            displayError(res.data);
                        }
                    })
                    .catch(error => {
                        // console.log("error2",error.response.data);
                        displayError(error.response.data);
                    });
                }else{
                    console.log('error exists')
                }
            }

            function checkError() {
                let errorMsg = [];
                let errorExists = false;
                if(name == '') {
                    errorMsg.push('Package Name is required'); 
                    errorExists = true;
                }
                packageServices.value.forEach((service, serviceIndex) => {
                    if(service.name == '') {
                        errorMsg.push('Service Name is required'); 
                        errorExists = true;
                    }
                    if(service.service_id == '') {
                        errorMsg.push('Please Choose a service');
                        errorExists = true;
                    }
                });
                if(errorMsg != '') {
                    errors.value = errorMsg;
                    setTimeout(() => {
                        errors.value = [];
                    }, 5000);
                }
                return errorExists;
            }

            function displayError(data) {
                let errorMsg = [];
                if(data.statusCode == 422) {
                    console.log('data errors', data.errors);
                    const keys = Object.keys(data.errors);
                    keys.forEach((key) => {
                        errorMsg.push(data.errors[key]);
                    });
                }else{
                    errorMsg.push(data.message);
                }
                errors.value = errorMsg;
                setTimeout(() => {
                    errors.value = [];
                }, 5000);
            }

            function addService() {
                packageServices.value.push({
                    name: "",
                    id: "",
                    host: "",
                    expiry: ""
                })
            }

            function removeService(serviceIndex) {
                if(window.confirm('Are you Sure you want to remove this service?')) {
                    packageServices.value.splice(serviceIndex, 1);
                }
            }



            function getServices() {
                console.log("get services");
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
            return { name, email, phoneNumber, services, packageServices, save, removeService, addService, errors }
        
        }
    }).mount('#add-package-modal-content')
    </script>