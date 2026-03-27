<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-amber-900 p-4 rounded">
            <h2 class="text-xl font-bold text-white">
                Product</h2>

            <a href="{{ route('admin.products.create') }}"
            class="bg-blue-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadowp">
            + Add Product
        </a>
    </div>
</x-slot>

<div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($products as $product)
    <div class="bg-white shadow rounded overflow-hidden">
        @if($product->image)
        <img src="{{ asset('storage/'.$product->image) }}"
        class="h-48 w-full object-cover">
        @endif

        <div class="p-4">
            <h3 class="font-bold text-lg">{{ $product->name}}</h3>
            <p class="text-gray-600"> Rp {{ number_format($product->price) }}</p>

            <div class="flex gap-2 mt-4">
                <a href="{{ route('admin.products.edit' , $product) }}"
                class="bg-yellow-500 text-white px-3 py-1 rounded">
                Edit
            </a>
            
            <form method="POST"
            action="{{ route('admin.products.destroy' , $product) }}">
            @csrf @method('DELETE')
            <button onclick="return confirm('Hapus produk?')"
            class="bg-red-600 text-white px-3 py-1 rounded">
            Delete
        </button>
    </form>
</div>
</div>
</div>
@endforeach
</div>
</x-app-layout>