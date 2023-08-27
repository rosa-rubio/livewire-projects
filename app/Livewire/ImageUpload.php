<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ImageUpload extends Component
{
    use WithFileUploads;

    /**
    * @var TemporaryUploadedFile
     */
    
    public $image = [];

    public function save()
    {
        $this->validate([
            'image.*' => 'image|max:1024',
        ]);

        foreach ($this->image as $image) {
            $image->store('public');
        }

        // $this->image->storeAs('public', $image->getClientOriginalName());
    }

    public function render()
    {
        return view('livewire.image-upload', [
            'images' => collect(Storage::files('public'))
                ->filter(function ($file) {
                    return in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['png', 'jpg', 'gif', 'png']);
                })
                ->map(function ($file) {
                    return Storage::url($file);
                })
        ]);
    }
}
