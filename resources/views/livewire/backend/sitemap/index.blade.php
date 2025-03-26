<div class="row">
    <div class="col-lg-6">
        <!-- Card Start -->
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="card-title m-0 text-white">Generate Sitemap</h5>
            </div>
            <div class="card-body">
                <p class="card-text">Click the button below to generate the sitemap for your website.</p>

                <button
                    wire:click="generateSitemap"
                    class="btn btn-primary"
                    wire:loading.attr="disabled"
                    wire:target="generateSitemap">
                    <!-- Show 'Generating...' when in progress, else default text -->
                    <span wire:loading.remove>Generate Sitemap</span>
                    <span wire:loading>Generating...</span>
                </button>

                @if ($message)
                <div class="alert alert-info mt-3">
                    {{ $message }}
                </div>
                @endif
            </div>
        </div>
        <!-- Card End -->
    </div>
</div>