<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ProcessProductImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $productId;
    protected $imageUrl;

    public function __construct($productId, $imageUrl)
    {
        $this->productId = $productId;
        $this->imageUrl = $imageUrl;
    }

    public function handle()
    {
        $product = Product::find($this->productId);
        if ($product && filter_var($this->imageUrl, FILTER_VALIDATE_URL)) {
            try {
                $response = Http::get($this->imageUrl);
                if ($response->successful()) {
                    $fileName = 'products/' . $this->productId . '.' . pathinfo($this->imageUrl, PATHINFO_EXTENSION);
                    Storage::put('public/' . $fileName, $response->body());
                    $product->update(['image' => Storage::url($fileName)]);
                }
            } catch (\Exception $e) {
                \Log::error('Image processing failed for product ' . $this->productId . ': ' . $e->getMessage());
            }
        }
    }
}