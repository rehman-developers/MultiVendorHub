<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FBR Invoice Data Entry</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-indigo-50 to-blue-100 min-h-screen flex justify-center py-12 px-4">
    <form action="{{ route('invoice.preview') }}" method="post"
        class="bg-white shadow-2xl rounded-3xl p-10 w-full max-w-7xl space-y-10 overflow-hidden">
        @csrf
        <!-- Header -->
        <div class="border-b pb-6">
            <h2 class="text-3xl font-bold text-indigo-800 flex items-center"><i
                    class="fas fa-file-invoice mr-3 text-indigo-600"></i>FBR Invoice Data Entry</h2>
            <p class="text-base text-gray-600 mt-2">Enter all required invoice details carefully for accurate
                processing.</p>
        </div>

        <!-- Invoice Section -->
        <div class="bg-white rounded-2xl shadow-md p-8">
            <h3 class="text-2xl font-semibold text-indigo-800 mb-6 flex items-center"><i
                    class="fas fa-info-circle mr-3 text-indigo-600"></i>Invoice Details</h3>
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Invoice RefNo</label>
                    <input type="text" name="invoiceRefNo" id="invoiceRefNo"
                        value="{{ old('invoiceRefNo', $old['invoiceRefNo'] ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Invoice Date</label>
                    <input type="date" name="invoiceDate" id="invoiceDate"
                        value="{{ old('invoiceDate', $old['invoiceDate'] ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Document Type</label>
                    <input name="documentType" list="documentTypes" type="text"
                        value="{{ old('documentType', $old['documentType'] ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200">
                    <datalist id="documentTypes">
                        @foreach($doctypes as $d)
                        <option value="{{ $d['docDescription'] ?? '' }}"></option>
                        @endforeach
                    </datalist>
                </div>
            </div>
        </div>

        <!-- Seller Info -->
        <div class="bg-gradient-to-r from-gray-50 to-indigo-50 rounded-2xl shadow-md p-8 border border-indigo-100">
            <h3 class="text-2xl font-semibold text-indigo-800 mb-6 flex items-center"><i
                    class="fas fa-user-tie mr-3 text-indigo-600"></i>Seller Information</h3>
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Business Name</label>
                    <input type="text" name="sellerBusinessName" id="sellerBusinessName"
                        value="{{ old('sellerBusinessName', $old['sellerBusinessName'] ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <input type="text" name="sellerAddress" id="sellerAddress"
                        value="{{ old('sellerAddress', $old['sellerAddress'] ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">NTN/CNIC</label>
                    <input type="number" name="sellerNTNCNIC" id="sellerNTNCNIC"
                        value="{{ old('sellerNTNCNIC', $old['sellerNTNCNIC'] ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Province</label>
                    <input name="sellerProvince" id="sellerProvince" type="text" list="sellerProvinces"
                        value="{{ old('sellerProvince', $old['sellerProvince'] ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200">
                    <datalist id="sellerProvinces">
                        @foreach($provinces as $p)
                        <option value="{{ $p['id'] }}">{{ $p['name'] }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
        </div>

        <!-- Buyer Info -->
        <div class="bg-gradient-to-r from-gray-50 to-indigo-50 rounded-2xl shadow-md p-8 border border-indigo-100">
            <h3 class="text-2xl font-semibold text-indigo-800 mb-6 flex items-center"><i
                    class="fas fa-user mr-3 text-indigo-600"></i>Buyer Information</h3>
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Business Name</label>
                    <input type="text" name="buyerBusinessName" id="buyerBusinessName"
                        value="{{ old('buyerBusinessName', $old['buyerBusinessName'] ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <input type="text" name="buyerAddress" id="buyerAddress"
                        value="{{ old('buyerAddress', $old['buyerAddress'] ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">NTN/CNIC</label>
                    <input type="number" name="buyerNTNCNIC" id="buyerNTNCNIC"
                        value="{{ old('buyerNTNCNIC', $old['buyerNTNCNIC'] ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Province</label>
                    <input name="buyerProvince" id="buyerProvince" type="text" list="buyerProvinces"
                        value="{{ old('buyerProvince', $old['buyerProvince'] ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200">
                    <datalist id="buyerProvinces">
                        @foreach($provinces as $p)
                        <option value="{{ $p['id'] }}">{{ $p['name'] }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
        </div>

        <!-- Items Section -->
        <div class="bg-gradient-to-r from-indigo-100 to-blue-100 p-8 rounded-2xl shadow-md border border-indigo-200">
            <h3 class="text-2xl font-semibold text-indigo-800 mb-6 flex items-center"><i
                    class="fas fa-box mr-3 text-indigo-600"></i>Item Details</h3>

            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Item HS Code</label>
                    <input name="itemCode" list="itemCodes" id="itemCode" type="text"
                        value="{{ old('itemCode', $old['itemCode'] ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" />
                    <datalist id="itemCodes">
                        @foreach($items as $it)
                        <option value="{{ $it['hs_code'] ?? '' }}">{{ $it['hs_code'] ?? '' }} - {{ $it['description'] ?? '' }}</option>
                        @endforeach
                    </datalist>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Item Description</label>
                    <input type="text" name="itemDescription" list="itemDescriptions" id="itemDescription"
                        value="{{ old('itemDescription', $old['itemDescription'] ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" />
                    <datalist id="itemDescriptions">
                        @foreach($items as $it)
                        <option value="{{ $it['description'] ?? '' }}">{{ $it['description'] ?? '' }} - {{
                            $it['hs_code'] ?? '' }}</option>
                        @endforeach
                    </datalist>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Item Quantity</label>
                    <input type="number" name="itemQuantity" id="itemQuantity"
                        value="{{ old('itemQuantity', $old['itemQuantity'] ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Item Unit (UoM)</label>
                    <input type="text" name="itemUnit" list="itemUnits" id="itemUnit"
                        value="{{ old('itemUnit', $old['itemUnit'] ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" />
                    <datalist id="itemUnits">
                        <!-- Populated dynamically based on selected item -->
                    </datalist>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Item Unit Price (Excl. Tax)</label>
                    <input type="number" name="itemUnitPrice" id="itemUnitPrice"
                        value="{{ old('itemUnitPrice', $old['itemUnitPrice'] ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" />
                </div>
            </div>

            <div class="grid md:grid-cols-4 gap-8 mt-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">FBR SRO NO</label>
                    <input name="sroNo" type="text" id="sroNo" list="sroNos"
                        value="{{ old('sroNo', $old['sroNo'] ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200">
                    <datalist id="sroNos">
                        <!-- Populated via AJAX -->
                    </datalist>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">FBR SRO Serial No</label>
                    <input type="text" name="sroItemNo" list="sroItemNos" id="sroItemNo"
                        value="{{ old('sroItemNo', $old['sroItemNo'] ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" />
                    <datalist id="sroItemNos">
                        <!-- Populated via AJAX -->
                    </datalist>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">FBR Sale Type</label>
                    <input name="saleType" id="saleType" type="text" list="saleTypes"
                        value="{{ old('saleType', $old['saleType'] ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" />
                    <datalist id="saleTypes">
                        @foreach($saleTypes as $s)
                        <option value="{{ $s['desc'] ?? '' }}"></option>
                        @endforeach
                    </datalist>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tax Rate</label>
                    <div class="flex">
                        <input type="text" name="taxRate" id="taxRate"
                            value="{{ old('taxRate', $computedTaxRate ?? '') }}"
                            class="w-full border border-indigo-300 rounded-s-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" />
                        <datalist id="taxRates"></datalist>
                        <button type="button" id="getTaxButton"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white p-3 rounded-e-xl font-medium transition duration-200">Get</button>
                    </div>
                </div>
            </div>

            <!-- HIDDEN inputs -->
            <input type="hidden" name="transTypeId" id="transTypeIdInput" value="{{ old('transTypeId') ?? '' }}">
            <input type="hidden" name="provinceId" id="provinceIdInput" value="{{ old('provinceId') ?? '' }}">
            <input type="hidden" name="date" id="dateInput" value="{{ old('date') ?? '' }}">
            <input type="hidden" name="quantity" id="quantityInput" value="{{ old('itemQuantity') ?? '' }}">
            <input type="hidden" name="unit_price" id="unitPriceInput" value="{{ old('itemUnitPrice') ?? '' }}">

            <div class="grid md:grid-cols-3 gap-8 mt-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Total Price Excl. Tax</label>
                    <input type="number" name="totalPrice" id="totalPrice"
                        value="{{ old('totalPrice', $computedLineTotal ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Total Tax</label>
                    <input type="number" name="totalTax" id="totalTax"
                        value="{{ old('totalTax', $computedTaxAmount ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Total Sale Value</label>
                    <input type="number" name="totalSaleValue" id="totalSaleValue"
                        value="{{ old('totalSaleValue', $old['totalSaleValue'] ?? '') }}"
                        class="w-full border border-indigo-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" />
                </div>
            </div>

            <!-- Buttons Section -->
            <div class="pt-6 flex justify-end space-x-4">
                <button type="submit"
                    class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-lg transition duration-200 flex items-center">
                    <i class="fas fa-plus mr-2"></i> Add Item
                </button>
                <button type="button" id="showJsonButton"
                    class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl shadow-lg transition duration-200 flex items-center">
                    <i class="fas fa-file-code mr-2"></i> Preview JSON
                </button>
            </div>
        </div>
    </form>

    <script>
        console.log("FBR items passed to page:", @json($items));
        const saleTypes = @json($saleTypes);
        const items = @json($items);
        const provinces = @json($provinces);
        const sroList = @json($sroList);

        document.addEventListener("DOMContentLoaded", () => {
            const $ = s => document.querySelector(s);
            const form = $('form');
            const itemCodeInput = $('#itemCode');
            const itemDescInput = $('#itemDescription');
            const itemUnitInput = $('#itemUnit');
            const itemUnitsDatalist = $('#itemUnits');
            const saleTypeInput = $('#saleType');
            const taxRateInput = $('#taxRate');
            const qtyInput = $('#itemQuantity');
            const priceInput = $('#itemUnitPrice');
            const totalPriceInput = $('#totalPrice');
            const totalTaxInput = $('#totalTax');
            const totalSaleInput = $('#totalSaleValue');
            const invoiceDateInput = $('#invoiceDate');
            const sellerProvinceSelect = $('#sellerProvince');
            const buyerProvinceSelect = $('#buyerProvince');
            const transTypeIdInput = $('#transTypeIdInput');
            const provinceIdInput = $('#provinceIdInput');
            const dateInput = $('#dateInput');
            const quantityInput = $('#quantityInput');
            const unitPriceInput = $('#unitPriceInput');
            const showJsonButton = $('#showJsonButton');
            const getTaxButton = $('#getTaxButton');
            const sroNoInput = $('#sroNo');
            const sroItemNoInput = $('#sroItemNo');
            const sroNosDatalist = $('#sroNos');
            const sroItemNosDatalist = $('#sroItemNos');

            // Normalize helper
            const norm = s => (s || '').toString().trim().toLowerCase().replace(/\./g, ''); // Remove dots for consistent matching

            // Function to update item units based on selected item
            const updateItemUnits = async (hsCode) => {
                itemUnitsDatalist.innerHTML = '';
                itemUnitInput.value = ''; // Clear initially
                if (!hsCode) {
                    console.warn('No HS code provided for UoM fetch');
                    return;
                }
                const normalizedHsCode = norm(hsCode);
                console.log('Normalized HS Code for UoM fetch:', normalizedHsCode);
                try {
                    const res = await fetch(`{{ route('invoice.getHsUom') }}?hs_code=${encodeURIComponent(normalizedHsCode)}`, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                    const uoms = await res.json();
                    console.log(`Fetched UOMs for HS Code ${normalizedHsCode}:`, uoms);
                    if (Array.isArray(uoms) && uoms.length > 0) {
                        uoms.forEach(u => {
                            const option = document.createElement('option');
                            option.value = u;
                            option.textContent = u;
                            itemUnitsDatalist.appendChild(option);
                        });
                        itemUnitInput.value = uoms[0] || 'No Unit'; // Set first UOM or 'No Unit'
                    } else {
                        console.warn(`No UOMs from API for HS Code ${normalizedHsCode}`);
                        const match = items.find(it => norm(it.hs_code || '') === normalizedHsCode);
                        if (match) {
                            itemUnitInput.value = match.uom || 'No Unit';
                            const option = document.createElement('option');
                            option.value = match.uom || 'No Unit';
                            option.textContent = match.uom || 'No Unit';
                            itemUnitsDatalist.appendChild(option);
                        } else {
                            itemUnitInput.value = 'No Unit';
                            const option = document.createElement('option');
                            option.value = 'No Unit';
                            option.textContent = 'No Unit';
                            itemUnitsDatalist.appendChild(option);
                        }
                    }
                } catch (error) {
                    console.error(`Error fetching UOM for HS Code ${normalizedHsCode}:`, error);
                    const match = items.find(it => norm(it.hs_code || '') === normalizedHsCode);
                    if (match) {
                        itemUnitInput.value = match.uom || 'No Unit';
                        const option = document.createElement('option');
                        option.value = match.uom || 'No Unit';
                        option.textContent = match.uom || 'No Unit';
                        itemUnitsDatalist.appendChild(option);
                    } else {
                        itemUnitInput.value = 'No Unit';
                        const option = document.createElement('option');
                        option.value = 'No Unit';
                        option.textContent = 'No Unit';
                        itemUnitsDatalist.appendChild(option);
                    }
                }
            };

            // Function to calculate totals
            const calc = () => {
                const qty = parseFloat(qtyInput.value) || 0;
                const price = parseFloat(priceInput.value) || 0;
                const totalPrice = qty * price;
                totalPriceInput.value = totalPrice ? totalPrice.toFixed(2) : '';

                const rawRate = (taxRateInput.value || "").toString().replace("%", "").trim();
                const rate = rawRate === "" ? NaN : parseFloat(rawRate);

                if (!isFinite(rate)) {
                    totalTaxInput.value = "";
                    totalSaleInput.value = totalPriceInput.value;
                } else {
                    const totalTax = (totalPrice * rate) / 100;
                    totalTaxInput.value = totalTax.toFixed(2);
                    totalSaleInput.value = (totalPrice + totalTax).toFixed(2);
                }
            };

            // Update transTypeId based on saleType desc
            const updateTransTypeId = () => {
                const desc = norm(saleTypeInput.value);
                let match = saleTypes.find(s => norm(s.desc || '') === desc || String(s.id) === saleTypeInput.value);
                if (!match && desc) match = saleTypes.find(s => norm(s.desc || '').includes(desc) || (s.desc && desc.includes(norm(s.desc))));
                transTypeIdInput.value = match ? match.id : '';
            };

            // Update hidden inputs for getTax
            const updateHiddens = () => {
                provinceIdInput.value = sellerProvinceSelect.value || buyerProvinceSelect.value || '';
                quantityInput.value = qtyInput.value || '';
                unitPriceInput.value = priceInput.value || '';

                if (invoiceDateInput.value) {
                    const d = new Date(invoiceDateInput.value);
                    const day = String(d.getDate()).padStart(2, '0');
                    const mon = d.toLocaleString('default', { month: 'short' });
                    const year = d.getFullYear();
                    dateInput.value = `${day}-${mon}-${year}`;
                } else {
                    dateInput.value = '';
                }
            };

            // Auto-fill description and uom when code changes
            const updateFromCode = () => {
                const code = norm(itemCodeInput.value);
                console.log('Selected HS Code (normalized):', code);
                if (!code) {
                    itemDescInput.value = '';
                    itemUnitInput.value = '';
                    updateItemUnits('');
                    return;
                }
                const match = items.find(it => norm(it.hs_code || '') === code);
                if (match) {
                    console.log('Match found in items:', match);
                    itemDescInput.value = match.description || '';
                    itemUnitInput.value = match.uom || 'No Unit'; // Set UoM or 'No Unit' if not available
                    updateItemUnits(itemCodeInput.value); // Fetch UoMs via API
                    sroNoInput.value = match.sro_desc || '';
                    sroItemNoInput.value = match.sro_ser || '';
                } else {
                    console.warn('No match found for HS Code:', code);
                    itemDescInput.value = '';
                    itemUnitInput.value = 'No Unit';
                    updateItemUnits(code);
                }
            };

            // Auto-fill code and uom when description changes
            const updateFromDesc = () => {
                const desc = norm(itemDescInput.value);
                if (!desc) {
                    itemCodeInput.value = '';
                    itemUnitInput.value = '';
                    updateItemUnits('');
                    return;
                }
                const match = items.find(it => norm(it.description || '') === desc || (it.description && norm(it.description).includes(desc)));
                if (match) {
                    itemCodeInput.value = match.hs_code || '';
                    itemUnitInput.value = match.uom || 'No Unit'; // Set UoM or 'No Unit' if not available
                    updateItemUnits(match.hs_code); // Fetch UoMs via API
                    sroNoInput.value = match.sro_desc || '';
                    sroItemNoInput.value = match.sro_ser || '';
                }
            };

            // Auto-fill SRO serial no when SRO NO changes
            const updateFromSroNo = () => {
                const sroDesc = norm(sroNoInput.value);
                if (!sroDesc) {
                    sroItemNoInput.value = '';
                    return;
                }
                const match = sroList.find(sro => norm(sro.sro_desc || '') === sroDesc || (sro.sro_desc && norm(sro.sro_desc).includes(sroDesc)));
                if (match && match.sro_desc !== 'No SRO Available') {
                    sroItemNoInput.value = match.sro_ser || '';
                } else if (sroDesc === 'No SRO Available') {
                    sroItemNoInput.value = 'No Serial Available';
                }
            };

            // Auto-fill SRO NO when SRO serial no changes
            const updateFromSroSer = () => {
                const sroSer = norm(sroItemNoInput.value);
                if (!sroSer) {
                    sroNoInput.value = '';
                    return;
                }
                const match = sroList.find(sro => norm(sro.sro_ser || '') === sroSer || (sro.sro_ser && norm(sro.sro_ser).includes(sroSer)));
                if (match && match.sro_ser !== 'No Serial Available' && sroNoInput.value !== 'No SRO Available') {
                    sroNoInput.value = match.sro_desc || '';
                } else if (sroSer === 'No Serial Available' && !sroNoInput.value) {
                    sroNoInput.value = 'No SRO Available';
                }
            };

            const getProvinceName = (code) => {
                const match = provinces.find(p => String(p.id) == String(code));
                return match ? match.name : code;
            };

            // Preview JSON by submitting the form
            showJsonButton.addEventListener('click', () => {
                form.submit();
            });

            // Call backend to get tax via AJAX
            const fetchTax = async () => {
                updateTransTypeId();
                updateHiddens();

                const payload = {
                    transTypeId: transTypeIdInput.value,
                    provinceId: provinceIdInput.value,
                    date: dateInput.value,
                    quantity: quantityInput.value,
                    unit_price: unitPriceInput.value
                };

                if (!payload.transTypeId || !payload.provinceId) {
                    alert('Please choose Sale Type and Province before getting tax.');
                    return;
                }

                try {
                    const res = await fetch("{{ route('invoice.getTax') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(payload)
                    });

                    if (!res.ok) {
                        const txt = await res.text();
                        console.error('getTax error', res.status, txt);
                        alert('Error fetching tax rate. See console.');
                        return;
                    }

                    const json = await res.json();
                    console.log('getTax Response: ', json); // Debug
                    if (json) {
                        taxRateInput.value = (json.tax_rate !== null && json.tax_rate !== undefined) ? String(json.tax_rate) + '%' : '';
                        totalPriceInput.value = (json.line_total !== null && json.line_total !== undefined) ? parseFloat(json.line_total).toFixed(2) : totalPriceInput.value;
                        totalTaxInput.value = (json.tax_amount !== null && json.tax_amount !== undefined) ? parseFloat(json.tax_amount).toFixed(2) : totalTaxInput.value;
                        const tp = parseFloat(totalPriceInput.value) || 0;
                        const tt = parseFloat(totalTaxInput.value) || 0;
                        totalSaleInput.value = (tp + tt).toFixed(2);

                        // Fetch SRO using the returned rate_id
                        sroNosDatalist.innerHTML = '';
                        sroItemNosDatalist.innerHTML = '';
                        if (!json.rate_id) {
                            console.warn('No rate_id received, populating dummy SRO data');
                            sroList.length = 0;
                            sroList.push({ sro_desc: 'No SRO Available', sro_ser: 'No Serial Available' });
                            const sroOption = document.createElement('option');
                            sroOption.value = 'No SRO Available';
                            sroOption.textContent = 'No SRO Available';
                            sroNosDatalist.appendChild(sroOption);

                            const serOption = document.createElement('option');
                            serOption.value = 'No Serial Available';
                            serOption.textContent = 'No Serial Available';
                            sroItemNosDatalist.appendChild(serOption);
                            updateFromSroNo();
                            updateFromSroSer();
                            return;
                        }

                        try {
                            const sroRes = await fetch(`{{ route('invoice.getSroList') }}?rate_id=${json.rate_id}&date=${dateInput.value}`);
                            if (!sroRes.ok) {
                                const txt = await sroRes.text();
                                console.error('getSroList error', sroRes.status, txt);
                                alert('Error fetching SRO data. See console.');
                                return;
                            }
                            const sroData = await sroRes.json();
                            console.log('SRO Data Received: ', sroData); // Debug
                            sroList.length = 0; // Clear existing
                            sroList.push(...sroData); // Update sroList
                            sroNosDatalist.innerHTML = '';
                            sroItemNosDatalist.innerHTML = '';
                            sroData.forEach(sro => {
                                const sroOption = document.createElement('option');
                                sroOption.value = sro.sro_desc || 'No SRO Available';
                                sroOption.textContent = sro.sro_desc || 'No SRO Available';
                                sroNosDatalist.appendChild(sroOption);

                                const serOption = document.createElement('option');
                                serOption.value = sro.sro_ser || 'No Serial Available';
                                serOption.textContent = `${sro.sro_ser || 'No Serial Available'} - ${sro.sro_desc || 'No SRO Available'}`;
                                sroItemNosDatalist.appendChild(serOption);
                            });
                            // Trigger auto-fill after population
                            updateFromSroNo();
                            updateFromSroSer();
                        } catch (error) {
                            console.error('Error fetching SRO:', error);
                            alert('Error fetching SRO data. See console.');
                            sroList.length = 0;
                            sroList.push({ sro_desc: 'No SRO Available', sro_ser: 'No Serial Available' });
                            const sroOption = document.createElement('option');
                            sroOption.value = 'No SRO Available';
                            sroOption.textContent = 'No SRO Available';
                            sroNosDatalist.appendChild(sroOption);

                            const serOption = document.createElement('option');
                            serOption.value = 'No Serial Available';
                            serOption.textContent = 'No Serial Available';
                            sroItemNosDatalist.appendChild(serOption);
                            updateFromSroNo();
                            updateFromSroSer();
                        }
                    }
                } catch (err) {
                    console.error('Unexpected error getting tax:', err);
                    alert('Unexpected error getting tax. See console.');
                }
            };

            // Add event listeners for calculations
            [qtyInput, priceInput, taxRateInput].forEach(inp => inp.addEventListener('input', calc));

            // Add event listeners for updates
            saleTypeInput.addEventListener('input', updateTransTypeId);
            saleTypeInput.addEventListener('change', updateTransTypeId);
            [invoiceDateInput, sellerProvinceSelect, qtyInput, priceInput].forEach(inp => {
                inp.addEventListener('input', updateHiddens);
                inp.addEventListener('change', updateHiddens);
            });

            // Use 'input' and 'change' for live matching
            itemCodeInput.addEventListener('input', updateFromCode);
            itemCodeInput.addEventListener('change', updateFromCode);
            itemDescInput.addEventListener('input', updateFromDesc);
            itemDescInput.addEventListener('change', updateFromDesc);
            sroNoInput.addEventListener('input', updateFromSroNo);
            sroNoInput.addEventListener('change', updateFromSroNo);
            sroItemNoInput.addEventListener('input', updateFromSroSer);
            sroItemNoInput.addEventListener('change', updateFromSroSer);

            // Hook GET button
            getTaxButton.addEventListener('click', fetchTax);

            // Initial calls
            updateTransTypeId();
            updateHiddens();
            updateFromCode();
            updateFromDesc();
            updateFromSroNo();
            updateFromSroSer();
            calc();
            updateItemUnits(itemCodeInput.value); // Initial unit population if old value
        });
    </script>
</body>
</html>