<?php

namespace App\Livewire\Module\DotationEpi;

use App\Models\MonthDotationEpi;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.app')]
class DotationEpiCreate extends Component
{
    #[Validate('required')]
    public $monthYear;

    public function submitDotation()
    {
        $this->validate();

        $create = MonthDotationEpi::create(['monthYear' => $this->monthYear]);

        $lastMonthId = DB::table('month_dotation_epis')->latest('id')->value('id');

        // 2. On insère tous les enrollments avec cet ID fixe
        DB::table('execute_dotation_epis')->insertUsing(
            ['enrollment_id', 'month_dotation_epi_id'],
            DB::table('enrollments')->select('id', DB::raw($lastMonthId))
        );
        session()->flash('success', 'Done/已完成 !');
        return redirect()->route('epi.execute');
    }
    
    public function render()
    {
        return view('livewire.module.dotation-epi.dotation-epi-create');
    }
}
