<div>

    <section class="rounded-lg bg-white shadow-lg">

        <header class="border-b border-gray-200 px-6 py-2">
            <div class="flex justify-between">
                <h1 class="text-lg font-semibold text-gray-700">
                    Opciones
                </h1>

                <x-button wire:click="$set('newOption.openModal', true)">
                    Nuevo
                </x-button>
            </div>
        </header>

        <div class="p-6">

            <div class="space-y-6">

                @foreach ($options as $option)
                    <div class="p-6 rounded-lg border border-gary-200 relative" wire:key="option-{{ $option->id }}">

                        <div class="absolute -top-3 px-4 bg-white">

                            <button class="mr-1" onclick="confirmDelete({{$option->id}}, 'option')">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>

                            <span>
                                {{ $option->name }}
                            </span>
                        </div>

                        {{-- valores --}}
                        <div class="flex flex-wrap mb-4">
                            @foreach ($option->features as $feature)
                                @switch($option->type)
                                    @case(1)
                                        <span
                                            class="bg-indigo-100 text-indigo-800 text-xs font-medium me-2 pl-2.5 pr-1.5 py-0.5 rounded-sm dark:bg-indigo-900 dark:text-indigo-300">
                                            {{ $feature->description }}

                                            <button class="ml-0.5" onclick="confirmDelete({{ $feature->id }}, 'feature')">
                                                <i class="fa-solid fa-xmark hover:text-red-500"></i>
                                            </button>
                                        </span>
                                    @break

                                    @case(2)
                                        {{-- color --}}
                                        <div class="relative">
                                            <span
                                                class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-300 mr-4"
                                                style="background-color: {{ $feature->value }}">
                                            </span>

                                            <button
                                                class="absolute z-10 left-3 -top-2 rounded-full bg-white h-4 w-4 flex justify-center items-center"
                                                onclick="confirmDelete({{ $feature->id }}, 'feature')">
                                                <i class="fa-solid fa-trash hover:text-red-500 text-xs"></i>
                                            </button>
                                        </div>
                                    @break

                                    @default
                                        {{-- Sin acción --}}
                                @endswitch
                            @endforeach
                        </div>

                        <div>
                            @livewire('admin.options.add-new-feature', ['option' => $option], key('add-new-feature' . $option->id))
                        </div>

                    </div>
                @endforeach

            </div>

        </div>

    </section>


    <x-dialog-modal wire:model="newOption.openModal">

        <x-slot name="title">
            Crear nueva opcion
        </x-slot>

        <x-slot name="content">

            <x-validation-errors class="mb-4" />
            <div class="grid grid-cols-2 gap-6 mb-4">
                <div>

                    <x-label class="mb-1">
                        Nombre
                    </x-label>
                    <x-input wire:model="newOption.name" class="w-full" placeholder="Por ejemplo tamaño, Color" />
                </div>

                <div>
                    <x-label class="mb-1">
                        Tipo
                    </x-label>
                    <x-select wire:model.live="newOption.type" class="w-full">

                        <option value="1">Texto</option>
                        <option value="2">Color</option>

                    </x-select>
                </div>
            </div>

            <div class="flex items-center mb-4">
                <hr class="flex-1">
                <span class="mx-4">
                    Valores
                </span>
                <hr class="flex-1">
            </div>

            <div class="mb-4 space-y-4">
                @foreach ($newOption->features as $index => $feature)
                    <div class="p-6 rounded-lg border border-gray-200 relative" wire:key="features-{{ $index }}">

                        <div class="absolute -top-3 px-4 bg-white">
                            <button wire:click="removeFeature({{ $index }})">
                                <i class="fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>
                            </button>
                        </div>

                        <div class="grid grid-cols-2">
                            <div>
                                <x-label class="mb-1">
                                    Valor
                                </x-label>

                                @switch($newOption->type)
                                    @case(1)
                                        <x-input wire:model="newOption.features.{{ $index }}.value" class="w-full"
                                            placeholder="Ingrese el valor de la opcion" />
                                    @break

                                    @case(2)
                                        <div
                                            class="border border-gray-300 rounded-md h-[42px] flex items-center justify-between px-3">

                                            {{ $newOption->features[$index]['value'] ?: 'Seleccione un color' }}

                                            <input type="color"
                                                wire:model.live="newOption.features.{{ $index }}.value"
                                                class="w-full" />
                                        </div>
                                    @break

                                    @default
                                @endswitch
                            </div>

                            <div>
                                <x-label class="mb-1">
                                    Descripcion
                                </x-label>
                                <x-input wire:model="newOption.features.{{ $index }}.description" class="w-full"
                                    placeholder="Ingrese la descripcion" />

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-end">

                <x-button wire:click="addFeature" class="mr-2">
                    Agreagar valor
                </x-button>
            </div>
        </x-slot>

        <x-slot name="footer">

            <button class="btn btn-blue" wire:click="addOption">
                Agreagar
            </button>
        </x-slot>

    </x-dialog-modal>

    @push('js')
        <script>
            function confirmDelete(id, type) {

                Swal.fire({
                    title: "Estas seguro?",
                    text: "No podras revertirlo!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, borralo!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {

                        switch (type) {
                            case 'feature':
                                @this.call('deleteFeature', id);
                                break;
                            case 'option':
                                @this.call('deleteOption', id);
                                break;
                            default:
                                console.error('Tipo no reconocido:', type);
                        }

                    }
                });
            }
        </script>
    @endpush
</div>
