<?php

namespace App\Livewire\Frontend\CustomOrder;

use App\Models\CustomizationCategory;
use App\Models\Design;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads, WithPagination;

    public $categoryName;
    public $selectedOptions = [];

    public function mount($categoryName)
    {
        $this->categoryName = $categoryName;
    }

    public function selectOption($designId, $optionId)
    {
        // Keep existing fields and only update design_id
        $this->selectedOptions[$optionId]['design_id'] = $designId;

        // Remove user-uploaded image if they pick a predefined design
        unset($this->selectedOptions[$optionId]['image']);
        unset($this->selectedOptions[$optionId]['image_url']);
    }

    public function saveOption($optionId)
    {
        if (isset($this->selectedOptions[$optionId]['image'])) {
            $path = $this->selectedOptions[$optionId]['image']->store('uploads/options', 'public');
            $this->selectedOptions[$optionId]['image_url'] = $path;

            // Clear selected design if user uploaded their own
            unset($this->selectedOptions[$optionId]['design_id']);
        }

        if (isset($this->selectedOptions[$optionId]['text'])) {
            $this->selectedOptions[$optionId]['custom_text'] = $this->selectedOptions[$optionId]['text'];
        }

        session()->flash('message', 'Option saved!');
    }

    public function clearOption($optionId)
    {
        if (isset($this->selectedOptions[$optionId])) {
            unset($this->selectedOptions[$optionId]);
        }
    }

    public function render()
    {
        $category = CustomizationCategory::where('name', $this->categoryName)->first();

        return view('livewire.frontend.custom-order.index', [
            'categories' => CustomizationCategory::all(),
            'category' => $category,
            'designs' => Design::latest()->get(),
        ]);
    }
}
