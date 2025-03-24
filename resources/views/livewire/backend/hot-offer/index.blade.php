<div class="row">
    <!-- Form Section -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary">
                <h4 class="m-0 text-white">{{ $isEditing ? 'Edit Hot Offer' : 'Create Hot Offer' }}</h4>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
                    <div class="form-group mb-3">
                        <label for="title">Title</label>
                        <input type="text" id="title" wire:model="title" class="form-control">
                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="text">Description</label>
                        <textarea id="text" wire:model="text" class="form-control"></textarea>
                        @error('text') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="product">Product</label>
                        <select id="product" wire:model="product_id" class="form-control">
                            <option value="">Select a Product</option>
                            @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        @error('product_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="image">Image</label>
                        <div class="image-preview">
                            @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" style="height: 100%; width: auto;">
                            @elseif($currentImage)
                            <img src="{{ url('storage/'. $currentImage) }}" style="height: 100%; width: auto;">
                            @endif
                        </div>
                        <input type="file" id="image" wire:model="image" class="form-control">
                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ $isEditing ? 'Update Offer' : 'Create Offer' }}
                    </button>

                    @if($isEditing)
                    <button type="button" wire:click="cancelEdit" class="btn btn-secondary">Cancel</button>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary">
                <h4 class="m-0 text-white">Hot Offers</h4>
            </div>
            <div class="card-body">
                <input type="text" wire:model="search" class="form-control w-50" placeholder="Search by title...">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th wire:click="sortBy('title')" style="cursor: pointer">
                                Title
                                @if($sortField === 'title')
                                @if($sortDirection === 'asc')
                                <span>&#8593;</span>
                                @else
                                <span>&#8595;</span>
                                @endif
                                @endif
                            </th>
                            <th wire:click="sortBy('created_at')" style="cursor: pointer">
                                Created At
                                @if($sortField === 'created_at')
                                @if($sortDirection === 'asc')
                                <span>&#8593;</span>
                                @else
                                <span>&#8595;</span>
                                @endif
                                @endif
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hotOffers as $offer)
                        <tr>
                            <td class="align-middle">
                                <img src="{{ url('storage/', $offer->image) }}" alt="" style="width: 50px;">
                            </td>
                            <td class="align-middle">{{ $offer->title }}</td>
                            <td class="align-middle">{{ $offer->created_at->format('Y-m-d') }}</td>
                            <td class="align-middle">
                                <button wire:click="edit({{ $offer->id }})" class="btn btn-warning btn-sm">Edit</button>
                                <button wire:click="delete({{ $offer->id }})" class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-between">
                    <div>
                        Showing {{ $hotOffers->firstItem() }} to {{ $hotOffers->lastItem() }} of {{ $hotOffers->total() }} offers.
                    </div>
                    <div>
                        {{ $hotOffers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>