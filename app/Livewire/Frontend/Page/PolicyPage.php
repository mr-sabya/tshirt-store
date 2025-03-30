<?php

namespace App\Livewire\Frontend\Page;

use App\Models\Page;
use Livewire\Component;

class PolicyPage extends Component
{
    public function render()
    {
        return view('livewire.frontend.page.policy-page', [
            'page' => Page::where('slug', 'privacy-policy')->first()
        ]);
    }
}
