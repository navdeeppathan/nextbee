@extends('Inventory.layouts.app')

@section('content')

<style>
 .select2-container {
    width: 100% !important;
}

.select2-container--default .select2-selection--multiple {
    min-height: 45px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    padding: 5px;
}

.select2-selection__choice {
    background-color: #2563eb !important;
    border: none !important;
    color: white !important;
    padding: 3px 8px !important;
    border-radius: 6px !important;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<div class="p-6">

    <div class="bg-white rounded-xl shadow-md p-6 max-w-2xl mx-auto">

        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            🚢 Add Container
        </h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="/container/store">
            @csrf

            <!-- Container No -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Container No</label>
                <input type="text" name="container_no"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter container number" required>
            </div>

            <!-- ETA -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">ETA Days</label>
                <input type="number" name="eta_days"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter days" required>
            </div>

            <!-- Arrival Date -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Arrival Date</label>
                <input type="date" name="arrival_date"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Products Multi Select -->
            <div class="mb-5">
                <label class="block text-sm font-medium mb-1">Select Products</label>

                <select name="product_ids[]" id="productSelect"
                    class="w-full" multiple="multiple">

                    @foreach($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->title }} (£{{ $product->price }})
                        </option>
                    @endforeach

                </select>

            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
                Save Container
            </button>

        </form>

    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('#productSelect').select2({
        placeholder: "Search and select products",
        allowClear: true,
        width: '100%'
    });
});
</script>

@endsection