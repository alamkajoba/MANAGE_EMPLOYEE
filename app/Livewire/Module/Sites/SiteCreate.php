<?php

namespace App\Livewire\Module\Sites;

use App\Models\Site;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.app')]
class SiteCreate extends Component
{

    public $convertName;
    #[Validate('required')]
    public $nameSite = '';
    #[Validate('nullable')]
    public $description = '';

    public function submitSite()
    {
        $this->validate();

        //Check if exist
        $this->convertName = Str::lower(trim($this->nameSite));

        $existCategory = Site::whereRaw('LOWER(nameSite) = ?', [$this->convertName])
            ->exists();

        if ($existCategory) {
            session()->flash('danger', "Cet Site existe déjà!...");
            return;
        }
        $userId = Auth::id();
        $site = Site::create([
            'nameSite' => $this->nameSite,
            'description' => $this->description,
            'user_id' => $userId,
        ]);
        session()->flash('success', "Done/已完成 !");
        return redirect()->to(route('site.create'));
    }

    public function render()
    {
        return view('livewire.module.sites.site-create');
    }
}
