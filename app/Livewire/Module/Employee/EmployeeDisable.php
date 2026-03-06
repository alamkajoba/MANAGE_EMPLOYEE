<?php

namespace App\Livewire\Module\Employee;

use App\Enums\EmployeeStatusEnum;
use App\Models\Enrollment;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class EmployeeDisable extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url(as: 'q')]
    public ?string $search = '';

    //enable employee
    public function enableEmployee($id)
    {
        $employee = Enrollment::findOrFail($id);
        $employee->update([
            'employeeStatus' => EmployeeStatusEnum::ENABLE->value,
        ]);
    }
    
    public function render()
    {
        $enrollment = Enrollment::with('functionType', 'site')
                                ->where('employeeStatus', EmployeeStatusEnum::DISABLE->value)
                                ->search($this->search)
                                ->paginate(5);

        return view('livewire.module.employee.employee-disable',[
            'enrollment' => $enrollment,
            ]);
    }
}
