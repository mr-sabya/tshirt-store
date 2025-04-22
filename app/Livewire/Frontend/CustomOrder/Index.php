<?php

namespace App\Livewire\Frontend\CustomOrder;

use App\Models\CustomizationCategory;
use App\Models\Design;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $categoryName;
    public $selectedOptions = []; // ['design_id' => 'option_id']

    public function mount($categoryName)
    {
        $this->categoryName = $categoryName;
    }

    public function selectOption($designId, $optionId)
    {
        $this->selectedOptions[$designId] = $optionId;
    }

    public function render()
    {
        return view('livewire.frontend.custom-order.index', [
            'categories' => CustomizationCategory::all(),
            'category' => CustomizationCategory::where('name', $this->categoryName)->first(),
            'designs' => Design::orderBy('created_at', 'desc')->paginate(12),
        ]);
    }
}
