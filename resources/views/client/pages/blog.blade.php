@extends('app')

@section('content')

<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="index.html">home</a></li>
                        <li>blog sidebar</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--blog area start-->
<div class="blog_page_section blog_sidebar blog_reverse mt-23">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <div class="blog_sidebar_widget">
                    <div class="widget_list widget_search">
                        <h3>Search</h3>
                        <form action="#">
                            <input placeholder="Search..." type="text">
                            <button type="submit">search</button>
                        </form>
                    </div>
                    <div class="widget_list widget_tag">
                        <h3>Tag products</h3>
                        <div class="tag_widget">
                            <ul>
                                <li><a href="#">asian</a></li>
                                <li><a href="#">brown</a></li>
                                <li><a href="#">euro</a></li>
                                <li><a href="#">fashion</a></li>
                                <li><a href="#">hat</a></li>
                                <li><a href="#">t-shirt</a></li>
                                <li><a href="#">teen</a></li>
                                <li><a href="#">travel</a></li>
                                <li><a href="#">white</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="widget_list widget_post">
                        <h3>Recent Posts</h3>
                        @foreach($blogs as $blog)
                        <div class="post_wrapper">
                            <div class="post_thumb">
                                <a href="{{ route('client.blogs.show', $blog->id) }}"><img src="{{ asset('storage/' . $blog->image) }}" alt=""></a>
                            </div>
                            <div class="post_info">
                                <h3><a href="{{ route('client.blogs.show', $blog->id) }}">{{ $blog->title }}</a></h3>
                                <span>{{ $blog->created_at->format('F d, Y') }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12">
                <div class="blog_wrapper">
                    @foreach($blogs as $blog)
                    <div class="single_blog">
                        <div class="blog_thumb">
                            <a href="{{ route('client.blogs.show', $blog->id) }}"><img src="{{ asset('storage/' . $blog->image) }}" alt=""></a>
                        </div>
                        <div class="blog_content">
                            <h3><a href="{{ route('client.blogs.show', $blog->id) }}">{{ $blog->title }}</a></h3>
                            <div class="blog_meta">
                                <span class="post_date"><i class="fa fa-calendar"></i> {{ $blog->created_at->format('F d, Y') }}</span>
                                <span class="author"><i class="fa fa-user-circle"></i> Posts by : admin</span>
                                <span class="category">
                                    <i class="fa fa-folder-open"></i>
                                    <a href="#">{{ $blog->category }}</a>
                                </span>
                            </div>
                            <div class="blog_desc">
                                <p>{{ \Str::limit($blog->content, 150) }}</p>
                            </div>
                            <div class="readmore_button">
                                <a href="{{ route('client.blogs.show', $blog->id) }}">read more</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!--blog area end-->

<!--blog pagination area start-->
<div class="blog_pagination">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="pagination">
                    <ul>
                        <li class="current">1</li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li class="next"><a href="#">next</a></li>
                        <li><a href="#">>></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--blog pagination area end-->

@endsection
