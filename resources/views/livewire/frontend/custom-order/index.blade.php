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
                                        {{ $option->name }}
                                    </button>
                                </li>
                                @endforeach
                            </ul>
                        </div>


                    </div>
                    @endforeach
                </div>

            </div>

            <div class="col-lg-6">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @foreach($category->options as $option)
                    @php
                    $optionId = 'option_' . $option->id;
                    $isActive = $loop->first;
                    @endphp
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $isActive ? 'active' : '' }}"
                            id="{{ $optionId }}-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#{{ $optionId }}"
                            type="button"
                            role="tab"
                            aria-controls="{{ $optionId }}"
                            aria-selected="{{ $isActive ? 'true' : 'false' }}">
                            {{ $option->name }}
                        </button>
                    </li>
                    @endforeach
                </ul>

                <div class="tab-content" id="myTabContent">
                    @foreach($category->options as $option)
                    @php
                    $optionId = 'option_' . $option->id;
                    $data = $selectedOptions[$option->id] ?? [];
                    @endphp
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                        id="{{ $optionId }}"
                        role="tabpanel"
                        aria-labelledby="{{ $optionId }}-tab">
                        <div class="customizer-frame">
                            <h4 class="text-center mt-4 mb-4">{{ $option->name }}</h4>
                            <img src="{{ url('storage/' . $option->image) }}" alt="" class="w-100 mb-3">
                            <div class="{{ Str::lower(str_replace(' ', '', $option->name)) }}">

                                {{-- Show selected existing design --}}
                                @if (!empty($data['design_id']))
                                @php $design = \App\Models\Design::find($data['design_id']); @endphp
                                @if ($design)
                                <img src="{{ url('storage/' . $design->image) }}" class="preview-image mb-2">
                                @endif
                                @endif

                                {{-- Show uploaded image --}}
                                @if (!empty($data['image']))
                                <img src="{{ $data['image']->temporaryUrl() }}" class="preview-image mb-2">
                                @elseif (!empty($data['image_url']))
                                <img src="{{ url('storage/' . $data['image_url']) }}" class="preview-image mb-2">
                                @endif

                                {{-- Show custom text --}}
                                @if (!empty($data['custom_text']))
                                <p class="text-center mt-2">{{ $data['custom_text'] }}</p>
                                @endif
                            </div>
                        </div>

                        {{-- Input for custom text --}}
                        <div class="form-group mt-3">
                            <label for="text-input-{{ $option->id }}">Custom Text</label>
                            <input type="text" class="form-control"
                                id="text-input-{{ $option->id }}"
                                wire:model="selectedOptions.{{ $option->id }}.text"
                                placeholder="Enter custom text">
                        </div>

                        {{-- Image upload --}}
                        <div class="form-group mt-3">
                            <label for="image-input-{{ $option->id }}">Upload Your Design</label>
                            <input type="file" class="form-control-file"
                                id="image-input-{{ $option->id }}"
                                wire:model="selectedOptions.{{ $option->id }}.image">
                        </div>

                        <button type="button" class="btn btn-primary mt-4"
                            wire:click="saveOption({{ $option->id }})">
                            Save Option
                        </button>
                        <button type="button"
                            class="btn btn-secondary"
                            wire:click="clearOption({{ $option->id }})">
                            Clear
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>