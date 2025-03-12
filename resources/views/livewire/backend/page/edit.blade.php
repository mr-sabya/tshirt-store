<div>
    @if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="updatePage">


        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title
            @if ($page->status == 'draft') text-danger
            @elseif ($page->status == 'published') text-success
            @endif">
                            {{ $page->title }}
                        </h4>
                    </div>

                    <div class="card-body">


                        <div class="mb-3">
                            <label class="form-label">Sub Heading</label>
                            <input type="text" class="form-control" wire:model="sub_heading">
                            @error('sub_heading') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>



                        <div class="mb-3">
                            <label class="form-label">Text</label>
                            <livewire:quill-text-editor
                                id="details"
                                wire:model="text"
                                theme="snow" />
                            @error('text') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Page</button>

                    </div>
                </div>
            </div>

            <div class="col-lg-4">

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Image</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <div class="image-preview">
                                @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" style="height: 100%; width: auto;">
                                @elseif($currentImage)
                                <img src="{{ url('storage/'. $currentImage) }}" style="height: 100%; width: auto;">
                                @endif
                            </div>
                            <input type="file" class="form-control" wire:model="image">
                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>