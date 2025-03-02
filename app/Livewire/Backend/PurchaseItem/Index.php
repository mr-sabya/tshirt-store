<?php

namespace App\Livewire\Backend\PurchaseItem;

use App\Models\Product;
use App\Models\PurchaseOrderItem;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $purchaseOrderId;
    public $product_id, $quantity, $price, $item_id, $search = '';
    public $sortBy = 'id', $sortDirection = 'asc';

    protected $rules = [
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
    ];

    public function mount($purchaseOrderId)
    {
        $this->purchaseOrderId = $purchaseOrderId;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function storeOrUpdate()
    {
        $this->validate();

        if ($this->item_id) {
            $orderItem = PurchaseOrderItem::find($this->item_id);
            $orderItem->update([
                'product_id' => $this->product_id,
                'quantity' => $this->quantity,
                'price' => $this->price,
            ]);

            session()->flash('message', 'Order Item updated successfully');
        } else {
            PurchaseOrderItem::create([
                'purchase_order_id' => $this->purchaseOrderId,
                'product_id' => $this->product_id,
                'quantity' => $this->quantity,
                'price' => $this->price,
            ]);

            session()->flash('message', 'Order Item added successfully');
        }

        $this->resetForm();
        $this->dispatch('refreshOrderItems');
    }

    public function editItem($itemId)
    {
        $item = PurchaseOrderItem::find($itemId);
        $this->item_id = $item->id;
        $this->product_id = $item->product_id;
        $this->quantity = $item->quantity;
        $this->price = $item->price;
    }

    public function deleteItem($itemId)
    {
        $item = PurchaseOrderItem::find($itemId);
        $item->delete();
    }

    public function resetForm()
    {
        $this->product_id = '';
        $this->quantity = '';
        $this->price = '';
        $this->item_id = '';
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

    public function render()
    {
        $products = Product::all();
        $orderItems = PurchaseOrderItem::where('purchase_order_id', $this->purchaseOrderId)
            ->where(function ($query) {
                $query->where('quantity', 'like', '%' . $this->search . '%')
                    ->orWhere('price', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.backend.purchase-item.index', compact('orderItems', 'products'));
    }
}
