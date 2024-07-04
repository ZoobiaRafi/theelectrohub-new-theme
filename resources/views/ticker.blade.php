@extends('/layouts/master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
@stop

@section('title')
    <title>Tickers</title>
@stop
@section('body')
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row"></div>
    @if (session('success'))
        <div class="row">
            <div class="col-xl-12 col-md-12 col-12 mb-1">
                <div class="demo-spacing-0">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <div class="alert-body">
                            {{ session('success') }}
                        </div>
                        
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <br>
    @endif
    <div class="content-body">
        <div class="row">
            <div class="col-xl-10 col-md-6 col-12 mb-1">
                <div class="form-group">
                    <input v-model = "query" type="text" class="form-control" id="search-fields" placeholder="Search Ticker" @keyup.enter="fetchparam">
                </div>
            </div>
            @can('add' , app('App\Ticker'))
                <div class="col-xl-2 col-md-6 col-12 mb-1">
                    <button @click="showModal" type="button" class="btn btn-outline-primary waves-effect add-product"><i class="fa-light fa-plus"></i> &nbsp;Add Ticker</button>
                </div>
            @endcan
        </div>

        <div class="row" id="table-head">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table id="table-user" class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>Title</th>
                                    <th>Icon</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if = "tableData.length === 0">
                                    <td colspan="9" class="text-center"><b>No Tickers Found</b></td>
                                </tr>
                                <tr v-for="(items, index) in paginatedData" :key="items.id">
                                    <td>@{{ items.title }}</td>
                                    <td>@{{ items.icon }}</td>
                                    <td>
                                        <div style="border-radius: 0.25rem !important;" class="px-2 badge badge-pill" :class="items.status === 1 ? 'badge-light-success' : 'badge-light-danger'">@{{ items.status === 1 ? 'Active' : 'Inactive' }}</div>
                                    </td>
                                    <td>
                                        <button class="waves-effect mb-1 btn" @click="updateStatus(items.id)" type="button" data-toggle="tooltip" data-placement="top" :data-original-title="items.status === 1 ? 'Deactivate' : 'Activate'" :class="items.status === 1 ? 'btn-outline-danger' : 'btn-outline-success'"><i :class="items.status === 1 ? 'fa-regular fa-ban' : 'fa-light fa-lock'"></i></button>
                                        @can('delete', app('App\Ticker'))
                                            <button @click="Delete(items.id)" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="btn btn-outline-warning waves-effect mb-1"><i class="fa-thin fa-trash"></i></button>
                                        @endcan
                                        @can('edit' , app('App\Ticker'))
                                            <button @click="edit(items.id)" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Update" class="btn btn-outline-success waves-effect mb-1 btn-update"><i class="fa-light fa-pen-to-square"></i></button>
                                        @endcan
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12" v-if = "tableData.length > 0">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item" :class="{ 'disabled': currentPage === 1 }">
                            <a class="page-link" @click="changePage(currentPage - 1)" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
        
                        <li class="page-item" v-for="page in pages" :key="page" :class="{ 'active': page === currentPage }">
                            <a class="page-link" @click="changePage(page)" href="#">@{{ page }}</a>
                        </li>
        
                        <li class="page-item" :class="{ 'disabled': currentPage === totalPages }">
                            <a class="page-link" @click="changePage(currentPage + 1)" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

{{-- Add User Modal --}}
    <div class="modal fade text-left" id="add-product-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true" :class="{ 'show': modalVisible}" :style="{ 'padding-right': customStylesApplied ? '17px' : '0' , 'display' : customStylesApplied ? 'block' : 'none' , 'background-color' : customStylesApplied ? 'rgba(0, 0, 0, 0.2)' : 'rgba(0, 0, 0, 0)'}">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">@{{modalTitle}}</h4>
                    <button @click = "hideModal"  type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="alert alert-success" v-show="successAlert" role="alert"><p class="alert-body alert-body-success">@{{ successMessage }}</p></div>
                        <div class="alert alert-warning" v-show="warningAlert" role="alert"><p class="alert-body alert-body-warning">@{{ warningMessage }}</p></div>
                        <input v-model = "id" type="hidden" id="id">
                        <label>Title: </label>
                        <div class="form-group">
                            <input v-model="title" type="text" placeholder="Enter Title" class="form-control" />
                            <div class="feedback" style="display: none;"></div>
                        </div>
                        <label>Icons: </label>
                        <div class="form-group">
                            <input v-model="icons" type="text" placeholder="Enter Icons" class="form-control" />
                            <div class="feedback" style="display: none;"></div>
                        </div>
                        <div class="form-group status" v-if="showStatus">
                            <label>Status: </label>
                            <select class="form-control" v-model="status">
                                <option disabled>Please Select</option>
                                <option selected value = "1">Active</option>
                                <option value = "0">In Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="submitForm" type="button" class="btn btn-primary" :disabled="submitting"><span v-if="submitting" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>@{{ submitting ? ' Please wait' : 'Submit' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{-- Add User Modal --}}


@endsection

@section('javascript')
    <script src="{{url('backend/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous" ></script>
    <script src="{{url('backend/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{url('backend/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
    <script>
        
        new Vue({
            el: '#app',
            data: {
                modalVisible: false,
                customStylesApplied: false,
                tableData : [],
                title: '',
                id : '',
                icons: '',
                status: '1',
                submitting: false,
                successAlert: false,
                warningAlert: false,
                successMessage: '',
                warningMessage: '',
                query : '',
                modalTitle : '',
                showStatus : true,
                currentPage: 1,
                itemsPerPage: 10,    

            },
            created() {
                this.fetchuser()
            },

            computed: {
                totalPages() {
                    return Math.ceil(this.tableData.length / this.itemsPerPage);
                },
                paginatedData() {
                    const start = (this.currentPage - 1) * this.itemsPerPage;
                    const end = start + this.itemsPerPage;
                    return this.tableData.slice(start, end);
                },
                pages() {
                    const pages = [];
                    for (let i = 1; i <= this.totalPages; i++) {
                        pages.push(i);
                    }
                    return pages;
                },
            },

            methods: {
                changePage(page) {
                    if (page >= 1 && page <= this.totalPages) {
                        this.currentPage = page;
                    }
                },

                showModal() {
                    this.modalVisible = true;
                    this.customStylesApplied = true;
                    this.modalTitle = 'Add Ticker';
                },

                hideModal(){
                    this.modalVisible = false;
                    this.customStylesApplied = false;
                },

                submitForm(){
                    this.submitting = true;
                    const formdata = new FormData();
                    formdata.append("_token", "{{ csrf_token() }}");
                    formdata.append("status", this.status);
                    formdata.append("title", this.title);
                    formdata.append("icons", this.icons);
                    formdata.append("id", this.id);
                    if(this.id == ""){
                        if(this.title != ""){
                            if(this.icons != ""){
                                fetch('/dashboard/ticker/submit' , {
                                    method : "POST" , 
                                    body : formdata,
                                })
                                .then((response) => response.json())
                                .then((data) => {
                                    if(data.status == "success"){
                                        // console.log(data.data);
                                        this.successMessage = data.message;
                                        this.successAlert = true;
                                        this.warningAlert = false;
                                        this.tableData.unshift(data.data);
                                    }
                                    else if(data.status == "warning"){
                                        this.warningMessage = data.message;
                                        this.successAlert = false;
                                        this.warningAlert = true;
                                    }
                                })
                                .catch((error) => {
                                    console.error('Error:', error);
                                })
                                .finally(() => {
                                    this.submitting = false;
                                });
                            }
                            else{
                                this.warningMessage = "Please enter icon";
                                this.successAlert = false;
                                this.warningAlert = true;
                                this.submitting = false;
                            }
                        }
                        else{
                            this.warningMessage = "Please enter title";
                            this.successAlert = false;
                            this.warningAlert = true;
                            this.submitting = false;
                        }
                    }
                    else{
                        if(this.title != ""){
                            if(this.icons != ""){
                                fetch('/dashboard/ticker/update' , {
                                    method : "POST" , 
                                    body : formdata,
                                })
                                .then((response) => response.json())
                                .then((data) => {
                                    if(data.status == "success"){
                                        this.successMessage = data.message;
                                        this.successAlert = true;
                                        this.warningAlert = false;
                                        const index = this.tableData.findIndex((item) => item.id === this.id);
                                        if (index !== -1) {
                                            const updateddata = data.data;
                                            this.$set(this.tableData, index, updateddata);
                                        }
                                    }
                                    else if(data.status == "warning"){
                                        this.warningMessage = data.message;
                                        this.successAlert = false;
                                        this.warningAlert = true;
                                    }
                                })
                                .catch((error) => {
                                    console.error('Error:', error);
                                })
                                .finally(() => {
                                    this.submitting = false;
                                });
                            }
                            else{
                                this.warningMessage = "Please enter icon";
                                this.successAlert = false;
                                this.warningAlert = true;
                                this.submitting = false;
                            }
                        }
                        else{
                            this.warningMessage = "Please enter title";
                            this.successAlert = false;
                            this.warningAlert = true;
                            this.submitting = false;
                        }
                    }
                },

                fetchuser() {
                    const link = `/dashboard/user`;
                    fetch(link)
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === "success") {
                                var refkey = data.data.ref_key;
                                this.fetchdata(refkey);
                            }
                        })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                },

                edit(id) {
                    const link = `/dashboard/ticker/edit/${id}`;
                    fetch(link).then(response => response.json())
                    .then(data => {
                        if(data.status == "success"){
                            const result = data.data;
                            this.icons = result.icon;
                            this.id = result.id;
                            this.title = result.title;
                            this.modalVisible = true;
                            this.customStylesApplied = true;
                            this.modalTitle = 'Update Ticker';
                            this.showStatus = false;
                        }
                    });
                },

                fetchdata(refkey){
                    const link = `/dashboard/ticker/${refkey}`;
                    fetch(link , { headers: { 'Accept': 'application/json' }})
                        .then(response => response.json())
                        .then(data => {
                            const result = data.ticker;
                            this.tableData = result;
                            this.currentPage = 1;
                        })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                },

                fetchparam(refkey) {
                    let link = `/dashboard/ticker/${refkey}`;
                    if (this.query) {
                        link += `?query=${encodeURIComponent(this.query)}`;
                    }
                    fetch(link, { headers: { 'Accept': 'application/json' } })
                        .then(response => response.json())
                        .then(data => {
                            const result = data.ticker;
                            this.tableData = result;
                            this.currentPage = 1;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                },

                updateStatus(id) {
                    const link = `/dashboard/ticker/status/submit?id=${id}`;
                    fetch(link)
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === "success") {
                                const updateddata = data.data;
                                const index = this.tableData.findIndex(item => item.id === id);
                                if (index !== -1) {
                                    this.$set(this.tableData[index], 'status', updateddata.status);
                                }
                            }
                        })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                },

                Delete(id) {
                    const link = `/dashboard/ticker/delete/submit?id=${id}`;
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-outline-danger ml-1',
                        },
                        buttonsStyling: false,
                    }).then((result) => {
                        if (result.value) {
                        fetch(link)
                            .then((response) => response.json())
                            .then((data) => {
                                if (data.status === "success") {
                                    const index = this.tableData.findIndex((item) => item.id === id);
                                    if (index !== -1) {
                                        this.tableData.splice(index, 1);
                                    }
                                }
                            })
                            .catch((error) => {
                                console.error('Error:', error);
                            });
                        }
                    });
                }
            }
        });
    </script>
@stop