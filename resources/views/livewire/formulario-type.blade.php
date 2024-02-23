<div>
    
    <div class="bg-white shadow rounded-lg p-6 mb-9">

        <x-button class="mb-5" wire:click="$toggle('showFormCreateType')">
            Mostrar Formulario
        </x-button>

        @if ($showFormCreateType)
        <form class="mt-4" wire:submit="save()">

            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <x-label>
                        Nombre del modelo
                    </x-label>
                    <x-input class="w-full" wire:model="typeCreate.type_name" />
                    <x-input-error for="typeCreate.type_name" />
                </div>
            </div>

            <x-button class="">
            Registrar
            </x-button>

        </form>
        @endif

    </div>

    <div class="bg-white shadow rounded-lg p-6 mt-6">

        <div class="mb-4">
            <x-input class="w-full" placeholder="Buscar modelo..." wire:model.live="searchType" />
        </div>

        <div class="flex items-center justify-center min-h-[450px]">
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200 rounded-t-lg">
                <tr>
                    <th scope="col" class="py-3 px-6">Modelo</th>
                    <th scope="col" class="py-3 px-6">Acciones</th>
                </tr>
                </thead>
                <tbody>

                    @foreach ($types as $type)
                <tr class="bg-white border-b" wire:key="mark-{{ $type->id }}">

                    <td class="py-4 px-6">{{ $type->type_name }}</td>
                    <td class="py-4 px-6">
                        <x-button wire:click="edit({{ $type->id }})">
                            Editar
                        </x-button>
                    </td>

                </tr>

                @endforeach

                </tbody>
            </table>
        </div>
        </div>
        </div>

        <div class="mt-4">
            {{ $types->links(data: ['scrollTo' => false]) }}
        </div>

        <form wire:submit="update()">
            <x-dialog-modal wire:model="typeEdit.open">
                <x-slot name="title">
                    Modelo a actualizar
                </x-slot>

                <x-slot name="content">
                    
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <x-label>
                                    Nombre del modelo
                                </x-label>
                                <x-input class="w-full" wire:model="typeEdit.type_name" />
                                <x-input-error for="typeEdit.type_name" />
                            </div>
                        </div>
            
                </x-slot>

                <x-slot name="footer">
                    <x-button class="mr-2">
                        Actualizar
                    </x-button>

                    <x-danger-button class="" wire:click="$set('typeEdit.open', false)">
                        Cancelar
                    </x-danger-button>
                </x-slot>
            </x-dialog-modal>
        </form>

    </div>

</div>
