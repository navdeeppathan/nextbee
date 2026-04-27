@extends('Inventory.layouts.app')

@section('content')

    <div class="p-6">

        <div class="flex justify-between items-center mb-4">

            <h2 class="text-2xl font-bold">📦 All Containers</h2>

            <a href="/container/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                + Add Container
            </a>

        </div>

        <table class="w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Container No</th>
                    <th class="p-2 border">ETA</th>
                    <th class="p-2 border">Products</th>
                </tr>
            </thead>

            <tbody>
                @foreach($containers as $container)
                    <tr>
                        <td class="p-2 border">{{ $container->container_no }}</td>
                        <td class="p-2 border">{{ $container->eta_days }} Days</td>
                        <td class="p-2 border">
                            @foreach($container->products as $product)
                                <span class="bg-blue-100 px-2 py-1 rounded text-sm">
                                    {{ $product->title }}
                                </span>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>

@endsection