<?php

namespace App\Livewire\Forms;

use App\Models\Mark;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MarkCreateForm extends Form
{
    public ?Mark $mark;

    public $mark_name = '';

    public function setMark(Mark $mark)
    {
        $this->mark = $mark;
        $this->mark_name = $mark->mark_name;
    }

    public function rules()
    {
        return [
            'mark_name' => [
                'required',
                'alpha',
                Rule::unique('marks'),
            ]
        ];
    }

    public function validationAttributes()
    {
        return [
            'mark_name' => 'marca',
        ];
    }

    public function save()
    {
        $this->validate();

        $mark = Mark::create(
            $this->only('mark_name')
        );

        $this->reset();
    }
}
