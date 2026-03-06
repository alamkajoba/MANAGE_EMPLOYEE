<?php

namespace App\Livewire\Module\Sites;

use App\Models\Site;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class SiteIndex extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url(as: 'q')]
    public ?string $search = '';
    
    public function render()
    {
        $site = Site::search($this->search)
                ->latest()
                ->paginate(5);
                
        return view('livewire.module.sites.site-index',[
            'site' => $site,
        ]);
    }
}
