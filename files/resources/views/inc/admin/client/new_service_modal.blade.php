<div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title" id="serviceModalLabel">Add {{$package->name}} Package Service</h5>
        </div>
        <div id="modal-content" class="modal-body pb-6">
            
            <form @submit.prevent="save()" class="panel-body flex flex-col justify-center">
                <p class="alert alert-danger hidden" id="error"></p>
                <div>
                    <p>Service Name</p>
                    <input type="text" v-model="name" class="form-control" />
                </div>
                <div class="my-3">
                    <p>Service</p>
                    <select v-model="serviceId" class="form-control">
                        <option value="">SELECT SERVICE</option>
                        @foreach($services as $service)
                            <option value="{{$service->id}}">{{$service->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="my-3">
                    <p>Expiry Date:</p>
                    <input type="date" v-model="expiry" class="form-control" />
                </div>
                <div class="my-3">
                    <p>Host:</p>
                    <input type="text" v-model="host" class="form-control" />
                </div>
                <input type="hidden" id="packageId" value="{{$package->id}}" />
                
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
            let name = ref('');
            let serviceId = ref('');
            let expiry = ref('');
            let host = ref('');

            function save() {
                const errorExists = checkError();
                if(!errorExists) {
                    console.log('submit form');
                    var token = $('meta[name="csrf-token"]').attr('content');
                    var package_id = $('#packageId').value;
                    let formData = {
                        _token: token, name: name.value, service_id: serviceId.value, package_id: packageId.value, expiry_date: expiry.value, host: host.value
                    }
                    console.log(formData);
                    let url = "{{env('APP_URL')}}/admin/package_service/save";
                    axios.post(url, formData)
                    .then(res => {
                        console.log('res:',res);
                        if(res.data.statusCode == 200) {
                            window.location.reload();
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

            function checkError() {
                let errorExists = false;
                let error = '';
                
                if(serviceId == '') {
                    error += 'Please Choose a service<br/>';
                    errorExists = true;
                }
                console.log('error', error);
                console.log('service id:', serviceId);

                if(error != '') {
                    $('#error').removeClass('hidden');
                    $('#error').html(error);
                    setTimeout(() => {
                        $('#error').html('');
                        $('#error').addClass('hidden');
                    }, 5000);
                }
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
                    $('#error').removeClass('hidden');
                    $('#error').html(error);
                    setTimeout(() => {
                        $('#error').html('');
                        $('#error').addClass('hidden');
                    }, 9000);
                }else{
                    $('#error').removeClass('hidden');
                    $('#error').html(data.message);
                    setTimeout(() => {
                        $('#error').html('');
                        $('#error').addClass('hidden');
                    }, 5000);
                }
            }

            onMounted(() => {
                console.log("mounted")
            })
            return { name, save, serviceId, expiry, host }
        }
    }).mount('#modal-content')
    </script>