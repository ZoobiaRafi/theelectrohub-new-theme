@extends('/layouts/master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/forms/select/select2.min.css')}}">
@stop

@section('title')
    <title>Edit Faq</title>
@stop
@section('body')
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row"></div>
    <div class="content-body">
        <form method="post" action = "/dashboard/edit-faq/{{$faq->id}}/submit">
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
                <div class="col-xl-12 col-md-12 col-12 mb-1">
                    <div class="form-group">
                        <label for="name">Question</label>
                        <input value="{{$faq->question}}" name="question" type="text" class="form-control" placeholder="Enter Question">
                    </div>
                </div>
                <div class="col-xl-12 col-md-12 col-12 mb-1">
                    <label for="answer">Answer</label>
                    <div class="form-label-group mb-0">
                        <textarea data-length="250" class="form-control char-textarea" name="answer" rows="3" placeholder="Answer">{{$faq->answer}}</textarea>
                    </div>
                    <small class="textarea-counter-value float-right"><span class="char-count">0</span> / 250 </small>
                </div>
                
                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <label>Status: </label>
                    <div class="form-group">
                        <select class="form-control" name="status">
                            <option disabled>Please Select</option>
                            <option @if($faq->status == 1) selected @endif value="1">Active</option>
                            <option @if($faq->status == 0) selected @endif value="0">In Active</option>
                        </select>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <label>Type: </label>
                    <div class="form-group">
                        <select class="form-control" id="type" name="type">
                            <option disabled selected>Please Select</option>
                            <option @if($faq->type == 1) selected @endif value="1">General</option>
                            <option @if($faq->type == 2) selected @endif value="2">Category</option>
                            <option @if($faq->type == 3) selected @endif value="3">Product</option>
                        </select>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-12 mb-1 category" @if($faq->type == 2) style="display: block;" @else style="display: none;" @endif>
                    <label>Category: </label>
                    <div class="form-group">
                        @php
                            $selectcatids = $faq->category->pluck('category_id')->toArray();
                        @endphp
                        <select class="select2 form-control" name="cat_ids[]" multiple>
                            <option disabled>Please Select</option>
                            @foreach($category as $c)
                                <option @if(in_array($c->id, $selectcatids)) selected @endif value="{{$c->id}}">{{ucwords($c->title)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12 mb-1 product" @if($faq->type == 3) style="display: block;" @else style="display: none;"  @endif>
                    <label>Products: </label>
                    <div class="form-group">
                        @php
                            $selectproids = $faq->product->pluck('product_id')->toArray();
                        @endphp
                        <select class="select2 form-control" name="pro_ids[]" multiple>
                            <option disabled>Please Select</option>
                            @foreach($product as $p)
                                <option @if(in_array($p->id, $selectproids)) selected @endif value="{{$p->id}}">{{ucwords($p->title)}}</option>
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
    <script>

        $(document).ready(function(){
            $("#type").change(function(){
                var id = $(this).val();
                if(id == 2){
                    $(".category").slideDown();
                    $(".product").hide();
                }
                else if(id == 3){
                    $(".category").hide();
                    $(".product").slideDown();
                }
                else if(id == 1){
                    $(".category").hide();
                    $(".product").hide();
                }
            });
        });
    </script>
@endsection