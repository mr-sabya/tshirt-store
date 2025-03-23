<div class="container mt-4">
    <h2 class="mb-4">Add Product Color</h2>
    <form wire:submit.prevent="store">
        <div class="mb-3">
            <label for="product" class="form-label">Product</label>
            <select wire:model="product_id" class="form-select">
                <option value="">Select Product</option>
                @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
            @error('product_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <select wire:model="color_id" class="form-select">
                <option value="">Select Color</option>
                @foreach($colors as $color)
                <option value="{{ $color->id }}">{{ $color->name }}</option>
                @endforeach
            </select>
            @error('color_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-check mb-3">
            <input wire:model="is_stock" class="form-check-input" type="checkbox" id="inStock">
            <label class="form-check-label" for="inStock">In Stock</label>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input wire:model="stock" type="number" class="form-control">
            @error('stock') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
    </form>

    <h3 class="mt-4">Product Colors</h3>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Product</th>
                <th>Color</th>
                <th>In Stock</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productColors as $product)
            @foreach($product->colors as $color)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $color->name }}</td>
                <td>{{ $color->pivot->is_stock ? 'Yes' : 'No' }}</td>
                <td>{{ $color->pivot->stock }}</td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
</div>