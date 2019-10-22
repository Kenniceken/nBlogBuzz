@extends('layouts.backend.app')

@section('title', 'Post - Detail')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout -->
        <a href="{{ route('author.post.index') }}" class="btn btn-info m-t-15 waves-effect rounded-0">
            <i class="material-icons">keyboard_backspace</i> BACK
        </a>

        @if($post->is_approved == false)
            <button type="button" class="btn btn-warning pull-right" disabled>
                <i class="material-icons">block</i>
                <span>Pending</span>
            </button>
        @else
            <button type="button" class="btn btn-primary pull-right" disabled>
                <i class="material-icons">done</i>
                <span>Approved</span>
            </button>
        @endif
        <br>
        <br>
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card rounded-0">
                    <div class="header">
                        <h2>
                            {{ $post->title }}<br>
                            <small>Posted By <strong><a target="_blank" href="{{ route('author.profile', $post->user->username) }}">{{ $post->user->name }}</a></strong>
                                on {{ $post->created_at->toFormattedDateString() }}
                            </small>
                        </h2>
                    </div>
                    <div class="body">
                        {!! $post->body !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="card rounded-0">
                    <div class="header bg-teal">
                        <h2>
                            CATEGORIES
                        </h2>
                    </div>
                    <div class="body">
                        @foreach($post->categories as $category)
                            <span class="label bg-teal">{{ $category->name }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="card rounded-0">
                    <div class="header bg-teal">
                        <h2>
                            TAGS
                        </h2>
                    </div>
                    <div class="body">
                        @foreach($post->tags as $tag)
                            <span class="label bg-teal">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card rounded-0">
                    <div class="header bg-teal">
                        <h2>
                            FEATURED IMAGE
                        </h2>
                    </div>
                    <div class="body">
                        <img class="img-responsive" src="{{ Storage::disk('public')->url('post/'.$post->image) }}" alt="{{ $post->title }}">
                    </div>
                </div>

            </div>
        </div>
        <!-- #END# Vertical Layout -->
    </div>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

@endpush
