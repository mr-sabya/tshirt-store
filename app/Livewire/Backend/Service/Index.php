<?php

namespace App\Livewire\Backend\Service;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $icon, $title, $text, $service_id;
    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $updateMode = false;

    protected $rules = [
        'icon' => 'required|string',
        'title' => 'required|string|max:255',
        'text' => 'required|string',
    ];

    public function store()
    {
        $this->validate();
        Service::create(['icon' => $this->icon, 'title' => $this->title, 'text' => $this->text]);

        session()->flash('message', 'Service added successfully!');
        $this->resetFields();
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $this->service_id = $service->id;
        $this->icon = $service->icon;
        $this->title = $service->title;
        $this->text = $service->text;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate();
        Service::findOrFail($this->service_id)->update(['icon' => $this->icon, 'title' => $this->title, 'text' => $this->text]);

        session()->flash('message', 'Service updated successfully!');
        $this->resetFields();
    }

    public function delete($id)
    {
        Service::findOrFail($id)->delete();
        session()->flash('message', 'Service deleted successfully!');
    }

    public function resetFields()
    {
        $this->icon = '';
        $this->title = '';
        $this->text = '';
        $this->service_id = null;
        $this->updateMode = false;
    }

    public function sortBy($field)
    {
        $this->sortDirection = ($this->sortField === $field && $this->sortDirection === 'asc') ? 'desc' : 'asc';
        $this->sortField = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $services = Service::where('title', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(5);

        return view('livewire.backend.service.index', compact('services'));
    }

}
