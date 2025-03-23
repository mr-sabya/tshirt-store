<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5>Manage Variations</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="save">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="color_id">Color</label>
                                <select id="color_id" wire:model="color_id" class="form-control">
                                    <option value="">Select Color</option>
                                    @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                    @endforeach
                                </select>
                                @error('color_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-12">
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
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5>Variations List</h5>
                </div>
                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Color</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($variations as $variation)
                            <tr>
                                <td>{{ $variation->id }}</td>
                                <td>{{ $variation->color->name }}</td>
                                <td>
                                    @if ($variation->image)
                                    <img src="{{ url('storage/'. $variation->image) }}" alt="" style="width: 50px;">
                                    @endif
                                </td>
                                <td>
                                    <button wire:click="edit({{ $variation->id }})" class="btn btn-info btn-sm">Edit</button>
                                    <button wire:click="delete({{ $variation->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">No variations found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $variations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>