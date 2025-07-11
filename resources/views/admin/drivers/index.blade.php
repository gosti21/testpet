<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Repartidores',
    ],

]">

    <x-slot name="action">
        <a href="{{route('admin.drivers.create')}}" class="btn btn-blue">
            Nuevo
        </a>
    </x-slot>

    @livewire('admin.drivers.driver-table')

</x-admin-layout>
