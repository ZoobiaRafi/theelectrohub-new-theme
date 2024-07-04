@extends ('frontend.layout.master')

@section('title')
My Account | The Electrohub
@endsection

@section('meta')
@endsection

@section('css')
<style>
    .u-slick__arrow-classic:hover {
        color: var(--white) !important;
    }

    .u-slick__arrow-classic-inner:before {
        color: var(--primary);
    }

    .h-350 {
        height: 350px;
    }

    @media only screen and (max-width: 600px) {
        .h-350 {
            height: auto;
        }

    }

    @media (min-width: 768px) {
        .u-header--white-nav-links-md:not(.bg-white):not(.js-header-fix-moment) .u-header__nav-link {
            color: #333e48 !important;
        }
    }
</style>
<link rel="stylesheet" href="{{url('frontend/assets/css/account.css')}}">

@endsection

@section('content')
<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main">
    <div class="bg-gray-13 bg-md-transparent pt-20">
        {{-- <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('homePage')}}">Home</a></li>
        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Track your Order</li>
        </ol>
        </nav>
    </div>
    <!-- End breadcrumb -->
    </div> --}}
    </div>
    <div class="account mb-6">
        <div class="container">
            <div class="mb-6 text-center">
                <h1 class="mb-6">My Account</h1>
                <!-- <p class="text-gray-90 px-xl-10">To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p> -->
            </div>
            <div class="row">
                <!-- <div class="col-md-12 col-sm-12 col-lg-12 d-grid align-items-center justify-content-center">
                        <h3>My Account</h3>
                    </div> -->
                <div class="tab-main col-md-12">

                    <div class="tab">
                        <button class="tablinks" onclick="openTab(event, 'profile')" id="defaultOpen">My
                            Profile</button>
                        <button class="tablinks" onclick="openTab(event, 'history')">Order History</button>
                        <button class="tablinks" onclick="openTab(event, 'all')">All Ordered
                            Products</button>
                        <button class="tablinks" onclick="openTab(event, 'password')">Change Password</button>
                    </div>

                    <div id="profile" class="tabcontent">
                        <div class="d-grid align-items-center justify-content-center">
                            <h3 class="tab-title">My Profile</h3>

                        </div>
                        <div class="profile-details">
                            @if($UserID != 0)
                            @php
                            $nameParts = explode(' ', $user->name, 2);
                            $firstName = $nameParts[0];
                            $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
                            @endphp
                            <div class="row mb-3">
                                <label class="col-lg-4 col-4 col-form-label fw-semibold">Full Name</label>

                                <div class="col-lg-8 col-8">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="hidden" name="user" id="user" value="{{$user->id}}">
                                            @if($firstName != null)
                                            <input type="text" name="fname" id="first-name" class="form-control form-control-lg mb-3 mb-lg-0" placeholder="First name" value="{{$firstName}}">
                                            @else
                                            <input type="text" name="fname" id="first-name" class="form-control form-control-lg mb-3 mb-lg-0" placeholder="Enter your first name">
                                            @endif
                                        </div>

                                        <div class="col-lg-6">
                                            @if($lastName != null)
                                            <input type="text" name="lname" id="last-name" class="form-control form-control-lg" placeholder="Last name" value="{{$lastName}}">
                                            @else
                                            <input type="text" name="lname" id="last-name" class="form-control form-control-lg" placeholder="Enter your last name">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-4 col-form-label fw-semibold">Email</label>

                                <div class="col-lg-8 col-8">
                                    <input type="email" name="email" class="form-control form-control-lg" disabled value="{{$user->email}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-4 col-form-label fw-semibold">Contact Number</label>

                                <div class="col-lg-8 col-8">
                                    @if($user->contact_no != null)
                                    <input type="tel" name="phone" id="phone-no" class="form-control form-control-lg" placeholder="Phone number" value="{{$user->contact_no}}">
                                    @else
                                    <input type="tel" name="phone" id="phone-no" class="form-control form-control-lg" placeholder="Enter your contact number">
                                    @endif
                                </div>
                            </div>

                            <!-- <div class="row mb-3">
                                <label class="col-lg-4 col-form-label fw-semibold">Company Site</label>

                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="website" class="form-control form-control-lg" placeholder="Company website" value="max@teh.com">
                                </div>
                            </div> -->
                            @else
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label fw-semibold">Full Name</label>

                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="text" name="fname" class="form-control form-control-lg mb-3 mb-lg-0" placeholder="First name">
                                        </div>

                                        <div class="col-lg-6">
                                            <input type="text" name="lname" class="form-control form-control-lg" placeholder="Last name">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label fw-semibold">Company</label>

                                <div class="col-lg-8">
                                    <input type="text" name="company" class="form-control form-control-lg" placeholder="Company name" value="Electrohub">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label fw-semibold">Contact Phone</label>

                                <div class="col-lg-8">
                                    <input type="tel" name="phone" class="form-control form-control-lg" placeholder="Phone number" value="044 3276 454 935">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label fw-semibold">Company Site</label>

                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="website" class="form-control form-control-lg" placeholder="Company website" value="max@teh.com">
                                </div>
                            </div>
                            @endif
                            <div class="button-div row mb-0">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-save" id="btn-save">Save Changes</button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div id="history" class="tabcontent">
                        <div class="d-grid align-items-center justify-content-center">
                            <h3 class="tab-title">Order History</h3>

                        </div>
                        <div class="history-details">
                            <div class="table-responsive">
                                <table class="table" id="history_table">
                                    <thead>
                                        <tr>
                                            <th>Order No.</th>
                                            <th>Postal Code</th>
                                            <th>Payment Method</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order_items as $order)
                                        <tr>
                                            <td>#{{$order->order_no}}</td>
                                            <td>{{$order->postal_code}}</td>
                                            <td>{{$order->payment_gateway}}</td>
                                            <td>{{ date("d-m-Y", $order->created_at->timestamp) }}</td>
                                            <td>{{$order->status_detail ? $order->status_detail->title : ''}}</td>
                                            <td>&pound;{{$order->order_total}}</td>
                                            <td>
                                                <a href="javascript:void(0);" data-orderid="{{ $order->order_no }}" class="btn w-100 px-5 btn-primary-dark transition-3d-hover btn-reorder"><i class="ec ec-returning mr-2 font-size-15"></i> Reorder</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="all" class="tabcontent">
                        <div class="d-grid align-items-center justify-content-center">
                            <h3 class="tab-title">All Ordered Products</h3>

                        </div>
                        <div class="all-orders">
                            <div class="table-responsive">
                                <table class="table" id="all_orders_table">
                                    <thead>
                                        <tr>
                                            <th>Order No.</th>
                                            <th>Product</th>
                                            <th>Date</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order_items as $order)
                                            @foreach ($order->order_products as $product)
                                                <tr>
                                                    <td>#{{$order->order_no}}</td>
                                                    <td title="{{$product->product_detail->title}}" class="color-theme-blue">{{$product->product_detail->title}}</td>
                                                    <td>{{ date("d-m-Y", $product->product_detail->created_at->timestamp) }}</td>
                                                    <td>{{$product->quantity}}</td>
                                                    <td>&pound;{{$product->price}}</td>
                                                    <td>&pound;{{number_format((($product->price) * ($product->quantity)),2)}}</td>
                                                    <td>
                                                        <a href="{{ route('listwholeorder', ['id' => $order->order_no]) }}" class="btn w-100 px-5 btn-primary-dark transition-3d-hover btn-reorder"><i class="ec ec-returning mr-2 font-size-10"></i> Reorder</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <div id="password" class="tabcontent">
                        <div class="d-grid align-items-center justify-content-center">
                            <h3 class="tab-title">Change Password</h3>

                        </div>
                        <div class="password-detail">
                            <div class="row mb-3">
                                <label class="col-lg-4 col-4 col-form-label fw-semibold">Old Password</label>

                                <div class="col-lg-8 col-8">
                                    <input type="password" name="current-pass" id="current-pass" class="form-control form-control-lg" placeholder="Enter your current password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-4 col-form-label fw-semibold">New Password</label>

                                <div class="col-lg-8 col-8">
                                    <input type="password" name="new-pass" id="new-pass" class="form-control form-control-lg" placeholder="Enter your new password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-4 col-form-label fw-semibold">Confirm Password</label>

                                <div class="col-lg-8 col-8">
                                    <input type="password" name="confirm-pass" id="confirm-pass" class="form-control form-control-lg" placeholder="Confirm your password">
                                </div>
                            </div>

                            <div class="button-div row mb-0">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-save" id="save-pwd">Save Password</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->
@endsection

@section('js')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script>
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
<script>
    $(document).ready(function() {
        new DataTable('#history_table');
        new DataTable('#all_orders_table');

        $('#btn-save').on("click", function() {
            var fname = $("#first-name").val();
            var lname = $("#last-name").val();
            var phone = $("#phone-no").val();
            var user = $("#user").val();

            $.ajax({
                url: "{{route('userupdate')}}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    userid: user,
                    contact_no: phone,
                    lastname: lname,
                    firstname: fname,
                },
                success: function(response) {
                    if (response['status'] == "success") {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "bottom",
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                // toast.style.background = '#ffa366';
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });

                        Toast.fire({
                            icon: "success",
                            title: response.message
                        });

                    }
                }
            });

        });

        $("#save-pwd").on("click", function() {
            var currpass = $("#current-pass").val();
            var newpass = $("#new-pass").val();
            var confpass = $("#confirm-pass").val();
            var userid = $("#user").val();

            // console.log("cur ="+ currpass + " newpass= " +newpass +" confpass= "+ confpass+" userid= "+userid);
            $.ajax({
                url: "{{route('updateUserPassword')}}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    userid: userid,
                    old_password: currpass,
                    new_password: newpass,
                    confirm_password: confpass,
                },
                success: function(response) {
                    if (response['status'] == "success") {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "bottom",
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                // toast.style.background = '#ffa366';
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });

                        Toast.fire({
                            icon: "success",
                            title: response.message
                        });
                    }
                    if (response['status'] == "error") {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "bottom",
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                // toast.style.background = '#ffa366';
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });

                        Toast.fire({
                            icon: "error",
                            title: response.message
                        });
                    }
                }
            });
        });

        $(".btn-reorder").click(function(){
            var orderid = $(this).data('orderid');
            var link = '/re-order?id=' + orderid;
            $.get(link  , function(res){
                if(res['status'] == "success"){
                    setTimeout(() => {
                        window.location.href = res['redirect'];
                    }, 1000);
                }
            });
        });
    });
</script>
@endsection