<?php

namespace App\Livewire\Module\FunctionType;

use App\Models\FunctionType;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class FunctionTypeIndex extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url(as: 'q')]
    public ?string $search = '';
    
    public function render()
    {
        $function = FunctionType::search($this->search)
                ->latest()
                ->paginate(5);

        return view('livewire.module.function-type.function-type-index',[
            'function' => $function,
            ]);
    }
}
