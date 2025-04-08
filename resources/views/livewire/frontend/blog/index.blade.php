<!-- Ec Blog page -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="ec-blogs-rightside col-lg-12 col-md-12">

                <!-- Blog content Start -->
                <div class="ec-blogs-content">
                    <div class="ec-blogs-inner">
                        <div class="row">
                            @foreach ($blogs as $blog)
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-6 ec-blog-block">
                                <div class="ec-blog-inner">
                                    <div class="ec-blog-image">
                                        <a href="{{ route('blog.show', $blog->slug) }}" wire:navigate>
                                            <img class="blog-image" src="{{ url('storage/' . $blog->featured_image) }}"
                                                alt="Blog" />
                                        </a>
                                    </div>
                                    <div class="ec-blog-content">
                                        <h5 class="ec-blog-title">
                                            <a href="{{ route('blog.show', $blog->slug) }}" wire:navigate>{{ $blog->title }}</a>
                                        </h5>

                                        <div class="ec-blog-date">By <span>Admin</span> / {{ date('F d, Y', strtotime($blog->created_at)) }}</div>
                                        <div class="ec-blog-desc">{{ $blog->meta_description }}</div>

                                        <div class="ec-blog-btn"><a href="{{ route('blog.show', $blog->slug) }}" wire:navigate class="btn btn-primary">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Ec Pagination Start -->
                    <div class="ec-pro-pagination">
                        {{ $blogs->links() }}

                    </div>
                    <!-- Ec Pagination End -->
                </div>
                <!--Blog content End -->
            </div>
        </div>
    </div>
</section>