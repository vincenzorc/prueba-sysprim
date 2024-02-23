<?php

namespace App\Livewire;

use App\Livewire\Forms\VehicleCreateForm;
use App\Livewire\Forms\VehicleEditForm;
use App\Models\Mark;
use App\Models\Type;
use App\Models\Vehicle;
use Livewire\Component;
use Livewire\WithPagination;

class FormularioVehicle extends Component
{
    use WithPagination;

    public $types, $marks;

    public VehicleCreateForm $vehicleCreate;
    public VehicleEditForm $vehicleEdit;

    public $searchVehicle = '';
    public $showFormCreateVehicle = false;

    public function mount(Vehicle $vehicle)
    {
        $this->vehicleCreate->setVehicle($vehicle);
        $this->vehicleEdit->setVehicle($vehicle);

        $this->types = Type::all();
        $this->marks = Mark::all();
    }

    public function save()
    {
        $this->vehicleCreate->save();

        $this->resetPage(pageName: 'pageVehicles');
    }

    public function edit($vehicleId)
    {
        $this->resetValidation();
        
        $this->vehicleEdit->edit($vehicleId);
    }

    public function update()
    {
        $this->vehicleEdit->update();
    }

    public function destroy($vehicleId)
    {
        $vehicle = Vehicle::find($vehicleId);
        $vehicle->delete();
    }

    public function render()
    {
        $vehicles = Vehicle::select('id','placa','color','year','date_entry','mark_id','type_id')
                            ->when($this->searchVehicle, function ($query) {
                                $query->where('placa', 'like', '%' . $this->searchVehicle . '%');
                            })
                            ->orderBy('id','desc')
                            ->paginate(5, pageName: 'pageVehicles');

        return view('livewire.formulario-vehicle', compact('vehicles'));
    }
}
