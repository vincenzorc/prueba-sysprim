<?php

namespace App\Livewire\Forms;

use App\Models\Mark;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MarkEditForm extends Form
{
    public ?Mark $mark;

    public $mark_name = '';

    public $markEditId = '';

    public $open = false;

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
                'unique:marks,mark_name,' . $this->markEditId,
            ]
        ];
    }

    public function validationAttributes()
    {
        return [
            'mark_name' => 'marca',
        ];
    }

    public function edit($markId)
    {
        $this->open = true;
        $this->markEditId = $markId;

        $mark = Mark::find($markId);

        $this->mark_name = $mark->mark_name;
    }

    public function update()
    {
        $this->validate();

        $mark = Mark::find($this->markEditId);

        $mark->update(
            $this->only('mark_name')
        );

        $this->reset();
    }
}
