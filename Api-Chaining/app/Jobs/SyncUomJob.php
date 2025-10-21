<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\Item;

class SyncUomJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $hsCode;

    public function __construct($hsCode)
    {
        $this->hsCode = $hsCode;
    }

   public function handle()
{
    \Log::info('SyncUomJob started for hs_code: ' . $this->hsCode);

    $response = Http::withToken(config('fbr.FBR_TOKEN'))
        ->get("https://gw.fbr.gov.pk/pdi/v2/HS_UOM", [
            'hs_code' => $this->hsCode,
            'annexure_id' => 3,
        ]);

    \Log::info('API Response for hs_code ' . $this->hsCode . ': ' . json_encode($response->json()));

    $uoms = $response->json();

    if (is_array($uoms) && !empty($uoms)) {
        $uom = $this->pick($uoms[0], ['uom', 'description', 'uom_desc', 'unit', 'UOM', 'unitOfMeasure', 'uomCode']);
        \Log::info('Selected UOM for hs_code ' . $this->hsCode . ': ' . $uom);

        Item::where('hs_code', $this->hsCode)
            ->update(['uom' => $uom]);
        \Log::info('UOM updated for hs_code ' . $this->hsCode . ' to: ' . $uom);
    } else {
        \Log::warning('No UOM data received for hs_code ' . $this->hsCode);
        Item::where('hs_code', $this->hsCode)
            ->update(['uom' => null]);
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