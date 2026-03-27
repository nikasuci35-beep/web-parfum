<x-app-Layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Add Product</h2>
    </x-slot>

    <div class="p-6 max-w-x1">
        <form method="POST" enctype="multipart/form-data"
        action="{{ route('admin.products.store') }}">
        @csrf
        
        <input type="text" name="name" placeholder="Nama"
        class="w-full mb-3 border р-2">
        
        <input type="number" name="price" placeholder="Harga"
        class="w-full mb-3 border p-2">

        <textarea name="description" placeholder="Deskripsi"
        class="w-full mb-3 border p-2"></textarea>
        
        <input type="file" name="image" class="mb-3">
        
        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Save
        </button>
    </form>
</div>
</x-app-layout>