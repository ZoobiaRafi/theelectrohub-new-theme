@extends('/layouts/master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
@stop

@section('title')
    <title>Contact Us Topic</title>
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
                    <input type="text" class="form-control" id="search-fields" placeholder="Search Topic">
                </div>
            </div>
            @can('add' , app('App\ContactusTopic'))
                <div class="col-xl-2 col-md-6 col-12 mb-1">
                    <button type="button" class="btn btn-outline-primary waves-effect add-category"><i class="fa-light fa-plus"></i> &nbsp;Add Topic</button>
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
                                    <th>S No.</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($contactustopic->count() > 0)
                                    @foreach($contactustopic as $all)
                                        <tr id="row-{{$all->id}}">
                                            <td>{{$all->id}}</td>
                                            <td>{{ucwords($all->title)}}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($all->status == 1)
                                                        <div style="border-radius: 0.25rem !important;" class="px-2 badge badge-pill badge-light-success">Active</div>
                                                    @elseif($all->status == 0)
                                                        <div style="border-radius: 0.25rem !important;" class="px-2 badge badge-pill badge-light-danger">In Active</div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                @if($all->status == 1)
                                                    <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Deactivate" class="btn btn-outline-danger waves-effect mb-1 status-category"><i class="fa-regular fa-ban"></i></button>
                                                @else
                                                    <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Activate" class="btn btn-outline-success waves-effect mb-1 status-category"><i class="fa-light fa-lock"></i></button>
                                                @endif
                                                @can('edit' , app('App\ContactusTopic'))
                                                    <button data-id = "{{$all->id}}" data-title="{{$all->title}}" data-status="{{$all->status}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Update" class="btn btn-outline-success waves-effect mb-1 btn-update"><i class="fa-light fa-pen-to-square"></i></button>
                                                @endcan
                                                @can('delete' , app('App\ContactusTopic'))
                                                    <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="btn btn-outline-warning waves-effect mb-1 btn-delete"><i class="fa-thin fa-trash"></i></button>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center"><b>No Topics Found</b></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if($contactustopic->count() > 0)
                <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                    <div>
                        <div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination mt-2">
                                    @if ($contactustopic->currentPage() == 1)
                                        <li class="page-item prev disabled"><span class="page-link"></span></li>
                                    @else
                                        <li class="page-item prev"><a class="page-link" href="{{ $contactustopic->previousPageUrl() }}"></a></li>
                                    @endif
                
                                    @foreach ($contactustopic->getUrlRange(1, $contactustopic->lastPage()) as $page => $url)
                                        @if ($page == $contactustopic->currentPage())
                                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach
                
                                    @if ($contactustopic->hasMorePages())
                                        <li class="page-item next"><a class="page-link" href="{{ $contactustopic->nextPageUrl() }}"></a></li>
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
    <div class="modal fade text-left" id="add-category-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="alert alert-success" style="display: none;" role="alert"><p class="alert-body alert-body-success"></p></div>
                        <div class="alert alert-warning" style="display: none;" role="alert"><p class="alert-body alert-body-warning"></p></div>
                        <input type="hidden" id="id">
                        <label>Title: </label>
                        <div class="form-group">
                            <input id="title" type="text" placeholder="Enter Title" class="form-control" />
                            <div class="feedback" style="display: none;"></div>
                        </div>
                        <label>Status: </label>
                        <div class="form-group">
                            <select class="form-control" id="status">
                                <option disabled>Please Select</option>
                                <option selected value = "1">Active</option>
                                <option value = "0">In Active</option>
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
            $(".add-category").click(function(){
                $("#add-category-modal").modal('show');
            });

            $(".btn-update").click(function(){
                var title = $(this).data('title');
                var slug = $(this).data('slug');
                var id = $(this).data('id');
                var sale = $(this).data('sale');
                if(sale == 1){
                    var discounttype = $(this).data('discounttype');
                    var discount = $(this).data('discount');
                    var startdate = $(this).data('startdate');
                    var enddate = $(this).data('enddate');
                    $("#sale").val(sale);
                    $("#discounttype").val(discounttype);
                    $("#discount").val(discount);
                    $("#start_date").val(startdate);
                    $("#end_date").val(enddate);

                    $(".sale").slideDown();
                    $(".discounttype").slideDown();
                    $(".discount").slideDown();
                    $(".startdate").slideDown();
                    $(".enddate").slideDown();
                }
                $("#title").val(title);
                $("#slug").val(slug);
                $(".slug").show();
                $("#id").val(id);
                $("#myModalLabel33").html("Update Category")
                $("#add-category-modal").modal('show');
            });

            $(".btn-submit").click(function() {
                var title = $("#title").val();
                var status = $("#status").val();
                var id = $("#id").val();
                if (title !== "") {
                    if (status !== "") {
                        $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");
                        $(this).attr("disabled", "disabled");

                        if (id === "") {
                            // This is a new category submission
                            var formData = new FormData();
                            formData.append("_token", "{{ csrf_token() }}");
                            formData.append("status", status);
                            formData.append("title", title);
                            $.ajax({
                                url: "/dashboard/contact-us-topic/submit",
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
                        } else {
                            // This is a category update
                            var formData = new FormData();
                            formData.append("_token", "{{ csrf_token() }}");
                            formData.append("status", status);
                            formData.append("title", title);
                            formData.append("id", id);
                            $.ajax({
                                url: "/dashboard/contact-us-topic/update/submit",
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
                        }
                    }
                }
            });

            $(".btn-delete").click(function(){
                var id = $(this).data('id');
                var link = '/dashboard/contact-us-topic/delete/submit?id=' + id;
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

            $(".status-category").click(function(){
                var id = $(this).data('id');
                var link = "/dashboard/contact-us-topic/status/submit?id=" +id;
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

        });
    </script>
@stop