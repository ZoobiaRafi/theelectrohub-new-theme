@extends('/layouts/master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/vendors.min.css')}}">
@stop

@section('title')
    <title>Profile Update</title>
@stop
@section('body')
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row"></div>
    <div class="content-body">
        <div class="card">
            <div class="card-body">
                <form @keyup.enter="submit">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-12 mb-1">
                            <div class="alert alert-success" v-if = "successAlert" role="alert"><p class="alert-body alert-body-success">@{{successMessage}}</p></div>
                            <div class="alert alert-warning" v-if = "warningAlert" role="alert"><p class="alert-body alert-body-warning">@{{warningMessage}}</p></div>
                        </div>
                        <div class="col-xl-12 col-md-12 col-12 mb-1">
                            <div class="form-group">
                                <label for="name">User name</label>
                                <input type="text" class="form-control" v-model="username" readonly placeholder="Enter User Name">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12 col-12 mb-1">
                            <div class="form-group">
                                <label for="number">Name</label>
                                <input type="text" class="form-control" v-model="name" placeholder="Enter Name" value="{{$user->name}}">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12 col-12 mb-1">
                            <div class="form-group">
                                <label for="number">Email</label>
                                <input @blur="checkEmail" :class="{ 'is-valid': isValid, 'is-invalid': isInvalid }" type="text" class="form-control" v-model="email" placeholder="Enter Email" value="{{$user->email}}">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12 col-12 mb-1">
                            <div class="form-group">
                                <label for="number">Contact Number</label>
                                <input @blur="checkPhone" :class="{ 'is-valid': isValid, 'is-invalid': isInvalid }" type="text" class="form-control" v-model="number" placeholder="Enter Number" value="{{$user->contact_no}}">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12 col-12 mb-1">
                            <div class="form-group">
                                <label for="number">Existing Password</label>
                                <input type="password" class="form-control" v-model="currpassword" placeholder="Enter Existing Password">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12 col-12 mb-1">
                            <div class="form-group">
                                <label for="number">Password</label>
                                <input type="password" class="form-control" v-model="password" placeholder="Enter Password">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12 col-12 mb-1 submit">
                            <div class="form-group">
                                <button @click = "submit" :disabled="submitting" type="button" class="btn btn-primary waves-effect waves-float waves-light btn-submit"><span v-if="submitting" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>@{{ submitting ? ' Please wait' : 'Submit' }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script src="{{url('backend/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{url('backend/app-assets/vendors/js/ui/jquery.sticky.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous" ></script>
    
    <script>
        new Vue({
            el: '#app',
            data: {
                submitting: false,
                successAlert: false,
                warningAlert: false,
                successMessage: '',
                warningMessage: '',
                username : '',
                email: '',
                number: '',
                name: '', 
                password: '',
                currpassword: '',
                isValid: false,
                isInvalid: false,
            },

            created() {
                this.fetchprofile()
            },

            directives: {
                mask: {
                    bind(el, binding) {
                        $(el).inputmask(binding.value);
                    },
                    update(el, binding) {
                        $(el).inputmask(binding.value);
                    },
                },
            },

            methods: {
                submit(){
                    this.submitting = true;
                    const formdata = new FormData();
                    formdata.append("_token", "{{ csrf_token() }}");
                    formdata.append("name", this.name);
                    formdata.append("number", this.number);
                    formdata.append("email", this.email);
                    formdata.append("password", this.password);
                    formdata.append("currpassword", this.currpassword);
                    fetch('/dashboard/profile-update-submit' , {
                        method : "POST",
                        body : formdata
                    })
                    .then(response => response.json())
                    .then((data) => {
                        if(data.status == "success"){
                            this.successMessage  = data.message;
                            this.successAlert = true;
                            this.warningAlert = false;
                            const result = data.user;
                            this.username = result.username;
                            this.email = result.email;
                            this.number = result.contact_no;
                            this.name = result.name;
                            this.submitting = false;
                        }
                        else if(data.status == "warning"){
                            this.warningMessage  = data.message;
                            this.successAlert = false;
                            this.warningAlert = true;
                            this.submitting = false;
                        }
                    })
                },

                fetchprofile(){
                    const link = `/dashboard/profile`;
                    fetch(link , { headers: { 'Accept': 'application/json' }})
                    .then((response) => response.json())
                    .then((data) => {
                        if(data.status == "success"){
                            const result = data.user;
                            this.username = result.username;
                            this.email = result.email;
                            this.number = result.contact_no;
                            this.name = result.name;
                        }
                    })
                },

                checkEmail() {
                    const link = '/dashboard/check?email=' + this.email;
                    fetch(link)
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.status === 'success') {
                            this.isValid = true;
                            this.isInvalid = false;
                        } else if (data.status === 'warning') {
                            this.isValid = false;
                            this.isInvalid = true;
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
                },

                checkPhone() {
                    const link = '/dashboard/check?number=' + this.number;
                    fetch(link)
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.status === 'success') {
                            this.isValid = true;
                            this.isInvalid = false;
                        } else if (data.status === 'warning') {
                            this.isValid = false;
                            this.isInvalid = true;
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
                }
            }
        });
    </script>
@stop