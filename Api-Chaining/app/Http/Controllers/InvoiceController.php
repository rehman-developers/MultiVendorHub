<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Models\Item; // Add this for database fetch

class InvoiceController extends Controller
{
    public function fbrToken()
    {
        return config('fbr.FBR_TOKEN') ?? env('FBR_TOKEN');
    }

    // ---------- CREATE VIEW: server fetch + cache all lists ----------
    public function create(Request $request)
    {
        $doctypes  = $this->getDocTypes();
        $provinces = $this->getProvinces();
        $items     = Item::all(); // Fetch from database
        $uoms      = $this->getUom();
        $sroList   = []; // Dynamic via AJAX, set empty initially
        $saleTypes = $this->getSaleTypes();

        // old input (after redirect back) and computed tax stored in session by getTax()
        $old = old();
        $computedTaxRate   = session('computed_tax_rate');
        $computedTaxAmount = session('computed_tax_amount');
        $computedLineTotal = session('computed_line_total');

        return view('create', compact(
            'doctypes','provinces','items','uoms','sroList','saleTypes','old',
            'computedTaxRate','computedTaxAmount','computedLineTotal'
        ));
    }

    // ---------- Helper: normalize keys from FBR responses ----------
    protected function normalizeItem($it)
    {
        if (!is_array($it)) return [];

        $hs = $this->pick($it, ['hS_CODE','HS_CODE','hs_code','hscode','hsCode']);
        $desc = $this->pick($it, ['description','Description','desc','DESC']);
        $uom = $this->pick($it, ['uom','uom_desc','measurement','unit','uomDesc', 'UOM', 'unitOfMeasure', 'uomCode']);
        $sro_ser = $this->pick($it, ['serNo', 'SRO_ITEM_SER_NO', 'serialNo', 'sroSerialNo', 'itemSerialNo', 'sro_item_serial_no']);
        $sro_desc = $this->pick($it, ['srO_DESC','sro_desc','sroDescription','srO_ITEM_DESC','sro_item_desc','SRO_DESC','SRO_DESCRIPTION']);
        return [
            'hs_code' => $hs,
            'description' => $desc,
            'uom' => $uom,
            'raw' => $it,
            'sro_ser' => $sro_ser,
            'sro_desc' => $sro_desc,
        ];
    }

    public function normalizeProvince($p)
    {
        return [
            'id' => $this->pick($p, ['stateProvinceCode']),
            'name' => $this->pick($p, ['stateProvinceDesc']),
        ];
    }

    public function normalizeSaleType($s)
    {
        return [
            'id' => $this->pick($s, ['transactioN_TYPE_ID']),
            'desc' => $this->pick($s, ['transactioN_DESC']),
            'raw' => $s,
        ];
    }

    public function pick($arr, $keys)
    {
        foreach ($keys as $k) {
            if (array_key_exists($k, $arr) && $arr[$k] !== null && $arr[$k] !== '') return $arr[$k];
        }
        // case-insensitive fallback
        foreach ($arr as $k2 => $v) {
            foreach ($keys as $k) {
                if (strcasecmp($k, $k2) === 0 && $v !== null && $v !== '') return $v;
            }
        }
        return null;
    }

    // ---------- Cached FBR list methods (normalize outputs) ----------
    public function getDocTypes()
    {
        $resp = $this->safeGet("https://gw.fbr.gov.pk/pdi/v1/doctypecode");
        return is_array($resp) ? $resp : [];
    }

    public function getProvinces()
    {
        $resp = $this->safeGet("https://gw.fbr.gov.pk/pdi/v1/provinces");
        if (!is_array($resp)) return [];
        return array_map([$this, 'normalizeProvince'], $resp);
    }

    public function getItemDescCode()
    {
        $resp = $this->safeGet("https://gw.fbr.gov.pk/pdi/v1/itemdesccode");
        if (!is_array($resp)) return [];
        return array_map([$this, 'normalizeItem'], $resp);
    }

    public function getUom()
    {
        $resp = $this->safeGet("https://gw.fbr.gov.pk/pdi/v1/uom");
        return is_array($resp) ? $resp : [];
    }

    public function getSroList(Request $request)
    {
        $rateId = $request->get('rate_id');
        $dateInput = $request->get('date');

        if (!$rateId) {
            \Log::warning('getSroList: No rate_id provided');
            return response()->json([[
                'sro_desc' => 'No SRO Available',
                'sro_ser' => 'No Serial Available'
            ]]);
        }

        if ($dateInput) {
            try {
                $date = Carbon::parse($dateInput)->format('d-M-Y');
            } catch (\Exception $e) {
                \Log::error('getSroList: Invalid date format', ['date' => $dateInput, 'error' => $e->getMessage()]);
                $date = Carbon::now()->locale('en')->translatedFormat('d-M-Y');
            }
        } else {
            $date = Carbon::now()->locale('en')->translatedFormat('d-M-Y');
        }
        $cacheKey = "fbr_sro_schedule_{$rateId}_{$date}";

        return Cache::remember($cacheKey, 60 * 60 * 24 * 6, function () use ($rateId, $date) {
            $resp = $this->safeGet("https://gw.fbr.gov.pk/pdi/v1/SroSchedule", [
                'rate_id' => $rateId,
                'date' => $date,
                'origination_supplier_csv' => 1,
            ]);

            \Log::debug('SRO API Raw Response: ', ['response' => $resp]);

            if (!is_array($resp) || empty($resp)) {
                \Log::warning('getSroList: Empty or non-array response from API', ['response' => $resp]);
                return [[
                    'sro_desc' => 'No SRO Available',
                    'sro_ser' => 'No Serial Available'
                ]];
            }

            $normalized = array_map([$this, 'normalizeItem'], $resp);
            \Log::debug('SRO Normalized Data: ', ['normalized' => $normalized]);

            if (empty($normalized) || !isset($normalized[0]['sro_desc']) || !isset($normalized[0]['sro_ser'])) {
                \Log::warning('getSroList: No valid SRO data after normalization');
                return [[
                    'sro_desc' => 'No SRO Available',
                    'sro_ser' => 'No Serial Available'
                ]];
            }

            return $normalized;
        });
    }

    public function getSaleTypes()
    {
        $resp = $this->safeGet("https://gw.fbr.gov.pk/pdi/v1/transtypecode");
        if (!is_array($resp)) return [];
        return array_map([$this, 'normalizeSaleType'], $resp);
    }

    // ---------- SaleTypeToRate call ----------
    public function getSaleTypeRates(array $params = [])
    {
        $date = $params['date'] ?? Carbon::now()->format('d-M-Y');
        $transTypeId = $params['transTypeId'] ?? null;
        $orig = $params['originationSupplier'] ?? ($params['provinceId'] ?? null);

        $query = ['date' => $date];
        if ($transTypeId) $query['transTypeId'] = $transTypeId;
        if ($orig) $query['originationSupplier'] = $orig;

        return $this->safeGet("https://gw.fbr.gov.pk/pdi/v2/SaleTypeToRate", $query);
    }

    // ---------- getTax endpoint (form POST) ----------
    public function getTax(Request $request)
    {
        $data = $request->validate([
            'transTypeId' => 'required',
            'provinceId'  => 'required',
            'date' => 'nullable|date_format:d-M-Y',
            'quantity' => 'nullable|numeric',
            'unit_price' => 'nullable|numeric',
        ]);

        $date = $data['date'] ?? Carbon::now()->format('d-M-Y');
        $transTypeId = $data['transTypeId'];
        $provinceId = $data['provinceId'];

        $rates = $this->getSaleTypeRates([
            'date' => $date,
            'transTypeId' => $transTypeId,
            'originationSupplier' => $provinceId,
        ]);

        // parse percentage: try to find numeric fields
        $percent = null;
        $rateId = null;
        if (is_array($rates) && count($rates) > 0) {
            $first = Arr::first($rates);
            if (is_array($first)) {
                $percent = $this->pick($first, ['ratE_VALUE','rate_value','rate','ratEValue']);
                $rateId = $this->pick($first, ['ratE_ID','rate_id','ratEID']);
            } else {
                $percent = is_numeric($rates[0]) ? $rates[0] : null;
            }
        }

        if ($percent !== null) {
            $percent = (float) $percent;
        }

        $qty = (float) ($data['quantity'] ?? 0);
        $unitPrice = (float) ($data['unit_price'] ?? 0);
        $lineTotal = $qty * $unitPrice;
        $totalTax = $percent !== null ? ($lineTotal * $percent / 100) : null;

        // If AJAX/json requested, return JSON (so frontend fetch can use it)
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'tax_rate' => $percent,
                'tax_amount' => $totalTax,
                'line_total' => $lineTotal,
                'rate_id' => $rateId,
            ]);
        }

        // store computed values in session and redirect to create (blade reads from session)
        session([
            'computed_tax_rate' => $percent,
            'computed_tax_amount' => $totalTax,
            'computed_line_total' => $lineTotal
        ]);

        return redirect()->route('invoice.create')->withInput($request->all());
    }

    // ---------- getHsUom endpoint (new for UOM per HS code) ----------
  public function getHsUom(Request $request)
{
    $hsCode = str_replace('.', '', $request->get('hs_code'));

    if (!$hsCode) {
        return response()->json([]);
    }

    $cacheKey = "fbr_hs_uom_{$hsCode}";

    return Cache::remember($cacheKey, 60 * 60 * 24 * 6, function () use ($hsCode) {
        $resp = $this->safeGet("https://gw.fbr.gov.pk/pdi/v2/HS_UOM", [
            'hs_code' => $hsCode,
            'annexure_id' => 3, // Required for sales annexure, as per FBR DI API documentation
        ]);

        \Log::debug('getHsUom API Response for HS Code ' . $hsCode . ': ', ['response' => $resp]);

        if (!is_array($resp) || empty($resp)) {
            \Log::warning('getHsUom: Empty or non-array response for HS Code ' . $hsCode);
            return [];
        }

        // Normalize response to ensure we get valid UOMs
        $uoms = array_map(function ($u) {
            $unit = $this->pick($u, ['uom', 'description', 'uom_desc', 'unit', 'UOM', 'unitOfMeasure', 'uomCode']);
            return $unit ? (string) $unit : null;
        }, $resp);

        $uoms = array_filter($uoms); // Remove null values
        return $uoms ? array_values($uoms) : [];
    });
}

    // ---------- preview JSON (post from form) ----------
    public function preview(Request $request)
    {
        $data = $request->all();

        // if items were sent as items_json (hidden field, see blade), decode and select
        $item = null;
        if (!empty($data['items_json']) && isset($data['item_index'])) {
            $items = json_decode($data['items_json'], true);
            $idx = (int) $data['item_index'];
            $itemRaw = $items[$idx] ?? null;
            if ($itemRaw) {
                $item = [
                    'code' => $itemRaw['hs_code'] ?? $itemRaw['raw']['hS_CODE'] ?? null,
                    'description' => $itemRaw['description'] ?? ($itemRaw['raw']['description'] ?? null),
                    'unit' => $data['itemUnit'] ?? ($itemRaw['uom'] ?? null),
                    'unitPrice' => $data['itemUnitPrice'] ?? null,
                    'quantity' => $data['itemQuantity'] ?? null,
                    'sroNo' => $data['sroNo'] ?? null,
                    'sroItemNo' => $data['sroItemNo'] ?? null,
                ];
            }
        } else {
            // fallback read from inputs
            $item = [
                'code' => $data['itemCode'] ?? null,
                'description' => $data['itemDescription'] ?? null,
                'unit' => $data['itemUnit'] ?? null,
                'unitPrice' => $data['itemUnitPrice'] ?? null,
                'quantity' => $data['itemQuantity'] ?? null,
                'sroNo' => $data['sroNo'] ?? null,
                'sroItemNo' => $data['sroItemNo'] ?? null,
            ];
        }

        $payload = [
            'invoice' => [
                'refNo' => $data['invoiceRefNo'] ?? null,
                'date' => $data['invoiceDate'] ?? null,
                'documentType' => $data['documentType'] ?? null,
            ],
            'seller' => [
                'businessName' => $data['sellerBusinessName'] ?? null,
                'address' => $data['sellerAddress'] ?? null,
                'ntnCnic' => $data['sellerNTNCNIC'] ?? null,
                'province' => $this->getProvinceName($data['sellerProvince'] ?? null),
            ],
            'buyer' => [
                'businessName' => $data['buyerBusinessName'] ?? null,
                'address' => $data['buyerAddress'] ?? null,
                'ntnCnic' => $data['buyerNTNCNIC'] ?? null,
                'province' => $this->getProvinceName($data['buyerProvince'] ?? null),
            ],
            'item' => $item,
        ];

        // If computed tax in session, add it
        $payload['item']['taxRate'] = session('computed_tax_rate') ?? $data['taxRate'] ?? null;
        $payload['item']['totalPrice'] = session('computed_line_total') ?? $data['totalPrice'] ?? null;
        $payload['item']['totalTax'] = session('computed_tax_amount') ?? $data['totalTax'] ?? null;

        return view('preview', compact('payload'));
    }

    protected function getProvinceName($code)
    {
        $provinces = $this->getProvinces();
        $match = Arr::first($provinces, function ($p) use ($code) {
            return $p['id'] == $code;
        });
        return $match ? $match['name'] : $code;
    }

    // ---------- safe GET helper with token, try/catch ----------
    public function safeGet($url, $query = [])
    {
        try {
            $token = $this->fbrToken();
            $req = Http::acceptJson();
            if ($token) $req = $req->withToken($token);

            $resp = $req->get($url, $query);

            \Log::info('API Call: ' . $url . ' | Params: ' . json_encode($query) . ' | Status: ' . $resp->status() . ' | Body: ' . $resp->body());

            if ($resp->successful()) {
                return $resp->json();
            }

            \Log::error('API Fail: ' . $url . ' | Status: ' . $resp->status());
            return null;
        } catch (\Throwable $e) {
            \Log::error('API Error: ' . $url . ' | Msg: ' . $e->getMessage());
            return null;
        }
    }   
}