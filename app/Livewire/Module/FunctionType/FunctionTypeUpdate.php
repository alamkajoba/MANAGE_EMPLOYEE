<?php

namespace App\Livewire\Module\FunctionType;

use App\Models\FunctionType;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.app')]
class FunctionTypeUpdate extends Component
{
    #[Validate('required|min:3|string')]
    public $nameFunction = '';

    #[Validate('required|numeric|min:0')]
    public $salary = 0.00;

    #[Validate('nullable|numeric|min:1|max:31')]
    public $workDay = 1;

    public FunctionType $functionType;
    
    public function mount(FunctionType $functionType)
    {
        $this->functionType = $functionType;

        $this->nameFunction = $functionType->nameFunction;
        $this->workDay      = $functionType->workDay;
        $this->salary             = $functionType?->salary;
    }

    private function dataFunctionType(): array
    {

        $id = Auth::id();
        return [
            'nameFunction' => $this->nameFunction,
            'salary' => $this->salary,
            'workDay' => $this->workDay,
            'user_id' => $id
        ];
    }

    public function updateFunction()
    {
        $this->validate();

        $this->functionType->update($this->dataFunctionType());
        session()->flash('success', "La Fonction: ".$this->nameFunction. " a été modifiéé avec succès.");
        return redirect()->to(route('function.index'));
    }

    
    public function render()
    {
        return view('livewire.module.function-type.function-type-update');
    }
}
