<?php

namespace App\Livewire\Frontend\Page;

use App\Models\Page;
use Livewire\Component;

class TermsPage extends Component
{
    public function render()
    {
        return view('livewire.frontend.page.terms-page', [
            'page' => Page::where('slug', 'terms-conditions')->first()
        ]);
    }
}
