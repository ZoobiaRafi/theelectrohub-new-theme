@extends('/layouts/master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/forms/select/select2.min.css')}}">
    <style>
        .text-size label{
            font-size: 15px !important; 
        }
    </style>
@stop

@section('title')
    <title>Order</title>
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
                    <input type="text" class="form-control" id="search-fields" placeholder="Search Order">
                </div>
            </div>
        </div>

        <div class="row" id="table-head">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            @foreach($orderstatus as $os)
                                <li class="nav-item">
                                    <a class="nav-link @if($loop->iteration == 1) active @endif" id="{{$os->title}}-tab" data-toggle="tab" href="#{{$os->title}}" aria-controls="home" role="tab" aria-selected="true">{{$os->title}} &nbsp;
                                        @if($os->title == "Delivered")
                                            <div class="badge badge-glow badge-success">{{$ordersByStatus[$os->title]->count()}}</div>
                                        @elseif($os->title == "Returned" || $os->title == "Cancelled")
                                            <div class="badge badge-glow badge-danger">{{$ordersByStatus[$os->title]->count()}}</div>
                                        @elseif($os->title == "Confirmed")
                                            <div class="badge badge-glow badge-success">{{$ordersByStatus[$os->title]->count()}}</div>
                                        @elseif($os->title == "Pending")
                                            <div class="badge badge-glow badge-warning">{{$ordersByStatus[$os->title]->count()}}</div>
                                        @else
                                            <div class="badge badge-glow badge-info">{{$ordersByStatus[$os->title]->count()}}</div>
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        
                        <div class="tab-content">
                            @foreach($orderstatus as $status)
                                @if(isset($ordersByStatus[$status->title]) && $ordersByStatus[$status->title]->isNotEmpty())
                                    <div role="tabpanel" class="tab-pane @if($loop->iteration == 1) active @endif" id="{{$status->title}}" aria-labelledby="{{$status->title}}-tab" aria-expanded="true">
                                        <div class="card">
                                            <div class="table-responsive">
                                                <table id="table-user" class="table table-striped">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Order ID</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            {{-- <th>Contact</th> --}}
                                                            <th>Postal Code</th>
                                                            <th>Total</th>
                                                            <th>Tracking</th>
                                                            <th>Receipt</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                        
                                                    <tbody>
                                                        @foreach($ordersByStatus[$status->title] as $all)
                                                            <tr id="row-{{$all->id}}">
                                                                <td>{{$all->id}}</td>
                                                                <td>{{$all->name}}</td>
                                                                <td>{{$all->email}}</td>
                                                                {{-- <td>{{$all->contact_no}}</td> --}}
                                                                <td>{{$all->postal_code}}</td>
                                                                <td>
                                                                    @if(isset($all->order_total))
                                                                        &pound;{{ number_format((float)($all->order_total ?? 0), 2) }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <button data-toggle="tooltip" data-placement="right" data-original-title="{{$all->shipping_tracking_id}}" type="button" class="btn btn-outline-info round waves-effect"><i class="fa-light fa-link"></i></button>
                                                                </td>
                                                                <td>
                                                                    <button data-toggle="tooltip" data-placement="right" data-original-title="{{$all->payment_transaction_id}}" type="button" class="btn btn-outline-info round waves-effect"><i class="fa-light fa-link"></i></button>
                                                                </td>
                                                                <td>
                                                                    @php
                                                                        $title = $all->status_detail ? $all->status_detail->title : ''; 
                                                                    @endphp
                                                                    @if($title == "Delivered")
                                                                        <div class="badge badge-glow badge-success">{{$title}}</div>
                                                                    @elseif($title == "Returned" || $title == "Cancelled")
                                                                        <div class="badge badge-glow badge-danger">{{$title}}</div>
                                                                    @elseif($title == "Confirmed")
                                                                        <div class="badge badge-glow badge-success">{{$title}}</div>
                                                                    @elseif($title == "Pending")
                                                                        <div class="badge badge-glow badge-warning">{{$title}}</div>
                                                                    @else
                                                                        <div class="badge badge-glow badge-info">{{$title}}</div>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @can('read' , app('App\Order')) 
                                                                        <button data-id="{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="View #{{$all->id}}" class="btn btn-outline-info waves-effect mb-1 btn-view"><i class="fa-light fa-eye"></i></button>
                                                                    @endcan
                                                                    @can('edit' , app('App\Order'))
                                                                        <button data-id="{{$all->id}}" data-status="{{$all->status}}" @if($all->status == 5) data-reason = "{{$all->reason}}" @endif type="button" data-toggle="tooltip" data-placement="top" data-original-title="Update #{{$all->id}}" class="btn btn-outline-success waves-effect mb-1 btn-update"><i class="fa-light fa-pen-to-square"></i></button>
                                                                    @endcan
                                                                    @can('delete' , app('App\Order'))
                                                                        <button data-id="{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Delete #{{$all->id}}" class="btn btn-outline-warning waves-effect mb-1 btn-delete"><i class="fa-thin fa-trash"></i></button>
                                                                    @endcan
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div role="tabpanel" class="tab-pane @if($loop->iteration == 1) active @endif" id="{{$status->title}}" aria-labelledby="{{$status->title}}" aria-expanded="true">
                                        <div class="card">
                                            <div class="table-responsive">
                                                <table id="table-user" class="table table-striped">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Order ID</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Contact</th>
                                                            <th>Postal Code</th>
                                                            <th>Total</th>
                                                            <th>Tracking</th>
                                                            <th>Receipt</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <td class="text-center" colspan="10"><strong>No Orders Found</strong></td>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Add User Modal --}}
    <div class="modal fade text-left" id="order-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Update Order</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="alert alert-success" style="display: none;" role="alert"><p class="alert-body alert-body-success"></p></div>
                        <div class="alert alert-warning" style="display: none;" role="alert"><p class="alert-body alert-body-warning"></p></div>
                        <input type="hidden" id="id">

                        <div class="form-group">
                            <label>Order Status: </label>
                            <select class="form-control" id="orderstatus">
                                <option selected disabled>Please Select</option>
                                @foreach($orderstatus as $os)
                                    <option value = "{{$os->id}}">{{ucwords($os->title)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group reason" style="display: none;">
                            <label>Reason: </label>
                            <input id="reason" type="text" placeholder="Enter Reason" class="form-control" />
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

{{-- View Order Modal --}}
<div class="modal fade text-left" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">View Order</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#">
                <div class="modal-body">
                    <div class="form-group text-size">
                        <label><b>Order ID: #</b> <span id="orderid"></span></label>
                    </div>
                    <div class="form-group text-size">
                        <label><b>Name: </b> <span id="cust_name"></span></label>
                    </div>
                    <div class="form-group text-size">
                        <label><b>Phone: </b> <span id="cust_phone"></span></label>
                    </div>
                    <div class="form-group text-size">
                        <label><b>Address: </b> <span id="cust_address"></span></label>
                    </div>
                    <div class="form-group text-size">
                        <label><b>Post Code: </b> <span id="cust_postalcode"></span></label>
                    </div>
                    <div class="form-group text-size">
                        <label class="w-100 text-center"><b>Products </b></label><br><br>
                        <div class="card">
                            <div class="table-responsive">
                                <table id="table-products" class="table table-striped"></table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-size">
                        <label><b>Status: </b> <span id="status"></span></label>
                    </div>
                    <div class="form-group text-size">
                        <label><b>Payment Status: </b> <span id="payment-status"></span></label>
                    </div>
                    <div class="form-group text-size">
                        <label><b>Tracking: </b> <span id="tracking-id"></span></label>
                    </div>
                    <div class="form-group text-size">
                        <label><b>Shipping Total: </b> &pound;<span id="shipping-total"></span></label>
                    </div>
                    <div class="form-group text-size">
                        <label><b>Order Total: </b> &pound;<span id="order-total"></span></label>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- View Order Modal --}}

@endsection

@section('javascript')
    <script src="{{url('backend/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous" ></script>
    <script src="{{url('backend/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{url('backend/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
    <script src="{{url('backend/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{url('backend/app-assets/js/scripts/forms/form-select2.js')}}"></script>
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
            $("#orderstatus").change(function(){
                var value = $(this).val();
                if(value == 5){
                    $(".reason").slideDown();
                }
                else{
                    $(".reason").slideUp();
                    $(".alert-warning").slideUp();
                }
            });
            $(".btn-update").click(function(){
                $("#order-modal").modal('show');
                var status = $(this).data('status');
                var reason = $(this).data('reason');
                var id = $(this).data('id');
                $("#orderstatus").val(status);
                $("#id").val(id);
                if(status == 5){
                    $(".reason").slideDown();
                    $("#reason").val(reason);
                }
            });

            $(".btn-submit").click(function(){
                var id = $("#id").val();
                var status = $("#orderstatus").val();
                var formData = new FormData();
                formData.append("_token", "{{ csrf_token() }}");
                formData.append('id' , id);
                formData.append('status' , status);

                if(status == 5){
                    var reason = $("#reason").val();
                    if (reason == "" || reason == undefined) {
                        $(".alert-body-warning").html("Please provide a reason.");
                        $(".alert-warning").slideDown();
                        return;
                    }
                    formData.append('reason' , reason);
                }

                $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");
                $(this).attr("disabled", "disabled");
                $.ajax({
                    type : "POST",
                    url : "/dashboard/order-status/update",
                    data : formData,
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
                        else if(response['status'] == "error"){
                            $(".alert-body-warning").html(response['message']);
                            $(".alert-warning").slideDown();
                            $(".alert-success").slideUp();
                            $(".btn-submit").html("Submit");
                            $(".btn-submit").removeAttr("disabled");
                        }
                    }
                });
            });

            $(".btn-delete").click(function(){
                var id = $(this).data('id');
                var link = '/dashboard/customer/order/delete?id=' + id;
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

            $(".btn-view").click(function(){
                var orderid = $(this).data('id');
                var link = '/dashboard/customer/order/view?id=' + orderid;
                $.get(link , function(res){
                    if(res['status'] == "success"){
                        var data = res['data'];
                        $("#orderid").html(data['orderno']);
                        $("#cust_name").html(data['custname']);
                        $("#cust_phone").html(data['custphone']);
                        $("#cust_address").html(data['custaddress']);
                        $("#cust_postalcode").html(data['custpostalcode']);
                        var status = data['status'];
                        if(status == "Delivered"){
                            $("#status").html('<div class="badge badge-glow badge-success">'+ status +'</div>');
                        }
                        else if(status == "Returned" || status == "Cancelled"){
                            $("#status").html('<div class="badge badge-glow badge-danger">'+ status +'</div>');
                        }
                        else if(status == "Confirmed"){
                            $("#status").html('<div class="badge badge-glow badge-success">'+ status +'</div>');
                        }
                        else if(status == "Pending"){
                            $("#status").html('<div class="badge badge-glow badge-warning">'+ status +'</div>');
                        }
                        else{
                            $("#status").html('<div class="badge badge-glow badge-info">'+ status +'</div>');
                        }

                        var paymentstatus = data['paymentstatus'];
                        if(paymentstatus == "Paid"){
                            $("#payment-status").html('<div class="badge badge-glow badge-success">'+ paymentstatus +'</div>');
                        }
                        else if(paymentstatus == "Not Paid"){
                            $("#payment-status").html('<div class="badge badge-glow badge-danger">'+ paymentstatus +'</div>');
                        }
                        $("#tracking-id").html(data['trackingid']);
                        $("#shipping-total").html(data['shippingtotal']);
                        $("#order-total").html(data['ordertotal']);
                        var products = data['products'];
                        var productsTable = '<thead><tr><th>Title</th><th>Quantity</th><th>Price</th><th>Total</th></tr></thead><tbody>';
                        for (var i = 0; i < products.length; i++) {
                            productsTable += '<tr>';
                            productsTable += '<td>' + products[i]['proname'] + '</td>';
                            productsTable += '<td>' + products[i]['proqty'] + '</td>';
                            productsTable += '<td> &pound;' + products[i]['proprice'] + '</td>';
                            productsTable += '<td> &pound;' + products[i]['prototal'] + '</td>';
                            productsTable += '</tr>';
                        }
                        productsTable += '</tbody></table>';
                        $("#table-products").html(productsTable);
                        $("#view-modal").modal('show');
                    }
                });
            });
        });

    </script>
@stop