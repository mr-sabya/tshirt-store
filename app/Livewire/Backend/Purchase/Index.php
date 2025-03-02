<?php

namespace App\Livewire\Backend\Purchase;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedPurchaseOrderId = null;
    public $order_number, $supplier_id, $total_amount, $status, $ordered_at, $received_at;
    public $sortBy = 'order_number';
    public $sortDirection = 'asc';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function showOrderItems($purchaseOrderId)
    {
        $this->selectedPurchaseOrderId = $purchaseOrderId;
        $this->dispatch('setPurchaseOrderId', $purchaseOrderId);
    }

    public function resetForm()
    {
        $this->selectedPurchaseOrderId = null;
        $this->order_number = '';
        $this->supplier_id = '';
        $this->total_amount = '';
        $this->status = '';
        $this->ordered_at = '';
        $this->received_at = '';
    }

    public function storeOrUpdate()
    {
        $this->validate([
            'order_number' => 'required',
            'supplier_id' => 'required|exists:suppliers,id',
            'total_amount' => 'required|numeric',
            'status' => 'required',
            'ordered_at' => 'required|date',
            'received_at' => 'nullable|date',
        ]);

        if ($this->selectedPurchaseOrderId) {
            $purchaseOrder = PurchaseOrder::find($this->selectedPurchaseOrderId);
            $purchaseOrder->update([
                'order_number' => $this->order_number,
                'supplier_id' => $this->supplier_id,
                'total_amount' => $this->total_amount,
                'status' => $this->status,
                'ordered_at' => $this->ordered_at,
                'received_at' => $this->received_at,
            ]);

            session()->flash('message', 'Purchase Order updated successfully');
        } else {
            PurchaseOrder::create([
                'order_number' => $this->order_number,
                'supplier_id' => $this->supplier_id,
                'total_amount' => $this->total_amount,
                'status' => $this->status,
                'ordered_at' => $this->ordered_at,
                'received_at' => $this->received_at,
            ]);

            session()->flash('message', 'Purchase Order created successfully');
        }

        $this->resetForm();
        $this->dispatch('refreshPurchaseOrders');
    }

    public function sortByColumn($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    // Method to cancel selection
    public function cancelSelection()
    {
        $this->selectedPurchaseOrderId = null;  // Reset the selected purchase order ID
    }

    public function render()
    {
        $suppliers = Supplier::all();

        $purchaseOrders = PurchaseOrder::where('order_number', 'like', '%' . $this->search . '%')
            ->orWhereHas('supplier', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.backend.purchase.index', compact('purchaseOrders', 'suppliers'));
    }
}
