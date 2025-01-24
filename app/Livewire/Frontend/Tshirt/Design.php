<?php

namespace App\Livewire\Frontend\Tshirt;

use App\Models\Design as ModelsDesign;
use App\Models\Tshirt;
use Livewire\Component;
use Livewire\WithFileUploads;

class Design extends Component
{
    use WithFileUploads;

    public $tshirts;
    public $designs;
    public $selectedTshirt;
    public $selectedDesign;
    public $uploadedDesign;
    public $customText;
    public $previewDesign;
    public $previewTshirt;

    // Listen for events dispatched from JavaScript
    protected $listeners = ['tshirtOrDesignSelected' => 'handleTshirtOrDesignSelected'];

    public function mount()
    {
        $this->tshirts = Tshirt::where('is_active', true)->get();
        $this->designs = ModelsDesign::all();
        $this->previewTshirt = $this->tshirts->first()?->image ?? null;
        $this->previewDesign = $this->designs->first()?->image ?? null;
    }

    public function updatedUploadedDesign()
    {
        $this->previewDesign = $this->uploadedDesign->temporaryUrl();
    }

    public function selectTshirt($image)
    {
        $this->previewTshirt = $image;
        // Dispatch the event with the image source
        $this->dispatch('tshirtOrDesignSelected', $image);
    }

    public function selectDesign($image)
    {
        $this->previewDesign = $image;
        // Dispatch the event with the image source
        $this->dispatch('tshirtOrDesignSelected', $image);
    }


    public function handleTshirtOrDesignSelected($imageSrc)
    {
        // dd($imageSrc);
        // Handle the emitted event (e.g., store the selected image)
        if (strpos($imageSrc, 'tshirt') !== false) {
            $this->selectedTshirt = $imageSrc;
        } else {
            $this->selectedDesign = $imageSrc;
        }

        // Optionally, trigger any additional Livewire actions or updates here
    }

    public function resetCanvas()
    {
        $this->selectedTshirt = null;
        $this->selectedDesign = null;
        $this->uploadedDesign = null;
        $this->customText = null;
        $this->previewDesign = null;
        $this->previewTshirt = $this->tshirts->first()?->image ?? null;
    }

    public function render()
    {
        return view('livewire.frontend.tshirt.design');
    }
}
