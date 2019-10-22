@extends('layouts.backend.app')

@section('title', 'Post - Update')

@push('css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout -->
        <form action="{{ route('author.post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card rounded-0">
                        <div class="header">
                            <h2>
                                UPDATE THIS BLOG POST
                            </h2>
                        </div>
                        <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="name" class="form-control" name="title" value="{{ $post->title }}">
                                    <label class="form-label">Blog Post Title</label>
                                </div>
                            </div>

                            <img src="{{ asset('storage/post/'.$post->image) }}" alt="{{ Str::limit($post->name, 50) }}" style="width: 100px; height: 50px;">
                            <br>
                            <br>
                            <div class="form-group form-float">
                                <div class="file-path-wrapper">
                                    <label for="image">Featured Image</label>
                                    <input type="file" name="image" class="custom-file">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="publish" class="filled-in" name="status" value="1" {{ $post->status == true ? 'checked' : '' }}>
                                <label for="publish">Publish</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card rounded-0">
                        <div class="header">
                            <h2>
                                SELECT CATEGORIES & TAGS
                            </h2>
                        </div>
                        <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
                                    <label class="category">Select Categories</label>
                                    <select name="categories[]" id="category" class="form-control show-tick" data-live-search="true" multiple>
                                        @foreach($categories as $category)
                                            <option
                                                @foreach($post->categories as $postCategory)
                                                    {{ $postCategory->id == $category->id ? 'selected' : '' }}
                                                @endforeach
                                                value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
                                    <label class="tag">Select Tags</label>
                                    <select name="tags[]" id="tag" class="form-control show-tick" data-live-search="true" multiple>
                                        @foreach($tags as $tag)
                                            <option
                                                @foreach($post->tags as $postTag)
                                                    {{ $postTag->id == $tag->id ? 'selected' : '' }}
                                                @endforeach
                                                value="{{ $tag->id }}">
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <a href="{{ route('author.post.index') }}" class="btn btn-outline-light m-t-15 waves-effect rounded-0">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect rounded-0">SAVE CHANGES</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Vertical Layout -->

            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card rounded-0">
                        <div class="header">
                            <h2>
                                BLOG POST CONTENT
                            </h2>
                        </div>
                        <div class="body">
                            <textarea name="body" id="tinymce" cols="30" rows="10">
                                {{ $post->body }}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Vertical Layout -->
        </form>
    </div>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>
    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('assets/backend/plugins/tinymce') }}';
        });
    </script>
@endpush
