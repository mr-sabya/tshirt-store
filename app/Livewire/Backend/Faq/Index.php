<?php

namespace App\Livewire\Backend\Faq;

use App\Models\Faq;
use Livewire\Component;

class Index extends Component
{
    public $faqs, $question, $answer, $status = true, $faq_id;
    public $isEditing = false;

    protected $rules = [
        'question' => 'required|string|max:255',
        'answer' => 'required|string',
        'status' => 'boolean',
    ];


    public function save()
    {
        $this->validate();

        Faq::create([
            'question' => $this->question,
            'answer' => $this->answer,
            'status' => $this->status,
        ]);

        session()->flash('message', 'FAQ added successfully.');
        $this->resetInput();
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        $this->faq_id = $faq->id;
        $this->question = $faq->question;
        $this->answer = $faq->answer;
        $this->status = $faq->status;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate();

        $faq = Faq::findOrFail($this->faq_id);
        $faq->update([
            'question' => $this->question,
            'answer' => $this->answer,
            'status' => $this->status,
        ]);

        session()->flash('message', 'FAQ updated successfully.');
        $this->resetInput();
        $this->isEditing = false;
    }

    public function delete($id)
    {
        Faq::findOrFail($id)->delete();
        session()->flash('message', 'FAQ deleted successfully.');
    }

    private function resetInput()
    {
        $this->question = '';
        $this->answer = '';
        $this->status = true;
        $this->faq_id = null;
    }

    public function render()
    {
        $this->faqs = Faq::latest()->get();
        return view('livewire.backend.faq.index');
    }
}
