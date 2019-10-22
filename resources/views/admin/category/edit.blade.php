@extends('layouts.backend.app')

@section('title', 'Edit')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card rounded-0">
                    <div class="header">
                        <h2>
                            UPDATE THIS CATEGORY
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="name" class="form-control" name="name" value="{{ $category->name }}">
                                    <label class="form-label">Category Name</label>
                                </div>
                                <br>
                                <img src="{{ asset('storage/category/slider/'.$category->image) }}" alt="{{ Str::limit($category->name, 50) }}" style="width: 100px; height: 70px;">
                            </div>
                            <div class="form-group">
                                <input type="file" name="image">
                            </div>
                            <br>
                            <a href="{{ route('admin.category.index') }}" class="btn btn-outline-light m-t-15 waves-effect rounded-0">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect rounded-0">SAVE CHANGES</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Vertical Layout -->
    </div>
@endsection

@push('js')
@endpush
