<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Dashboard User</h2>
</x-slot>

<div class="p-6">
    <p>Hallo {{auth()->user()->name}} </p>
    <p>Role: USER</p>
</div>
</x-app-layout>