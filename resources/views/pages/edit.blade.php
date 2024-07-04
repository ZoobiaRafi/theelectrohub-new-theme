@extends('/layouts/master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/forms/select/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/editors/quill/katex.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/editors/quill/monokai-sublime.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/editors/quill/quill.snow.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/editors/quill/quill.bubble.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/plugins/forms/form-quill-editor.css')}}">
@stop

@section('title')
    <title>Add Content Page</title>
@stop
@section('body')
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row"></div>
    <div class="content-body">
        <form method="post" action = "/dashboard/edit-content-page/{{$contentpage->id}}/submit">
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
                        <input value="{{$contentpage->title}}" name="title" type="text" class="form-control" placeholder="Enter Title">
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <div class="form-group">
                        <label for="name">Slug</label>
                        <input value="{{$contentpage->slug}}" name="slug" type="text" class="form-control" placeholder="Enter Slug">
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <div class="form-group">
                        <label for="name">Sort order</label>
                        <input value="{{$contentpage->sort_order}}" name="sort_order" type="text" class="form-control" placeholder="Enter Sort Order">
                    </div>
                </div>
                
                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <label>Location: </label>
                    <div class="form-group">
                        <select class="form-control" name="location">
                            <option disabled>Please Select</option>
                            <option @if($contentpage->location == 1) selected @endif value="1" >Header</option>
                            <option @if($contentpage->location == 2) selected @endif value="2">Footer</option>
                        </select>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <label>Section: </label>
                    <div class="form-group">
                        <select class="form-control" name="section">
                            <option disabled>Please Select</option>
                            <option @if($contentpage->section == 1) selected @endif value="1">Section 1</option>
                            <option @if($contentpage->section == 2) selected @endif value="2">Section 2</option>
                            <option @if($contentpage->section == 3) selected @endif value="3">Section 3</option>
                        </select>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <div class="form-group">
                        <label for="name">Custom Link</label>
                        <input value="{{$contentpage->custom_link}}" name="custom_link" type="text" class="form-control" placeholder="Enter Custom Link">
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-12 mb-1">
                    <label>Status: </label>
                    <div class="form-group">
                        <select class="form-control" name="status">
                            <option disabled>Please Select</option>
                            <option @if($contentpage->status == 1) selected @endif value="1">Active</option>
                            <option @if($contentpage->status == 0) selected @endif value="0">In Active</option>
                        </select>
                    </div>
                </div>

                <!-- full Editor start -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Description</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="full-wrapper">
                                        <div id="full-container">
                                            <div class="editor">{!!$contentpage->description!!}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- full Editor end -->
                <input value="{!!$contentpage->text!!}" type="hidden" name="description" id="editorContent">
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
    <script src="{{url('backend/app-assets/vendors/js/editors/quill/katex.min.js')}}"></script>
    <script src="{{url('backend/app-assets/vendors/js/editors/quill/highlight.min.js')}}"></script>
    <script src="{{url('backend/app-assets/vendors/js/editors/quill/quill.min.js')}}"></script>
    <script>
        var fullEditor = new Quill('#full-container .editor', {
            bounds: '#full-container .editor',
            modules: {
            formula: true,
            syntax: true,
            toolbar: [
                [
                {
                    font: []
                },
                {
                    size: []
                }
                ],
                ['bold', 'italic', 'underline', 'strike'],
                [
                {
                    color: []
                },
                {
                    background: []
                }
                ],
                [
                {
                    script: 'super'
                },
                {
                    script: 'sub'
                }
                ],
                [
                {
                    header: '1'
                },
                {
                    header: '2'
                },
                'blockquote',
                'code-block'
                ],
                [
                {
                    list: 'ordered'
                },
                {
                    list: 'bullet'
                },
                {
                    indent: '-1'
                },
                {
                    indent: '+1'
                }
                ],
                [
                'direction',
                {
                    align: []
                }
                ],
                ['link', 'image', 'video', 'formula'],
                ['clean']
            ]
            },
            theme: 'snow'
        });

        var content = {!! json_encode($contentpage->text) !!};
        fullEditor.root.innerHTML = content;

        var form = document.querySelector('form');

        form.addEventListener('submit', function (event) {
            var editorContent = fullEditor.root.innerHTML;
            document.getElementById('editorContent').value = editorContent;
        });

    </script>
@endsection