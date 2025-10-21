<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\Item;

class SyncItemsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $response = Http::withToken(config('fbr.FBR_TOKEN'))
            ->get("https://gw.fbr.gov.pk/pdi/v1/itemdesccode");

        $itemsData = $response->json();

        if (is_array($itemsData)) {
            foreach ($itemsData as $itemData) {
                $hsCode = $this->pick($itemData, ['hS_CODE','HS_CODE','hs_code','hscode','hsCode']);
                $description = $this->pick($itemData, ['description','Description','desc','DESC']);
                $uom = $this->pick($itemData, ['uom','uom_desc','measurement','unit','uomDesc']);

                Item::updateOrCreate(
                    ['hs_code' => $hsCode],  // Uses 'hs_code' to match migration
                    ['description' => $description, 'uom' => $uom]
                );
            }
        }
    }

    private function pick($arr, $keys)
    {
        foreach ($keys as $k) {
            if (array_key_exists($k, $arr) && $arr[$k] !== null && $arr[$k] !== '') return $arr[$k];
        }
        foreach ($arr as $k2 => $v) {
            foreach ($keys as $k) {
                if (strcasecmp($k, $k2) === 0 && $v !== null && $v !== '') return $v;
            }
        }
        return null;
    }
}