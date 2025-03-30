<div>
    @if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <form wire:submit.prevent="save">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h5 class="text-white m-0">Edit SEO & Social Share Content</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" class="form-control" wire:model.live="meta_title">
                            @error('meta_title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Meta Description</label>
                                    <textarea class="form-control" wire:model.debounce.500ms="meta_description" rows="3"></textarea>
                                    @error('meta_description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Meta Keywords</label>
                                    <textarea class="form-control" wire:model.live="meta_keywords" rows="3"></textarea>
                                    @error('meta_keywords')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h5 class="text-white m-0">Edit SEO & Social Share Content</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label class="form-label">OG Title</label>
                                    <input type="text" class="form-control" wire:model.live="og_title">
                                    @error('og_title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">OG Description</label>
                                    <textarea class="form-control" wire:model.live="og_description" rows="4"></textarea>
                                    @error('og_description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">OG Image</label>
                                    <div class="image-preview" style="height: 145px;">
                                        @if ($new_og_image)
                                        <img src="{{ $new_og_image->temporaryUrl() }}" class="img-thumbnail" style="height: 100%; width: auto;">
                                        @elseif ($og_image)
                                        <img src="{{ asset('storage/' . $og_image) }}" class="img-thumbnail" style="height: 100%; width: auto;">
                                        @endif
                                    </div>
                                    <input type="file" class="form-control" wire:model="new_og_image">
                                    @error('new_og_image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>