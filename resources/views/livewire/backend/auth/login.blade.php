<div>
    <form class="form-horizontal mt-3 mx-3" wire:submit.prevent="login">
        @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="form-group mb-3">
            <div class="col-12">
                <input
                    class="form-control"
                    type="text"
                    placeholder="Phone"
                    wire:model="phone"
                    required />
                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group mb-3">
            <div class="col-12">
                <input
                    class="form-control"
                    type="password"
                    placeholder="Password"
                    wire:model="password"
                    required />
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="col-12">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-signup" type="checkbox" wire:model="remember">
                    <label for="checkbox-signup" class="text-color">
                        Remember me
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group text-center mt-3">
            <div class="col-12">
                <button class="btn btn-primary btn-block btn-lg waves-effect waves-light w-100" type="submit">
                    Log In
                </button>
            </div>
        </div>

        <div class="form-group row mt-4 mb-0">
            <div class="col-sm-7">
                <a href="#" class="text-color">
                    <i class="mdi mdi-lock me-1"></i> Forgot your password?
                </a>
            </div>
            <div class="col-sm-5 text-right">
                <a href="#" class="text-color">Create an account</a>
            </div>
        </div>
    </form>
</div>