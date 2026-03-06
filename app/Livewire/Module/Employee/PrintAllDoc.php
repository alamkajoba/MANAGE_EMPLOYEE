<?php

namespace App\Livewire\Module\Employee;

use App\Models\Enrollment;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.printAllDoc')]
class PrintAllDoc extends Component
{
    public function render()
    {
        $enrollments = Enrollment::all();
        return view('livewire.module.employee.print-all-doc',['enrollments' => $enrollments]);
    }
}
