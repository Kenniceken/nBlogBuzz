@extends('layouts.backend.app')

@section('title', 'Admin Dashboard')

@push('css')

@endpush


@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>ADMIN DASHBOARD</h2>
        </div>
        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL POSTS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $posts->count() }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-blue hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">thumb_up_alt</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL LIKES</div>
                        <div class="number count-to" data-from="0" data-to="{{ Auth::user()->favorite_posts()->count() }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">announcement</i>
                    </div>
                    <div class="content">
                        <div class="text">PENDING POSTS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $total_pending_posts }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-teal hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">remove_red_eye</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL VIEWS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $all_views }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-xs-12 col-xs-12 col-sm-4 col-lg-3">
                <div class="info-box bg-deep-purple hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">apps</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL CATEGORIES</div>
                        <div class="number count-to" data-from="0" data-to="{{ $category_count }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>

                <div class="info-box bg-lime hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">labels</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL TAGS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $tag_count }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>

                <div class="info-box bg-blue hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">group</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL AUTHORS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $author_count }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>

                <div class="info-box bg-blue-grey hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">group_add</i>
                    </div>
                    <div class="content">
                        <div class="text">NEW AUTHORS TODAY</div>
                        <div class="number count-to" data-from="0" data-to="{{ $new_authors_today }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-xs-12 col-sm-8 col-lg-9">
                <div class="card">
                    <div class="header">
                        <h2 class="text"> TOP 5 POPULAR POSTS</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>Ranked:</th>
                                        <th>Title</th>
                                        <th>Authors</th>
                                        <th>Views</th>
                                        <th>Likes</th>
                                        <th>Comments</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($popular_posts as $key=>$post)
                                    <tr>
                                        <td> {{ $key + 1 }}</td>
                                        <td> {{ Str::limit($post->title, '20') }} </td>
                                        <td> {{ $post->user->name }} </td>
                                        <td> {{ $post->view_count }} </td>
                                        <td class="text-center"> {{ $post->favorite_to_users_count }} </td>
                                        <td class="text-center"> {{ $post->comments_count }} </td>
                                        <td>
                                            @if($post->status == true)
                                                <span class="label bg-teal"> Published </span>
                                            @else
                                                <span class="label bg-warning"> Pending </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm waves-effect" target="_blank" href="{{ route('post.details', $post->slug) }}"> View </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- #END# Widgets -->

        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>TOP 10 ACTIVE AUTHORS</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                <tr>
                                    <th>Ranked</th>
                                    <th>Author Name</th>
                                    <th class="text-center">Posts</th>
                                    <th class="text-center">Comments</th>
                                    <th class="text-center">Likes</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($active_authors as $key=>$author)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td> {{ $author->name }} </td>
                                        <td class="text-center"> {{ $author->posts_count }} </td>
                                        <td class="text-center"> {{ $author->comments_count }} </td>
                                        <td class="text-center"> {{ $author->favorite_posts_count }} </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->
        </div>
    </div>
@endsection


@push('js')
    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/morrisjs/morris.js') }}"></script>

    <!-- ChartJs -->
    <script src="{{ asset('assets/backend/plugins/chartjs/Chart.bundle.js') }}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="assets/backend/plugins/flot-charts/jquery.flot.js"></script>
    <script src="assets/backend/plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="assets/backend/plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="assets/backend/plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="assets/backend/plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="assets/backend/plugins/jquery-sparkline/jquery.sparkline.js"></script>
    <script src="{{ asset('assets/backend/js/pages/index.js') }}"></script>
@endpush
