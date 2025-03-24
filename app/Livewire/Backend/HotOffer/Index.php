<?php

namespace App\Livewire\Backend\HotOffer;

use App\Models\HotOffer;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads;

    public $title, $text, $product_id, $image, $currentImage, $search = '';
    public $isEditing = false, $editingId = null;
    public $sortField = 'created_at', $sortDirection = 'desc';

    protected $rules = [
        'title' => 'required|string|max:255',
        'text' => 'required|string',
        'product_id' => 'required|exists:products,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
    ];


    // Store a new hot offer
    public function store()
    {
        $this->validate();

        if ($this->image) {
            $imagePath = $this->image->store('hot_offers', 'public');
        }

        HotOffer::create([
            'title' => $this->title,
            'text' => $this->text,
            'product_id' => $this->product_id,
            'image' => $imagePath ?? null,
        ]);

        $this->resetFields();
    }

    // Edit an existing hot offer
    public function edit($id)
    {
        $offer = HotOffer::find($id);
        $this->editingId = $offer->id;
        $this->title = $offer->title;
        $this->text = $offer->text;
        $this->product_id = $offer->product;
        $this->currentImage = $offer->image;
        $this->isEditing = true;
    }

    // Update a hot offer
    public function update()
    {
        $this->validate();

        $offer = HotOffer::find($this->editingId);

        if ($this->image) {
            $imagePath = $this->image->store('hot_offers', 'public');
            $offer->image = $imagePath;
        }

        $offer->update([
            'title' => $this->title,
            'text' => $this->text,
            'product_id' => $this->product_id,
        ]);

        $this->resetFields();
    }

    // Delete a hot offer
    public function delete($id)
    {
        HotOffer::find($id)->delete();
    }

    // Reset fields for create or edit
    private function resetFields()
    {
        $this->title = '';
        $this->text = '';
        $this->product_id = '';
        $this->image = null;
        $this->currentImage = null;
        $this->isEditing = false;
        $this->editingId = null;
    }

    // Cancel editing and reset the form
    public function cancelEdit()
    {
        $this->resetFields();
    }

    // Sorting method
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    // Render method to load view with products
    public function render()
    {
        $products = Product::all();

        $hotOffers = HotOffer::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(5); // Set your pagination limit here

        return view('livewire.backend.hot-offer.index', compact('products', 'hotOffers'));
    }
}
