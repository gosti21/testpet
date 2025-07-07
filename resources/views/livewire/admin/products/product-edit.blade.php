<div>


    <form wire:submit="store">



        <figure class="mb-4 relative">

            <div class="absolute top-8 right-8">
                <label class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer text-gray-700">
                    <i class="fa fa-camera mr-2"></i>
                    actualizar imagen

                    <input type="file" class="hidden" accept="image/*" wire:model="image">

                </label>
            </div>

            <img class="aspect-[16/9] object-cover object-center w-full"
                src="{{ $image ? $image->temporaryUrl() : Storage::url($productEdit['image_path']) }}" alt="">
        </figure>

        <x-validation-errors class="mb-4" />

        <div class="card">

            <div class="mb-4">
                <x-label class="mb-1">
                    Codigo
                </x-label>

                <x-input wire:model="productEdit.sku" class="w-full" placeholder="Ingrese el codigo del producto" />
            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Nombre
                </x-label>

                <x-input wire:model="productEdit.name" class="w-full"
                    placeholder="Por favor ingrese el nombre del producto" />
            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Descripcion
                </x-label>

                <x-textarea wire:model="productEdit.description" class="w-full"
                    placeholder="Por favor ingrese la descripcion del producto">
                </x-textarea>

            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Familias
                </x-label>

                <select class="w-full" wire:model.live="family_id">

                    <option value="" disabled>
                        Seleccione una familia
                    </option>

                    @foreach ($families as $family)
                        <option value="{{ $family->id }}">
                            {{ $family->name }}
                        </option>
                    @endforeach

                </select>

            </div>


            <div class="mb-4">

                <x-label class="mb-1">
                    Categorias
                </x-label>

                <select class="w-full" wire:model.live="category_id">

                    <option value="" disabled>
                        Seleccione una categoria
                    </option>

                    @foreach ($this->categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-4">

                <x-label class="mb-1">
                    Subcategorias
                </x-label>

                <select class="w-full" wire:model.live="productEdit.subcategory_id">

                    <option value="" disabled>
                        Seleccione una subcategoria
                    </option>

                    @foreach ($this->subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">
                            {{ $subcategory->name }}
                        </option>
                    @endforeach

                </select>
            </div>


            <div class="mb-4">
                <x-label class="mb-1">
                    Precio
                </x-label>

                <x-input type="number" step="0.01" wire:model="productEdit.price" class="w-full"
                    placeholder="Por favor ingrese el precio del producto" />
            </div>

            @empty($product->variants->count() > 0)
                <div class="mb-4">
                    <x-label class="mb-1">
                        Stock
                    </x-label>

                    <x-input type="number" wire:model="productEdit.stock" class="w-full"
                        placeholder="Por favor ingrese el stock del producto" />
                </div>
            @endempty

            <div class="flex justify-end">
                <div>
                    <x-danger-button onclick="confirmDelete()">
                        Eliminar
                    </x-danger-button>

                    <x-button class="ml-2">
                        Actualizar
                    </x-button>
                </div>
            </div>
        </div>
    </form>



    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" id="delete-form">
        @csrf

        @method('DELETE')
    </form>

    @push('js')
        <script>
            function confirmDelete() {
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

                        document.getElementById('delete-form').submit();

                    }
                });
            }
        </script>
    @endpush
</div>
