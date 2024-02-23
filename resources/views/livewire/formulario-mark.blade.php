<div>
    
    <div class="bg-white shadow rounded-lg p-6 mb-9">

        <x-button class="mb-5" wire:click="$toggle('showFormCreateMark')">
            Mostrar Formulario
        </x-button>

        @if ($showFormCreateMark)
        <form class="mt-4" wire:submit="save()">

            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <x-label>
                        Nombre de la marca
                    </x-label>
                    <x-input class="w-full" wire:model="markCreate.mark_name" />
                    <x-input-error for="markCreate.mark_name" />
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
            <x-input class="w-full" placeholder="Buscar marca..." wire:model.live="searchMark" />
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

                    @foreach ($marks as $mark)
                <tr class="bg-white border-b" wire:key="mark-{{ $mark->id }}">

                    <td class="py-4 px-6">{{ $mark->mark_name }}</td>
                    <td class="py-4 px-6">
                        <x-button wire:click="edit({{ $mark->id }})">
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
            {{ $marks->links(data: ['scrollTo' => false]) }}
        </div>

        <form wire:submit="update()">
            <x-dialog-modal wire:model="markEdit.open">
                <x-slot name="title">
                    Marca a actualizar
                </x-slot>

                <x-slot name="content">
                    
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <x-label>
                                    Nombre de la marca
                                </x-label>
                                <x-input class="w-full" wire:model="markEdit.mark_name" />
                                <x-input-error for="markEdit.mark_name" />
                            </div>
                        </div>
            
                </x-slot>

                <x-slot name="footer">
                    <x-button class="mr-2">
                        Actualizar
                    </x-button>

                    <x-danger-button class="" wire:click="$set('markEdit.open', false)">
                        Cancelar
                    </x-danger-button>
                </x-slot>
            </x-dialog-modal>
        </form>

    </div>

</div>
