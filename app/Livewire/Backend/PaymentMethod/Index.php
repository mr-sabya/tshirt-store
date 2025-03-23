<?php

namespace App\Livewire\Backend\PaymentMethod;

use App\Models\PaymentMethod;
use Livewire\Component;

class Index extends Component
{
    public $paymentMethods, $paymentMethodId;
    public $name, $description, $bkash_number, $bank_account_number, $third_party_gateway_details, $is_active;


    public function resetFields()
    {
        $this->name = '';
        $this->description = '';
        $this->bkash_number = '';
        $this->bank_account_number = '';
        $this->third_party_gateway_details = '';
        $this->is_active = false;
        $this->paymentMethodId = null;
    }

    public function savePaymentMethod()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'nullable',
            'bkash_number' => 'nullable',
            'bank_account_number' => 'nullable',
            'third_party_gateway_details' => 'nullable',
            'is_active' => 'boolean',
        ]);

        PaymentMethod::updateOrCreate(
            ['id' => $this->paymentMethodId],
            [
                'name' => $this->name,
                'description' => $this->description,
                'bkash_number' => $this->bkash_number,
                'bank_account_number' => $this->bank_account_number,
                'third_party_gateway_details' => $this->third_party_gateway_details,
                'is_active' => $this->is_active ? 1 : 0,
            ]
        );

        session()->flash('message', $this->paymentMethodId ? 'Payment Method Updated' : 'Payment Method Created');

        $this->resetFields();
    }

    public function edit($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $this->paymentMethodId = $paymentMethod->id;
        $this->name = $paymentMethod->name;
        $this->description = $paymentMethod->description;
        $this->bkash_number = $paymentMethod->bkash_number;
        $this->bank_account_number = $paymentMethod->bank_account_number;
        $this->third_party_gateway_details = $paymentMethod->third_party_gateway_details;
        $this->is_active = $paymentMethod->is_active ? true : false;
    }

    public function delete($id)
    {
        PaymentMethod::findOrFail($id)->delete();
        session()->flash('message', 'Payment Method Deleted');
    }

    public function render()
    {
        $this->paymentMethods = PaymentMethod::all();
        return view('livewire.backend.payment-method.index');
    }
}
