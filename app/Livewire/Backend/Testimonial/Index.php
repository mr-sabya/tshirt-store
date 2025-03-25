<?php

namespace App\Livewire\Backend\Testimonial;

use App\Helpers\ImageHelper;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads, WithPagination, WithoutUrlPagination;

    public $name, $position, $company_name, $review, $rating, $image, $testimonialId;
    public $currentImage; // To hold the new image file
    public $searchTerm = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    protected $rules = [
        'name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'company_name' => 'required|string|max:255',
        'review' => 'required|string|max:500',
        'rating' => 'required|integer|min:1|max:5',
        'image' => 'nullable|image|max:2048',
    ];

    public function submit()
    {
        $this->validate();

        if ($this->image) {
            $imagePath = $this->image
                ? ImageHelper::uploadImage($this->image, 'testimonials', $this->currentImage)
                : $this->currentImage; // Retain the existing image if no new image    
        }


        if ($this->testimonialId) {
            $testimonial = Testimonial::find($this->testimonialId);

            $testimonial->update([
                'name' => $this->name,
                'position' => $this->position,
                'company_name' => $this->company_name,
                'review' => $this->review,
                'rating' => $this->rating,
                'image' => $this->image ? $imagePath : $this->currentImage,
            ]);
        } else {
            Testimonial::create([
                'name' => $this->name,
                'position' => $this->position,
                'company_name' => $this->company_name,
                'review' => $this->review,
                'rating' => $this->rating,
                'image' => $imagePath,
            ]);
        }

        session()->flash('message', 'Testimonial saved successfully!');
        $this->resetForm();
    }

    public function edit($id)
    {
        $testimonial = Testimonial::find($id);
        $this->testimonialId = $id;
        $this->name = $testimonial->name;
        $this->position = $testimonial->position;
        $this->company_name = $testimonial->company_name;
        $this->review = $testimonial->review;
        $this->rating = $testimonial->rating;
        $this->currentImage = $testimonial->image; // Save current image path
    }

    public function resetForm()
    {
        $this->name = '';
        $this->position = '';
        $this->company_name = '';
        $this->review = '';
        $this->rating = '';
        $this->currentImage = null;
        $this->image = null;
        $this->testimonialId = null;
    }

    // Method to handle sorting
    public function sortBy($field)
    {
        if ($this->sortBy == $field) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    // Method to get testimonials with search, sort, and paginate
    public function getTestimonials()
    {
        return Testimonial::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('position', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('company_name', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('review', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);
    }

    public function delete($testimonialId)
    {
        $testimonial = Testimonial::find($testimonialId);

        if ($testimonial) {
            // Delete the testimonial image if exists
            if ($testimonial->image) {
                Storage::delete('public/' . $testimonial->image);
            }

            // Delete the testimonial
            $testimonial->delete();

            // Flash a success message
            session()->flash('message', 'Testimonial deleted successfully!');
        } else {
            session()->flash('error', 'Testimonial not found.');
        }

        // Refresh the testimonials list
        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.backend.testimonial.index', [
            'testimonials' => $this->getTestimonials(),
        ]);
    }
}
