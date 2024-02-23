<?php

namespace App\Livewire;

use App\Livewire\Forms\TypeCreateForm;
use App\Livewire\Forms\TypeEditForm;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;

class FormularioType extends Component
{
    use WithPagination;

    public TypeCreateForm $typeCreate;
    public TypeEditForm $typeEdit;

    public $showFormCreateType = false;

    public $searchType = '';

    public function mount(Type $type)
    {
        $this->typeCreate->setType($type);
        $this->typeEdit->setType($type);
    }

    public function save()
    {
        $this->typeCreate->save();

        $this->resetPage(pageName: 'pageTypes');
    }

    public function edit($typeId)
    {
        $this->resetValidation();
        
        $this->typeEdit->edit($typeId);
    }

    public function update()
    {
        $this->typeEdit->update();
    }

    public function render()
    {
        $types = Type::select('type_name','id')
                ->when($this->searchType, function ($query) {
                    $query->where('type_name', 'like', '%' . $this->searchType . '%');
                })
                ->orderBy('id','desc')
                ->paginate(5, pageName: 'pageTypes');

        return view('livewire.formulario-type', compact('types'));
    }
}
