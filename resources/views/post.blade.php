@extends('layouts.frontend.app')

@section('title')
    {{ $post->title }}
@endsection
@push('css')
    <link href="{{ asset('assets/frontend/css/single-post/styles.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/frontend/css/single-post/responsive.css') }}" rel="stylesheet">
{{--    <link href="https://fonts.googleapis.com/css?family=Exo+2|Ubuntu&display=swap" rel="stylesheet">--}}
    <style>

        .header-bg {
            height: 400px;
            width: 100%;
            background-image: url({{  Storage::disk('public')->url('post/'.$post->image)  }});
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        /*.titleText {*/
        /*    position: absolute;*/
        /*    color: #f1c40f;*/
        /*    font-weight: bolder;*/
        /*    !*font-family: 'Ubuntu', sans-serif;*!*/
        /*    font-family: 'Exo 2', sans-serif;*/
        /*    top: 50%;*/
        /*    left: 50%;*/
        /*    margin-right: -50%;*/
        /*    transform: translate(-50%, -50%); }*/
        /*}*/

        .favorite_posts{
            color: #0652DD;
        }
    </style>
@endpush
@section('content')
    <div class="header-bg">
    </div><!-- slider -->

    <section class="post-area section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 no-right-padding">
                    <div class="main-post">
                        <div class="blog-post-inner">
                            <div class="post-info">
                                <div class="left-area">
                                    <a class="avatar" href="{{ route('author.profile', $post->user->username) }}"><img src="{{ Storage::disk('public')->url('profile/'.$post->user->image) }}" alt="{{ $post->user->name }}"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="{{ route('author.profile', $post->user->username) }}"><b>{{ $post->user->name }}</b></a>
                                    <h6 class="date">on {{ $post->created_at->diffForHumans() }}</h6>
                                </div>

                            </div><!-- post-info -->

                            <h3 class="title"><a href="{{ route('post.details', $post->slug) }}"><b>{{ $post->title }}</b></a></h3>

                            <div class="para">
                                {!! html_entity_decode($post->body) !!}
                            </div>

                            <ul class="tags">
                                @foreach($post->tags as $tag)
                                    <li><a href="{{ route('tag.posts', $tag->slug) }}">{{ $tag->name }}</a></li>
                                @endforeach
                            </ul>
                        </div><!-- blog-post-inner -->

                        <div class="post-icons-area">
                            <ul class="post-icons">
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
                                    <a href="#"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a>
                                </li>
                                <li>
                                    <a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a>
                                </li>
                            </ul>

                            <ul class="icons">
                                <li>SHARE : </li>
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-linkedin"></i></a></li>
                            </ul>
                        </div>


                    </div><!-- main-post -->
                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 no-left-padding">

                    <div class="single-post info-area">

                        <div class="sidebar-area about-area">
                            <h4 class="title"><b>ABOUT {{ strtoupper($post->user->name) }}</b></h4>
                            <p>
                                {{ $post->user->about }}
                            </p>
                        </div>

                        <div class="tag-area">

                            <h4 class="title"><b>CATEGORIES</b></h4>
                            <ul>
                                @foreach($post->categories as $category)
                                    <li><a href="{{ route('category.posts', $category->slug) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>

                        </div><!-- subscribe-area -->

                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- post-area -->


    <section class="recomended-area section">
        <div class="container">
            <div class="row">
                @foreach($randomposts as $randompost)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                                <div class="blog-image"><img src="{{ Storage::disk('public')->url('post/'.$randompost->image) }}" alt="{{ $randompost->title }}"></div>
                                <a class="avatar" href="{{ route('author.profile', $randompost->user->username) }}"><img src="{{ Storage::disk('public')->url('profile/'.$randompost->user->image) }}" alt="{{ $randompost->user->name }}"></a>
                                <div class="blog-info">
                                    <h4 class="title"><a href="{{ route('post.details', $randompost->slug) }}"><b>{{ $randompost->title }}</b></a></h4>

                                    <ul class="post-footer">
                                        <li>
                                            @guest
                                                <a href="javascript:void(0);" onclick="toastr.warning('You Must be Logged in before you can Like this Blog Post.','Warning',{
                                                    closeButton: true,
                                                    progressBar: true,
                                                })"><i class="ion-heart"></i>{{ $randompost->favorite_to_users->count() }}</a>
                                            @else
                                                <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $randompost->id }}').submit();"
                                                   class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$randompost->id)->count()  == 0 ? 'favorite_posts' : ''}}"><i class="ion-thumbsup"></i>{{ $randompost->favorite_to_users->count() }}</a>

                                                <form id="favorite-form-{{ $randompost->id }}" method="POST" action="{{ route('post.favorite',$randompost->id) }}" style="display: none;">
                                                    @csrf
                                                </form>
                                            @endguest
                                        </li>
                                        <li>
                                            <a target="_blank" href="{{ route('post.details', $randompost->slug.'#comments') }}"><i class="ion-chatbubble"></i>{{ $randompost->comments->count() }}</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="ion-eye"></i>{{ $randompost->view_count }}</a>
                                        </li>
                                    </ul>
                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-lg-4 col-md-6 -->
                @endforeach

            </div><!-- row -->

        </div><!-- container -->
    </section>

    <section class="comment-section">
        <div class="container">
            <h4><b>LEAVE A COMMENT</b></h4>
            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="comment-form">
                       @guest
                           <p>
                               Please Login to Leave a Comment..
                               <a href="{{ route('login') }}">Login</a>
                           </p>
                       @else
                          <form method="post" action="{{ route('comment.store', $post->id) }}">
                              @csrf
                                <div class="row">
                                    <div class="col-sm-12">
									<textarea name="comment" rows="2" class="text-area-messge form-control"
                                              placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
                                    </div><!-- col-sm-12 -->
                                    <div class="col-sm-12">
                                        <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                                    </div><!-- col-sm-12 -->

                                </div><!-- row -->
                            </form>
                       @endguest
                    </div><!-- comment-form -->

                    <h4><b>COMMENTS ({{ $post->comments()->count() }})</b></h4>
                    @if($post->comments->count() > 0)
                        @foreach($post->comments as $comment)
                            <div class="commnets-area">
                                <div class="comment">
                                    <div class="post-info">
                                        <div class="left-area">
                                            <a class="avatar" href="{{ route('author.profile', $comment->user->username) }}"><img src="{{ Storage::disk('public')->url('profile/'.$comment->user->image) }}" alt="{{ $comment->user->name }}"></a>
                                        </div>
                                        <div class="middle-area">
                                            <a class="name" href="{{ route('author.profile', $comment->user->username) }}"><b>{{$comment->user->name}}</b></a>
                                            <h6 class="date">on {{$comment->created_at->diffForHumans()}}</h6>
                                        </div>
                                        {{--                                    <div class="right-area">--}}
                                        {{--                                        <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>--}}
                                        {{--                                    </div>--}}
                                    </div><!-- post-info -->
                                    <p>
                                        {{ $comment->comment  }}
                                    </p>
                                </div>
                            </div><!-- commnets-area -->
                        @endforeach
                     @else

                        <div class="commnets-area">
                            <div class="comment">
                                <p class="mt-3">
                                    No Comment Yet!!!, Be the First to Leave a Comment :)  ...
                                </p>
                            </div>
                        </div><!-- commnets-area -->
                    @endif
{{--                     <a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</b></a>--}}
                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section>
@endsection

@push('js')

@endpush


