<!-- Ec Blog page -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="ec-blogs-rightside col-lg-8 col-md-12">

                <!-- Blog content Start -->
                <div class="ec-blogs-content">
                    <div class="ec-blogs-inner">
                        <div class="ec-blog-main-img">
                            <img class="blog-image w-100" src="{{ url('storage/' . $blog->featured_image) }}" alt="Blog" />
                        </div>
                        <div class="ec-blog-date">
                            <p class="date">28 JUNE, 2021-2022 - </p><a href="javascript:void(0)">5 Comments</a>
                        </div>
                        <div class="ec-blog-detail">
                            {!! $blog->content !!}
                        </div>

                        <div class="ec-blog-arrows">
                            @if ($previousBlog)
                            <a href="{{ route('blog.show', $previousBlog->slug) }}" wire:navigate>
                                <i class="ecicon eci-angle-left"></i> Prev Post
                            </a>
                            @else
                            <a href="javascript:void(0)" class="disabled" style="color: #ccc;">
                                <i class="ecicon eci-angle-left"></i> Prev Post
                            </a>
                            @endif

                            @if ($nextBlog)
                            <a href="{{ route('blog.show', $nextBlog->slug) }}" wire:navigate>
                                Next Post <i class="ecicon eci-angle-right"></i>
                            </a>
                            @else
                            <a href="javascript:void(0)" class="disabled" style="color: #ccc;">
                                Next Post <i class="ecicon eci-angle-right"></i>
                            </a>
                            @endif
                        </div>

                        <!-- Comment Section -->
                        <div class="ec-blog-comments">
                            <div class="ec-blog-cmt-preview">
                                <div class="ec-blog-comment-wrapper mt-55">
                                    <h4 class="ec-blog-dec-title">Comments : {{ count($comments) }}</h4>
                                    @foreach($comments as $comment)
                                    <div class="ec-single-comment-wrapper mt-35">
                                        <div class="ec-blog-user-img">
                                            <img src="{{ url('assets/frontend/images/blog-image/9.jpg') }}" alt="blog image">
                                        </div>
                                        <div class="ec-blog-comment-content">
                                            <h5>{{ $comment->user_name }}</h5>
                                            <span>{{ $comment->created_at->format('F j, Y') }}</span>
                                            <p>{{ $comment->content }}</p>
                                            <div class="ec-blog-details-btn">
                                                
                                                <a href="javascript:void(0)" wire:click="submitReply({{ $comment->id }})">Reply</a>
                                                
                                            </div>
                                        </div>
                                        <!-- Show replies -->
                                        @foreach ($comment->replies as $reply)
                                        <div class="ec-single-comment-wrapper mt-50 ml-150">
                                            <div class="ec-blog-user-img">
                                                <img src="{{ url('assets/frontend/images/blog-image/10.jpg') }}" alt="blog image">
                                            </div>
                                            <div class="ec-blog-comment-content">
                                                <h5>{{ $reply->user_name }}</h5>
                                                <span>{{ $reply->created_at->format('F j, Y') }}</span>
                                                <p>{{ $reply->content }}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Comment Form -->
                            <div class="ec-blog-cmt-form">
                                <div class="ec-blog-reply-wrapper mt-50">
                                    <h4 class="ec-blog-dec-title">Leave A Reply</h4>
                                    <form class="ec-blog-form" wire:submit.prevent="submitComment">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="ec-leave-form">
                                                    <input type="text" wire:model="userName" placeholder="Full Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="ec-leave-form">
                                                    <input type="email" wire:model="userEmail" placeholder="Email Address">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="ec-text-leave">
                                                    <textarea wire:model="commentContent" placeholder="Message"></textarea>
                                                    <button type="submit" class="btn btn-lg btn-secondary">Reply Now</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--Blog content End -->
            </div>
            <!-- Sidebar Area Start -->
            <div class="ec-blogs-leftside col-lg-4 col-md-12">

                <div class="ec-sidebar-wrap">

                    <div class="ec-sidebar-block ec-sidebar-recent-blog">
                        <div class="ec-sb-title">
                            <h3 class="ec-sidebar-title">Recent Articles</h3>
                        </div>
                        <div class="ec-sb-block-content">
                            @foreach($recentBlogs as $recentBlog)
                            <div class="ec-sidebar-block-item">
                                <h5 class="ec-blog-title"><a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a></h5>
                                <div class="ec-blog-date">{{ date('F d, Y', strtotime($blog->created_at)) }}</div>
                            </div>
                            @endforeach

                        </div>
                    </div>

                    <!-- Sidebar Recent Blog Block -->
                    <div class="ec-sidebar-block ec-sidebar-recent-blog">
                        <div class="ec-sb-title">
                            <h3 class="ec-sidebar-title">Recent Products</h3>
                        </div>
                        <div class="ec-sb-block-content">
                            @foreach($products as $product)
                            <div class="ec-sidebar-block-item d-flex gap-2">
                                <div class="image" style="flex-basis: 20%;">
                                    <a href="{{ route('product.show', $product->slug) }}" wire:navigate>
                                        <img class="img-fluid" src="{{ url('storage/' . $product->image) }}" alt="Product" />
                                    </a>
                                </div>
                                <div class="text" style="flex-basis: 80%;">
                                    <div class="ec-pro-content ec-product-body">
                                        <ul class="ec-rating d-flex">
                                            @php
                                            $averageRating = $product->averageRating(); // Get the average rating
                                            $fullStars = floor($averageRating); // Full stars
                                            $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0; // Check if there is a half star
                                            $emptyStars = 5 - ($fullStars + $halfStar); // Empty stars
                                            @endphp

                                            @for ($i = 1; $i <= $fullStars; $i++)
                                                <li class="ecicon eci-star fill">
                                                </li> <!-- Full star -->
                                                @endfor

                                                @if ($halfStar)
                                                <li class="ecicon eci-star-half"></li> <!-- Half star -->
                                                @endif

                                                @for ($i = 1; $i <= $emptyStars; $i++)
                                                    <li class="ecicon eci-star">
                                                    </li> <!-- Empty star -->
                                                    @endfor
                                        </ul>

                                        <h5 class="ec-pro-title"><a href="{{ route('product.show', $product->slug) }}" wire:navigate>{{ $product->name }}</a></h5>
                                        <div class="ec-pro-list-desc">{{ $product->short_desc }}</div>
                                        <span class="ec-price">
                                            <span class="new-price">৳{{ $product->price }}</span>
                                            <span class="old-price" style="text-decoration: line-through; color: #ccc;">৳{{ $product->regular_price }}</span>
                                        </span>

                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                    <!-- Sidebar Recent Blog Block -->

                </div>
            </div>
        </div>
    </div>
</section>