<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Website Settings</h4>
        </div>
        <div class="card-body">
            @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <ul class="nav nav-tabs" id="settingsTabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#general">General</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#contact">Contact Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#social">Social Links</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#seo">SEO Settings</a>
                </li>
            </ul>

            <div class="tab-content mt-3">
                <!-- General Settings -->
                <div class="tab-pane fade show active" id="general">
                    <div class="mb-3">
                        <label>Site Name</label>
                        <input type="text" class="form-control" wire:model="site_name">
                    </div>
                    <div class="mb-3">
                        <label>Tagline</label>
                        <input type="text" class="form-control" wire:model="tagline">
                    </div>
                    <div class="mb-3">
                        <label>Top Header Text</label>
                        <input type="text" class="form-control" wire:model="top_header_text">
                    </div>
                    <div class="mb-3">
                        <label>Currency</label>
                        <input type="text" class="form-control" wire:model="currency">
                    </div>

                    <!-- Logo Upload -->
                    <div class="mb-3">
                        <label>Logo</label>
                        <input type="file" class="form-control" wire:model="uploadedLogo">
                        @if ($uploadedLogo)
                        <img src="{{ $uploadedLogo->temporaryUrl() }}" class="img-thumbnail mt-2" width="150">
                        @elseif ($logo)
                        <img src="{{ asset('storage/' . $logo) }}" class="img-thumbnail mt-2" width="150">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label>Footer Logo</label>
                        <input type="file" class="form-control" wire:model="uploadedFooterLogo">
                        @if ($uploadedFooterLogo)
                        <img src="{{ $uploadedFooterLogo->temporaryUrl() }}" class="img-thumbnail mt-2" width="150">
                        @elseif ($footer_logo)
                        <img src="{{ asset('storage/' . $footer_logo) }}" class="img-thumbnail mt-2" width="150">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label>Favicon</label>
                        <input type="file" class="form-control" wire:model="uploadedFavicon">
                        @if ($uploadedFavicon)
                        <img src="{{ $uploadedFavicon->temporaryUrl() }}" class="img-thumbnail mt-2" width="50">
                        @elseif ($favicon)
                        <img src="{{ asset('storage/' . $favicon) }}" class="img-thumbnail mt-2" width="50">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label>Footer About</label>
                        <textarea class="form-control" wire:model="footer_about"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Newsletter Text</label>
                        <textarea class="form-control" wire:model="newsletter_text"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Copyright Text</label>
                        <textarea class="form-control" wire:model="copyright_text"></textarea>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="tab-pane fade" id="contact">
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" wire:model="email">
                    </div>
                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" class="form-control" wire:model="phone">
                    </div>
                    <div class="mb-3">
                        <label>Address</label>
                        <textarea class="form-control" wire:model="address"></textarea>
                    </div>


                </div>

                <!-- Social Media Links -->
                <div class="tab-pane fade" id="social">
                    <div class="mb-3">
                        <label>Facebook</label>
                        <input type="text" class="form-control" wire:model="facebook">
                    </div>
                    <div class="mb-3">
                        <label>Twitter</label>
                        <input type="text" class="form-control" wire:model="twitter">
                    </div>
                    <div class="mb-3">
                        <label>LinkedIn</label>
                        <input type="text" class="form-control" wire:model="linkedin">
                    </div>
                    <div class="mb-3">
                        <label>Instagram</label>
                        <input type="text" class="form-control" wire:model="instagram">
                    </div>
                    <div class="mb-3">
                        <label>YouTube</label>
                        <input type="text" class="form-control" wire:model="youtube">
                    </div>
                    <div class="mb-3">
                        <label>TikTok</label>
                        <input type="text" class="form-control" wire:model="tiktok">
                    </div>
                    <div class="mb-3">
                        <label>Threads</label>
                        <input type="text" class="form-control" wire:model="thread">
                    </div>
                </div>

                <!-- SEO Settings -->
                <div class="tab-pane fade" id="seo">
                    <div class="mb-3">
                        <label>Meta Title</label>
                        <input type="text" class="form-control" wire:model="meta_title">
                    </div>
                    <div class="mb-3">
                        <label>Meta Description</label>
                        <textarea class="form-control" wire:model="meta_description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Meta Keywords</label>
                        <textarea class="form-control" wire:model="meta_keywords"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="canonical_url">Canonical Url </label>
                        <input type="text" class="form-control" id="canonical_url" wire:model="canonical_url">
                    </div>

                    
                    <!-- OG Title -->
                    <div class="form-group mb-3">
                        <label for="og_title">OG Title</label>
                        <input type="text" class="form-control" id="og_title" wire:model="og_title">
                    </div>

                    <!-- OG Description -->
                    <div class="form-group mb-3">
                        <label for="og_description">OG Description</label>
                        <textarea class="form-control" id="og_description" wire:model="og_description"></textarea>
                    </div>

                    <!-- OG Image Upload -->
                    <div class="form-group mb-3">
                        <label for="og_image">OG Image</label>
                        <input type="file" class="form-control-file" wire:model="uploadedOgImage">
                        @if ($uploadedOgImage)
                        <img src="{{ $uploadedOgImage->temporaryUrl() }}" width="100" class="mt-2">
                        @elseif($og_image)
                        <img src="{{ asset('storage/' . $og_image) }}" width="100" class="mt-2">
                        @endif
                    </div>

                    <!-- OG Type -->
                    <div class="form-group mb-3">
                        <label for="og_type">OG Type</label>
                        <select class="form-control" id="og_type" wire:model="og_type">
                            <option value="website">Website</option>
                            <option value="article">Article</option>
                            <option value="video">Video</option>
                            <!-- Add more OG types as needed -->
                        </select>
                    </div>

                </div>
            </div>

            <button class="btn btn-primary mt-3" wire:click="updateSettings">Save Changes</button>
        </div>
    </div>
</div>