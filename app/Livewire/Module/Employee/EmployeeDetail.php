<?php

namespace App\Livewire\Module\Employee;

use App\Models\Enrollment;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.printDoc')]
class EmployeeDetail extends Component
{
    public $enrollment; 

    public function mount($id)
    {
        $this->enrollment = Enrollment::findOrFail($id);
        // with('site', 'functionType')->

        // dd([
        //     'photo' => $this->enrollment->ownerPassport,
        //     'NN' => $this->enrollment->copyNationalCard,
        // ]);
    }

    public function render()
    {
        return view('livewire.module.employee.employee-detail');
    }
}
