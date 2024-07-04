@extends('/layouts/master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
@stop

@section('title')
    <title>Content Page</title>
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
                    <input type="text" class="form-control" id="search-fields" placeholder="Search Content Page">
                </div>
            </div>
            @can('add' , app('App\ContentPage'))
                <div class="col-xl-2 col-md-6 col-12 mb-1">
                    <a href="{{route('add_content_page')}}"><button type="button" class="btn btn-outline-primary waves-effect add-category"><i class="fa-light fa-plus"></i> &nbsp;Add Page</button></a>
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
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($contentpage->count() > 0)
                                    @foreach($contentpage as $all)
                                        <tr id="row-{{$all->id}}">
                                            <td>{{$all->id}}</td>
                                            <td>{{ucwords($all->title)}}</td>
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
                                                    <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Deactivate" class="btn btn-outline-danger waves-effect mb-1 status-category"><i class="fa-regular fa-ban"></i></button>
                                                @else
                                                    <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Activate" class="btn btn-outline-success waves-effect mb-1 status-category"><i class="fa-light fa-lock"></i></button>
                                                @endif
                                                @can('read' , app('App\ContentPage'))
                                                    <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="View" class="btn btn-outline-info waves-effect mb-1 action-contentpage"><i class="fa-light fa-arrow-up-right-from-square"></i></button>
                                                @endcan
                                                @can('edit' , app('App\ContentPage'))
                                                    <a href = "{{route('edit_content_page' , $all->id)}}"><button data-id = "{{$all->id}}" data-title="{{$all->title}}" data-status="{{$all->status}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Update" class="btn btn-outline-success waves-effect mb-1 btn-update"><i class="fa-light fa-pen-to-square"></i></button></a>
                                                @endcan
                                                @can('delete' , app('App\ContentPage'))
                                                    <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="btn btn-outline-warning waves-effect mb-1 btn-delete"><i class="fa-thin fa-trash"></i></button>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center"><b>No Content Page Found</b></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if($contentpage->count() > 0)
                <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                    <div>
                        <div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination mt-2">
                                    @if ($contentpage->currentPage() == 1)
                                        <li class="page-item prev disabled"><span class="page-link"></span></li>
                                    @else
                                        <li class="page-item prev"><a class="page-link" href="{{ $contentpage->previousPageUrl() }}"></a></li>
                                    @endif
                
                                    @foreach ($contentpage->getUrlRange(1, $contentpage->lastPage()) as $page => $url)
                                        @if ($page == $contentpage->currentPage())
                                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach
                
                                    @if ($contentpage->hasMorePages())
                                        <li class="page-item next"><a class="page-link" href="{{ $contentpage->nextPageUrl() }}"></a></li>
                                    @else
                                        <li class="page-item next disabled"><span class="page-link"></span></li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- View Modal --}}
    <div class="modal fade text-left" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">View Content Page</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="form-group">
                            <label><b>Title: </b> <span id="title"></span></label>
                        </div>
                        <div class="form-group">
                            <label><b>Location: </b> <span id="location"></span></label>
                        </div>
                        <div class="form-group">
                            <label><b>Section: </b> <span id="section"></span></label>
                        </div>
                        <div style="display:none;" class="form-group custom-link">
                            <label><b>Custom Link: </b> <span id="custom_link"></span></label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{-- View Modal --}}
@endsection

@section('javascript')
    <script src="{{url('backend/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous" ></script>
    <script src="{{url('backend/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{url('backend/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
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
                var link = '/dashboard/contentpage/delete/submit?id=' + id;
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
                var link = "/dashboard/edit-contentpage/status/submit?id=" +id;
                $.get(link , function(res){
                    if(res['status'] == "success"){
                        location.reload();
                    }
                });
            });

            $(".action-contentpage").click(function(){
                var id = $(this).data('id');
                var link = '/dashboard/contentpage/view?id=' +id;
                $.get(link , function(res){
                    if(res['status'] == "success"){
                        var data = res['data'];
                        var location = "";
                        var section = "";
                        if(data['location'] == 1){
                            location = "Header";
                        }
                        else if(data['location'] == 2){
                            location = "Footer";
                        }
                        if(data['section'] == 1){
                            section = "Section 1";
                        }
                        else if(data['section'] == 2){
                            section = "Section 2";
                        }
                        else if(data['section'] == 3){
                            section = "Section 3";
                        }
                        $("#title").html(data['title']);
                        $("#location").html(location);
                        $("#section").html(section);
                        if(data['custom_link'] != null){
                            $("#custom_link").html(data['custom_link']);
                            $(".custom-link").show();
                        }
                        $("#view-modal").modal('show');
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