<?php

namespace App\Livewire\Backend\Product;

use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Manage extends Component
{
    use WithFileUploads;

    public $productId;
    public $name, $slug, $sku, $price, $regular_price, $buy_price, $cost_price, $is_stock, $stock, $category_id, $image, $details, $short_desc, $status, $featured, $discount;
    public $size_ids = [];  // Array to hold selected sizes

    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:products,slug',
        'sku' => 'required|string|max:255|unique:products,sku',
        'price' => 'required|numeric',
        'regular_price' => 'nullable|numeric',
        'buy_price' => 'nullable|numeric',
        'cost_price' => 'nullable|numeric',
        'is_stock' => 'required|boolean',
        'stock' => 'nullable|numeric',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'details' => 'nullable|string',
        'short_desc' => 'nullable|string|max:255',
        'status' => 'required|boolean',
        'featured' => 'nullable|boolean',
        'discount' => 'nullable|numeric|min:0|max:100',
        'size_ids' => 'required|array|min:1', // Ensure at least one size is selected
        'size_ids.*' => 'exists:sizes,id', // Ensure each selected size exists
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->loadProduct($id);
        }
    }

    public function calculateDiscount()
    {
        if ($this->regular_price && $this->price) {
            $this->discount = (($this->regular_price - $this->price) / $this->regular_price) * 100;
        } else {
            $this->discount = 0; // If regular price or price is not set, set discount to 0
        }
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function save()
    {
        $this->validate();

        if ($this->image) {
            $imagePath = $this->image->store('product_images', 'public');
        }

        $product = Product::updateOrCreate(
            ['id' => $this->productId],
            [
                'name' => $this->name,
                'slug' => $this->slug,
                'sku' => $this->sku,
                'price' => $this->price,
                'regular_price' => $this->regular_price,
                'buy_price' => $this->buy_price,
                'cost_price' => $this->cost_price,
                'is_stock' => $this->is_stock,
                'stock' => $this->stock,
                'category_id' => $this->category_id,
                'image' => $this->image ? $imagePath : null,
                'details' => $this->details,
                'short_desc' => $this->short_desc,
                'status' => $this->status,
                'featured' => $this->featured,
                'discount' => $this->discount,
            ]
        );

        // Sync the selected sizes with the product
        $product->sizes()->sync($this->size_ids);

        session()->flash('message', $this->productId ? 'Product updated successfully.' : 'Product created successfully.');

        return redirect()->route('products.index');
    }

    public function loadProduct($id)
    {
        $product = Product::findOrFail($id);
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->sku = $product->sku;
        $this->price = $product->price;
        $this->regular_price = $product->regular_price;
        $this->buy_price = $product->buy_price;
        $this->cost_price = $product->cost_price;
        $this->is_stock = $product->is_stock;
        $this->stock = $product->stock;
        $this->category_id = $product->category_id;
        $this->image = $product->image;
        $this->details = $product->details;
        $this->short_desc = $product->short_desc;
        $this->status = $product->status;
        $this->featured = $product->featured;
        $this->discount = $product->discount;
        // Load the selected sizes
        $this->size_ids = $product->sizes->pluck('id')->toArray();
    }

    public function render()
    {
        $categories = Category::all();
        $sizes = Size::all();  // Get all sizes for selection
        return view('livewire.backend.product.manage', compact('categories', 'sizes'));
    }
}
