<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Repartidores',
        'route' => route('admin.drivers.index'),
    ],
    [
        'name' => 'Nuevo',
    ],
]">
    <div class="bg-white rounded-lg shadow-lg p-8">

        <x-validation-errors/>

        <form action="{{ route('admin.drivers.store') }}" method="POST">

            @csrf

            <div class="mb-4">
                <x-label class="mb-1">
                    Usuario
                </x-label>

                <x-select
                    class="w-full"
                    name="user_id">

                    <option value="" selected disabled>
                        Seleccione un Usuario
                    </option>

                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            @selected($user->id == old('user_id'))>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">

                <div>
                    <x-label class="mb-1">
                        Tipo de unidad
                    </x-label>

                    <x-select class="w-full"
                        name="type">

                        <option value="1" @selected(old('type') == 1)>
                            Automovil
                        </option>

                        <option value="2" @selected(old('type') == 2)>
                            Motocicleta
                        </option>

                    </x-select>
                </div>

                <div>
                    <x-label class="mb-1">
                        Placa
                    </x-label>

                    <x-input class="w-full" name="plate_number"
                    value="{{old('plate_number')}}"
                    placeholder="Ingrese la placa del vehiculo"/>
                </div>

            </div>

            <div class="flex justify-end">
                <button>
                    GUARDAR
                </button>
            </div>

        </form>

    </div>

</x-admin-layout>
