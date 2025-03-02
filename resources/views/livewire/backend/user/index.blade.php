<div class="card mt-4">
    <div class="card-header">
        <h2 class="mb-0">User List</h2>
    </div>

    <div class="card-body">
        <!-- Search Input -->
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Search by name or phone" wire:model="search">
        </div>

        <!-- Table with sorting and pagination -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>
                        <button class="btn btn-link" wire:click="sortBy('name')">
                            Name
                            @if ($sortBy === 'name')
                            <i class="bi {{ $sortDirection === 'asc' ? 'bi-chevron-up' : 'bi-chevron-down' }}"></i>
                            @endif
                        </button>
                    </th>
                    <th>
                        <button class="btn btn-link" wire:click="sortBy('phone')">
                            Phone
                            @if ($sortBy === 'phone')
                            <i class="bi {{ $sortDirection === 'asc' ? 'bi-chevron-up' : 'bi-chevron-down' }}"></i>
                            @endif
                        </button>
                    </th>
                    <th>
                        <button class="btn btn-link" wire:click="sortBy('is_verified')">
                            Verified
                            @if ($sortBy === 'is_verified')
                            <i class="bi {{ $sortDirection === 'asc' ? 'bi-chevron-up' : 'bi-chevron-down' }}"></i>
                            @endif
                        </button>
                    </th>
                    <th>
                        <button class="btn btn-link" wire:click="sortBy('is_admin')">
                            Admin
                            @if ($sortBy === 'is_admin')
                            <i class="bi {{ $sortDirection === 'asc' ? 'bi-chevron-up' : 'bi-chevron-down' }}"></i>
                            @endif
                        </button>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        <span class="badge {{ $user->is_verified ? 'bg-success' : 'bg-danger' }}">
                            {{ $user->is_verified ? 'Verified' : 'Not Verified' }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $user->is_admin ? 'bg-primary' : 'bg-secondary' }}">
                            {{ $user->is_admin ? 'Admin' : 'User' }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-info">View</button>
                        <button class="btn btn-sm btn-warning">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination links -->
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
</div>