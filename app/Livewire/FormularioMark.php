<?php

namespace App\Livewire;

use App\Livewire\Forms\MarkCreateForm;
use App\Livewire\Forms\MarkEditForm;
use App\Models\Mark;
use Livewire\Component;
use Livewire\WithPagination;

class FormularioMark extends Component
{
    use WithPagination;

    public MarkCreateForm $markCreate;
    public MarkEditForm $markEdit;

    public $showFormCreateMark = false;

    public $searchMark = '';

    public function mount(Mark $mark)
    {
        $this->markCreate->setMark($mark);
        $this->markEdit->setMark($mark);
    }

    public function save()
    {
        $this->markCreate->save();

        $this->resetPage(pageName: 'pageMarks');
    }

    public function edit($markId)
    {
        $this->resetValidation();
        
        $this->markEdit->edit($markId);
    }

    public function update()
    {
        $this->markEdit->update();
    }

    public function destroy($markId)
    {
        $mark = Mark::find($markId);
        $mark->delete();
    }

    public function render()
    {
        $marks = Mark::select('mark_name','id')
                ->when($this->searchMark, function ($query) {
                    $query->where('mark_name', 'like', '%' . $this->searchMark . '%');
                })
                ->orderBy('id','desc')
                ->paginate(5, pageName: 'pageMarks');

        return view('livewire.formulario-mark', compact('marks'));
    }
}
