<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'rotue' => route('admin.dashboard'),
    ],
    [
        'name' => 'Opciones',
    ],
]">

    @livewire('admin.options.manage-options')
    
</x-admin-layout>
