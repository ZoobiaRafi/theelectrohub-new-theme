@extends('/layouts/master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css')}}">
@stop

@section('title')
    <title>Coupon Code</title>
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
                    <input type="text" class="form-control" id="search-fields" placeholder="Search coupon">
                </div>
            </div>
            @can('add' , app('App\CouponCode'))
                <div class="col-xl-2 col-md-6 col-12 mb-1">
                    <a href = "{{route('add_coupon_code')}}"><button type="button" class="btn btn-outline-primary waves-effect add-coupon"><i class="fa-light fa-plus"></i> &nbsp;Add Coupon Code</button></a>
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
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>Created By</th>
                                    <th>Coupon Type</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($couponcode->count() > 0)
                                    @foreach($couponcode as $all)
                                        <tr id="row-{{$all->id}}">
                                            <td>{{$all->id}}</td>
                                            <td>{{ucwords($all->title)}}</td>
                                            <td>{{$all->code}}</td>
                                            <td>
                                                @if($all->type == 1)
                                                    Flat
                                                @elseif($all->type == 2)
                                                    Percentage
                                                @endif
                                            </td>
                                            <td>{{$all->discount}}</td>
                                            <td>{{$all->user_detail ? $all->user_detail->name : ""}}</td>
                                            <td>
                                                @if($all->coupon_type == 1)
                                                    General
                                                @elseif($all->coupon_type == 2)
                                                    Category
                                                @elseif($all->coupon_type == 3)
                                                    Product
                                                @elseif($all->coupon_type == 4)
                                                    User
                                                @elseif($all->coupon_type == 5)
                                                    Category & User
                                                @elseif($all->coupon_type == 6)
                                                    Product & User
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($all->status  == 1)
                                                        <div style="border-radius: 0.25rem !important;" class="px-2 badge badge-pill badge-light-success">Status</div>
                                                    @elseif($all->status == 0)
                                                        <div style="border-radius: 0.25rem !important;" class="px-2 badge badge-pill badge-light-danger">In Active</div>
                                                    @endif
                                                </div>
                                            </td>
                                            
                                            <td>
                                                @if($all->status == 1)
                                                    <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Deactivate" class="btn btn-outline-danger waves-effect mb-1 status-coupon"><i class="fa-regular fa-ban"></i></button>
                                                @else
                                                    <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Activate" class="btn btn-outline-success waves-effect mb-1 status-coupon"><i class="fa-light fa-lock"></i></button>
                                                @endif
                                                @can('read' , app('App\CouponCode'))
                                                    @if($all->status == 1)
                                                        <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Action" class="btn btn-outline-info waves-effect mb-1 action-coupon"><i class="fa-light fa-arrow-up-right-from-square"></i></button>
                                                    @endif
                                                @endcan
                                                @can('edit' , app('App\CouponCode'))
                                                    <a href = "{{route('edit_coupon_code' , $all->id)}}"><button data-id = "{{$all->id}}" data-catid = "{{$all->cat_id}}" data-title="{{$all->title}}" data-slug="{{$all->slug}}" data-price = "{{$all->price}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Update" class="btn btn-outline-success waves-effect mb-1 btn-update"><i class="fa-light fa-pen-to-square"></i></button></a>
                                                @endcan
                                                @can('delete' , app('App\CouponCode'))
                                                    <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="btn btn-outline-warning waves-effect mb-1 btn-delete"><i class="fa-thin fa-trash"></i></button>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center"><b>No Coupon Codes Found</b></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                <div>
                    <div>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination mt-2">
                                @if ($couponcode->currentPage() == 1)
                                    <li class="page-item prev disabled"><span class="page-link"></span></li>
                                @else
                                    <li class="page-item prev"><a class="page-link" href="{{ $couponcode->previousPageUrl() }}"></a></li>
                                @endif
            
                                @foreach ($couponcode->getUrlRange(1, $couponcode->lastPage()) as $page => $url)
                                    @if ($page == $couponcode->currentPage())
                                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
            
                                @if ($couponcode->hasMorePages())
                                    <li class="page-item next"><a class="page-link" href="{{ $couponcode->nextPageUrl() }}"></a></li>
                                @else
                                    <li class="page-item next disabled"><span class="page-link"></span></li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="coupon-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Coupon Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Apply</th>
                            <th>Expiry</th>
                        </tr>
                    </thead>
                    <tbody class="data-body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script src="{{url('backend/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous" ></script>
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

            $(".btn-delete").click(function(){
                var id = $(this).data('id');
                var link = '/dashboard/delete-coupon-code/' + id;
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

            $(".status-coupon").click(function(){
                var id = $(this).data('id');
                var link = '/dashboard/status-coupon-code/' + id;
                $.get(link , function(res){
                    if(res['status'] == 'success'){
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                }); 
            });

            $(".action-coupon").click(function(){
                var id = $(this).data('id');
                var link = '/dashboard/details-coupon-code/' + id;
                $.get(link, function(res){
                    if (res['status'] == "success") {
                        var html = "<tr><td>" + res['message']['type'] + "</td>";
                        var categories = res['message']['category'];
                        var products = res['message']['products'];
                        var users = res['message']['users'];
                        var cat_users = res['message']['cat_users'];
                        var pro_users = res['message']['pro_users'];

                        if (categories && categories.length > 0) {
                            html += "<td>";
                            for (var i = 0; i < categories.length; i++) {
                                if (i > 0) {
                                    html += ", ";
                                }
                                html += categories[i]['cattitle'];
                            }
                            html += "</td>";
                        } 
                        else if (products && products.length > 0) {
                            html += "<td>";
                            for (var i = 0; i < products.length; i++) {
                                if (i > 0) {
                                    html += ", ";
                                }
                                html += products[i]['protitle'];
                            }
                            html += "</td>";
                        } 
                        else if (users && users.length > 0) {
                            html += "<td>";
                            for (var i = 0; i < users.length; i++) {
                                if (i > 0) {
                                    html += ", ";
                                }
                                html += users[i]['username'];
                            }
                            html += "</td>";
                        } 
                        else if (cat_users && cat_users.length > 0) {
                            html += "<td>";
                            for (var i = 0; i < cat_users.length; i++) {
                                if (i > 0) {
                                    html += ", ";
                                }
                                var catuser = cat_users[i];
                                if (catuser.userid !== undefined) {
                                    html += catuser.username;
                                } else if (catuser.catid !== undefined) {
                                    html += catuser.cattitle;
                                }
                            }
                            html += "</td>";
                        }

                        else if (pro_users && pro_users.length > 0) {
                            html += "<td>";
                            for (var i = 0; i < pro_users.length; i++) {
                                if (i > 0) {
                                    html += ", ";
                                }
                                var prouser = pro_users[i];
                                if (prouser.userid !== undefined) {
                                    html += prouser.username;
                                } else if (prouser.catid !== undefined) {
                                    html += prouser.cattitle;
                                }
                            }
                            html += "</td>";
                        }
                        
                        html += "<td>" + res['message']['expirydate'] + "</td></tr>";
                        $(".data-body").html(html);
                        $("#coupon-modal").modal('show');
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