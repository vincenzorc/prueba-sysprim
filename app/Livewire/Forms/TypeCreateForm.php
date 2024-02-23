<?php

namespace App\Livewire\Forms;

use App\Models\Type;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TypeCreateForm extends Form
{
    public ?Type $type;

    public $type_name = '';

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
                Rule::unique('types'),
            ]
        ];
    }

    public function validationAttributes()
    {
        return [
            'type_name' => 'modelo',
        ];
    }

    public function save()
    {
        $this->validate();

        $type = Type::create(
            $this->only('type_name')
        );

        $this->reset();
    }
}
