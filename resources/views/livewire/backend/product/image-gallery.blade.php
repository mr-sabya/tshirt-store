<div class="row">
    <!-- Left Column: Image Upload Form -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="m-0 text-white">Upload Images</h5>
            </div>
            <div class="card-body">
                @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
                @endif

                <form wire:submit.prevent="uploadImages">
                    <div class="mb-3">
                        <label class="form-label">Select Images</label>
                        <input type="file" class="form-control" wire:model="images" multiple>
                        @error('images.*') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Live Preview of Selected Images -->
                    <div class="row">
                        @foreach ($newImagePreviews as $preview)
                        <div class="col-4 mb-2">
                            <img src="{{ $preview }}" class="img-thumbnail" style="height: 100px; object-fit: cover;">
                        </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Upload</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Column: Image Gallery -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="m-0 text-white">Image Gallery</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse ($productImages as $image)
                    <div class="col-md-3 mb-3">
                        <div class="border">
                            <div class="p-3 text-center">
                                <img src="{{ asset('storage/' . $image->image_path) }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                                <button class="btn btn-danger btn-sm" wire:click="deleteImage({{ $image->id }})">Delete</button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-center">No images uploaded yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>