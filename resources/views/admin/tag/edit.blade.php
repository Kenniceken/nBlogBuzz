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
                            UPDATE THIS TAG
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.tag.update', $tag->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="name" class="form-control" name="name" value="{{ $tag->name }}">
                                    <label class="form-label">Tag Name</label>
                                </div>
                            </div>
                            <br>
                            <a href="{{ route('admin.tag.index') }}" class="btn btn-outline-light m-t-15 waves-effect rounded-0">BACK</a>
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
