<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <div class="card">
        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
            <h4 class="m-0 text-white">Product List</h4>
            <a href="{{ route('admin.product.create') }}" wire:navigate class="btn btn-light">Add Product</a>
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
                        <td class="align-middle d-flex gap-2">
                            <a href="{{ route('admin.product.edit', $product->id) }}" wire:navigate class="btn btn-info btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm" wire:click="confirmDelete({{ $product->id }})" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>

                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <button class="dropdown-item"
                                            wire:key="variations-button-{{ $product->id }}"
                                            wire:click="toggleVariations({{ $product->id }})">
                                            Variations
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item"
                                            wire:key="images-button-{{ $product->id }}"
                                            wire:click="toggleImages({{ $product->id }})">
                                            Gallery
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item"
                                            wire:key="sizes-button-{{ $product->id }}"
                                            wire:click="toggleforSizes({{ $product->id }})">
                                            Sizes
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item"
                                            wire:key="info-button-{{ $product->id }}"
                                            wire:click="toggleforInfo({{ $product->id }})">
                                            More Infos
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item"
                                            wire:key="seo-button-{{ $product->id }}"
                                            wire:click="toggleforSeo({{ $product->id }})">
                                            SEO
                                        </button>
                                    </li>
                                </ul>
                            </div>

                        </td>
                    </tr>

                    {{-- Variations --}}
                    @if ($product->id === $selectedProductId)
                    <tr wire:key="variations-row-{{ $product->id }}">
                        <td colspan="8">
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
                        <td colspan="8">
                            <livewire:backend.product.image-gallery
                                :productId="$product->id"
                                wire:key="images-component-{{ $product->id }}"
                                wire:ignore.self />
                        </td>
                    </tr>
                    @endif

                    @if ($product->id === $selectedProductIdForSizes)
                    <tr wire:key="sizes-row-{{ $product->id }}">
                        <td colspan="8">
                            <livewire:backend.product.sizes
                                :productId="$product->id"
                                wire:key="sizes-component-{{ $product->id }}"
                                wire:ignore.self />
                        </td>
                    </tr>
                    @endif
                    @if ($product->id === $selectedProductIdForInfo)
                    <tr wire:key="info-row-{{ $product->id }}">
                        <td colspan="8">
                            <livewire:backend.product.info
                                :productId="$product->id"
                                wire:key="info-component-{{ $product->id }}"
                                wire:ignore.self />
                        </td>
                    </tr>
                    @endif

                    @if ($product->id === $selectedProductIdForSeo)
                    <tr wire:key="seo-row-{{ $product->id }}">
                        <td colspan="8">
                            <livewire:backend.product.seo
                                :productId="$product->id"
                                wire:key="seo-component-{{ $product->id }}"
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


    <!-- Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteProduct" data-bs-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>


</div>