<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Dashboard Admin</h2>
</x-slot>

<div class="p-6">
    <p>Hallo Admin {{auth()->user()->name}} </p>
    <p>Role: ADMIN</p>
</div>
</x-app-layout>