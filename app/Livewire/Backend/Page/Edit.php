<?php

namespace App\Livewire\Backend\Page;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $page;
    public $sub_heading, $image, $text, $currentImage;

    protected $rules = [
        'sub_heading' => 'nullable|string|max:255',
        'image' => 'nullable|image|max:1024',  // Optional image, max size 1MB
        'text' => 'nullable|string',
    ];

    public function mount($pageId)
    {
        $this->page = Page::findOrFail($pageId);
        $this->sub_heading = $this->page->sub_heading;
        $this->text = $this->page->text;
        $this->currentImage = $this->page->image;
    }

    public function updatePage()
    {
        $this->validate();

        // Handle image upload if provided
        if ($this->image) {
            $imagePath = $this->image->store('images', 'public');
            $this->page->image = $imagePath;
        }

        $this->page->sub_heading = $this->sub_heading;
        $this->page->text = $this->text;
        $this->page->save();

        session()->flash('message', 'Page updated successfully!');
        return $this->redirect(route('admin.page.index'), navigate:true);  // Redirect to the index page after updating
    }

    public function render()
    {
        return view('livewire.backend.page.edit');
    }
}
