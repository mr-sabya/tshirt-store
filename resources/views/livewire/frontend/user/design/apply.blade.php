<div class="ec-vendor-dashboard-card">
    <div class="ec-vendor-card-header">
        <h5>Apply as a Designer</h5>
    </div>
    <div class="ec-vendor-card-body">

        <div class="card-body">
            @if ($notApprovedMessage)
            <div class="alert alert-warning mt-3" role="alert">
                {{ $notApprovedMessage }}
            </div>
            @endif


            <p class="text-muted">{{ $infoText }}</p>


            @if ($user->is_designer)
            <div class="alert alert-success" role="alert">
                <strong>Congratulations!</strong> You have already applied as a designer.
            </div>
            @else
            <button wire:click="apply" class="btn btn-primary">
                <i class="fas fa-paint-brush"></i> Apply Now
            </button>
            @endif

            @if ($message)
            <div class="alert alert-info mt-3" role="alert">
                {{ $message }}
            </div>
            @endif
        </div>
    </div>
</div>