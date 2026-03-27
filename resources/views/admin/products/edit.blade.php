<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Edit Product</h2>
    </x-slot>

    <div class="p-6 max-w-x1">
        <form method="POST" enctype="multipart/form-data"
        action="{{ route('admin.products.update', $product) }}">
        @csrf @method('PUT')
        
        <input type="text" name="name"
        value="{{ $product->name }}"
        class="w-full mb-3 border p-2">
        
        <input type="number" name="price"
        value="{{ $product->price }}"
        class="w-full mb-3 border p-2">
        
        <textarea name="description"
        class="w-full mb-3 border p-2">{{ $product->description }}</textarea>

    <input type="file" name="image" class="sb-3">
    
    <button class="bg-green-600 text-white px-4 py-2 rounded">
        Update
    </button>
</form>
</div>
</x-app-layout>