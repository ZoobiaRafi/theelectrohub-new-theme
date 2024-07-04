@extends('/layouts/master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
@stop

@section('title')
    <title>Contact Us</title>
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
            <div class="col-xl-12 col-md-6 col-12 mb-1">
                <div class="form-group">
                    <input type="text" class="form-control" id="search-fields" placeholder="Search Contact Us">
                </div>
            </div>
        </div>

        <div class="row" id="table-head">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table id="table-user" class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>S No.</th>
                                    <th>Name</th>
                                    <th>Topic</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($contactus->count() > 0)
                                    @foreach($contactus as $all)
                                        <tr id="row-{{$all->id}}">
                                            <td>{{$all->id}}</td>
                                            <td>{{$all->name}}</td>
                                            <td>{{$all->topic_detail ? $all->topic_detail->title : ""}}</td>
                                            <td>{{$all->contact_no}}</td>
                                            <td>
                                                {{$all->status_detail ? $all->status_detail->title : ""}}
                                            </td>
                                            <td>                                                
                                                @can('read' , app('App\ContactU'))
                                                    <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="View" class="btn btn-outline-info waves-effect mb-1 btn-view"><i class="fa-light fa-eye"></i></button>
                                                @endcan
                                                @can('edit' , app('App\ContactU'))
                                                    <button data-id = "{{$all->id}}" data-status = "{{$all->status}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Update" class="btn btn-outline-success waves-effect mb-1 btn-update"><i class="fa-light fa-pen-to-square"></i></button>
                                                @endcan
                                                @can('delete' , app('App\ContactU'))
                                                    <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="btn btn-outline-warning waves-effect mb-1 btn-delete"><i class="fa-thin fa-trash"></i></button>
                                                @endcan
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center"><b>No Contact Request Found</b></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if($contactus->count() > 0)
                <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                    <div>
                        <div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination mt-2">
                                    @if ($contactus->currentPage() == 1)
                                        <li class="page-item prev disabled"><span class="page-link"></span></li>
                                    @else
                                        <li class="page-item prev"><a class="page-link" href="{{ $contactus->previousPageUrl() }}"></a></li>
                                    @endif
                
                                    @foreach ($contactus->getUrlRange(1, $contactus->lastPage()) as $page => $url)
                                        @if ($page == $contactus->currentPage())
                                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach
                
                                    @if ($contactus->hasMorePages())
                                        <li class="page-item next"><a class="page-link" href="{{ $contactus->nextPageUrl() }}"></a></li>
                                    @else
                                        <li class="page-item next disabled"><span class="page-link"></span></li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Add User Modal --}}
    <div class="modal fade text-left" id="add-product-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Update Contact Request</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="alert alert-success" style="display: none;" role="alert"><p class="alert-body alert-body-success"></p></div>
                        <div class="alert alert-warning" style="display: none;" role="alert"><p class="alert-body alert-body-warning"></p></div>
                        <input type="hidden" id="id">
                        <label>Status: </label>
                        <div class="form-group">
                            <select class="form-control" id="status">
                                <option disabled>Please Select</option>
                                @foreach($contactstatus as $status)
                                    <option value = "{{$status->id}}">{{ucwords($status->title)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{-- Add User Modal --}}

{{-- View Modal --}}
    <div class="modal fade text-left" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">View Contact Request</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="form-group">
                            <label><b>Name: </b> <span id="name"></span></label>
                        </div>
                        <div class="form-group">
                            <label><b>Phone: </b> <span id="phone"></span></label>
                        </div>
                        <div class="form-group">
                            <label><b>Email: </b> <span id="email"></span></label>
                        </div>
                        <div class="form-group">
                            <label><b>Message: </b> <span id="message"></span></label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{-- View Modal --}}


@endsection

@section('javascript')
    <script src="{{url('backend/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous" ></script>
    <script src="{{url('backend/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{url('backend/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
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

        $(document).ready(function(){
            $(".btn-update").click(function(){
                var status = $(this).data('status');
                var id = $(this).data('id');
                $("#status").val(status);
                $("#id").val(id);
                $("#add-product-modal").modal('show');
            });

            $(".btn-submit").click(function() {
                var status = $("#status").val();
                var id = $("#id").val();    
                $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");
                $(this).attr("disabled", "disabled");
                var formData = new FormData();
                formData.append("_token", "{{ csrf_token() }}");
                formData.append("id", id);
                formData.append("status", status);
                $.ajax({
                    url: "/dashboard/contact-us/update/submit",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if(response['status'] == "success"){
                            $(".alert-body-success").html(response['message']);
                            $(".alert-success").slideDown();
                            $(".alert-warning").slideUp();
                            $(".btn-submit").html("Submit");
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        }
                        else if(response['status'] == "warning"){
                            $(".alert-body-warning").html(response['message']);
                            $(".alert-warning").slideDown();
                            $(".alert-success").slideUp();
                            $(".btn-submit").html("Submit");
                            $(".btn-submit").removeAttr("disabled");
                        }
                    }
                });
            });

            $(".btn-view").click(function(){
                var id = $(this).data("id");
                var link = "/dashboard/contact-us/view/" + id;
                $.get(link , function(res){
                    if(res['status'] == "success"){
                        var data = res['data'];
                        $("#name").html(data['name']);
                        $("#phone").html(data['contact_no']);
                        $("#email").html(data['email']);
                        $("#message").html(data['message']);
                        $("#view-modal").modal('show');
                    }
                });
            });


            $(".btn-delete").click(function(){
                var id = $(this).data('id');
                var link = '/dashboard/contact-us/delete/submit?id=' + id;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-outline-danger ml-1'
                    },
                    buttonsStyling: false
                }).then(function (result) {
                    if (result.value) {
                        $.get(link,function(res){
                            if(res['status'] == "success"){
                                $("#row-" + id).slideUp();
                            }
                        });
                    }
                });
            });

            $(".status-product").click(function(){
                var id = $(this).data('id');
                var link = "/dashboard/product/status/submit?id=" +id;
                $.get(link , function(res){
                    if(res['status'] == "success"){
                        location.reload();
                    }
                });
            });

            $("#search-fields").keydown(function(event) {
                if (event.keyCode === 13) {
                    var searchValue = $(this).val();
                    if (searchValue) {
                        var currentURL = window.location.href;
                        var newURL = currentURL + (currentURL.includes('?') ? '&' : '?') + 'query=' + encodeURIComponent(searchValue);
                        window.location.href = newURL;
                    }
                }
            });

            $(".upload-csv").click(function(){
                $("#upload-csv-modal").modal('show');
            });

            $(".btn-upload-csv").click(function(){
                var csv = $("#file").get(0);
                var file = csv.files[0];
                if (file !== undefined && file !== null) {
                    var filename = file.name;
                    var fileext = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                    var allowext = ['csv', 'xlsx'];
                }
                if ($.inArray(fileext, allowext) === -1) {
                    $(".alert-body-warning").html("Only CSV & XLSX files allowed");
                    $(".alert-warning").slideDown();
                    return;
                }

                $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");
                $(this).attr("disabled", "disabled");

                setTimeout(function(){
                    $("#product-upload-csv").submit();
                },1000);
            });

            $("#sale").change(function(){
                var val = $(this).val();
                if(val == 1){
                    $(".discount-type").slideDown();
                    $(".discount").slideDown();
                    $(".startdate").slideDown();
                    $(".enddate").slideDown();
                }
                else{
                    $(".discount-type").hide();
                    $(".discount").hide();
                    $(".startdate").hide();
                    $(".enddate").hide();
                }
            });

        });
    </script>
@stop