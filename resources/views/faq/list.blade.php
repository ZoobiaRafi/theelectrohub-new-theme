@extends('/layouts/master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
@stop

@section('title')
    <title>FAQ's</title>
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
                    <input type="text" class="form-control" id="search-fields" placeholder="Search Faq">
                </div>
            </div>
            @can('add' , app('App\Faq'))
                <div class="col-xl-2 col-md-6 col-12 mb-1">
                    <a href = "{{route('faq_add')}}"><button type="button" class="btn btn-outline-primary waves-effect add-faq"><i class="fa-light fa-plus"></i> &nbsp;Add Faq</button></a>
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
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($faq->count() > 0)
                                    @foreach($faq as $all)
                                        <tr id="row-{{$all->id}}">
                                            <td>{{$all->id}}</td>
                                            <td>{{substr($all->question , 0 , 20)}}</td>
                                            <td>{{substr($all->answer , 0 , 20)}}</td>
                                            <td>
                                                @if($all->type == 1)
                                                    General
                                                @elseif($all->type == 2)
                                                    Category
                                                @elseif($all->type == 3)
                                                    Product
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
                                                @can('read' , app('App\Faq'))
                                                    <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="View" class="btn btn-outline-info waves-effect mb-1 btn-view"><i class="fa-light fa-eye"></i></button>
                                                @endcan                                                
                                                @can('edit' , app('App\Faq'))
                                                    <a href = "{{route('faq_edit' , $all->id)}}"><button data-id = "{{$all->id}}" data-status = "{{$all->status}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Update" class="btn btn-outline-success waves-effect mb-1 btn-update"><i class="fa-light fa-pen-to-square"></i></button></a>
                                                @endcan
                                                @can('delete' , app('App\Faq'))
                                                    <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="btn btn-outline-warning waves-effect mb-1 btn-delete"><i class="fa-thin fa-trash"></i></button>
                                                @endcan
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center"><b>No FAQ's Found</b></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if($faq->count() > 0)
                <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                    <div>
                        <div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination mt-2">
                                    @if ($faq->currentPage() == 1)
                                        <li class="page-item prev disabled"><span class="page-link"></span></li>
                                    @else
                                        <li class="page-item prev"><a class="page-link" href="{{ $faq->previousPageUrl() }}"></a></li>
                                    @endif
                
                                    @foreach ($faq->getUrlRange(1, $faq->lastPage()) as $page => $url)
                                        @if ($page == $faq->currentPage())
                                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach
                
                                    @if ($faq->hasMorePages())
                                        <li class="page-item next"><a class="page-link" href="{{ $faq->nextPageUrl() }}"></a></li>
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
                    <h4 class="modal-title" id="myModalLabel33">View Faq</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="form-group">
                            <label><b>Question: </b> <span id="question"></span></label>
                        </div>
                        <div class="form-group">
                            <label><b>Answer: </b> <span id="answer"></span></label>
                        </div>
                        <div class="form-group">
                            <label><b>Type: </b> <span id="type"></span></label>
                        </div>
                        <div class="form-group">
                            <label><b>Applied: </b> <span id="applied"></span></label>
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
                var link = '/dashboard/faq/delete/submit?id=' + id;
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
                var id = $(this).data('id');
                var link = '/dashboard/faq/view/' + id;
                $.get(link , function(res){
                    if(res['status'] == "success"){
                        var data = res['data'];
                        var type = "";
                        var title = ""
                        $("#question").html(data['question']);
                        $("#answer").html(data['answer']);
                        if(data['type'] == 1){
                            type = "General";
                        }
                        else if(data['type'] == 2){
                            type = "Category";
                            for(var i = 0; i < data['catids'].length; i++){
                                if(title != ""){
                                    title += ", ";
                                }
                                title += data['catids'][i]['catttile'];
                            }
                        }
                        else if(data['type'] == 3){
                            type = "Product";
                            for(var i = 0; i < data['proids'].length; i++){
                                if(title != ""){
                                    title += ", ";
                                }
                                title += data['proids'][i]['protitle'];
                            }
                        }
                        $("#type").html(type);
                        $("#applied").html(title);
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