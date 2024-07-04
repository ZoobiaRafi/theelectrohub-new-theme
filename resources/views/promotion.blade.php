@extends('/layouts/master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/forms/select/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/extensions/toastr.min.css')}}">
@stop

@section('title')
    <title>Promotion</title>
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
            <div class="col-xl-8 col-md-6 col-12 mb-1">
                <div class="form-group">
                    <input type="text" class="form-control" id="search-fields" placeholder="Search promotion">
                </div>
            </div>
            @can('add' , app('App\Promotion'))
                <div class="col-xl-2 col-md-6 col-12 mb-1">
                    <button type="button" class="btn btn-outline-primary waves-effect add-category"><i class="fa-light fa-plus"></i> &nbsp;Add Promotion</button>
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
                                    <th>S.No</th>
                                    <th>Desktop Image</th>
                                    <th>Mobile Image</th>
                                    <th>title</th>
                                    <th>link</th>
                                    <th>Date/Time</th>
                                    <th>Sale</th>
                                    <th>Bestseller</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($promotion->count() > 0)
                                    @foreach($promotion as $all)
                                        <tr id="row-{{$all->id}}">
                                            <td>{{$all->id}}</td>
                                             <td>
                                                <img height="50" width="50" src="{{url('/')}}/{{$all->desktop_image}}">
                                            </td>
                                            <td>
                                                <img height="50" width="50" src="{{url('/')}}/{{$all->mobile_image}}">
                                            </td>
                                            <td>
                                                {{ucwords($all->title)}} &nbsp;
                                            </td>
                                            
                                            <td>
                                                {{($all->link)}} &nbsp;
                                            </td>
                                            <td>{{date('d-m-Y' , strtotime($all->created_at))}} / {{date('H:i:s' , strtotime($all->created_at))}}</td>
                                            <td>
                                                <div class="custom-control custom-switch custom-switch-success">
                                                    <input data-title = "{{$all->title}}" data-id="{{$all->id}}" type="checkbox" class="custom-control-input sale-toggle" id="sale-{{$all->id}}" @if($all->is_sale == 1) checked="checked" @endif>
                                                    <label class="custom-control-label" for="sale-{{$all->id}}">
                                                        <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></span>
                                                        <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-switch custom-switch-success">
                                                    <input data-title = "{{$all->title}}" data-id="{{$all->id}}" type="checkbox" class="custom-control-input bestseller-toggle" id="bestseller-{{$all->id}}" @if($all->is_bestseller == 1) checked="checked" @endif>
                                                    <label class="custom-control-label" for="bestseller-{{$all->id}}">
                                                        <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></span>
                                                        <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></span>
                                                    </label>
                                                </div>
                                            </td>
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
                                                    <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Deactivate" class="btn btn-outline-danger waves-effect mb-1 status-promotion"><i class="fa-regular fa-ban"></i></button>
                                                @else
                                                    <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Activate" class="btn btn-outline-success waves-effect mb-1 status-promotion"><i class="fa-light fa-lock"></i></button>
                                                @endif
                                                @can('edit' , app('App\Category'))
                                                    <button data-parentcategory = "{{$all->parent_category}}" data-id = "{{$all->id}}" data-title="{{$all->title}}" data-link="{{$all->link}}" data-sale = "{{$all->is_sale}}" 
                                                        data-bestseller = "{{$all->is_bestseller}}" data-status = "{{$all->status}}" 
                                                        type="button" data-toggle="tooltip" data-placement="top" data-original-title="Update" class="btn btn-outline-success waves-effect mb-1 btn-update">
                                                        <i class="fa-light fa-pen-to-square"></i>
                                                    </button>
                                                @endcan
                                                @can('delete' , app('App\Category'))
                                                    <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="btn btn-outline-warning waves-effect mb-1 btn-delete"><i class="fa-thin fa-trash"></i></button>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center"><b>No Promotions Found</b></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if($promotion->count() > 0)
                <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                    <div>
                        <div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination mt-2">
                                    <li title="First Page" class="page-item"><a class="page-link" href="{{ $promotion->appends(request()->query())->url(1) }}"><i data-feather='rewind'></i></a></li>
                                    @if ($promotion->currentPage() == 1)
                                        <li class="page-item prev disabled"><span class="page-link"></span></li>
                                    @else
                                        <li class="page-item prev"><a class="page-link" href="{{ $promotion->appends(request()->query())->previousPageUrl() }}"></a></li>
                                    @endif

                                    @php
                                        $startPage = max(1, $promotion->currentPage() - 5);
                                        $endPage = min($promotion->lastPage(), $promotion->currentPage() + 5);
                                    @endphp

                                    @for ($page = $startPage; $page <= $endPage; $page++)
                                        @if ($page == $promotion->currentPage())
                                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link" href="{{ $promotion->appends(request()->query())->url($page) }}">{{ $page }}</a></li>
                                        @endif
                                    @endfor

                                    @if ($promotion->hasMorePages())
                                        <li class="page-item next"><a class="page-link" href="{{ $promotion->appends(request()->query())->nextPageUrl() }}"></a></li>
                                    @else
                                        <li class="page-item next disabled"><span class="page-link"></span></li>
                                    @endif
                                    <li title="Last Page" class="page-item"><a class="page-link" href="{{ $promotion->appends(request()->query())->url($promotion->lastPage()) }}"><i data-feather='fast-forward'></i></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Add Promotion Modal --}}
    <div class="modal fade text-left" id="add-promotion-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add Promotion</h4>
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
                        <div class="form-group">
                            <label>Link: </label>
                            <div class="form-group">
                                <input id="link" type="text" placeholder="Enter Link" class="form-control" />
                                <div class="feedback" style="display: none;"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Sale: </label>
                            <select class="form-control" id="sale">
                                <option disabled>Please Select</option>
                                <option value = "1">Yes</option>
                                <option selected value = "0">No</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Best Seller: </label>
                            <select class="form-control" id="bestseller">
                                <option disabled>Please Select</option>
                                <option value = "1">Yes</option>
                                <option selected value = "0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Desktop Image: </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="desktop">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Mobile Image: </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="mobile">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
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
    <script src="{{url('backend/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{url('backend/app-assets/js/scripts/forms/form-select2.js')}}"></script>
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

        $(document).ready(function(){
            $(".add-category").click(function(){
                $("#add-promotion-modal").modal('show');
                $("#title").val("title");
                $("#id").val("");
                $("#sale").val(0);
            });

            $(".btn-update").click(function(){
                var title = $(this).data('title');
                var link = $(this).data('link');
                var id = $(this).data('id');
                var sale = $(this).data('sale');
                var bestseller = $(this).data('bestseller');
                var status = $(this).data('status');
                
                $("#title").val(title);
                $("#link").val(link);
                $("#sale").val(sale);
                $("#bestseller").val(bestseller);
                $("#status").val(status);
                $("#id").val(id);
                $("#myModalLabel33").html("Update Promotion")
                $("#add-promotion-modal").modal('show');
            });

            $(".btn-submit").click(function() {
                var title = $("#title").val();
                var status = $("#status").val();
                var id = $("#id").val();
                var desktop = $("#desktop").get(0);
                var mobile = $("#mobile").get(0);
                var desktop_img = desktop.files[0];
                var mobile_img = mobile.files[0];;
                var link = $("#link").val();
                var sale = $("#sale").val();
                var bestseller = $("#bestseller").val();
                if (title !== "") {
                    if (status !== "") {
                        if (desktop_img !== undefined && desktop_img !== null) {
                            var filename = desktop_img.name;
                            var fileext = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                            var allowext = ['jpg', 'jpeg', 'png', 'webp'];
                            var size = desktop_img.size;
                            var maxsize = 1048576;

                            if (size > maxsize) {
                                $(".alert-body-warning").html("Your image size is greater than 1 MB");
                                $(".alert-warning").slideDown();
                                return;
                            }

                            if ($.inArray(fileext, allowext) === -1) {
                                $(".alert-body-warning").html("Only JPG, JPEG, PNG & WEBP allowed");
                                $(".alert-warning").slideDown();
                                return;
                            }
                        }

                        if (mobile_img !== undefined && mobile_img !== null) {
                            var filename = mobile_img.name;
                            var fileext = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                            var allowext = ['jpg', 'jpeg', 'png', 'webp'];
                            var size = mobile_img.size;
                            var maxsize = 1048576;

                            if (size > maxsize) {
                                $(".alert-body-warning").html("Your image size is greater than 1 MB");
                                $(".alert-warning").slideDown();
                                return;
                            }

                            if ($.inArray(fileext, allowext) === -1) {
                                $(".alert-body-warning").html("Only JPG, JPEG, PNG & WEBP allowed");
                                $(".alert-warning").slideDown();
                                return;
                            }
                        }

                        $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");
                        $(this).attr("disabled", "disabled");

                        if (id === "") {
                            // This is a new category submission
                            var formData = new FormData();
                            formData.append("_token", "{{ csrf_token() }}");
                            formData.append("status", status);
                            formData.append("title", title);
                            formData.append("sale", sale);
                            formData.append("bestseller", bestseller);
                            formData.append("link", link);
                            if (desktop_img !== undefined && desktop_img !== null) {
                                formData.append("desktop_img", desktop_img);
                            }
                            if (mobile_img !== undefined && mobile_img !== null) {
                                formData.append("mobile_img", mobile_img);
                            }
                            $.ajax({
                                url: "/dashboard/promotion/submit",
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
                        else {
                            // This is a category update
                            var formData = new FormData();
                            formData.append("_token", "{{ csrf_token() }}");
                            formData.append("status", status);
                            formData.append("title", title);
                            formData.append("sale", sale);
                            formData.append("bestseller", bestseller);
                            formData.append("link", link);
                            if (desktop_img !== undefined && desktop_img !== null) {
                                formData.append("desktop_img", desktop_img);
                            }
                            if (mobile_img !== undefined && mobile_img !== null) {
                                formData.append("mobile_img", mobile_img);
                            }
                            formData.append("id", id);
                            $.ajax({
                                url: "/dashboard/promotion/update",
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
                var link = '/dashboard/promotion/delete/submit?id=' + id;
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

            $(".sale-toggle").change(function(){
                var id = $(this).data('id');
                var title = $(this).data('title');
                var link = '/dashboard/promotion/sale-status/submit?id=' + id;
                $.get(link , function(res){
                    if(res['status'] == "success"){
                        toastr['success'](res['message'], 'Success!', {
                            closeButton: true,
                            tapToDismiss: false,
                        });
                    }
                });
            });

            $(".bestseller-toggle").change(function(){
                var id = $(this).data('id');
                var title = $(this).data('title');
                var link = '/dashboard/promotion/bestseller-status/submit?id=' + id;
                $.get(link , function(res){
                    if(res['status'] == "success"){
                        toastr['success'](res['message'], 'Success!', {
                            closeButton: true,
                            tapToDismiss: false,
                        });
                    }
                });
            });

            $(".status-promotion").click(function(){
                var id = $(this).data('id');
                var link = "/dashboard/promotion/status/submit?id=" +id;
                $.get(link , function(res){
                    if(res['status'] == "success"){
                        location.reload();
                    }
                });
            });
        });
    </script>
@stop