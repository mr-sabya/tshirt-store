<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Product;
use App\Models\ProductRating;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Rating extends Component
{
    public $rating = 0;
    public $review;
    public $product_id;

    // Validation rules
    protected $rules = [
        'rating' => 'required|integer|min:1|max:5', // Rating must be between 1 and 5
        'review' => 'nullable|string|max:1000', // Review text can be nullable
    ];

    public function mount($product_id)
    {
        $this->product_id = $product_id;
    }

    // Set the rating value
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    // Store the rating and review
    public function storeRating()
    {
        // dd($this->rating);
        $this->validate();

        // Check if the user has already rated this product
        $existingRating = ProductRating::where('user_id', Auth::id())
            ->where('product_id', $this->product_id)
            ->first();

        if ($existingRating) {
            // Update the existing rating and review
            $existingRating->rating = $this->rating;
            $existingRating->review = $this->review;
            $existingRating->save();
        } else {
            // Create a new rating with review
            ProductRating::create([
                'user_id' => Auth::id(),
                'product_id' => $this->product_id,
                'rating' => $this->rating,
                'review' => $this->review,
            ]);
        }

        $this->review = '';

        // Emit success message
        session()->flash('message', 'Your rating and review have been saved!');
    }

    public function render()
    {
        $product = Product::where('id', $this->product_id)->first();
        return view('livewire.frontend.product.rating', [
            'ratings' => $product->ratings()->latest()->get(),
        ]);
    }
}
