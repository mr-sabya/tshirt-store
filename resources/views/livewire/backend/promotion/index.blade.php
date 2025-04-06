<div class="row">
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-primary">
                <h4 class="m-0 text-white">Update Promotion</h4>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="updatePromotion">
                    <div class="form-group mb-3">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control" id="product_name" wire:model="product_name" required>
                        @error('product_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="offer_text">Offer Text</label>
                        <input type="text" class="form-control" id="offer_text" wire:model="offer_text" required>
                        @error('offer_text') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="offer_description">Offer Description</label>
                        <textarea class="form-control" id="offer_description" wire:model="offer_description" required></textarea>
                        @error('offer_description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="product_id">Product</label>
                        <select class="form-control" id="product_id" wire:model="product_id" required>
                            <option value="">Select Product</option>
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        @error('product_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="offer_image">Offer Image</label>
                        <div class="image-preview">
                            @if ($offerImagePreview)
                            <img src="{{ $offerImagePreview }}" alt="Offer Image" style="height: 100%; width: auto;">
                            @endif
                        </div>
                        <input type="file" class="form-control" id="offer_image" wire:model="offer_image">
                        @error('offer_image') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="background_image">Background Image</label>
                        <div class="image-preview">
                            @if ($backgroundImagePreview)
                            <img src="{{ $backgroundImagePreview }}" alt="Background Image" style="height: 100%; width: auto;">
                            @endif
                        </div>
                        <input type="file" class="form-control" id="background_image" wire:model="background_image">
                        @error('background_image') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update Promotion</button>
                </form>
            </div>
        </div>
    </div>
</div>