<?php

namespace App\Livewire\Backend\DeliveryCharge;

use App\Models\City;
use App\Models\DeliveryCharge;
use Livewire\Component;

class Index extends Component
{
    public $city_id, $charge, $deliveryChargeId;
    public $deliveryCharges;



    public function resetFields()
    {
        $this->city_id = '';
        $this->charge = '';
        $this->deliveryChargeId = null;
    }

    public function saveDeliveryCharge()
    {
        $this->validate([
            'city_id' => 'required|exists:cities,id',
            'charge' => 'required|numeric|min:0',
        ]);

        DeliveryCharge::updateOrCreate(
            ['id' => $this->deliveryChargeId],
            [
                'city_id' => $this->city_id,
                'charge' => $this->charge,
            ]
        );

        session()->flash('message', $this->deliveryChargeId ? 'Delivery Charge Updated' : 'Delivery Charge Created');
        $this->resetFields();
    }

    public function edit($id)
    {
        $deliveryCharge = DeliveryCharge::findOrFail($id);
        $this->deliveryChargeId = $deliveryCharge->id;
        $this->city_id = $deliveryCharge->city_id;
        $this->charge = $deliveryCharge->charge;
    }

    public function delete($id)
    {
        DeliveryCharge::findOrFail($id)->delete();
        session()->flash('message', 'Delivery Charge Deleted');
    }

    public function render()
    {
        $this->deliveryCharges = DeliveryCharge::with('city')->get();
        $cities = City::all();
        return view('livewire.backend.delivery-charge.index', compact('cities'));
    }

}
