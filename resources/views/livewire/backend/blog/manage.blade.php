<div>
    @if (session()->has('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form -->
    <form wire:submit.prevent="save" class="mb-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="m-0 text-white">Blog Details</h4>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <label>Title</label>
                            <input wire:model.defer="title" type="text" class="form-control" wire:keyup="generateSlug">
                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Slug</label>
                            <input wire:model.defer="slug" type="text" class="form-control">
                            @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>


                        <div class="mb-3">
                            <label>Content</label>
                            <livewire:quill-text-editor
                                id="details"
                                wire:model="content"
                                theme="snow" />
                            @error('content') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="m-0 text-white">SEO Details</h4>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <label>Meta Title</label>
                            <input wire:model.defer="meta_title" type="text" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Meta Description</label>
                            <textarea wire:model.defer="meta_description" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Meta Keywords</label>
                            <input wire:model.defer="meta_keywords" type="text" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>OG Title</label>
                            <input wire:model.defer="og_title" type="text" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>OG Description</label>
                            <textarea wire:model.defer="og_description" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="m-0 text-white">Image</h4>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <label>Featured Image</label>
                            <div class="image-preview">
                                @if ($new_featured_image)
                                <img src="{{ $new_featured_image->temporaryUrl() }}" style="height: 100%; width: auto;">
                                @elseif ($featured_image)
                                <img src="{{ asset('storage/' . $featured_image) }}" style="height: 100%; width: auto;">
                                @endif
                            </div>
                            <input wire:model="new_featured_image" type="file" class="form-control">

                            @error('new_featured_image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>OG Image</label>
                            {{ $og_image }}
                            <div class="image-preview">
                                @if ($new_og_image)
                                <img src="{{ $new_og_image->temporaryUrl() }}" style="height: 100%; width: auto;">
                                @elseif ($og_image)
                                <img src="{{ asset('storage/' . $og_image) }}" style="height: 100%; width: auto;">
                                @endif
                            </div>

                            <input wire:model="new_og_image" type="file" class="form-control">
                            @error('new_og_image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>
                                <input wire:model.defer="is_published" type="checkbox"> Published
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <button class="btn btn-primary">Save Blog</button>
                <button type="button" class="btn btn-secondary" wire:click="resetForm">Reset</button>
            </div>
        </div>
    </form>
</div>