<?php

namespace App\Livewire\Frontend\Page;

use App\Models\Page;
use Livewire\Component;

class RefundPolicyPage extends Component
{
    public function render()
    {
        return view('livewire.frontend.page.refund-policy-page',[
            'page' => Page::where('slug', 'refund-policy')->first()
        ]);
    }
}
