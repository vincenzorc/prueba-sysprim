<div>
    
    <div class="bg-white shadow rounded-lg p-6 mb-9">

        <x-button class="mb-5" wire:click="$toggle('showFormCreateVehicle')">
            Mostrar Formulario
        </x-button>

        @if ($showFormCreateVehicle)
        <form class="mt-4" wire:submit="save()">

            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <x-label>
                        Placa
                    </x-label>
                    <x-input class="w-full" placeholder="Ej: ABC12DE" wire:model="vehicleCreate.placa" />
                    <x-input-error for="vehicleCreate.placa" />
                </div>
    
                <div class="mb-4">
                    <x-label>
                        Color
                    </x-label>
                    <x-input class="w-full" wire:model="vehicleCreate.color" />
                    <x-input-error for="vehicleCreate.color" />
                </div>
            </div>

            <div class="mb-4">
                <x-label>
                    Año
                </x-label>
                <x-input class="w-full" wire:model="vehicleCreate.year" />
                <x-input-error for="vehicleCreate.year" />
            </div>

            <div class="mb-4">
                <x-label>
                    Fecha de ingreso
                </x-label>
                <x-input class="w-full" wire:model="vehicleCreate.date_entry" />
                <x-input-error for="vehicleCreate.date_entry" />
            </div>

            <div class="mb-4">
                <x-label>
                    Modelo
                </x-label>
                <x-select class="w-full" wire:model="vehicleCreate.type_id">

                    <option value="">Seleccione un modelo</option>

                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                    @endforeach

                </x-select>

                <x-input-error for="vehicleCreate.type_id" />
            </div>

            <div class="mb-4">
                <x-label>
                    Marca
                </x-label>
                <x-select class="w-full" wire:model="vehicleCreate.mark_id">

                    <option value="">Seleccione una marca</option>

                    @foreach ($marks as $mark)
                        <option value="{{ $mark->id }}">{{ $mark->mark_name }}</option>
                    @endforeach

                </x-select>

                <x-input-error for="vehicleCreate.mark_id" />
            </div>

            <x-button class="">
            Registrar
            </x-button>

        </form>
        @endif

    </div>

    <div class="bg-white shadow rounded-lg p-6 mt-6">

        <div class="mb-4">
            <x-input class="w-full" placeholder="Buscar placa..." wire:model.live="searchVehicle" />
        </div>

        <div class="flex items-center justify-center min-h-[450px]">
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200 rounded-t-lg">
                <tr>
                    <th scope="col" class="py-3 px-6">Placa</th>
                    <th scope="col" class="py-3 px-6">Color</th>
                    <th scope="col" class="py-3 px-6">Año</th>
                    <th scope="col" class="py-3 px-6">Fecha de ingreso</th>
                    <th scope="col" class="py-3 px-6">Modelo</th>
                    <th scope="col" class="py-3 px-6">Marca</th>
                    <th scope="col" class="py-3 px-6">Acciones</th>
                </tr>
                </thead>
                <tbody>

                    @foreach ($vehicles as $vehicle)
                <tr class="bg-white border-b" wire:key="vehicle-{{ $vehicle->id }}">

                    <td class="py-4 px-6">{{ $vehicle->placa }}</td>
                    <td class="py-4 px-6">{{ $vehicle->color }}</td>
                    <td class="py-4 px-6">{{ $vehicle->year }}</td>
                    <td class="py-4 px-6">{{ $vehicle->date_entry }}</td>
                    <td class="py-4 px-6">{{ $vehicle->mark->mark_name }}</td>
                    <td class="py-4 px-6">{{ $vehicle->type->type_name }}</td>
                    <td class="py-4 px-6">
                        <x-button wire:click="edit({{ $vehicle->id }})">
                            Editar
                        </x-button>

                        <x-danger-button onclick="confirm('¿Está seguro de eliminar el vehiculo?') || event.stopImmediatePropagation()" wire:click="destroy({{ $vehicle->id }})">
                            Eliminar
                        </x-danger-button>
                    </td>

                </tr>

                @endforeach

                </tbody>
            </table>
        </div>
        </div>
        </div>

        <div class="mt-4">
            {{ $vehicles->links(data: ['scrollTo' => false]) }}
        </div>

        <form wire:submit="update()">
            <x-dialog-modal wire:model="vehicleEdit.open">
                <x-slot name="title">
                    vehiculo a actualizar
                </x-slot>

                <x-slot name="content">
                    

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <x-label>
                                    Placa
                                </x-label>
                                <x-input class="w-full" wire:model="vehicleEdit.placa" />
                                <x-input-error for="vehicleEdit.placa" />
                            </div>
                
                            <div class="mb-4">
                                <x-label>
                                    Color
                                </x-label>
                                <x-input class="w-full" wire:model="vehicleEdit.color" />
                                <x-input-error for="vehicleEdit.color" />
                            </div>
                        </div>
            
                        <div class="mb-4">
                            <x-label>
                                Año
                            </x-label>
                            <x-input class="w-full" wire:model="vehicleEdit.year" />
                            <x-input-error for="vehicleEdit.year" />
                        </div>
            
                        <div class="mb-4">
                            <x-label>
                                Fecha de ingreso
                            </x-label>
                            <x-input class="w-full" wire:model="vehicleEdit.date_entry" />
                            <x-input-error for="vehicleEdit.date_entry" />
                        </div>
            
                        <div class="mb-4">
                            <x-label>
                                Modelo
                            </x-label>
                            <x-select class="w-full" wire:model="vehicleEdit.type_id">
            
                                <option value="">Seleccione un modelo</option>
            
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                                @endforeach
            
                            </x-select>
                            <x-input-error for="vehicleEdit.type_id" />
                        </div>
            
                        <div class="mb-4">
                            <x-label>
                                Marca
                            </x-label>
                            <x-select class="w-full" wire:model="vehicleEdit.mark_id">
            
                                <option value="">Seleccione una marca</option>
            
                                @foreach ($marks as $mark)
                                    <option value="{{ $mark->id }}">{{ $mark->mark_name }}</option>
                                @endforeach
            
                            </x-select>
                            <x-input-error for="vehicleEdit.mark_id" />
                        </div>
            
                </x-slot>

                <x-slot name="footer">
                    <x-button class="mr-2">
                        Actualizar
                    </x-button>

                    <x-danger-button class="" wire:click="$set('vehicleEdit.open', false)">
                        Cancelar
                    </x-danger-button>
                </x-slot>
            </x-dialog-modal>
        </form>

    </div>

</div>
