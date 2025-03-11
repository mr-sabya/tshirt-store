<div class="">
    <div class="row">
        <!-- Left Column: Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Generate Barcode</h5>
                </div>
                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <form wire:submit.prevent="createBarcode">
                        <div class="mb-3">
                            <label>Product ID (Optional)</label>
                            <input type="text" class="form-control" wire:model="product_id" placeholder="Enter Product ID">
                        </div>

                        <div class="mb-3">
                            <label>Barcode Code</label>
                            <input type="text" class="form-control" wire:model="code" placeholder="Enter Barcode Code">
                            @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Generate Barcode</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column: Table -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Barcodes List</h5>
                    <input type="text" class="form-control w-50" wire:model="search" placeholder="Search Barcode...">
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product ID</th>
                                <th>Barcode</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barcodes as $barcode)
                                <tr>
                                    <td>{{ $barcode->id }}</td>
                                    <td>{{ $barcode->product_id ?? 'N/A' }}</td>
                                    <td>
                                        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($barcode->code, 'C128') }}" alt="barcode">
                                        <br>{{ $barcode->code }}
                                    </td>
                                    <td>
                                        <button wire:click="downloadBarcode({{ $barcode->id }})" class="btn btn-primary btn-sm">Download</button>
                                        <button wire:click="deleteBarcode({{ $barcode->id }})" class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $barcodes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
