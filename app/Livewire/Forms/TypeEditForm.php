<?php

namespace App\Livewire\Forms;

use App\Models\Type;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TypeEditForm extends Form
{
    public ?Type $type;

    public $type_name = '';

    public $typeEditId = '';

    public $open = false;

    public function setType(Type $type)
    {
        $this->type = $type;
        $this->type_name = $type->type_name;
    }

    public function rules()
    {
        return [
            'type_name' => [
                'required',
                'alpha',
                'unique:types,type_name,' . $this->typeEditId,
            ]
        ];
    }

    public function validationAttributes()
    {
        return [
            'type_name' => 'modelo',
        ];
    }

    public function edit($typeId)
    {
        $this->open = true;
        $this->typeEditId = $typeId;

        $type = Type::find($typeId);

        $this->type_name = $type->type_name;
    }

    public function update()
    {
        $this->validate();

        $type = Type::find($this->typeEditId);

        $type->update(
            $this->only('type_name')
        );

        $this->reset();
    }
}
