<div>
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Back to User List</a>
    </div>

    <!-- Approve Button -->
    @if (!$user->is_approved && $user->is_designer)
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0 text-white">Approve as Designer</h4>
        </div>

        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <p class="card-text m-0">Approve this user as a designer.</p>
                <button class="btn btn-primary" wire:click="approve">Approve</button>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-white">User Details</h4>
                </div>

                <div class="card-body">
                    <!-- User Avatar and Info -->
                    <div class="text-center">
                        <img src="{{ $user->image ? url('storage/'.$user->image) : $user->getUrlfriendlyAvatar($size = 400) }}"
                            alt="User Avatar"
                            class="rounded-circle img-fluid border border-4 border-primary"
                            style="width: 150px; height: 150px;">
                        <h5 class="mt-3 text-dark">{{ $user->name }}</h5>
                        <p class="text-muted">{{ $user->phone }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-white">User Details</h4>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <h6><strong>Address:</strong></h6>
                            <p class="text-muted">{{ $user->address }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6><strong>Verified:</strong></h6>
                            <p>
                                <span class="badge {{ $user->is_verified ? 'bg-success' : 'bg-danger' }}">
                                    {{ $user->is_verified ? 'Verified' : 'Not Verified' }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6><strong>Admin Status:</strong></h6>
                            <p>
                                <span class="badge {{ $user->is_admin ? 'bg-primary' : 'bg-secondary' }}">
                                    {{ $user->is_admin ? 'Admin' : 'User' }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6><strong>Designer Status:</strong></h6>
                            <p>
                                <span class="badge {{ $user->is_designer ? 'bg-warning' : 'bg-secondary' }}">
                                    {{ $user->is_designer ? 'Designer' : 'Not a Designer' }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6><strong>Created At:</strong></h6>
                            <p class="text-muted">{{ $user->created_at->format('F j, Y') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6><strong>Last Updated:</strong></h6>
                            <p class="text-muted">{{ $user->updated_at->format('F j, Y') }}</p>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-white">Reset Password</h4>
                </div>

                <div class="card-body">
                    <form wire:submit.prevent="resetPassword">
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="new_password" wire:model="newPassword" required>
                                <button type="button" class="btn btn-outline-secondary" id="toggle-password-visibility">
                                    <i class="ri-eye-line" id="password-visibility-icon"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary" id="copy-password">
                                    <i class="ri-file-copy-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" wire:model="confirmPassword" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                            <button type="button" class="btn btn-secondary" id="generate-password">Generate Password</button>
                        </div>

                    </form>
                    @if (session()->has('password_reset_message'))
                    <div class="alert alert-success mt-3" role="alert">
                        {{ session('password_reset_message') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    // Function to generate a random password
    function generatePassword(length = 12) {
        const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()";
        let password = '';
        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * charset.length);
            password += charset[randomIndex];
        }
        return password;
    }

    // Event listener for the Generate Password button
    document.getElementById('generate-password').addEventListener('click', function() {
        const newPasswordField = document.getElementById('new_password');
        const confirmPasswordField = document.getElementById('confirm_password');
        const generatedPassword = generatePassword();
        newPasswordField.value = generatedPassword;
        confirmPasswordField.value = generatedPassword;
    });

    // Toggle password visibility
    document.getElementById('toggle-password-visibility').addEventListener('click', function() {
        const passwordField = document.getElementById('new_password');
        const confirmPasswordField = document.getElementById('confirm_password');
        const icon = document.getElementById('password-visibility-icon');

        if (passwordField.type === "password") {
            passwordField.type = "text";
            confirmPasswordField.type = "text";
            icon.classList.remove('ri-eye-line');
            icon.classList.add('ri-eye-off-line');
        } else {
            passwordField.type = "password";
            confirmPasswordField.type = "password";
            icon.classList.remove('ri-eye-off-line');
            icon.classList.add('ri-eye-line');
        }
    });

    // Copy password to clipboard
    document.getElementById('copy-password').addEventListener('click', function() {
        const passwordField = document.getElementById('new_password');
        navigator.clipboard.writeText(passwordField.value)
            .then(function() {
                alert('Password copied to clipboard!');
            })
            .catch(function() {
                alert('Failed to copy password.');
            });
    });
</script>