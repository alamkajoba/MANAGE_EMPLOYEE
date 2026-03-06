<?php

namespace App\Livewire\Module\DotationEpi;

use App\Enums\DotationEpiEnum;
use App\Models\Enrollment;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class DotationEpiIndex extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url(as: 'q')]
    public ?string $search = '';

    public function render()
    {
        $dotation = Enrollment::with(['executeDotation','functionType','site']) // On charge la relation
            ->whereHas('executeDotation', function ($query) {
                // Cette condition s'applique sur la table 'execute_dotations'
                $query->where('dotationEPI', DotationEpiEnum::YES->value);
            })
            ->search($this->search) // Votre scope de recherche habituel
            ->paginate(5);

        return view('livewire.module.dotation-epi.dotation-epi-index',[
            'dotation' => $dotation,
            ]);
    }
}
