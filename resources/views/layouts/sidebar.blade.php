<div class="sidebar">
    <div class="widget">
        <h2 class="widget-title">Popular Posts</h2>
        <div class="blog-list-widget">
            <div class="list-group">

                @foreach($popular_posts as $post)
                    <a href="{{ route('posts.single', ['slug' => $post->slug]) }}"
                       class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="w-100 justify-content-between">
                            <img src="{{ $post->getImage() }}" alt="" class="img-fluid float-left">
                            <h5 class="mb-1">{{ $post->title }}</h5>
                            <small>{{ $post->getPostDate() }}</small>
                            <small>| <i class="fa fa-eye"></i> {{ $post->views }}</small>
                        </div>
                    </a>
                @endforeach
            </div>
        </div><!-- end blog-list -->
    </div><!-- end widget -->



    <div class="widget">
        <h2 class="widget-title">Categories</h2>
        <div class="link-widget">
            <ul>
                @foreach($categories as $category)
                    <li><a href="{{ route('categories.single', ['slug' => $category->slug]) }}">{{ $category->title }} <span>({{ $category->posts_count }})</span></a></li>
                @endforeach
            </ul>
        </div><!-- end link-widget -->
    </div><!-- end widget -->

    <div class="widget">
        <h2 class="widget-title">Tags</h2>
        <div class="link-widget">
            <ul>
                @foreach($tags as $tag)
                    <li><a href="{{ route('tags.single', ['slug' => $tag->slug]) }}">{{ $tag->title }} <span>({{ $tag->posts_count }})</span></a></li>
                @endforeach
            </ul>
        </div><!-- end link-widget -->
    </div><!-- end widget -->
</div><!-- end sidebar -->


