<?php

namespace App\Livewire\Backend\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $statusFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $expandedOrders = [];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function filterByStatus($status)
    {
        $this->statusFilter = $status;
        $this->resetPage();
    }


    public function toggleOrder($orderId)
    {
        if (in_array($orderId, $this->expandedOrders)) {
            $this->expandedOrders = array_diff($this->expandedOrders, [$orderId]); // Remove from array
        } else {
            $this->expandedOrders[] = $orderId; // Add to array
        }
    }

    public function render()
    {
        $orders = Order::with('orderItems.product')
            ->where(function ($query) {
                if ($this->search) {
                    $query->where('order_id', 'like', "%{$this->search}%")
                        ->orWhere('invoice_no', 'like', "%{$this->search}%")
                        ->orWhereHas('user', function ($q) {
                            $q->where('name', 'like', "%{$this->search}%");
                        });
                }
            })
            ->when($this->statusFilter, function ($query) {
                return $query->where('status', $this->statusFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.backend.order.index', compact('orders'));
    }
}
