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
                const normalizedHsCode = norm(hsCode); // Normalize once
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
                        itemUnitInput.value = uoms[0] || ''; // Set first UOM
                    } else {
                        console.warn(`No UOMs from API for HS Code ${normalizedHsCode}`);
                        const match = items.find(it => norm(it.hs_code || '') === normalizedHsCode);
                        if (match && match.uom) {
                            console.log('Fallback UOM from database:', match.uom);
                            itemUnitInput.value = match.uom;
                            const option = document.createElement('option');
                            option.value = match.uom;
                            option.textContent = match.uom;
                            itemUnitsDatalist.appendChild(option);
                        } else {
                            console.warn('No matching UOM found in database for:', normalizedHsCode);
                        }
                    }
                } catch (error) {
                    console.error(`Error fetching UOM for HS Code ${normalizedHsCode}:`, error);
                    const match = items.find(it => norm(it.hs_code || '') === normalizedHsCode);
                    if (match && match.uom) {
                        console.log('Error fallback UOM from database:', match.uom);
                        itemUnitInput.value = match.uom;
                        const option = document.createElement('option');
                        option.value = match.uom;
                        option.textContent = match.uom;
                        itemUnitsDatalist.appendChild(option);
                    } else {
                        console.warn('No database fallback available due to error for:', normalizedHsCode);
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
                    itemUnitInput.value = match.uom || ''; // Set UoM from database initially
                    updateItemUnits(itemCodeInput.value); // Fetch UoMs via API
                    sroNoInput.value = match.sro_desc || '';
                    sroItemNoInput.value = match.sro_ser || '';
                } else {
                    console.warn('No match found for HS Code:', code);
                    itemDescInput.value = '';
                    itemUnitInput.value = '';
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
                    itemUnitInput.value = match.uom || ''; // Set UoM from database initially
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Carbon\Carbon;

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
        $items     = $this->getItemDescCode();
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
        $uom = $this->pick($it, ['uom','uom_desc','measurement','unit','uomDesc']);
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
    protected function safeGet($url, $query = [])
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

