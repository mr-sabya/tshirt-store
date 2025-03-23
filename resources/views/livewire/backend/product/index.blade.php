<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="m-0">Product List</h4>
            <a href="{{ route('admin.product.create') }}" wire:navigate class="btn btn-primary">Add Product</a>
        </div>

        <div class="card-body">
            <div class="d-flex justify-content-end">
                <div class="form-group mb-3 w-50">
                    <input type="text" class="form-control" wire:model="search" placeholder="Search Products...">
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bar Code</th>
                        <th>Image</th>
                        <th>
                            <a href="#" wire:click.prevent="toggleSort('name')">
                                Name
                                @if ($sortBy === 'name')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </a>
                        </th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr wire:key="product-{{ $product->id }}">
                        <th class="align-middle">{{ $loop->iteration }}</th>
                        <th class="align-middle">
                            <div style="display: flex; flex-direction: column;">
                                <img style="width: 120px;" src="data:image/png;base64,{{ DNS1D::getBarcodePNG($product->sku, 'C128') }}" alt="barcode" />
                                <small style="font-size: 9px;">{{ $product->sku }}</small>
                            </div>
                        </th>
                        <td class="align-middle"><img src="{{ url('storage/'. $product->image) }}" alt="" style="width: 50px;"></td>
                        <td class="align-middle">{{ $product->name }}</td>
                        <td class="align-middle">{{ $product->price }}</td>
                        <td class="align-middle">{{ $product->stock }}</td>
                        <td class="align-middle">{{ $product->status ? 'Active' : 'Inactive' }}</td>
                        <td class="align-middle">
                            <a href="{{ route('admin.product.edit', $product->id) }}" wire:navigate class="btn btn-info btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm" wire:click="delete({{ $product->id }})">Delete</button>

                            <button
                                class="btn btn-secondary btn-sm"
                                wire:key="variations-button-{{ $product->id }}"
                                wire:click="toggleVariations({{ $product->id }})">
                                Show Variations
                            </button>

                            <button
                                class="btn btn-secondary btn-sm"
                                wire:key="images-button-{{ $product->id }}"
                                wire:click="toggleImages({{ $product->id }})">
                                Show Gallery
                            </button>

                            <button
                                class="btn btn-secondary btn-sm"
                                wire:key="sizes-button-{{ $product->id }}"
                                wire:click="toggleforSizes({{ $product->id }})">
                                Sizes
                            </button>
                        </td>
                    </tr>

                    {{-- Variations --}}
                    @if ($product->id === $selectedProductId)
                    <tr wire:key="variations-row-{{ $product->id }}">
                        <td colspan="7">
                            <livewire:backend.product.variations
                                :productId="$product->id"
                                wire:key="variations-component-{{ $product->id }}"
                                wire:ignore.self />
                        </td>
                    </tr>
                    @endif

                    {{-- Image Gallery --}}
                    @if ($product->id === $selectedProductIdForImages)
                    <tr wire:key="images-row-{{ $product->id }}">
                        <td colspan="7">
                            <livewire:backend.product.image-gallery
                                :productId="$product->id"
                                wire:key="images-component-{{ $product->id }}"
                                wire:ignore.self />
                        </td>
                    </tr>
                    @endif

                    @if ($product->id === $selectedProductIdForSizes)
                    <tr wire:key="sizes-row-{{ $product->id }}">
                        <td colspan="7">
                            <livewire:backend.product.sizes
                                :productId="$product->id"
                                wire:key="sizes-component-{{ $product->id }}"
                                wire:ignore.self />
                        </td>
                    </tr>
                    @endif

                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No products found!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>