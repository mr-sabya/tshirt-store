<?php

namespace App\Livewire\Backend\BarCode;

use App\Models\Barcode;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Milon\Barcode\DNS1D;
use Intervention\Image\Facades\Image;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $product_id, $code, $search;
    public $barcode_id;

    protected $rules = [
        'product_id' => 'nullable|exists:products,id',
        'code' => 'required|string|unique:barcodes,code',
    ];

    public function createBarcode()
    {
        $this->validate();

        Barcode::create([
            'product_id' => $this->product_id,
            'code' => $this->code,
        ]);

        session()->flash('message', 'Barcode created successfully.');
        $this->reset(['product_id', 'code']);
    }

    public function deleteBarcode($id)
    {
        Barcode::findOrFail($id)->delete();
        session()->flash('message', 'Barcode deleted.');
    }

    public function downloadBarcode($id)
    {
        $barcode = Barcode::findOrFail($id);
        $barcodeGenerator = new DNS1D(); // Create an instance
        $barcodeData = $barcodeGenerator->getBarcodePNG($barcode->code, 'C128');

        // Convert Base64 PNG to Image and Save
        $image = Image::make(base64_decode($barcodeData))->resize(400, 100);
        $path = 'barcodes/' . $barcode->code . '.png';
        Storage::disk('public')->put($path, (string) $image->encode('png'));

        return response()->download(storage_path("app/public/{$path}"));
    }

    public function render()
    {
        $barcodes = Barcode::when($this->search, function ($query) {
            $query->where('code', 'like', "%{$this->search}%");
        })->orderBy('id', 'desc')->paginate(5);

        return view('livewire.backend.bar-code.index', compact('barcodes'));
    }
}
