<?php

namespace App\Livewire\Module\FunctionType;

use App\Models\FunctionType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.app')]
class FunctionTypeCreate extends Component
{
    public $convertName;
    #[Validate('required')]
    public $nameFunction = '';
    #[Validate('required')]
    public $salary = '';
    #[Validate('required')]
    public $workDay = '';

    public function submitFunction()
    {
        $this->validate();

        //Check if exist
        $this->convertName = Str::lower(trim($this->nameFunction));

        $existCategory = FunctionType::whereRaw('LOWER(nameFunction) = ?', [$this->convertName])
            ->exists();

        if ($existCategory) {
            session()->flash('danger', "Cette Fonction existe déjà!...");
            return;
        }
        $userId = Auth::id();
        $employee = FunctionType::create([
            'nameFunction' => $this->nameFunction,
            'salary' => $this->salary,
            'workDay' => $this->workDay,
            'user_id' => $userId,
        ]);
        session()->flash('success', "Done/已完成 !");
        return redirect()->to(route('function.create'));
    }

    public function render()
    {
        return view('livewire.module.function-type.function-type-create');
    }
}
