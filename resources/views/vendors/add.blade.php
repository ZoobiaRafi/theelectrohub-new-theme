@extends('/layouts/master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/forms/select/select2.min.css')}}">
@stop

@section('title')
    <title>Add Vendor</title>
@stop
@section('body')
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row"></div>
    <div class="content-body">
        <form method="post" action = "/dashboard/add-vendors/submit">
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
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Enter name">
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input name="email" type="email" class="form-control" placeholder="Enter email">
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <div class="form-group">
                        <label for="name">Phone</label>
                        <input id="phone" name="phone" type="text" class="form-control" placeholder="Enter Phone">
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <div class="form-group">
                        <label for="name">Address</label>
                        <input name="address" type="text" class="form-control" placeholder="Enter address">
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <div class="form-group">
                        <label for="name">Website</label>
                        <input name="website" type="text" class="form-control" placeholder="Enter Website">
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <div class="form-group">
                        <label for="name">Contact Person Name</label>
                        <input name="contact_person_name" type="text" class="form-control" placeholder="Enter Contact Person Name">
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <div class="form-group">
                        <label for="name">Contact Person Email</label>
                        <input name="contact_person_email" type="email" class="form-control" placeholder="Enter Contact Person Email">
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <div class="form-group">
                        <label for="name">Contact Person Phone</label>
                        <input name="contact_person_phone" id="contact_person_phone" type="text" class="form-control" placeholder="Enter Contact Person Phone">
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <div class="form-group">
                        <label for="name">Business Nature</label>
                        <input name="business_nature" type="text" class="form-control" placeholder="Enter Business Nature">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $("#phone").mask('99999-999999');
            $("#contact_person_phone").mask('99999-999999');
        });
    </script>
@endsection