<?php

namespace App\Livewire\Backend\Sitemap;

use Livewire\Component;
use Spatie\Sitemap\SitemapGenerator;

class Index extends Component
{
    public $message = '';

    public function generateSitemap()
    {
        try {
            SitemapGenerator::create(config('app.url'))
                ->writeToFile(public_path('sitemap.xml'));

            $this->message = "Sitemap generated successfully!";
        } catch (\Exception $e) {
            $this->message = "Error: " . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.backend.sitemap.index');
    }
}
