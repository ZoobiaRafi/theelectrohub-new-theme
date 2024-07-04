@extends('/layouts/master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
@stop

@section('title')
    <title>Vendors</title>
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
            <div class="col-xl-9 col-md-9 col-12 mb-1">
                <div class="form-group">
                    <input type="text" class="form-control" id="search-fields" placeholder="Search Vendor">
                </div>
            </div>
            @can('add' , app('App\Vendor'))
                <div class="col-xl-3 col-md-3 col-12 mb-1">
                    <button data-action='add' type="button" class="btn btn-outline-primary waves-effect add-vendor"><i class="fa-light fa-plus"></i> &nbsp;Add Vendor</button>
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
                                    <th>Vendor name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($vendor->count() <= 0)
                                    <tr>
                                        <td colspan="9" class="text-center"><b>No Vendors Found</b></td>
                                    </tr>
                                @else
                                    @foreach($vendor as $all)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="font-weight-bolder">{{ucwords( $all->vendor_name)}}</div>
                                                    <div class="font-small-2 text-muted">Email: {{ $all->email}}</div>
                                                    <div class="font-small-2 text-muted">Percentage: {{ $all->percentage}}</div>
                                                    <div class="font-small-2 text-muted">Website: {{ $all->website}}</div>
                                                    <div class="font-small-2 text-muted">Phone: {{ $all->phone}}</div>
                                                    <div class="font-small-2 text-muted">Address: {{ $all->address}}</div>
                                                    <div class="font-small-2 text-muted">Contact: {{ $all->contact_person_name}} | {{ $all->contact_person_email}} | {{ $all->contact_person_phone}}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="custom-control custom-switch custom-switch-success">
                                                    <input data-title="{{$all->title}}" data-id="{{$all->id}}" type="checkbox" class="custom-control-input status" id="status-{{$all->id}}" @if($all->status == 1) checked="" @endif>
                                                    <label class="custom-control-label" for="status-{{$all->id}}">
                                                        <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                                                <polyline points="20 6 9 17 4 12"></polyline>
                                                            </svg></span>
                                                        <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                            </svg></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @can('edit' , app('App\Vendor'))
                                                <button data-id="{{$all->id}}" data-vendorname="{{$all->vendor_name}}" data-email="{{$all->email}}" data-percentage="{{$all->percentage}}"
                                                data-phone="{{$all->phone}}" data-website="{{$all->website}}" data-status="{{$all->status}}" data-address="{{$all->address}}"  data-contact-person-name="{{$all->contact_person_name}}" 
                                                data-contact-person-phone="{{$all->contact_person_phone}}" data-contact-person-email = "{{ $all->contact_person_email }}" 
                                                type="button" data-toggle="tooltip" data-placement="top" data-original-title="Update" class="btn btn-outline-success waves-effect mb-1 btn-update">
                                                    <i class="fa-light fa-pen-to-square"></i>
                                                </button>
                                            @endcan
                                        </td>
                                    </tr> 
                                    @endforeach
                                @endif
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
    <div class="modal fade text-left" id="add-vendor-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true" :class="{ 'show': modalVisible}" :style="{ 'padding-right': customStylesApplied ? '17px' : '0' , 'display' : customStylesApplied ? 'block' : 'none' , 'background-color' : customStylesApplied ? 'rgba(0, 0, 0, 0.2)' : 'rgba(0, 0, 0, 0)'}">
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
                        <div class="alert alert-success" style="display: none;" role="alert">
                            <p class="alert-body alert-body-success"></p>
                        </div>
                        <div class="alert alert-warning" style="display: none;" role="alert">
                            <p class="alert-body alert-body-warning"></p>
                        </div>
                        <input type="hidden" id="id">
                        <label>Vendor name: </label>
                        <div class="form-group">
                            <input id="vendorname" type="text" placeholder="Enter vendor name" class="form-control" />
                            <div class="feedback" style="display: none;"></div>
                        </div>
                        <div class="form-group">
                            <label>Address: </label>
                            <input id="address" type="text" placeholder="Enter vendor address" class="form-control" />
                            <div class="feedback" style="display: none;"></div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Email:</label>
                                <input id="email" type="text" placeholder="Enter Email" class="form-control" />
                                <div class="feedback" style="display: none;"></div>
                            </div>
                            <div class="form-group col-md-6" >
                                <label>Phone: </label>
                                <input id="phone" type="text" placeholder="Enter phone" class="form-control" />
                                <div class="feedback" style="display: none;"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="website">Website:</label>
                                <input id="website" type="text" placeholder="Enter website" class="form-control" />
                                <div class="feedback" style="display: none;"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="percentage">Percentage</label>
                                <input id="percentage" type="text" placeholder="Enter %" class="form-control" />
                                <div class="feedback" style="display: none;"></div>
                            </div>
                        </div>

                        <div class="form-row">
                            <label> Contact Person: </label>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="conatctname">Name:</label>
                                <input id="conatctname" type="text" placeholder="Enter name" class="form-control" />
                                <div class="feedback" style="display: none;"></div>
                            </div>
                            <div class="form-group col-md-4" >
                                <label>Phone: </label>
                                <input id="conatctphone" type="text" placeholder="Enter phone" class="form-control" />
                                <div class="feedback" style="display: none;"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="conatctemail">Email:</label>
                                <input id="conatctemail" type="text" placeholder="Enter email" class="form-control" />
                                <div class="feedback" style="display: none;"></div>
                            </div>
                        </div>
                        
                        <div class="form-group status">
                            <label>Status: </label>
                            <select class="form-control" id="status">
                                <option disabled>Please Select</option>
                                <option selected value="1">Active</option>
                                <option value="0">In Active</option>
                            </select>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{-- Add User Modal --}}


@endsection

@section('javascript')
<script src="{{url('backend/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
<script src="{{url('backend/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{url('backend/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
<script src="{{url('backend/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{url('backend/app-assets/js/scripts/forms/form-select2.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="{{url('backend/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
<script>
    document.getElementById("search-fields").addEventListener("input", filterTable);

    function filterTable(event) {
        var query = event.target.value.toLowerCase();
        var rows = document.getElementById("table-user").querySelectorAll("tbody tr");
        rows.forEach(function(row) {
            var cells = row.querySelectorAll("td");
            var nameCell = cells[0];
            var match = false;
            if (nameCell.textContent.toLowerCase().includes(query)) {
                match = true;
            } else {
                for (var j = 1; j < cells.length; j++) {
                    if (cells[j].textContent.toLowerCase().includes(query)) {
                        match = true;
                        break;
                    }
                }
            }
            if (match) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    $(document).ready(function() {
        $(".j").fancybox({
            // You can add options here as needed
        });

        $(".status").change(function() {
            var id = $(this).data('id');
            var title = $(this).data('title');
            var link = '/dashboard/vendor/status/submit?id=' + id;
            $.get(link, function(res) {
                if (res['status'] == "success") {
                    toastr['success'](res['message'], 'Success!', {
                        closeButton: true,
                        tapToDismiss: false,
                    });
                } else if (res['status'] == "warning") {
                    toastr['warning'](res['message'], 'Warning', {
                        closeButton: true,
                        tapToDismiss: false,
                    });
                }
            });
        });

        $(".add-vendor").click(function() {
            $(".modal-title").html("Add New Vendor");
            $("#add-vendor-modal").modal('show');
            $("#vendorname").val("");
            $("#address").val("");
            $("#email").val("");
            $("#phone").val("");
            $("#website").val("");
            $("#percentage").val("");
            $("#conatctname").val("");
            $("#conatctphone").val("");
            $("#conatctemail").val("");
            $("#status").val("");
            $("#id").val("");
            $(".alert-success").slideUp();
            $(".alert-warning").slideUp();
        });

        $(".btn-update").click(function() {
            var action = $(this).data('action');
            if (action != "add") {
                var id = $(this).data('id');
                var vendorname = $(this).data('vendorname');
                var address = $(this).data('address');
                var email = $(this).data('email');
                var percentage = $(this).data('percentage');
                var phone = $(this).data('phone');
                var status = $(this).data('status');
                var website = $(this).data('website');
                var contactPersonName = $(this).data('contact-person-name');
                var contactPersonEmail = $(this).data('contact-person-email');
                var contactPersonPhone = $(this).data('contact-person-phone');
                
                $("#vendorname").val(vendorname);
                $("#address").val(address);
                $("#email").val(email);
                $("#phone").val(phone);
                $("#website").val(website);
                $("#percentage").val(percentage);
                $("#conatctname").val(contactPersonName);
                $("#conatctphone").val(contactPersonPhone);
                $("#conatctemail").val(contactPersonEmail);
                $("#status").val(status);
                $("#id").val(id);

                $("#myModalLabel33").html("Update Product");
            }
            $(".alert-success").slideUp();
            $(".alert-warning").slideUp();
            $("#add-vendor-modal").modal('show');
        });

        $(".btn-submit").click(function() {
            var formData = new FormData();
            var vendorname = $("#vendorname").val();
            var address = $("#address").val();
            var email = $("#email").val();
            var phone = $("#phone").val();
            var website = $("#website").val();
            var percentage = $("#percentage").val();
            var conatctname = $("#conatctname").val();
            var conatctphone = $("#conatctphone").val();
            var conatctemail = $("#conatctemail").val();
            var status = $("#status").val();
            var id = $("#id").val();

            if (vendorname !== "" && status !== "") {
                
                if (id === "") {
                    formData.append("_token", "{{ csrf_token() }}");
                    formData.append("vendorname",vendorname);
                    formData.append("address",address);
                    formData.append("email",email);
                    formData.append("phone",phone);
                    formData.append("website",website);
                    formData.append("percentage",percentage);
                    formData.append("conatctname",conatctname);
                    formData.append("conatctphone",conatctphone);
                    formData.append("conatctemail",conatctemail);
                    formData.append("status",status);


                    $.ajax({
                        url: "/dashboard/vendor/submit",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response['status'] == "success") {
                                $(".alert-body-success").html(response['message']);
                                $(".alert-success").slideDown();
                                $(".alert-warning").slideUp();
                                $(".btn-submit").html("Submit");
                                setTimeout(() => {
                                    location.reload();
                                }, 2000);
                            } else if (response['status'] == "error") {
                                $(".alert-body-warning").html(response['message']);
                                $(".alert-warning").slideDown();
                                $(".alert-success").slideUp();
                                $(".btn-submit").html("Submit");
                                $(".btn-submit").removeAttr("disabled");
                            }
                        }
                    });
                } else {
                    formData.append("_token", "{{ csrf_token() }}");
                    formData.append("id",id);
                    formData.append("vendorname",vendorname);
                    formData.append("address",address);
                    formData.append("email",email);
                    formData.append("phone",phone);
                    formData.append("website",website);
                    formData.append("percentage",percentage);
                    formData.append("conatctname",conatctname);
                    formData.append("conatctphone",conatctphone);
                    formData.append("conatctemail",conatctemail);
                    formData.append("status",status);
                    $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");
                    $(this).attr('disabled','disabled');
                    $.ajax({
                        url: "/dashboard/vendor/update",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response['status'] == "success") {
                                $(".alert-body-success").html(response['message']);
                                $(".alert-success").slideDown();
                                $(".alert-warning").slideUp();
                                $(".btn-submit").removeAttr("disabled");
                                $(".btn-submit").html("Submit");
                                setTimeout(() => {
                                    location.reload();
                                }, 2000);
                            } else if (response['status'] == "error") {
                                $(".alert-body-warning").html(response['message']);
                                $(".alert-warning").slideDown();
                                $(".alert-success").slideUp();
                                $(".btn-submit").html("Submit");
                                $(".btn-submit").removeAttr("disabled");
                            }
                        }
                    });
                }
            }
        });

        $(".status-product").click(function() {
            var id = $(this).data('id');
            var link = "/dashboard/vendor/status/submit?id=" + id;
            $.get(link, function(res) {
                if (res['status'] == "success") {
                    location.reload();
                }
            });
        });

        $("#search-fields").keydown(function(event) {
            if (event.keyCode === 13) {
                var searchValue = $(this).val();
                if (searchValue) {
                    var currentURL = window.location.href;
                    var url = new URL(currentURL);
                    var params = url.searchParams;

                    if (params.has('query')) {
                        params.set('query', encodeURIComponent(searchValue));
                    } else {
                        params.append('query', encodeURIComponent(searchValue));
                    }

                    url.search = params.toString();
                    window.location.href = url.toString();
                }
            }
        });

    });
</script>
@stop