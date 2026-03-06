<?php

use App\Livewire\Module\Dashboard\Dashboard;
use App\Livewire\Module\DotationEpi\DotationEpiCreate;
use App\Livewire\Module\DotationEpi\DotationEpiExecute;
use App\Livewire\Module\DotationEpi\DotationEpiIndex;
use App\Livewire\Module\Employee\EmployeeCreate;
use App\Livewire\Module\Employee\EmployeeDetail;
use App\Livewire\Module\Employee\EmployeeDisable;
use App\Livewire\Module\Employee\EmployeeEdit;
use App\Livewire\Module\Employee\EmployeeIndex;
use App\Livewire\Module\Employee\PrintAllDoc;
use App\Livewire\Module\Employee\PrintList;
use App\Livewire\Module\FunctionType\FunctionTypeCreate;
use App\Livewire\Module\FunctionType\FunctionTypeIndex;
use App\Livewire\Module\FunctionType\FunctionTypeUpdate;
use App\Livewire\Module\Sites\SiteCreate;
use App\Livewire\Module\Sites\SiteIndex;
use App\Livewire\Module\Sites\SiteUpdate;
use App\Livewire\Module\User\AssignPermission;
use App\Livewire\Module\User\SetPassword;
use App\Livewire\Module\User\UserCreate;
use App\Livewire\Module\User\UserIndex;
use App\Livewire\Module\User\UserUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

#Login route
Route::get('/', function () {
    return redirect()->route('login');
});

#Dashboard route
Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function (){
    Route::get('dashboard', Dashboard::class)->name('dashboard');
});

#function routes
Route::middleware('auth')->prefix('function')->name('function.')->group(function () {
    Route::get('index', FunctionTypeIndex::class)->name('index');
    Route::get('create', FunctionTypeCreate::class)->name('create');
    Route::get('update/{functionType}', FunctionTypeUpdate::class)->name('update');
});

#EPI routes
Route::middleware('auth')->prefix('epi')->name('epi.')->group(function () {
    Route::get('index', DotationEpiIndex::class)->name('index');
    Route::get('create', DotationEpiCreate::class)->name('create');
    Route::get('execute', DotationEpiExecute::class)->name('execute');
});

#Employee routes
Route::middleware('auth')->prefix('enrollment')->name('enrollment.')->group(function () {
    Route::get('index', EmployeeIndex::class)->name('index');
    Route::get('create', EmployeeCreate::class)->name('create');
    Route::get('detail/{id}', EmployeeDetail::class)->name('detail');
    Route::get('update/{enrollment}', EmployeeEdit::class)->name('update');
    Route::get('disable', EmployeeDisable::class)->name('disable');
    Route::get('printList', PrintList::class)->name('printList');
    Route::get('printAllDoc', PrintAllDoc::class)->name('printAllDoc');
});

#Permissions routes
Route::middleware('auth')->prefix('permission')->name('permission.')->group(function () {
    Route::get('assign/{id}', AssignPermission::class)->name('assign');
});

#Users routes
Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('index', UserIndex::class)->name('index');
    Route::get('create', UserCreate::class)->name('create');
    Route::get('update/{id}', UserUpdate::class)->name('update');
    Route::get('set', SetPassword::class)->name('set');
});

#sites routes
Route::middleware('auth')->prefix('site')->name('site.')->group(function () {
    Route::get('index', SiteIndex::class)->name('index');
    Route::get('create', SiteCreate::class)->name('create');
    Route::get('update/{id}', SiteUpdate::class)->name('update');
});

#Logout route
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
})->name('logout');

require __DIR__.'/auth.php';
