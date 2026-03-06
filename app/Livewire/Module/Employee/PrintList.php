<?php

namespace App\Livewire\Module\Employee;

use App\Models\Enrollment;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.printList')]
class PrintList extends Component
{
    public function render()
    {
        $print = Enrollment::all();

        return view('livewire.module.employee.print-list',
        ['print' => $print]
        );
    }
}
