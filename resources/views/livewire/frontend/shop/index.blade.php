<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="ec-shop-rightside col-lg-9 col-md-12 order-lg-last order-md-first margin-b-30">
                <div class="ec-pro-list-top d-flex">
                    <div class="col-md-6 ec-grid-list">
                        <div class="ec-gl-btn">
                            <button class="btn btn-grid active"><i class="fi-rr-apps"></i></button>
                            <button class="btn btn-list"><i class="fi-rr-list"></i></button>
                        </div>
                    </div>
                    <div class="col-md-6 ec-sort-select">
                        <span class="sort-by">Sort by</span>
                        <div class="ec-select-inner">
                            <select name="ec-select" id="ec-select" wire:change="updateSortOrder($event.target.value)">
                                <option selected disabled>Position</option>
                                <option value="1">Relevance</option>
                                <option value="2">Name, A to Z</option>
                                <option value="3">Name, Z to A</option>
                                <option value="4">Price, low to high</option>
                                <option value="5">Price, high to low</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Shop content Start -->
                <div class="shop-pro-content">
                    <div class="shop-pro-inner">
                        <div class="row">
                            @forelse($products as $product)
                            <livewire:frontend.components.product :productId="$product->id" :key="$product->id" />
                            @empty
                            <div class="col-lg-12">
                                <h4>No Products Found</h4>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Ec Pagination Start -->
                    <div class="ec-pro-pagination">
                        {{ $products->links() }}
                    </div>
                    <!-- Ec Pagination End -->
                </div>
                <!-- Shop content End -->
            </div>

            <!-- Sidebar Area Start -->
            <div class="ec-shop-leftside col-lg-3 col-md-12 order-lg-first order-md-last">
                <div id="shop_sidebar">
                    <div class="ec-sidebar-heading">
                        <h1>Filter Products By</h1>
                    </div>
                    <div class="ec-sidebar-wrap">
                        @if($this->showResetButton)
                        <div class="ec-sidebar-block">
                            <button type="button" class="btn btn-danger w-100 mt-3" wire:click="resetFilters">
                                Reset Filters
                            </button>
                        </div>
                        @endif

                        <!-- Sidebar Category Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Category</h3>
                            </div>

                            <div class="ec-sb-block-content">
                                <ul>
                                    @foreach($categories as $category)
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" id="category_{{ $category->id }}" value="{{ $category->id }}"
                                                wire:click="updateCategoryFilter({{ $category->id }})"
                                                @if(in_array($category->id, $categoryFilter)) checked @endif />
                                            <label for="category_{{ $category->id }}">{{ $category->name }}</label><span class="checked"></span>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Sidebar Size Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Size</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <ul>
                                    @foreach($sizes as $size)
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" id="size_{{ $size->id }}" value="{{ $size->id }}"
                                                wire:click="updateSizeFilter({{ $size->id }})"
                                                @if(in_array($size->id, $sizeFilter)) checked @endif />
                                            <label for="size_{{ $size->id }}">{{ $size->name }}</label><span class="checked"></span>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Sidebar Color Block -->
                        <div class="ec-sidebar-block ec-sidebar-block-clr">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Color</h3>
                            </div>
                            <div class="ec-sb-block-content ec-sidebar-dropdown">
                                <ul>
                                    @foreach($colors as $color)
                                    <li class="{{ in_array($color->id, $colorFilter) ? 'active' : '' }}">
                                        <div class="ec-sidebar-block-item">
                                            <input class="hidden-input" type="checkbox" id="color_{{ $color->id }}" value="{{ $color->id }}"
                                                wire:click="updateColorFilter({{ $color->id }})"
                                                @if(in_array($color->id, $colorFilter)) checked @endif />
                                            <label class="m-0" for="color_{{ $color->id }}">
                                                <span style="background-color:{{ $color->color }};"></span>
                                            </label>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar Area End -->
        </div>
    </div>
</section>