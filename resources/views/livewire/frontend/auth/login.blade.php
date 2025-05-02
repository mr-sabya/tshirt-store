<!-- Start Login -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Log In</h2>
                    <h2 class="ec-title">Log In</h2>
                    <p class="sub-title mb-3">Best place to buy and sell digital products</p>


                </div>
            </div>
            <div class="ec-login-wrapper">
                <div class="ec-login-container">
                    <div class="ec-login-form">

                        <!-- Livewire Login Form -->
                        <form wire:submit.prevent="login">
                            <span class="ec-login-wrap">
                                <div class="mb-4">
                                    <label>Phone Number*</label>
                                    <input type="text" class="m-0" wire:model="phone" placeholder="Enter your phone number" required />
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    @if (session('message'))<span class="text-danger"> {{ session('message') }}</span>@endif
                                </div>
                            </span>

                            <span class="ec-login-wrap">
                                <div class="mb-4">
                                    <label>Password*</label>
                                    <input type="password" class="m-0" wire:model="password" placeholder="Enter your password" required />
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </span>

                            <span class="ec-login-wrap ec-login-fp">
                                <label><a href="#">Forgot Password?</a></label>
                            </span>

                            <span class="ec-login-wrap ec-login-btn">
                                <button class="btn btn-primary" type="submit">Login</button>
                                <a href="{{ route('register') }}" wire:navigate class="btn btn-secondary">Register</a>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Login -->