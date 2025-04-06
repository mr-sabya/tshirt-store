<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <!-- Sidebar Start -->
            <div class="ec-compare-leftside col-lg-3 col-md-12">
                <div class="ec-sidebar-wrap">
                    <div class="ec-sidebar-block">
                        <div class="ec-sidebar-block-item">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Compare Content Start -->
            <div class="ec-compare-rightside col-lg-9 col-md-12">
                <!-- Compare content Start -->
                <div class="ec-compare-content">
                    <div class="ec-compare-inner">
                        <div class="row">
                            @forelse($compareProducts as $product)
                            <livewire:frontend.components.product productId="{{ $product->id }}" showRemoveFromCompare="true"/>
                            @empty
                            <div class="col-12">
                                <h4>No products in compare list.</h4>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <!-- Compare content End -->

            </div>

            <!-- Compare Table Start -->
            @if($compareProducts->count() > 0)
            <div class="ec-compare-table col-md-12">
                <div class="ec-com-tab-heading">Show Only Difference</div>
                <form action="#">
                    <div class="compare-table table-responsive">
                        <table class="table mb-0">
                            <tbody>
                                <!-- Name -->
                                <tr>
                                    <td class="first-column">Name</td>
                                    @foreach($compareProducts as $product)
                                    <td class="prod-{{ $loop->index + 1 }}">{{ $product->name }}</td>
                                    @endforeach
                                </tr>

                                <!-- SKU -->
                                <tr>
                                    <td class="first-column">SKU</td>
                                    @foreach($compareProducts as $product)
                                    <td class="prod-{{ $loop->index + 1 }}">
                                        {{ $product->sku ?? 'N/A' }}
                                    </td>
                                    @endforeach
                                </tr>

                                <!-- infos -->
                                @foreach($compareProducts as $product)
                                @foreach($product->infos as $info)
                                <tr>
                                    <td class="first-column">{{ $info->key }}</td>
                                    @foreach($compareProducts as $product)
                                    <td class="prod-{{ $loop->index + 1 }}">
                                        {{ $product->infos->where('id', $info->id)->first()->value ?? 'N/A' }}
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                                @endforeach

                                <!-- Availability -->
                                <tr>
                                    <td class="first-column">Availability</td>
                                    @foreach($compareProducts as $product)
                                    <td class="prod-{{ $loop->index + 1 }}">
                                        {{ $product->stock > 0 ? 'In Stock' : 'Out Of Stock' }}
                                    </td>
                                    @endforeach
                                </tr>

                                <!-- Customization -->
                                <tr>
                                    <td class="first-column">Customization</td>
                                    @foreach($compareProducts as $product)
                                    <td class="prod-{{ $loop->index + 1 }}">
                                        {{ $product->customization ?? 'Not Available' }}
                                    </td>
                                    @endforeach
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            @endif
            <!-- Compare Table End -->
        </div>
    </div>

    <!-- Modal for selecting a product -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Select a Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Product selection (you can customize this to load products dynamically) -->
                    <div>
                        @foreach($products as $product)
                        <livewire:frontend.components.product productId="{{ $product->id }}" compagePage="true" />
                        @endforeach

                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>