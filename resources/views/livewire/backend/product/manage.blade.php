<div>

    <div class="card">
        <div class="card-header">
            <h4>{{ $productId ? 'Edit Product' : 'Create Product' }}</h4>
        </div>
    </div>


    <form wire:submit.prevent="save">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">

                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name">Product Name</label>
                            <input type="text" id="name" class="form-control" wire:model="name" wire:keyup="generateSlug" required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" class="form-control" wire:model="slug" required>
                            @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="sku">SKU</label>
                            <input type="text" id="sku" class="form-control" wire:model="sku" required>
                            @error('sku') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="price">Price</label>
                                    <input type="number" id="price" class="form-control" wire:model="price" step="0.01" wire:keyup="calculateDiscount" required>
                                    @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="regular_price">Regular Price</label>
                                    <input type="number" id="regular_price" class="form-control" wire:model="regular_price" step="0.01" wire:keyup="calculateDiscount" required>
                                    @error('regular_price') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="discount">Discount</label>
                                    <input type="number" id="discount" class="form-control" wire:model="discount" step="0.01" max="100">
                                    @error('discount') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                        </div>



                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="buy_price">Buy Price</label>
                                    <input type="number" id="buy_price" class="form-control" wire:model="buy_price" step="0.01">
                                    @error('buy_price') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="cost_price">Cost Price</label>
                                    <input type="number" id="cost_price" class="form-control" wire:model="cost_price" step="0.01">
                                    @error('cost_price') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                            </div>

                        </div>

                        <div class="form-group mb-3">
                            <label for="details">Product Details</label>
                            <livewire:quill-text-editor
                                id="details"
                                wire:model.live="details"
                                theme="snow" />
                            @error('details') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="short_desc">Short Description</label>
                            <textarea id="short_desc" class="form-control" wire:model="short_desc"></textarea>
                            @error('short_desc') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ $productId ? 'Update Product' : 'Create Product' }}
                        </button>
                        <a href="{{ route('admin.product.index') }}" wire:navigate class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="category_id">Category</label>
                            <select id="category_id" class="form-control" wire:model="category_id" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="sizes">Sizes</label>
                            <select id="sizes" class="form-control" wire:model="size_ids" multiple>
                                <option value="">Select Sizes</option>
                                @foreach ($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @endforeach
                            </select>
                            @error('size_ids') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">Product Image</label>
                            <div class="image-preview">
                                @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" style="height: 100%; width: auto;">
                                @elseif($currentImage)
                                <img src="{{ url('uploads/', $currentImage) }}" style="height: 100%; width: auto;">
                                @endif
                            </div>
                            <input type="file" id="image" class="form-control" wire:model="image">
                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror

                        </div>

                        <div class="form-group mb-3">
                            <label for="featured">Featured?</label>
                            <input type="checkbox" id="featured" wire:model="featured">
                            @error('featured') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="is_stock">In Stock?</label>
                            <input type="checkbox" id="is_stock" wire:model="is_stock">
                            @error('is_stock') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="product_status">Active?</label>
                            <input type="checkbox" id="product_status" wire:model="status">
                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>


                        <div class="form-group mb-3">
                            <label for="stock">Stock</label>
                            <input type="number" id="stock" class="form-control" wire:model="stock">
                            @error('stock') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>



                    </div>
                </div>
            </div>

        </div>
    </form>

</div>