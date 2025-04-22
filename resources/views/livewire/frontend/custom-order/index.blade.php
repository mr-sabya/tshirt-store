<section class="ec-page-content section-space-p checkout_page ">
    <div class="container">
        <div class="custom-order-category">
            @foreach($categories as $cat)
            <div class="item">
                <div class="card p-2 {{ $cat->name == $categoryName ? 'bg-primary' : '' }}">
                    <a href="{{ route('custom-order.index', $cat->name) }}" wire:navigate>
                        <img src="{{ url('storage/' . $cat->image) }}" alt="" class="w-100">
                    </a>
                </div>
            </div>
            @endforeach
        </div>


        <!-- custom order design -->
        <div class="row mt-5 design">
            <div class="col-lg-6">

                <h5>Designs</h5>
                <div class="row">
                    @foreach($designs as $design)
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card position-relative">
                            <div class="design-card position-relative">
                                <img src="{{ url('storage/' . $design->image) }}" alt="" class="w-100 rounded">

                                <!-- Dropdown on top of image -->

                            </div>
                        </div>

                        <div class="dropdown">
                            <button class="btn btn-sm btn-primary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Select Option
                            </button>
                            <ul class="dropdown-menu w-100">
                                @foreach($category->options as $option)
                                <li>
                                    <button class="dropdown-item"
                                        wire:click="selectOption({{ $design->id }}, {{ $option->id }})">
                                        Select for {{ $option->name }}
                                    </button>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        @if(isset($selectedOptions[$design->id]))
                        @php
                        $selectedOption = $category->options->firstWhere('id', $selectedOptions[$design->id]);
                        @endphp
                        <div class="alert alert-info text-center mt-2">
                            Selected: {{ $selectedOption->name }}
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>

            </div>

            <div class="col-lg-6">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @foreach($category->options as $option)
                    @php $optionId = 'option_' . $option->id; @endphp
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                            id="{{ $optionId }}-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#{{ $optionId }}"
                            type="button"
                            role="tab"
                            aria-controls="{{ $optionId }}"
                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                            {{ $option->name }}
                        </button>
                    </li>
                    @endforeach
                </ul>

                <div class="tab-content" id="myTabContent">
                    @foreach($category->options as $option)
                    @php $optionId = 'option_' . $option->id; @endphp
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                        id="{{ $optionId }}"
                        role="tabpanel"
                        aria-labelledby="{{ $optionId }}-tab">
                        <div class="customizer-frame">
                            <h4>{{ $option->name }}</h4>
                            <img src="{{ url('storage/' . $option->image) }}" alt="">
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
</section>