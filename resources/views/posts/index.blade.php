@extends('layouts.layout')

@section('title', 'LaraBlog - Marketing Blog :: Home')

@section('header')

    <section id="cta" class="section" >
        <div class="container" >
            <div class="row" >
                <div class="col-lg-8 col-md-12 align-self-center" >
                    <h2>Laravel blog</h2>
                    <p class="lead"> Дипломный проект по PHP с использованием Фреймворка Laravel...</p>
                </div>
                <div class="col-lg-4 col-md-12" >
                    <div class="newsletter-widget text-center align-self-center" style="margin: 10px; padding: 10px" >
                        <h3>New post</h3>
                        @foreach($last_posts as $post)
                            <a href="{{ route('posts.single', ['slug' => $post->slug]) }}"
                               class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="w-100 justify-content-between">
                                    <img src="{{ $post->getImage() }}" alt="" class="img-fluid float-left">
                                    <h5 class="mb-1">{{ $post->title }}</h5>

                                </div>
                            </a>
                        @endforeach



                    </div><!-- end newsletter -->
                </div>

            </div>


        </div>
    </section>

@endsection

@section('content')

    <div class="page-wrapper">
        <div class="blog-custom-build">

            @foreach($posts as $post)
                <div class="blog-box wow fadeIn">
                    <div class="post-media">
                        <a href="{{ route('posts.single', ['slug' => $post->slug]) }}" title="">
                            <img src="{{ $post->getImage() }}" alt="" class="img-fluid">
                            <div class="hovereffect">
                                <span></span>
                            </div>
                            <!-- end hover -->
                        </a>
                    </div>
                    <!-- end media -->
                    <div class="blog-meta big-meta text-center">
                        <div class="post-sharing">
                            <ul class="list-inline">
                                <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span
                                            class="down-mobile">Share on Facebook</span></a></li>
                                <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span
                                            class="down-mobile">Tweet on Twitter</span></a></li>
                                <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a>
                                </li>
                            </ul>
                        </div><!-- end post-sharing -->

                        <h4><a href="{{ route('posts.single', ['slug' => $post->slug]) }}" title="">{{ $post->title }}</a></h4>
                        {!! $post->description !!}
                        <small><a href="{{ route('categories.single', ['slug' => $post->category->slug]) }}" title="">{{ $post->category->title }}</a></small>
                        <small>{{ $post->getPostDate() }}</small>
                        <small><i class="fa fa-eye"></i> {{ $post->views }}</small>
                    </div><!-- end meta -->
                </div><!-- end blog-box -->

                <hr class="invis">
            @endforeach

        </div>
    </div>

    <hr class="invis">

    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation">
                {{ $posts->links() }}
            </nav>
        </div><!-- end col -->
    </div><!-- end row -->

@endsection
