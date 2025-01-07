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
                        <li><a href="#">fashion</a></li>
                        <li>blog details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--blog body area start-->
<div class="blog_details blog_padding mt-23">
    <div class="container">
        <div class="row">

            <div class="col-lg-9 col-md-12">
                <!--blog grid area start-->
                <div class="blog_details_wrapper">
                    <div class="blog_thumb">
                        <a href="#"><img src="assets/img/blog/blog-big1.jpg" alt=""></a>
                    </div>
                    <div class="blog_content">
                        <h3 class="post_title">Blog image post</h3>
                        <div class="post_meta">
                            <span><i class="ion-person"></i> Posted by </span>
                            <span><a href="#">admin</a></span>
                            <span>|</span>
                            <span><i class="fa fa-calendar" aria-hidden="true"></i>  Posted on  March 10, 2019	</span>

                        </div>
                        <div class="post_content">
                            <p>Aenean et tempor eros, vitae sollicitudin velit. Etiam varius enim nec quam tempor, sed efficitur ex ultrices. Phasellus pretium est vel dui vestibulum condimentum. Aenean nec suscipit nibh. Phasellus nec lacus id arcu facilisis elementum. Curabitur lobortis, elit ut elementum congue, erat ex bibendum odio, nec iaculis lacus sem non lorem. Duis suscipit metus ante, sed convallis quam posuere quis. Ut tincidunt eleifend odio, ac fringilla mi vehicula nec. Nunc vitae lacus eget lectus imperdiet tempus sed in dui. Nam molestie magna at risus consectetur, placerat suscipit justo dignissim. Sed vitae fringilla enim, nec ullamcorper arcu.</p>
                            <blockquote>
                                <p>Quisque semper nunc vitae erat pellentesque, ac placerat arcu consectetur. In venenatis elit ac ultrices convallis. Duis est nisi, tincidunt ac urna sed, cursus blandit lectus. In ullamcorper sit amet ligula ut eleifend. Proin dictum tempor ligula, ac feugiat metus. Sed finibus tortor eu scelerisque scelerisque.</p>
                            </blockquote>


                        </div>
                        <div class="entry_content">
                            <div class="post_meta">
                                <span>Tags: </span>
                                <span><a href="#">, fashion</a></span>
                                <span><a href="#">, t-shirt</a></span>
                                <span><a href="#">, white</a></span>
                            </div>

                            <div class="social_sharing">
                                <h3>share this post:</h3>
                                <ul>
                                    <li><a href="#" title="facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#" title="twitter"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#" title="pinterest"><i class="fa fa-pinterest"></i></a></li>
                                    <li><a href="#" title="google+"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#" title="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>




                </div>
                <!--blog grid area start-->
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="blog_sidebar_widget">
                    <div class="widget_list widget_search">
                        <h3>Search</h3>
                        <form action="#">
                            <input placeholder="Search..." type="text">
                            <button type="submit">search</button>
                        </form>
                    </div>

                    <div class="widget_list widget_post">
                        <h3>Recent Posts</h3>
                        <div class="post_wrapper">
                            <div class="post_thumb">
                                <a href="blog-details.html"><img src="assets/img/blog/blog12.jpg" alt=""></a>
                            </div>
                            <div class="post_info">
                                <h3><a href="blog-details.html">Blog image post</a></h3>
                                <span>March 16, 2018 </span>
                            </div>
                        </div>
                        <div class="post_wrapper">
                            <div class="post_thumb">
                                <a href="blog-details.html"><img src="assets/img/blog/blog13.jpg" alt=""></a>
                            </div>
                            <div class="post_info">
                                <h3><a href="blog-details.html">Post with Gallery</a></h3>
                                <span>March 16, 2018 </span>
                            </div>
                        </div>
                        <div class="post_wrapper">
                            <div class="post_thumb">
                                <a href="blog-details.html"><img src="assets/img/blog/blog14.jpg" alt=""></a>
                            </div>
                            <div class="post_info">
                                <h3><a href="blog-details.html">Post with Audio</a></h3>
                                <span>March 16, 2018 </span>
                            </div>
                        </div>
                        <div class="post_wrapper">
                            <div class="post_thumb">
                                <a href="blog-details.html"><img src="assets/img/blog/blog15.jpg" alt=""></a>
                            </div>
                            <div class="post_info">
                                <h3><a href="blog-details.html">Post with Video</a></h3>
                                <span>March 16, 2018 </span>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
<!--blog section area end-->

@endsection
