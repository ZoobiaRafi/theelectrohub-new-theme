@extends('/layouts/master')
@section('css')
<link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
<link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/extensions/toastr.min.css')}}">
@stop

@section('title')
<title>Product</title>
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
            <div class="col-xl-12 col-md-12 col-12 mb-1 text-center">
                <h4>Showing <span>
                        <div class="badge badge-success">{{$procount}}</div> Products
                    </span></h4>
            </div>

            <div class="col-xl-6 col-md-6 col-12 mb-1">
                <div class="form-group">
                    <input type="text" class="form-control" id="search-fields" placeholder="Search Product">
                </div>
            </div>
            @can('add' , app('App\Product'))
            <div class="col-xl-6 col-md-6 col-12 mb-1">
                {{-- <div class="col-xl-1 col-md-1 col-12 mb-1"> --}}
                <button data-action='add' type="button" class="btn btn-outline-primary waves-effect add-product"><i class="fa-light fa-plus"></i> &nbsp;Add Product</button>
                {{-- </div> --}}
                {{-- <div class="col-xl-1 col-md-1 col-12 mb-1"> --}}
                <button type="button" class="btn btn-outline-primary waves-effect mla-csv"><i class="fa-light fa-cloud-arrow-up"></i> &nbsp;Mla CSV</button>
                {{-- </div> --}}
                {{-- <div class="col-xl-2 col-md-1 col-12 mb-1"> --}}
                <button type="button" class="btn btn-outline-primary waves-effect saxbe-csv"><i class="fa-light fa-cloud-arrow-up"></i> &nbsp;SaxBe CSV</button>
                {{-- </div> --}}
                {{-- <div class="col-xl-2 col-md-1 col-12 mb-1"> --}}
                <button type="button" class="btn btn-outline-primary waves-effect scoll-csv"><i class="fa-light fa-cloud-arrow-up"></i> &nbsp;Scoll CSV</button>
                <button type="button" class="btn btn-outline-primary waves-effect lw-csv"><i class="fa-light fa-cloud-arrow-up"></i> &nbsp;LW CSV</button>
                <button type="button" class="btn btn-outline-primary waves-effect price-csv"><i class="fa-light fa-cloud-arrow-up"></i> &nbsp;PriceImporter CSV</button>
                <button type="button" class="btn btn-outline-primary waves-effect update-catid"><i class="fa-light fa-cloud-arrow-up"></i> &nbsp;Update Category</button>
                {{-- </div> --}}
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
                                    <!--<th>Product ID</th>-->
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Product Code</th>
                                    <th>Vendor</th>
                                    <th>Vendor Price</th>
                                    <th>Percentage</th>
                                    <th>Retail Price</th>
                                    <!-- <th>Price</th> -->
                                    <th>Short Description</th>
                                    <th>Description</th>
                                    <th>Popular</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($product->count() > 0)
                                @foreach($product as $all)
                                <tr id="row-{{$all->id}}">
                                    <!--<td>{{$all->id}}</td>-->
                                    <td>
                                        <div class="image-container">
                                            <a class="fancybox" href="/{{$all->image}}" data-fancybox="images">
                                                <img class="main-image" src="/{{$all->image}}" height="50" width="50" alt="{{ $all->title }}">
                                            </a>
                                            @php
                                                $images = json_decode($all->uploader_image, true);
                                            @endphp
                                            @if($images && is_array($images))
                                                @foreach ($images as $image)
                                                    <a class="fancybox" href="/{{ $image }}" data-fancybox="images">
                                                        <img class="additional-image" src="/{{ $image }}" height="50" width="50" alt="{{ $all->title }}">
                                                    </a>
                                                @endforeach
                                            @endif
                                        </div>
                                        
                                    </td>
                                    <td>{{ucwords($all->title)}}</td>
                                    <td><a target="_blank" href="https://www.mlaccessories.co.uk/search?query={{$all->product_code}}">{{$all->product_code}}</a></td>
                                    <td>
                                        @if($all->percentage == "" || $all->percentage == null )
                                            {{ $all->vendor->vendor_name . "(" . $all->vendor->percentage . "%)" }}
                                        @endif
                                    </td>
                                    <td>{{ number_format(floatval($all->vendor_price), 2) }}</td>
                                    <td>
                                        @if($all->percentage != "" || $all->percentage != null )
                                            {{ "Custom ". $all->percentage . " %"  }}
                                        @else
                                            {{ "" }}
                                        @endif
                                    </td>
                                    <td>&pound;{{ number_format(floatval($all->price), 2) }}</td>
                                    <td>{{ substr($all->overview, 0, 50) }}</td>
                                    <td>{{ substr($all->long_description, 0, 50) }}</td>
                                    <td>
                                        <div class="custom-control custom-switch custom-switch-success">
                                            <input data-title="{{$all->title}}" data-id="{{$all->id}}" type="checkbox" class="custom-control-input popular" id="popular-{{$all->id}}" @if($all->popular_status == 1) checked="" @endif>
                                            <label class="custom-control-label" for="popular-{{$all->id}}">
                                                <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg></span>
                                                <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                                    </svg></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-control custom-switch custom-switch-success">
                                                <input data-title="{{$all->title}}" data-id="{{$all->id}}" type="checkbox" class="custom-control-input status" id="status-{{$all->id}}" @if($all->status == 1) checked="" @endif>
                                                <label class="custom-control-label" for="status-{{$all->id}}">
                                                    <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                        </svg></span>
                                                    <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg></span>
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        
                                        @if(isset($all->datasheet_url))
                                        <a href="{{$all->datasheet_url}}" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Datasheet" class="btn btn-outline-primary waves-effect mb-1 status-product"><i class="fa-light fa-file-pdf"></i></a>
                                        @endif
                                        @can('edit' , app('App\Product'))
                                        @php
                                        $catids = "";
                                        if(isset($all->product_to_category)){
                                        foreach($all->product_to_category as $cat){
                                        if($catids != ""){
                                        $catids .= "," . $cat->cat_id ;
                                        }
                                        else{
                                        $catids = $cat->cat_id;
                                        }
                                        }
                                        }
                                        @endphp
                                        <button data-vendorid="{{$all->vendor_id}}" data-id="{{$all->id}}" data-catid="{{$catids}}" data-title="{{$all->title}}" data-slug="{{$all->slug}}" data-price="{{$all->price}}" data-vendorprice="{{$all->vendor_price}}" data-product-percent="{{$all->percentage}}"  data-vendor-percentage="{{$all->vendor->percentage}}" data-qty="{{$all->qty}}" data-description = "{{ $all->long_description }}" data-shortdescription = "{{ $all->overview }}" @if($all->sale == 1) data-sale = "{{$all->sale}}" data-discounttype = "{{$all->discount_type}}" data-discount = "{{$all->discount}}" data-startdate = "{{$all->start_date}}" data-enddate = "{{$all->end_date}}" @endif type="button" data-toggle="tooltip" data-placement="top" data-original-title="Update" class="btn btn-outline-success waves-effect mb-1 btn-update"><i class="fa-light fa-pen-to-square"></i></button>
                                        @endcan
                                        @can('delete' , app('App\Product'))
                                        <button data-id="{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="btn btn-outline-warning waves-effect mb-1 btn-delete"><i class="fa-thin fa-trash"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="9" class="text-center"><b>No Products Found</b></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if($product->count() > 0)
            <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                <div>
                    <div>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination mt-2">
                                <li title="First Page" class="page-item"><a class="page-link" href="{{ $product->appends(request()->query())->url(1) }}"><i data-feather='rewind'></i></a></li>
                                @if ($product->currentPage() == 1)
                                <li class="page-item prev disabled"><span class="page-link"></span></li>
                                @else
                                <li class="page-item prev"><a class="page-link" href="{{ $product->appends(request()->query())->previousPageUrl() }}"></a></li>
                                @endif

                                @php
                                $startPage = max(1, $product->currentPage() - 5);
                                $endPage = min($product->lastPage(), $product->currentPage() + 5);
                                @endphp

                                @for ($page = $startPage; $page <= $endPage; $page++) @if ($page==$product->currentPage())
                                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                    @else
                                    <li class="page-item"><a class="page-link" href="{{ $product->appends(request()->query())->url($page) }}">{{ $page }}</a></li>
                                    @endif
                                    @endfor

                                    @if ($product->hasMorePages())
                                    <li class="page-item next"><a class="page-link" href="{{ $product->appends(request()->query())->nextPageUrl() }}"></a></li>
                                    @else
                                    <li class="page-item next disabled"><span class="page-link"></span></li>
                                    @endif
                                    <li title="Last Page" class="page-item"><a class="page-link" href="{{ $product->appends(request()->query())->url($product->lastPage()) }}"><i data-feather='fast-forward'></i></a></li>
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
<div class="modal fade text-left" id="add-product-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#">
                <div class="modal-body">
                    <div class="alert alert-success" style="display: none;" role="alert">
                        <p class="alert-body alert-body-success"></p>
                    </div>
                    <div class="alert alert-warning" style="display: none;" role="alert">
                        <p class="alert-body alert-body-warning"></p>
                    </div>
                    <input type="hidden" id="id">
                    <label>Title: </label>
                    <div class="form-group">
                        <input id="title" type="text" placeholder="Enter Title" class="form-control" />
                        <div class="feedback" style="display: none;"></div>
                    </div>
                    <div class="form-group status">
                        <label>Vendor: </label>
                        <select class="form-control" id="vendor">
                            <option disabled>Please Select</option>
                            @foreach($vendors as $v)
                            <option data-percentage = "{{$v->percentage}}" value="{{$v->id}}">{{$v->vendor_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group slug" style="display:none;">
                        <label>Slug: </label>
                        <input id="slug" type="text" placeholder="Enter Slug" class="form-control" />
                        <div class="feedback" style="display: none;"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="price">Retail Price:</label>
                            <input id="price" type="text" placeholder="Enter Price" disabled class="form-control" />
                            <div class="feedback" style="display: none;"></div>
                        </div>
                        <div class="form-group col-md-4"  style="display:none;">
                            <label>Quantity: </label>
                            <input id="quantity" type="text" placeholder="Enter Quantity" class="form-control" />
                            <div class="feedback" style="display: none;"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="vendor_price">Vendor Price:</label>
                            <input id="vendor_price" type="text" placeholder="Enter Price" class="form-control" />
                            <div class="feedback" style="display: none;"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="product_percentage">Product Percentage</label>
                            <input id="product_percentage" type="text" placeholder="Enter Price" class="form-control" />
                            <div class="feedback" style="display: none;"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Short Description: </label>
                        <input id="short-description" type="text" placeholder="Enter Short Description" class="form-control" />
                        <div class="feedback" style="display: none;"></div>
                    </div>
                    
                    <div class="form-group">
                        <label>Description: </label>
                        <input id="description" type="text" placeholder="Enter Description" class="form-control" />
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
                        <label>Other Image: </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="multiple-image" multiple>
                            <label class="custom-file-label" for="multiple-image">Choose file</label>
                        </div>
                    </div>

                    <input type="hidden" id="cat-id">

                    <label>Category: </label>
                    <div class="form-group">
                        <select multiple class="form-control select2 cats-select">
                            <option disabled>Please Select</option>
                            @foreach($category as $c)
                                <option value="{{$c->id}}">{{ucwords($c->title)}}</option>
                                @foreach($c->sub_categories as $cc)
                                    <option value="{{$cc->id}}">{{ucwords($cc->title_with_category)}}</option>
                                    @foreach($cc->sub_categories as $ccc)
                                        <option value="{{$ccc->id}}">{{ucwords($ccc->title_with_category)}}</option>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group status">
                        <label>Status: </label>
                        <select class="form-control" id="status">
                            <option disabled>Please Select</option>
                            <option selected value="1">Active</option>
                            <option value="0">In Active</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sale: </label>
                        <select class="form-control" id="sale">
                            <option disabled>Please Select</option>
                            <option value="1">Yes</option>
                            <option selected value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group discount-type" style="display: none;">
                        <label>Discount type: </label>
                        <select class="form-control" id="discount_type">
                            <option disabled>Please Select</option>
                            <option selected value="1">Flat</option>
                            <option value="0">Percentage</option>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Add User Modal --}}

{{-- Upload Product Using CSV Start --}}
<div class="modal fade text-left" id="mla-csv-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Add Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="mla-upload-csv" action="/dashboard/mla/file-import" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-warning" style="display: none;" role="alert">
                        <p class="alert-body alert-body-warning"></p>
                    </div>
                    <div class="form-group">
                        <label>File: </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file_mla" name="file">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-mla-csv">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Upload Product Using CSV End --}}

{{-- Upload Product Using CSV Start --}}
<div class="modal fade text-left" id="saxbe-csv-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Add Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="saxbe-upload-csv" action="/dashboard/saxbe/file-import" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-warning" style="display: none;" role="alert">
                        <p class="alert-body alert-body-warning"></p>
                    </div>
                    <div class="form-group">
                        <label>File: </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file_saxbe" name="file">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-saxbe-csv">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Upload Product Using CSV End --}}

{{-- Upload Product Using CSV Start --}}
<div class="modal fade text-left" id="scollmore-csv-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Add Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="scollmore-upload-csv" action="/dashboard/scollmore/file-import" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-warning" style="display: none;" role="alert">
                        <p class="alert-body alert-body-warning"></p>
                    </div>
                    <div class="form-group">
                        <label>File: </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file_scoll" name="file">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-scollmore-csv">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Upload Product Using CSV End --}}

{{-- Upload Product Using CSV Start --}}
<div class="modal fade text-left" id="lw-csv-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Add Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="lw-upload-csv" action="/dashboard/lw/file-import" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-warning" style="display: none;" role="alert">
                        <p class="alert-body alert-body-warning"></p>
                    </div>
                    <div class="form-group">
                        <label>File: </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file_lw" name="file">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-lw-csv">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Upload Product Using CSV End --}}

<div class="modal fade text-left" id="update-catid-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Update Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update-cat-id" action="/dashboard/update-cat-id/file-import" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-warning" style="display: none;" role="alert">
                        <p class="alert-body alert-body-warning"></p>
                    </div>
                    <div class="form-group">
                        <label>File: </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file_cat_id" name="file">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-update-catid">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Upload Product Using CSV Start --}}
<div class="modal fade text-left" id="price-csv-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Add Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="price-upload-csv" action="/dashboard/price/file-import" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-warning" style="display: none;" role="alert"><p class="alert-body alert-body-warning"></p></div>
                    <div class="form-group">
                        <label>File: </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file_price" name="file">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-price-csv">Submit</button>
                </div>
            </form> 
        </div>
    </div>
</div>
{{-- Upload Product Using CSV End --}}
@endsection

@section('javascript')
<script src="{{url('backend/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
<script src="{{url('backend/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{url('backend/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
<script src="{{url('backend/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{url('backend/app-assets/js/scripts/forms/form-select2.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
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

    $(document).ready(function() {
        $(".j").fancybox({
            // You can add options here as needed
        });

        $("#vendor_price").on('input' , function(){
            var price = $(this).val();
            var selectedOption = $("#vendor").find('option:selected');
            var value = selectedOption.data('percentage');
            var productpercentage = $("#product_percentage").val();

            if(productpercentage == ''){
                var percentage = price * (value / 100);
                price = parseFloat(percentage) + parseFloat(price);
                $("#price").val(price);
            }
            else{
                var percentage = price * (productpercentage / 100);
                price = parseFloat(percentage) + parseFloat(price);
                $("#price").val(price);
            }
        });

        $("#product_percentage").on('input' , function(){
            var percentage = $(this).val();
            var price = $("#vendor_price").val();
            if(percentage > 0){
                var totalprice =  price * (percentage / 100); 
                price = parseFloat(totalprice) + parseFloat(price);
                $("#price").val(price);
            }
        });

        $(".popular").change(function() {
            var id = $(this).data('id');
            var title = $(this).data('title');
            var link = '/dashboard/product/popular-status/submit?id=' + id;
            $.get(link, function(res) {
                if (res['status'] == "success") {
                    toastr['success'](res['message'], 'Success!', {
                        closeButton: true,
                        tapToDismiss: false,
                    });
                }
            });
        });

        $(".status").change(function() {
            var id = $(this).data('id');
            var title = $(this).data('title');
            var link = '/dashboard/product/status/submit?id=' + id;
            $.get(link, function(res) {
                if (res['status'] == "success") {
                    toastr['success'](res['message'], 'Success!', {
                        closeButton: true,
                        tapToDismiss: false,
                    });
                } else if (res['status'] == "warning") {
                    toastr['warning'](res['message'], 'Warning', {
                        closeButton: true,
                        tapToDismiss: false,
                    });
                }
            });
        });

        $(".add-product").click(function() {
            $(".modal-title").html("Add New Product");
            $("#add-product-modal").modal('show');
            $("#title").val("");
            $("#slug").val("");
            $("#cat-id").val("");
            $("#price").val("");
            $("#quantity").val("");
            $(".slug").hide();
            $("#id").val("");
            $(".alert-success").slideUp();
            $(".alert-warning").slideUp();
        });

        $(".btn-update").click(function() {
            var action = $(this).data('action');
            if (action != "add") {
                var title = $(this).data('title');
                var slug = $(this).data('slug');
                var id = $(this).data('id');
                var categoryids = $(this).data('catid');
                var categoryidsStr = categoryids !== null && categoryids !== undefined ? categoryids.toString() : '';
        
                var catid = categoryidsStr.includes(",") ? categoryidsStr.split(',') : [categoryidsStr];
        
                var price = $(this).data('price');
                var vendor_price = $(this).data('vendorprice');
                var product_percentage = $(this).data('product-percent');
                var vendor_percentage = $(this).data('vendor-percentage');
                var qty = $(this).data('qty');
                var sale = $(this).data('sale');
                var description = $(this).data('description');
                var shortdescription = $(this).data('shortdescription');
                if (sale == 1) {
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
                $.each(catid, function(index, catid) {
                    $('.cats-select').find('option[value="' + catid + '"]').prop('selected', true);
                });
                $('.cats-select').trigger('change.select2');
                $("#cat-id").val($(this).data('catid'));
                // if (product_percent === null || product_percent.trim() === "") {
                //     $("#price").val(vendor_price + (vendor_price * (vendor_percentage / 100)));
                // } else {
                //     $("#price").val(vendor_price + (vendor_price * (product_percentage / 100)));
                // }
                $("#vendor_price").val(vendor_price);
                $("#product_percentage").val(product_percentage);
                $("#quantity").val(qty);
                $("#id").val(id);
                $("#short-description").val(shortdescription);
                $("#description").val(description);
                $("#price").val(price);
                $("#myModalLabel33").html("Update Product");
            }
            $(".alert-success").slideUp();
            $(".alert-warning").slideUp();
            $("#add-product-modal").modal('show');
        });

        $(".btn-submit").click(function() {
            var formData = new FormData();
            var title = $("#title").val();
            var status = $("#status").val();
            var id = $("#id").val();
            var img = $("#image").get(0);
            var catid = $("#cat-id").val();
            var slug = $("#slug").val();
            var price = $("#price").val();
            var quantity = $("#quantity").val();
            var sale = $("#sale").val();
            var discount = $("#discount").val();
            var discounttype = $("#discount_type").val();
            var startdate = $("#start_date").val();
            var enddate = $("#end_date").val();
            var vendorid = $("#vendor").val();
            var shortdescription = $("#short-description").val();
            var description = $("#description").val();
            var vendorprice = $("#vendor_price").val();
            var productpercentage = $("#product_percentage").val();
            var file = img.files[0];

            var multiimages = $("#multiple-image").get(0).files;

            if (title !== "" && status !== "") {
                if (id === "") {
                    if (file === undefined) {
                        $(".alert-body-warning").html("Please select an image");
                        $(".alert-warning").slideDown();
                        return;
                    }
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

                if (multiimages.length > 0) {
                    for (var i = 0; i < multiimages.length; i++) {
                        var multiImageFile = multiimages[i];
                        var multiImageName = multiImageFile.name;
                        var multiImageExt = multiImageName.substring(multiImageName.lastIndexOf('.') + 1).toLowerCase();
                        var multiImageAllowext = ['jpg', 'jpeg', 'png', 'webp'];
                        var multiImageSize = multiImageFile.size;
                        var multiImageMaxsize = 1048576;

                        if (multiImageSize > multiImageMaxsize) {
                            $(".alert-body-warning").html("One or more image sizes are greater than 1 MB");
                            $(".alert-warning").slideDown();
                            return;
                        }

                        if ($.inArray(multiImageExt, multiImageAllowext) === -1) {
                            $(".alert-body-warning").html("Only JPG, JPEG, PNG & WEBP allowed");
                            $(".alert-warning").slideDown();
                            return;
                        }

                        formData.append("multiimages[]", multiImageFile);
                    }
                }

                $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");
                $(this).attr("disabled", "disabled");

                if (id === "") {
                    formData.append("_token", "{{ csrf_token() }}");
                    formData.append("status", status);
                    formData.append("title", title);
                    formData.append("price", price);
                    formData.append("vendorprice", vendorprice);
                    formData.append("productpercentage", productpercentage);
                    formData.append("quantity", quantity);
                    formData.append("image", file);
                    formData.append("catid", catid);
                    formData.append("sale", sale);
                    formData.append("discount", discount);
                    formData.append("discounttype", discounttype);
                    formData.append("startdate", startdate);
                    formData.append("vendorid", vendorid);
                    formData.append("enddate", enddate);
                    formData.append("shortdescription", shortdescription);
                    formData.append("description", description);

                    $.ajax({
                        url: "/dashboard/product/submit",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response['status'] == "success") {
                                $(".alert-body-success").html(response['message']);
                                $(".alert-success").slideDown();
                                $(".alert-warning").slideUp();
                                $(".btn-submit").html("Submit");
                                setTimeout(() => {
                                    location.reload();
                                }, 2000);
                            } else if (response['status'] == "error") {
                                $(".alert-body-warning").html(response['message']);
                                $(".alert-warning").slideDown();
                                $(".alert-success").slideUp();
                                $(".btn-submit").html("Submit");
                                $(".btn-submit").removeAttr("disabled");
                            }
                        }
                    });
                } else {
                    formData.append("_token", "{{ csrf_token() }}");
                    formData.append("title", title);
                    formData.append("image", file);
                    formData.append("price", price);
                    formData.append("vendorprice", vendorprice);
                    formData.append("productpercentage", productpercentage);
                    formData.append("catid", catid);
                    formData.append("quantity", quantity);
                    formData.append("id", id);
                    formData.append("slug", slug);
                    formData.append("sale", sale);
                    formData.append("discount", discount);
                    formData.append("discounttype", discounttype);
                    formData.append("vendorid", vendorid);
                    formData.append("startdate", startdate);
                    formData.append("enddate", enddate);
                    formData.append("shortdescription", shortdescription);
                    formData.append("description", description);

                    $.ajax({
                        url: "/dashboard/product/update",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response['status'] == "success") {
                                $(".alert-body-success").html(response['message']);
                                $(".alert-success").slideDown();
                                $(".alert-warning").slideUp();
                                $(".btn-submit").html("Submit");
                                setTimeout(() => {
                                    location.reload();
                                }, 2000);
                            } else if (response['status'] == "error") {
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
        });


        $(".btn-delete").click(function() {
            var id = $(this).data('id');
            var link = '/dashboard/product/delete/submit?id=' + id;
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
            }).then(function(result) {
                if (result.value) {
                    $.get(link, function(res) {
                        if (res['status'] == "success") {
                            $("#row-" + id).slideUp();
                        }
                    });
                }
            });
        });

        $(".status-product").click(function() {
            var id = $(this).data('id');
            var link = "/dashboard/product/status/submit?id=" + id;
            $.get(link, function(res) {
                if (res['status'] == "success") {
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

        $(".mla-csv").click(function() {
            $("#mla-csv-modal").modal('show');
        });

        $(".btn-mla-csv").click(function() {
            var csv = $("#file_mla").get(0);
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

            setTimeout(function() {
                $("#mla-upload-csv").submit();
            }, 1000);
        });

        $(".scoll-csv").click(function() {
            $("#scollmore-csv-modal").modal('show');
        });

        $(".btn-scollmore-csv").click(function() {
            var csv = $("#file_scoll").get(0);
            var file = csv.files[0];
            if (file !== undefined && file !== null) {
                var filename = file.name;
                var fileext = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                var allowext = ['csv', 'xlsx', 'xls'];
            }
            if ($.inArray(fileext, allowext) === -1) {
                $(".alert-body-warning").html("Only CSV & XLSX files allowed");
                $(".alert-warning").slideDown();
                return;
            }

            $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");
            $(this).attr("disabled", "disabled");

            setTimeout(function() {
                $("#scollmore-upload-csv").submit();
            }, 1000);
        });

        $(".lw-csv").click(function() {
            $("#lw-csv-modal").modal('show');
        });

        $(".btn-lw-csv").click(function() {
            var csv = $("#file_lw").get(0);
            var file = csv.files[0];
            if (file !== undefined && file !== null) {
                var filename = file.name;
                var fileext = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                var allowext = ['csv', 'xlsx', 'xls'];
            }
            if ($.inArray(fileext, allowext) === -1) {
                $(".alert-body-warning").html("Only CSV & XLSX files allowed");
                $(".alert-warning").slideDown();
                return;
            }

            $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");
            $(this).attr("disabled", "disabled");

            setTimeout(function() {
                $("#lw-upload-csv").submit();
            }, 1000);
        });

        $(".saxbe-csv").click(function() {
            $("#saxbe-csv-modal").modal('show');
        });

        $(".update-catid").click(function() {
            $("#update-catid-modal").modal('show');
        });

        $(".btn-update-catid").click(function() {
            var csv = $("#file_cat_id").get(0);
            var file = csv.files[0];
            if (file !== undefined && file !== null) {
                var filename = file.name;
                var fileext = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                var allowext = ['csv', 'xlsx', 'xls'];
            }
            if ($.inArray(fileext, allowext) === -1) {
                $(".alert-body-warning").html("Only CSV & XLSX files allowed");
                $(".alert-warning").slideDown();
                return;
            }

            $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");
            $(this).attr("disabled", "disabled");

            setTimeout(function() {
                $("#update-cat-id").submit();
            }, 1000);
        });

        $(".btn-saxbe-csv").click(function() {
            var csv = $("#file_saxbe").get(0);
            var file = csv.files[0];
            if (file !== undefined && file !== null) {
                var filename = file.name;
                var fileext = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                var allowext = ['csv', 'xlsx', 'xls'];
            }
            if ($.inArray(fileext, allowext) === -1) {
                $(".alert-body-warning").html("Only CSV & XLSX files allowed");
                $(".alert-warning").slideDown();
                return;
            }

            $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");
            $(this).attr("disabled", "disabled");

            setTimeout(function() {
                $("#saxbe-upload-csv").submit();
            }, 1000);
        });

        $("#sale").change(function() {
            var val = $(this).val();
            if (val == 1) {
                $(".discount-type").slideDown();
                $(".discount").slideDown();
                $(".startdate").slideDown();
                $(".enddate").slideDown();
            } else {
                $(".discount-type").hide();
                $(".discount").hide();
                $(".startdate").hide();
                $(".enddate").hide();
            }
        });

        $(".cats-select").change(function() {
            var val = $(this).val();
            $("#cat-id").val(val);
        });

        $(".price-csv").click(function() {
            $("#price-csv-modal").modal('show');
        });

        $(".btn-price-csv").click(function() {
            var csv = $("#file_price").get(0);
            var file = csv.files[0];
            if (file !== undefined && file !== null) {
                var filename = file.name;
                var fileext = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                var allowext = ['csv', 'xlsx', 'xls'];
            }
            if ($.inArray(fileext, allowext) === -1) {
                $(".alert-body-warning").html("Only CSV & XLSX files allowed");
                $(".alert-warning").slideDown();
                return;
            }

            $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");
            $(this).attr("disabled", "disabled");

            setTimeout(function() {
                $("#price-upload-csv").submit();
            }, 1000);
        });

    });
</script>
@stop