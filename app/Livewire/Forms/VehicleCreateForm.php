<?php

namespace App\Livewire\Forms;

use App\Models\Vehicle;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class VehicleCreateForm extends Form
{
    public ?Vehicle $vehicle;

    public $placa = '';

    public $color = '';

    public $year = '';

    public $date_entry = '';

    public $mark_id = '';

    public $type_id = '';

    public function setVehicle(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
        $this->placa = $vehicle->color;
        $this->year = $vehicle->year;
        $this->date_entry = $vehicle->date_entry;
        $this->mark_id = $vehicle->mark_id;
        $this->type_id = $vehicle->type_id;

    }

    public function rules()
    {
        return [
            'placa' => [
                'required',
                'string',
                'regex:/^[A-Za-z]{3}\d{2}[A-Za-z]{2}$/',
                Rule::unique('vehicles'),
            ],
            'color' => 'required|alpha',
            'year' => 'required|date_format:Y',
            'date_entry' => 'required|date|before_or_equal:today',
            'mark_id' => 'required|numeric|exists:marks,id',
            'type_id' => 'required|numeric|exists:types,id'
        ];
    }

    public function validationAttributes()
    {
        return [
            'placa' => 'placa',
            'color' => 'color',
            'year' => 'año',
            'date_entry' => 'fecha de ingreso',
            'mark_id' => 'marca',
            'type_id' => 'modelo'
        ];
    }

    public function save()
    {
        $this->validate();

        $vehicle = Vehicle::create(
            $this->only('placa', 'color', 'year', 'date_entry', 'mark_id', 'type_id')
        );

        $this->reset(['placa', 'color', 'year', 'date_entry', 'mark_id', 'type_id']);
    }
}
