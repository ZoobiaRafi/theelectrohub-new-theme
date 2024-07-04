@extends('/layouts/master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css')}}">
@stop

@section('title')
    <title>Newsletter</title>
@stop
@section('body')
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row"></div>
    <div class="content-body">
        <div class="row">
            <div class="col-xl-12 col-md-6 col-12 mb-1">
                <div class="form-group">
                    <input type="text" class="form-control" id="search-fields" placeholder="Search newsletter">
                </div>
            </div>
        </div>

        <div class="row" id="table-head">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table id="table-user" class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <!-- <th>IP Address</th> -->
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($newsletter) > 0)
                                    @foreach($newsletter as $all)
                                        <tr id="row-{{$all->id}}">
                                            <td>{{$all->id ? $all->id : ""}}</td>
                                            <td>{{$all->email ? $all->email : ""}}</td>
                                            <!-- <td>{{$all->ip_address ? $all->ip_address : ""}}</td> -->
                                            <td>                                            
                                                <button data-id = "{{$all->id}}" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="btn btn-outline-danger waves-effect mb-1 delete-newsletter-product"><i class="fa-thin fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center"><b>No newsletter Found</b></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if(count($newsletter) > 0)
                <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                    <div>
                        <div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination mt-2">
                                    @if ($newsletter->currentPage() == 1)
                                        <li class="page-item prev disabled"><span class="page-link"></span></li>
                                    @else
                                        <li class="page-item prev"><a class="page-link" href="{{ $newsletter->previousPageUrl() }}"></a></li>
                                    @endif
                
                                    @foreach ($newsletter->getUrlRange(1, $newsletter->lastPage()) as $page => $url)
                                        @if ($page == $newsletter->currentPage())
                                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach
                
                                    @if ($newsletter->hasMorePages())
                                        <li class="page-item next"><a class="page-link" href="{{ $newsletter->nextPageUrl() }}"></a></li>
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
            $(".delete-newsletter-product").click(function(){
                var id = $(this).data('id');
                var link = '/dashboard/delete/newsletter?id=' + id;

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
        });
    </script>
@stop