@extends('layouts.frontend.app')

@section('title')
    {{ $author->name }}
@endsection

@push('css')
    <link href="{{ asset('assets/frontend/css/profile/styles.css') }}" rel="stylesheet">

{{--    <link href="{{ asset('assets/frontend/css/profile/responsive.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('assets/frontend/css/category/styles.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/frontend/css/category/responsive.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="slider display-table center-text">
        <h1 class="title display-table-cell"><b>{{ $author->name }}</b></h1>
    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        @if($posts->count() > 0)
                            @foreach($posts as $post)
                            <div class="col-md-6 col-sm-12">
                                <div class="card h-100">
                                    <div class="single-post post-style-1">
                                        <div class="blog-image"><img src="{{ Storage::disk('public')->url('post/'.$post->image) }}" alt="{{ $post->title }}"></div>
                                        <a class="avatar" href="{{ route('author.profile', $post->user->username) }}"><img src="{{ Storage::disk('public')->url('profile/'.$post->user->image) }}" alt="{{ $post->user->name }}"></a>
                                        <div class="blog-info">
                                            <h4 class="title"><a href="{{ route('post.details', $post->slug) }}"><b>{{ $post->title }}</b></a></h4>

                                            <ul class="post-footer">
                                                <li>
                                                    @guest
                                                        <a href="javascript:void(0);" onclick="toastr.warning('You Must be Logged in before you can Like this Blog Post.','Warning',{
                                                    closeButton: true,
                                                    progressBar: true,
                                                })"><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>
                                                    @else
                                                        <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();"
                                                           class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count()  == 0 ? 'favorite_posts' : ''}}"><i class="ion-thumbsup"></i>{{ $post->favorite_to_users->count() }}</a>

                                                        <form id="favorite-form-{{ $post->id }}" method="POST" action="{{ route('post.favorite',$post->id) }}" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    @endguest
                                                </li>
                                                <li>
                                                    <a href="{{ route('post.details', $post->slug.'#comments') }}"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a>
                                                </li>
                                            </ul>
                                        </div><!-- blog-info -->
                                    </div><!-- single-post -->
                                </div><!-- card -->
                            </div><!-- col-lg-4 col-md-6 -->
                        @endforeach
                        @else
                            <div class="col-md-12 col-sm-12">
                                <div class="card h-100">
                                    <div class="single-post post-style-1">
                                        <div class="blog-info">
                                            <h4 class="title">
                                                <strong> Opp!!.. No Blog Post Yet by {{ $author->name }} !!!</strong>
                                            </h4>
                                        </div><!-- blog-info -->
                                    </div><!-- single-post -->
                                </div><!-- card -->
                            </div><!-- col-lg-4 col-md-6 -->
                        @endif
                    </div><!-- row -->

{{--                    <a class="load-more-btn" href="#"><b>LOAD MORE</b></a>--}}

                </div><!-- col-lg-8 col-md-12 -->
                <div class="col-lg-4 col-md-12 ">
                    <div class="single-post info-area ">
                        <div class="about-area">
                            <h4 class="title"><b>ABOUT {{ strtoupper($author->name) }}</b></h4>
                            <p class="text-justify">
                                {{ ($author->about) }}
                            </p>
                            <hr>
                            <p>Member Since: <strong><i>{{ $author->created_at->toDateString() }}</i></strong></p>
                            <hr>
                            <p>Total Post(s): <strong><i>{{ $author->posts->count() }}</i></strong></p>
                        </div>
                    </div><!-- info-area -->
                </div><!-- col-lg-4 col-md-12 -->
            </div><!-- row -->
        </div><!-- container -->
    </section><!-- section -->
@endsection


@push('js')

@endpush
