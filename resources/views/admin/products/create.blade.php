<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'rotue' => route('admin.dashboard'),
    ],
    [
        'name' => 'Productos',
        'rotue' => route('admin.products.index')
    ],
    [
        'name' => 'Nuevo',
    ],
]">

    @livewire('admin.products.product-create')

    
</x-admin-layout>
