@extends('/layouts/master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/forms/select/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
@stop

@section('title')
    <title>Edit Coupon Code</title>
@stop
@section('body')
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row"></div>
    <div class="content-body">
        <form method="post" action = "/dashboard/edit-coupon-code/{{$couponcode->id}}/submit">
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
                        <input value="{{ucwords($couponcode->title)}}" name="title" type="text" class="form-control" placeholder="Enter Coupon Title">
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <div class="form-group">
                        <label for="name">Code</label>
                        <input value="{{ucwords($couponcode->code)}}" name="code" type="text" class="form-control" placeholder="Enter Code">
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <div class="form-group">
                        <label for="name">Discount</label>
                        <input value="{{number_format($couponcode->discount , 2)}}" name="discount" type="text" class="form-control" placeholder="Enter Discount">
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <label>Expiry Date</label>
                    <div class="form-group">
                        <input value="{{$couponcode->expiry_date}}" type="hidden" id="expiry-date-input" name="expiry_date" class="form-control flatpickr-human-friendly flatpickr-input">
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <label>Type: </label>
                    <div class="form-group">
                        <select class="form-control" name="type">
                            <option disabled>Please Select</option>
                            <option value="1" @if($couponcode->type == 1) selected @endif>Flat</option>
                            <option value="0" @if($couponcode->type == 0) selected @endif>Discount</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <label>Status: </label>
                    <div class="form-group">
                        <select class="form-control" name="status">
                            <option disabled>Please Select</option>
                            <option value="1" @if($couponcode->status == 1) selected @endif>Active</option>
                            <option value="0" @if($couponcode->status == 0) selected @endif>In Active</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <label>Coupon Type: </label>
                    <div class="form-group">
                        <select id="coupon_type" class="form-control" name="coupon_type">
                            <option disabled>Please Select</option>
                            <option value="1" @if($couponcode->coupon_type == 1) selected @endif>General</option>
                            <option value="2" @if($couponcode->coupon_type == 2) selected @endif>Category Only</option>
                            <option value="3" @if($couponcode->coupon_type == 3) selected @endif>Product Only</option>
                            <option value="4" @if($couponcode->coupon_type == 4) selected @endif>User Only</option>
                            <option value="5" @if($couponcode->coupon_type == 5) selected @endif>Category & User</option>
                            <option value="6" @if($couponcode->coupon_type == 6) selected @endif>Product & User</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12 mb-1 category" @if($couponcode->coupon_type == 2 || $couponcode->coupon_type == 5) style="display: block;" @else style="display: none;" @endif>
                    <label>Category: </label>
                    <div class="form-group">
                        <select class="select2 form-control" name="cat_ids[]" multiple>
                            @php
                                $selectcatids = $couponcode->category_detail->pluck('cat_id')->toArray();
                            @endphp
                            <option disabled>Please Select</option>
                            @foreach($category as $c)
                                <option @if(in_array($c->id, $selectcatids)) selected @endif value="{{$c->id}}">{{ucwords($c->title)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12 mb-1 product" @if($couponcode->coupon_type == 3 || $couponcode->coupon_type == 6) style="display: block;" @else style="display: none;" @endif>
                    <label>Products: </label>
                    <div class="form-group">
                        <select class="select2 form-control" name="pro_ids[]" multiple>
                            @php
                                $selectproids = $couponcode->product_detail->pluck('product_id')->toArray();
                            @endphp
                            <option disabled>Please Select</option>
                            @foreach($product as $p)
                                <option @if(in_array($p->id, $selectproids)) selected @endif value="{{$p->id}}">{{ucwords($p->title)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12 mb-1 users" @if($couponcode->coupon_type == 4 || $couponcode->coupon_type == 5 || $couponcode->coupon_type == 6) style="display: block;" @else style="display: none;" @endif>
                    <label>Users: </label>
                    <div class="form-group">
                        <select class="select2 form-control" name="user_ids[]" multiple>
                            @php
                                $selectuserids = $couponcode->user->pluck('user_id')->toArray();
                            @endphp
                            <option disabled>Please Select</option>
                            @foreach($alluser as $u)
                                <option @if(in_array($u->id, $selectuserids)) selected @endif value="{{$u->id}}">{{ucwords($u->name)}}</option>
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