<?php

namespace App\Livewire\Frontend\Shop;

use Livewire\Component;
use App\Models\Category;
use App\Models\Size;
use App\Models\Color;
use App\Models\Product;

class Index extends Component
{
    public $categoryFilter = []; // Store selected category ids
    public $sizeFilter = [];     // Store selected size ids
    public $colorFilter = [];    // Store selected color ids
    public $sortOrder = '1';     // Default sort order
    public $page = 1;           // Pagination tracking

    // Reset page when filters change
    public function resetPage()
    {
        $this->page = 1;
    }

    // Handle filter changes (reset page)
    public function updated($propertyName)
    {
        $this->resetPage();
    }

    // Toggle category filter
    public function updateCategoryFilter($categoryId)
    {
        if (in_array($categoryId, $this->categoryFilter)) {
            // If already selected, remove it from the array
            $this->categoryFilter = array_diff($this->categoryFilter, [$categoryId]);
        } else {
            // If not selected, add it to the array
            $this->categoryFilter[] = $categoryId;
        }
        $this->resetPage();
    }

    // Toggle size filter
    public function updateSizeFilter($sizeId)
    {
        if (in_array($sizeId, $this->sizeFilter)) {
            // If already selected, remove it from the array
            $this->sizeFilter = array_diff($this->sizeFilter, [$sizeId]);
        } else {
            // If not selected, add it to the array
            $this->sizeFilter[] = $sizeId;
        }
        $this->resetPage();
    }

    // Toggle color filter
    public function updateColorFilter($colorId)
    {
        if (in_array($colorId, $this->colorFilter)) {
            // If already selected, remove it from the array
            $this->colorFilter = array_diff($this->colorFilter, [$colorId]);
        } else {
            // If not selected, add it to the array
            $this->colorFilter[] = $colorId;
        }
        $this->resetPage();
    }

    // Update sort order and reset page
    public function updateSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;
        $this->resetPage();
    }


    public function resetFilters()
    {
        $this->categoryFilter = [];
        $this->sizeFilter = [];
        $this->colorFilter = [];
        $this->sortOrder = '1'; // Reset sorting to default
        $this->resetPage(); // Reset pagination
    }


    public function getShowResetButtonProperty()
    {
        return !empty($this->categoryFilter) || !empty($this->sizeFilter) || !empty($this->colorFilter);
    }

    public function render()
    {
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();

        $products = Product::query();

        // Apply filters to the query
        if (!empty($this->categoryFilter)) {
            $products = $products->whereIn('category_id', $this->categoryFilter);
        }

        if (!empty($this->sizeFilter)) {
            $products = $products->whereHas('sizes', function ($query) {
                $query->whereIn('sizes.id', $this->sizeFilter);
            });
        }

        if (!empty($this->colorFilter)) {
            $products = $products->whereHas('variations', function ($query) {
                $query->whereIn('color_id', $this->colorFilter);
            });
        }

        // Sorting products based on the selected option
        switch ($this->sortOrder) {
            case '1': // Relevance
                break;
            case '2': // Name A-Z
                $products = $products->orderBy('name', 'asc');
                break;
            case '3': // Name Z-A
                $products = $products->orderBy('name', 'desc');
                break;
            case '4': // Price low to high
                $products = $products->orderBy('price', 'asc');
                break;
            case '5': // Price high to low
                $products = $products->orderBy('price', 'desc');
                break;
        }

        // Paginate the results
        $products = $products->paginate(12);

        return view('livewire.frontend.shop.index', compact('categories', 'sizes', 'colors', 'products'));
    }
}
