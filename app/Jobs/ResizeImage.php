<?php

namespace App\Jobs;

use Spatie\Image\Image;
use Illuminate\Bus\Queueable;
use Spatie\Image\Manipulations;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $h;
    private $w;
    private $fileName;
    private $path;



    /**
     * Create a new job instance.
     */
    public function __construct($filepath, $w, $h,)
    {
        $this->path = dirname($filepath);
        $this->fileName = basename($filepath);
        $this->w = $w;
        $this->h = $h;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $w = $this->w;
        $h = $this->h;
        $srcPath = storage_path() . '/app/public/' . $this->path . '/' . $this->fileName;

        if (!file_exists($srcPath)) {

            $srcPath = storage_path() . '/app/public/storage/immagini/Nuovo_progetto.png';

        }

        $destPath = storage_path() . '/app/public/' . $this->path . "/crop_{$w}x{$h}_" . $this->fileName;
        $croppedImage = Image::load($srcPath)->crop(Manipulations::CROP_CENTER, $w, $h)->save($destPath);
    }
}
