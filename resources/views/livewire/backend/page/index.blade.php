<div>
    @if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="row">
        @foreach ($pages as $page)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title m-0 text-white">{{ $page->title }}</h4>
                </div>
                <div class="card-body">
                    <p>{{ $page->sub_heading }}</p>
                    
                    <a href="{{ route('admin.page.edit', $page->id) }}" wire:navigate class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>