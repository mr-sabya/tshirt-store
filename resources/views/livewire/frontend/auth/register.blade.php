<!-- Start Register -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Register</h2>
                    <h2 class="ec-title">Register</h2>
                    <p class="sub-title mb-3">Best place to buy and sell digital products</p>
                </div>
            </div>
            <div class="ec-register-wrapper">
                <div class="ec-register-container">
                    <div class="ec-register-form">
                        <!-- Livewire Registration Form -->
                        <form wire:submit.prevent="submit">
                            <span class="ec-register-wrap ec-register-half">
                                <div class="mb-4">
                                    <label>Full Name*</label>
                                    <input type="text" class="m-0" wire:model="name" placeholder="Enter your name" />
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </span>

                            <span class="ec-register-wrap ec-register-half">
                                <div class="mb-4">
                                    <label>Phone Number*</label>
                                    <input type="text" class="m-0" wire:model="phone" placeholder="Enter your phone number" />
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </span>

                            <span class="ec-register-wrap ec-register-half">
                                <div class="mb-4">
                                    <label>Address</label>
                                    <input type="text" class="m-0" wire:model="address" placeholder="Address Line 1" />
                                    @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </span>

                            <span class="ec-register-wrap ec-register-half">
                                <div class="mb-4">
                                    <label>Post Code</label>
                                    <input type="text" class="m-0" wire:model="postcode" placeholder="Post Code" />
                                    @error('postcode') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </span>

                            <span class="ec-register-wrap ec-register-half">
                                <div class="mb-4">
                                    <label>Division *</label>
                                    <span class="ec-rg-select-inner m-0">
                                        <select wire:model="division_id" wire:change="getCity()" class="ec-register-select">
                                            <option value="" selected>Select Division</option>
                                            @foreach($divisions as $division)
                                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                                            @endforeach
                                        </select>
                                    </span>
                                    @error('division_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </span>

                            <span class="ec-register-wrap ec-register-half">
                                <div class="mb-4">
                                    <label>City *</label>
                                    <span class="ec-rg-select-inner m-0">
                                        <select wire:model="city_id" class="ec-register-select">
                                            <option value="" selected>Select City</option>
                                            @foreach($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </span>
                                    @error('city_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </span>

                            <span class="ec-register-wrap ec-register-half">
                                <div class="mb-4">
                                    <label>Password*</label>
                                    <input type="password" class="m-0" wire:model="password" placeholder="Enter your password" />
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </span>

                            <span class="ec-register-wrap ec-register-half">
                                <div class="mb-4">
                                    <label>Confirm Password*</label>
                                    <input type="password" class="m-0" wire:model="password_confirmation"
                                        wire:keyup="checkPasswordMatch"
                                        placeholder="Confirm your password" />
                                    @if($passwordMismatch)
                                    <span class="text-danger">Passwords do not match</span>
                                    @endif
                                </div>

                            </span>

                            <span class="ec-register-wrap ec-register-btn">
                                <button class="btn btn-primary" type="submit">Register</button>
                            </span>

                            @if (session()->has('message'))
                            <div class="alert alert-success mt-3">
                                {{ session('message') }}
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Register -->