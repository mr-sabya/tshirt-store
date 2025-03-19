<!-- User Profile Blade (profile.index.blade.php) -->
<div class="ec-vendor-dashboard-card ec-vendor-setting-card">
    <div class="ec-vendor-card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="ec-vendor-block-profile">
                    <div class="ec-vendor-block-img space-bottom-30">
                        <div class="ec-vendor-block-bg">
                            <a href="#" class="btn btn-lg btn-primary"
                                data-link-action="editmodal" title="Edit Detail"
                                data-bs-toggle="modal" data-bs-target="#edit_modal">Edit Detail</a>
                        </div>
                        <div class="ec-vendor-block-detail">
                            <div class="profile-image">
                                @if(Auth::user()->image)
                                <img class="v-img" src="{{ url('storage/'. Auth::user()->image) }}" alt="vendor image">
                                @else
                                <img class="v-img" src="{{ Auth::user()->getUrlfriendlyAvatar($size=400) }}" alt="vendor image">
                                @endif

                                <a href="javascript:void" data-bs-toggle="modal" data-bs-target="#updateImageModal"><i class="fi-rr-edit"></i></a>
                            </div>
                            <h5 class="name">{{ Auth::user()->name }}</h5>
                            <p>({{ Auth::user()->is_designer ? 'Designer' : 'Customer' }})</p>
                        </div>
                        <p>Hello <span>{{ Auth::user()->name }}</span></p>
                        <p>From your account you can easily view and track orders. You can manage and change your account information like address, contact information and history of orders.</p>
                    </div>
                    <h5>Account Information</h5>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="ec-vendor-detail-block ec-vendor-block-contact space-bottom-30">
                                <h6>Contact Number</h6>
                                <ul>
                                    <li><strong>Phone Number : </strong>{{ Auth::user()->phone }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="ec-vendor-detail-block ec-vendor-block-address mar-b-30">
                                <h6>Address
                                    <a href="javascript:void(0)" data-link-action="editmodal" title="Edit Detail" data-bs-toggle="modal" data-bs-target="#edit_modal">
                                        <i class="fi-rr-edit"></i>
                                    </a>
                                </h6>
                                <ul>
                                    <li>{{ Auth::user()->address }}, {{ Auth::user()->city->name ?? ''}} - {{ Auth::user()->postcode }}, {{ Auth::user()->division->name ?? ''}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal to Update Image -->
    <div class="modal fade" id="updateImageModal" tabindex="-1" aria-labelledby="updateImageModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-sm" style="width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title m-0" id="updateImageModalLabel">Update Profile Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateImage">
                        <!-- Image Upload Field -->
                        <div class="form-group">
                            <div class="image-preview">
                                <div class="image-box">
                                    @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}" alt="Image Preview" class="rounded w-100">
                                    @else
                                    @if(Auth::user()->image)
                                    <img class="v-img w-100" src="{{ url('storage/'. Auth::user()->image) }}" alt="vendor image">
                                    @else
                                    <img class="v-img w-100" src="{{ Auth::user()->getUrlfriendlyAvatar($size=400) }}" alt="vendor image">
                                    @endif
                                    @endif
                                </div>
                            </div>
                            <input type="file" wire:model="image" id="image" class="form-control">

                            <!-- Image Preview -->


                            @error('image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-3" data-bs-dismiss="modal" >Save Image</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal for Editing Profile Information -->
    <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="edit_modalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title m-0" id="edit_modalLabel">Edit Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateProfile">

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" wire:model="address" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="division">Division</label>
                            <div class="select-box">
                                <select wire:model="division_id" wire:change="getCity()" id="division" class="form-control">
                                    <option value="">Select Division</option>
                                    @foreach($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="city">City</label>
                            <div class="select-box">
                                <select wire:model="city_id" id="city" class="form-control">
                                    <option value="">Select City</option>
                                    @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="postcode">Postcode</label>
                            <input type="text" id="postcode" wire:model="postcode" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" >Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>