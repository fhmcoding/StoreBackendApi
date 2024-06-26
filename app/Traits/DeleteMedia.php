<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait DeleteMedia {

    public function deleteAllMedia()
    {
        foreach ($this->media as $media) {
            Storage::disk('public')->delete($this->{$media});
        }

        return $this;
    }


    public function deleteMedia($media)
    {
        Storage::disk('public')->delete($this->{$media});
        return $this;
    }

}
