@extends('/layouts/master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/forms/select/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/extensions/toastr.min.css')}}">
@stop

@section('title')
    <title>Category</title>
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
                    <input type="text" class="form-control" id="search-fields" placeholder="Search Category">
                </div>
            </div>
            @can('add' , app('App\Category'))
                <div class="col-xl-2 col-md-6 col-12 mb-1">
                    <button type="button" class="btn btn-outline-primary waves-effect add-category"><i class="fa-light fa-plus"></i> &nbsp;Add Category</button>
                </div>
                <div class="col-xl-2 col-md-6 col-12 mb-1">
                    <button type="button" class="btn btn-outline-primary waves-effect upload-csv"><i class="fa-light fa-cloud-arrow-up"></i> &nbsp;Upload CSV</button>
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
                                    <th>Code</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Parent</th>
                                    <th>Date/Time</th>
                                    <th>Home</th>
                                    <th>Menu</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($category->count() > 0)
                                    @foreach($category as $all)
                                        <tr id="row-{{$all->id}}">
                                            <td>{{$all->id}}</td>
                                            <td>{{$all->code}}</td>
                                             <td>
                                                <img height="50" width="50" src="{{url('/')}}/{{$all->image}}">
                                            </td>
                                            <td>
                                                {{ucwords($all->title)}} &nbsp;
                                                @if(!isset($all->parent_info))
                                                    <div data-toggle="tooltip" data-placement="right" data-original-title="Showing in menu" class="d-flex align-items-center">
                                                        @if($all->is_menu == 1)
                                                            <i style="color:green;" data-feather='thumbs-up'></i>
                                                        @endif
                                                    </div>
                                                @endif 
                                            </td>
                                            <!--<td>{{$all->slug}}</td>-->
                                            <!--<td>-->
                                            <!--    @if($all->sale == 1)-->
                                            <!--        <div style="border-radius: 0.25rem !important;" class="px-2 badge badge-pill badge-light-success">Discount</div>-->
                                            <!--    @else-->
                                            <!--        <div style="border-radius: 0.25rem !important;" class="px-2 badge badge-pill badge-light-danger">No discount</div>-->
                                            <!--    @endif-->
                                            <!--</td>-->
                                            <td>{{ $all->slug }}</td>
                                            <td>
                                                @if(isset($all->parent_info)) {{$all->parent_info ? $all->parent_info->title : ''}} @if(isset($all->parent_info->grand_parent_info)) <i data-feather='arrow-right'></i> {{$all->parent_info ? $all->parent_info->grand_parent_info ? $all->parent_info->grand_parent_info->title : '' : ''}} @endif @else - - - @endif 
                                            </td>
                                            
                                            <td>{{date('d-m-Y' , strtotime($all->created_at))}} / {{date('H:i:s' , strtotime($all->created_at))}}</td>
                                            <td></td>
                                            <td>
                                                <div class="custom-control custom-switch custom-switch-success">
                                                    <input data-title = "{{$all->title}}" data-id="{{$all->id}}" type="checkbox" class="custom-control-input homepage" id="homepage-{{$all->id}}" @if($all->home_status == 1) checked="checked" @endif>
                                                    <label class="custom-control-label" for="homepage-{{$all->id}}">
                                                        <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></span>
                                                        <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-switch custom-switch-success">
                                                    <input data-title = "{{$all->title}}" data-id="{{$all->id}}" type="checkbox" class="custom-control-input btn-show-menu" id="menu-{{$all->id}}" @if($all->show_menu == 1) checked="checked" @endif>
                                                    <label class="custom-control-label" for="menu-{{$all->id}}">
                                                        <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></span>
                                                        <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="custom-control custom-switch custom-switch-success">
                                                        <input data-title="{{$all->title}}" data-id="{{$all->id}}" type="checkbox" class="custom-control-input status" id="status-{{$all->id}}" @if($all->status == 1) checked="" @endif>
                                                        <label class="custom-control-label" for="status-{{$all->id}}">
                                                            <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></span>
                                                            <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($all->status == 1)
                                                    {{-- <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Deactivate" class="btn btn-outline-danger waves-effect mb-1 status-category"><i class="fa-regular fa-ban"></i></button> --}}
                                                @else
                                                    <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Activate" class="btn btn-outline-success waves-effect mb-1 status-category"><i class="fa-light fa-lock"></i></button>
                                                @endif
                                                @can('edit' , app('App\Category'))
                                                    <button data-code = "{{$all->code}}" data-parentcategory = "{{$all->parent_category}}" data-id = "{{$all->id}}" data-title="{{$all->title}}" data-slug="{{$all->slug}}" @if($all->sale == 1) data-sale = "{{$all->sale}}" data-discounttype = "{{$all->discount_type}}" data-discount = "{{$all->discount}}" data-startdate = "{{$all->start_date}}" data-enddate = "{{$all->end_date}}" @endif type="button" data-toggle="tooltip" data-placement="top" data-original-title="Update" class="btn btn-outline-success waves-effect mb-1 btn-update"><i class="fa-light fa-pen-to-square"></i></button>
                                                @endcan
                                                @can('delete' , app('App\Category'))
                                                    <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="btn btn-outline-warning waves-effect mb-1 btn-delete"><i class="fa-thin fa-trash"></i></button>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center"><b>No Categories Found</b></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                        <label>Code: </label>
                        <div class="form-group">
                            <input id="code" type="text" placeholder="Enter Code" class="form-control" />
                            <div class="feedback" style="display: none;"></div>
                        </div>
                        <label>Title: </label>
                        <div class="form-group">
                            <input id="title" type="text" placeholder="Enter Title" class="form-control" />
                            <div class="feedback" style="display: none;"></div>
                        </div>
                        <div class="form-group slug" style="display:none;">
                            <label>Slug: </label>
                            <input id="slug" type="text" placeholder="Enter Slug" class="form-control" />
                            <div class="feedback" style="display: none;"></div>
                        </div>
                        <div class="form-group">
                            <label>Parent Category: </label>
                            <select class="form-control select2" id="parent_category">
                                <option selected disabled>Please Select</option>
                                @foreach($allcategory as $c)
                                    <option value = "{{$c->id}}">{{ucwords($c->title)}}</option>
                                    @foreach($c->sub_categories as $cc)
                                        <option value = "{{$cc->id}}">{{ucwords($cc->title_with_category)}}</option>
                                        @foreach($cc->sub_categories as $ccc)
                                            <option value = "{{$ccc->id}}">{{ucwords($ccc->title_with_category)}}</option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sale: </label>
                            <select class="form-control" id="sale">
                                <option disabled>Please Select</option>
                                <option value = "1">Yes</option>
                                <option selected value = "0">No</option>
                            </select>
                        </div>
                        <div class="form-group discount-type" style="display: none;">
                            <label>Discount type: </label>
                            <select class="form-control" id="discount_type">
                                <option disabled>Please Select</option>
                                <option selected value = "1">Flat</option>
                                <option value = "0">Percentage</option>
                            </select>
                        </div>
                        <div class="form-group discount" style="display:none;">
                            <label>Discount: </label>
                            <input id="discount" type="text" placeholder="Enter discount" class="form-control" />
                            <div class="feedback" style="display: none;"></div>
                        </div>
                        <div class="form-group startdate" style="display:none;">
                            <label>Start Date: </label>
                            <input id="start_date" type="text" placeholder="Enter Start Date" class="form-control flatpickr-human-friendly flatpickr-input" />
                            <div class="feedback" style="display: none;"></div>
                        </div>
                        <div class="form-group enddate" style="display:none;">
                            <label>End Date: </label>
                            <input id="end_date" type="text" placeholder="Enter End Date" class="form-control flatpickr-human-friendly flatpickr-input" />
                            <div class="feedback" style="display: none;"></div>
                        </div>
                        <div class="form-group">
                            <label>Image: </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Icon 1: </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="iconone">
                                <label class="custom-file-label" for="iconone">Choose file</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Icon 2: </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="icontwo">
                                <label class="custom-file-label" for="icontwo">Choose file</label>
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

{{-- Upload Category Using CSV Start --}}
    <div class="modal fade text-left" id="upload-csv-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="category-upload-csv" action="/dashboard/category/file-import" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-warning" style="display: none;" role="alert"><p class="alert-body alert-body-warning"></p></div>
                        <div class="form-group">
                            <label>File: </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="file">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-upload-csv">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{-- Upload Category Using CSV End --}}

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

            $(".status").change(function(){
                var id = $(this).data('id');
                var title = $(this).data('title');
                var link = '/dashboard/category/status/submit?id=' + id;
                $.get(link , function(res){
                    if(res['status'] == "success"){
                        toastr['success'](res['message'], 'Success!', {
                            closeButton: true,
                            tapToDismiss: false,
                        });
                    }
                    else if(res['status'] == "warning"){
                        toastr['warning'](res['message'], 'Warning', {
                            closeButton: true,
                            tapToDismiss: false,
                        });
                    }
                });
            });

            $(".add-category").click(function(){
                $("#add-category-modal").modal('show');
                $("#title").val("title");
                $(".slug").hide();
                $("#id").val("");
                $("#parent_category").val();
                $("#sale").val(0);
            });

            $(".btn-update").click(function(){
                var title = $(this).data('title');
                var slug = $(this).data('slug');
                var id = $(this).data('id');
                var sale = $(this).data('sale');
                var parentcategory = $(this).data('parentcategory');
                var code = $(this).data('code');
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
                $("#code").val(code);
                $("#title").val(title);
                $("#slug").val(slug);
                $(".slug").show();
                $("#id").val(id);
                $("#parent_category").val(parentcategory);
                $("#myModalLabel33").html("Update Category")
                $("#add-category-modal").modal('show');
                $(".btn-submit").removeAttr('disabled' , 'disabled');
                $(".alert-success").slideUp();
                $(".alert-warning").slideUp();
            });

            $(".btn-submit").click(function() {
                var title = $("#title").val();
                var status = $("#status").val();
                var id = $("#id").val();
                var img = $("#image").get(0);
                var iconone = $("#iconone").get(0);
                var icontwo = $("#icontwo").get(0);
                var file = img.files[0];
                var firsticon = iconone.files[0];
                var secondicon = icontwo.files[0];
                var slug = $("#slug").val();
                var sale = $("#sale").val();
                var discount = $("#discount").val();
                var discounttype = $("#discount_type").val();
                var startdate = $("#start_date").val();
                var enddate = $("#end_date").val();
                var parentcategory = $("#parent_category").val();
                var code = $("#code").val();
                if (title !== "") {
                    if (status !== "") {
                        if (file !== undefined && file !== null) {
                            var filename = file.name;
                            var fileext = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                            var allowext = ['jpg', 'jpeg', 'png', 'webp'];
                            var size = file.size;
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

                        if (firsticon !== undefined && firsticon !== null) {
                            var filename = firsticon.name;
                            var fileext = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                            var allowext = ['jpg', 'jpeg', 'png', 'webp'];
                            var size = file.size;
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

                        if (secondicon !== undefined && secondicon !== null) {
                            var filename = secondicon.name;
                            var fileext = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                            var allowext = ['jpg', 'jpeg', 'png', 'webp'];
                            var size = file.size;
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
                            formData.append("discount", discount);
                            formData.append("discounttype", discounttype);
                            formData.append("startdate", startdate);
                            formData.append("enddate", enddate);
                            formData.append("parentcategory", parentcategory);
                            formData.append("code", code);
                            if (file !== undefined && file !== null) {
                                formData.append("image", file);
                            }
                            if (firsticon !== undefined && firsticon !== null) {
                                formData.append("firsticon", firsticon);
                            }
                            if (secondicon !== undefined && secondicon !== null) {
                                formData.append("secondicon", secondicon);
                            }
                            $.ajax({
                                url: "/dashboard/category/submit",
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
                                        // setTimeout(() => {
                                        //     location.reload();
                                        // }, 2000);
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
                            formData.append("title", title);
                            formData.append("slug", slug);
                            formData.append("sale", sale);
                            formData.append("discount", discount);
                            formData.append("discounttype", discounttype);
                            formData.append("startdate", startdate);
                            formData.append("enddate", enddate);
                            formData.append("parentcategory", parentcategory);
                            formData.append("code", code);
                            if (file !== undefined && file !== null) {
                                formData.append("image", file);
                            }
                            if (firsticon !== undefined && firsticon !== null) {
                                formData.append("firsticon", firsticon);
                            }
                            if (secondicon !== undefined && secondicon !== null) {
                                formData.append("secondicon", secondicon);
                            }
                            
                            formData.append("id", id);
                            $.ajax({
                                url: "/dashboard/category/update",
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
                                        // setTimeout(() => {
                                        //     location.reload();
                                        // }, 2000);
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
                var link = '/dashboard/category/delete/submit?id=' + id;
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
                var link = "/dashboard/category/status/submit?id=" +id;
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
                    $("#category-upload-csv").submit();
                },1000);
            });

            $(".homepage").change(function(){
                var id = $(this).data('id');
                var title = $(this).data('title');
                var link = '/dashboard/category/home-status/submit?id=' + id;
                $.get(link , function(res){
                    if(res['status'] == "success"){
                        toastr['success'](res['message'], 'Success!', {
                            closeButton: true,
                            tapToDismiss: false,
                        });
                    }
                });
            });
            
            $(".btn-show-menu").change(function(){
                var id = $(this).data('id');
                var title = $(this).data('title');
                var link = '/dashboard/category/show-menu/submit?id=' + id;
                $.get(link , function(res){
                    if(res['status'] == "success"){
                        toastr['success'](res['message'], 'Success!', {
                            closeButton: true,
                            tapToDismiss: false,
                        });
                    }
                });
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