@extends('layouts.frontend.app')

@section('title', 'Blog By Category')


@push('css')

    <link href="{{ asset('assets/frontend/css/category/styles.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/frontend/css/category/responsive.css') }}" rel="stylesheet">

    <style>
        .slider {
            height: 400px;
            width: 100%;
            background-image: url({{  Storage::disk('public')->url('category/'.$category->image)  }});
            -webkit-background-size: 100%;
            -moz-background-size: 100%;
            -o-background-size: 100%;
            background-size: 100%;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        .favorite_posts{
            color: #0652DD;
        }
    </style>
@endpush

@section('content')
    <div class="slider display-table center-text">
        <h1 class="title display-table-cell"><b>{{ $category->name }}</b></h1>
    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">
              @if($posts->count() > 0)
                    @foreach($posts as $post)
                        <div class="col-lg-4 col-md-6">
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
                                                })"><i class="ion-thumbsup"></i>{{ $post->favorite_to_users->count() }}</a>
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
                    <div class="col-lg-12 col-md-12">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                                <div class="blog-info">
                                    <h4 class="title">
                                        <strong> No Blog Post Found in This Category!!!</strong>
                                    </h4>
                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-lg-4 col-md-6 -->
              @endif
            </div><!-- row -->

{{--            {{ $posts->links() }}--}}

        </div><!-- container -->
    </section><!-- section -->

@endsection

@push('js')
@endpush
