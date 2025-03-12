<?php

namespace App\Livewire\Backend\Product;

use App\Helpers\ImageHelper;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\Supplier;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Manage extends Component
{
    use WithFileUploads;

    public $productId;
    public $name, $slug, $sku, $price, $regular_price, $buy_price, $cost_price, $is_stock, $stock, $category_id, $image, $details, $short_desc, $status, $featured, $discount, $color_id, $supplier_id, $currentImage;
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
        'color_id' => 'nullable|exists:colors,id',
        'supplier_id' => 'nullable|exists:suppliers,id',
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
        $this->rules['slug'] = 'required|string|max:255|unique:products,slug,' . ($this->productId ?? '0');
        $this->rules['sku'] = 'required|string|max:255|unique:products,sku,' . ($this->productId ?? '0');
        $this->validate();

        if ($this->image) {
            // Store or update the category
            $imagePath = $this->image
                ? ImageHelper::uploadImage($this->image, 'products', $this->currentImage)
                : $this->currentImage; // Retain the existing image if no new image
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
                'is_stock' => $this->is_stock == true ? 1 : 0,
                'stock' => $this->stock,
                'category_id' => $this->category_id,
                'image' => $this->image ? $imagePath : $this->currentImage,
                'details' => $this->details,
                'short_desc' => $this->short_desc,
                'status' => $this->status == true ? 1 : 0,
                'featured' => $this->featured == true ? 1 : 0,
                'discount' => $this->discount,
                'color_id' => $this->color_id,
                'supplier_id' => $this->supplier_id,
            ]
        );

        // Sync the selected sizes with the product
        $product->sizes()->sync($this->size_ids);

        session()->flash('message', $this->productId ? 'Product updated successfully.' : 'Product created successfully.');

        return redirect()->route('admin.product.index');
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
        $this->is_stock = $product->is_stock == 1 ? true : false;
        $this->stock = $product->stock;
        $this->category_id = $product->category_id;
        $this->currentImage = $product->image;
        $this->details = $product->details;
        $this->short_desc = $product->short_desc;


        $this->status =  $product->status == 1 ? true : false;
        $this->featured = $product->featured == 1 ? true : false;
        $this->discount = $product->discount;
        $this->color_id = $product->color_id;
        $this->supplier_id = $product->supplier_id;
        // Load the selected sizes
        $this->size_ids = $product->sizes->pluck('id')->toArray();
    }


    public function render()
    {
        $categories = Category::all();
        $sizes = Size::all();  // Get all sizes for selection
        $colors = Color::all();  // Get all colors for selection
        $suppliers = Supplier::all();  // Get all suppliers for selection
        return view('livewire.backend.product.manage', compact('categories', 'sizes', 'colors', 'suppliers'));
    }
}
