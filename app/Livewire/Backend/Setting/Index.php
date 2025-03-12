<?php

namespace App\Livewire\Backend\Setting;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $site_name, $tagline, $currency, $top_header_text;
    public $email, $phone, $address, $footer_about, $newsletter_text, $copyright_text;
    public $facebook, $twitter, $linkedin, $instagram, $youtube, $tiktok, $thread;
    public $meta_title, $meta_description, $meta_keywords;

    public $logo, $footer_logo, $favicon;
    public $uploadedLogo, $uploadedFooterLogo, $uploadedFavicon;

    public function mount()
    {
        $setting = Setting::find(1);

        if ($setting) {
            $this->site_name = $setting->site_name;
            $this->tagline = $setting->tagline;
            $this->currency = $setting->currency;
            $this->top_header_text = $setting->top_header_text;

            $this->email = $setting->email;
            $this->phone = $setting->phone;
            $this->address = $setting->address;
            $this->footer_about = $setting->footer_about;
            $this->newsletter_text = $setting->newsletter_text;
            $this->copyright_text = $setting->copyright_text;

            $this->facebook = $setting->facebook;
            $this->twitter = $setting->twitter;
            $this->linkedin = $setting->linkedin;
            $this->instagram = $setting->instagram;
            $this->youtube = $setting->youtube;
            $this->tiktok = $setting->tiktok;
            $this->thread = $setting->thread;

            $this->meta_title = $setting->meta_title;
            $this->meta_description = $setting->meta_description;
            $this->meta_keywords = $setting->meta_keywords;

            $this->logo = $setting->logo;
            $this->footer_logo = $setting->footer_logo;
            $this->favicon = $setting->favicon;
        }
    }

    public function updateSettings()
    {
        $setting = Setting::find(1);
        if (!$setting) {
            $setting = new Setting();
            $setting->id = 1;
        }

        // Update text fields
        $setting->site_name = $this->site_name;
        $setting->tagline = $this->tagline;
        $setting->currency = $this->currency;
        $setting->top_header_text = $this->top_header_text;

        $setting->email = $this->email;
        $setting->phone = $this->phone;
        $setting->address = $this->address;
        $setting->footer_about = $this->footer_about;
        $setting->newsletter_text = $this->newsletter_text;
        $setting->copyright_text = $this->copyright_text;

        $setting->facebook = $this->facebook;
        $setting->twitter = $this->twitter;
        $setting->linkedin = $this->linkedin;
        $setting->instagram = $this->instagram;
        $setting->youtube = $this->youtube;
        $setting->tiktok = $this->tiktok;
        $setting->thread = $this->thread;

        $setting->meta_title = $this->meta_title;
        $setting->meta_description = $this->meta_description;
        $setting->meta_keywords = $this->meta_keywords;

        // Handle image uploads
        if ($this->uploadedLogo) {
            $setting->logo = $this->uploadedLogo->store('settings', 'public');
        }
        if ($this->uploadedFooterLogo) {
            $setting->footer_logo = $this->uploadedFooterLogo->store('settings', 'public');
        }
        if ($this->uploadedFavicon) {
            $setting->favicon = $this->uploadedFavicon->store('settings', 'public');
        }

        $setting->save();
        session()->flash('success', 'Settings updated successfully!');
    }

    public function updatedUploadedLogo()
    {
        $this->validate(['uploadedLogo' => 'image|max:1024']);
    }

    public function updatedUploadedFooterLogo()
    {
        $this->validate(['uploadedFooterLogo' => 'image|max:1024']);
    }

    public function updatedUploadedFavicon()
    {
        $this->validate(['uploadedFavicon' => 'image|max:512']);
    }

    public function render()
    {
        return view('livewire.backend.setting.index');
    }
}
