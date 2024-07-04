@extends('/layouts/master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/forms/select/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
@stop

@section('title')
    <title>Add Coupon Code</title>
@stop
@section('body')
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row"></div>
    <div class="content-body">
        <form method="post" action = "/dashboard/add-coupon-code/submit">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <div class="alert-body">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if(Session::has('error'))
                {{Session::has('error')}}
            @endif
            <div class="row">
                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <div class="form-group">
                        <label for="name">Title</label>
                        <input name="title" type="text" class="form-control" placeholder="Enter Coupon Title">
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <div class="form-group">
                        <label for="name">Code</label>
                        <input name="code" type="text" class="form-control" placeholder="Enter Code">
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <div class="form-group">
                        <label for="name">Discount</label>
                        <input name="discount" type="text" class="form-control" placeholder="Enter Discount">
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <label>Expiry Date</label>
                    <div class="form-group">
                        <input type="hidden" id="expiry-date-input" name="expiry_date" class="form-control flatpickr-human-friendly flatpickr-input">
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <label>Type: </label>
                    <div class="form-group">
                        <select class="form-control" name="type">
                            <option disabled>Please Select</option>
                            <option value="1" selected>Flat</option>
                            <option value="0">Discount</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <label>Status: </label>
                    <div class="form-group">
                        <select class="form-control" name="status">
                            <option disabled>Please Select</option>
                            <option value="1" selected>Active</option>
                            <option value="0">In Active</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <label>Coupon Type: </label>
                    <div class="form-group">
                        <select id="coupon_type" class="form-control" name="coupon_type">
                            <option disabled>Please Select</option>
                            <option value="1" selected>General</option>
                            <option value="2">Category Only</option>
                            <option value="3">Product Only</option>
                            <option value="4">User Only</option>
                            <option value="5">Category & User</option>
                            <option value="6">Product & User</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12 mb-1 category" style="display: none;">
                    <label>Category: </label>
                    <div class="form-group">
                        <select class="select2 form-control" name="cat_ids[]" multiple>
                            <option disabled>Please Select</option>
                            @foreach($category as $c)
                                <option value="{{$c->id}}">{{ucwords($c->title)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12 mb-1 product" style="display: none;">
                    <label>Products: </label>
                    <div class="form-group">
                        <select class="select2 form-control" name="pro_ids[]" multiple>
                            <option disabled>Please Select</option>
                            @foreach($product as $p)
                                <option value="{{$p->id}}">{{ucwords($p->title)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12 mb-1 users" style="display: none;">
                    <label>Users: </label>
                    <div class="form-group">
                        <select class="select2 form-control" name="user_ids[]" multiple>
                            <option disabled>Please Select</option>
                            @foreach($alluser as $u)
                                <option value="{{$u->id}}">{{ucwords($u->name)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-xl-12 col-md-6 col-12 mb-1">
                    <div class="demo-inline-spacing">
                        <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">Submit</button>
                    </div> 
                </div>        
            </div>
        </form>
    </div>
</div>
@endsection

@section('javascript')
    <script src="{{url('backend/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{url('backend/app-assets/js/scripts/forms/form-select2.js')}}"></script>
    <script src="{{url('backend/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{url('backend/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
    <script>
        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
        var day = currentDate.getDate().toString().padStart(2, '0');
        var formattedDate = year + "-" + month + "-" + day;
        document.getElementById('expiry-date-input').value = formattedDate;
        
        $(document).ready(function(){
            $("#coupon_type").change(function(){
                var id = $(this).val();
                if(id == 2){
                    $(".category").slideDown();
                    $(".product").hide();
                    $(".users").hide();
                }
                else if(id == 3){
                    $(".category").hide();
                    $(".product").slideDown();
                    $(".users").hide();
                }
                else if(id == 4){
                    $(".category").hide();
                    $(".product").hide();
                    $(".users").slideDown();
                }
                else if(id == 5){
                    $(".category").slideDown();
                    $(".product").hide();
                    $(".users").slideDown();
                }
                else if(id == 6){
                    $(".category").hide();
                    $(".product").slideDown();
                    $(".users").slideDown();
                }
            });
        });
    </script>
@endsection