<?php

namespace App\Livewire\Module\Employee;

use App\Enums\CivilStateEnum;
use App\Enums\ContractTypeEnum;
use App\Enums\GenderEnum;
use App\Enums\StudyLevelEnum;
use App\Models\Enrollment;
use App\Models\FunctionType;
use App\Models\Site;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class EmployeeCreate extends Component
{

    use WithFileUploads;

    public $convertMiddleName;
    public $convertLastName;
    public $convertFirstName;
    public $step = 1;
    public $totalSteps = 3;
    public $allFunctionTypes;
    public $allSite;

    //basic informations
    public $firstName, $middleName, $lastName, $gender, $address, $civilState, $nationality, $birthDate, $birthPlace;
    
    //formation and professions
    public $studyLevel, $obtainingDate, $faculty, $otherProfession, $lastJob, $phone, $nationalNumber;

    //enrollment info
    public $startDate, $matricule, $function_type_id, $site_id, $desseaseHistory, $ownerPassport, $copyNationalCard;

    public function nextStep()
    {
        $this->validateData();
        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function validateData()
    {
        if ($this->step == 1) {
            $this->validate([
                'middleName' => 'required|string|regex:/^[a-zA-Z\s\-]+$/',
                'lastName' => 'required|string|regex:/^[a-zA-Z\s\-]+$/',
                'firstName' => 'required|string|regex:/^[a-zA-Z\s\-]+$/',
                'gender' => 'required|in:M,F',
                'birthDate' => 'required',
                'birthPlace' => 'required',
                'civilState' => 'required',
                'nationality' => 'required',
                'address' => 'required',
            ]);
        } elseif ($this->step == 2) {
            $this->validate([
                'studyLevel' => 'required',
                'phone' => 'required',
                'obtainingDate' => 'nullable',
                'nationalNumber' => 'nullable',
                'otherProfession' => 'nullable',
                'faculty' => 'nullable',
                'lastJob' => 'nullable',
            ]);
        } 
    }

    public function generateNextMatricule($employee)
    {

        return 'CSCC-' . str_pad($employee, 4, '0', STR_PAD_LEFT). '-' . $this->site_id;
    }

    public function saveEmployee()
    {

        $this->validate([
            'startDate' => 'nullable',
            'function_type_id' => 'nullable',
            'site_id' => 'nullable',
            'desseaseHistory' => 'nullable',
            'ownerPassport' => 'nullable|image|max:1024',
            'copyNationalCard' => 'nullable|image|max:1024',
        ]);

        //Path passport
        $pathPassport = $this->ownerPassport->store('photos', 'public');

        //Path Id
        $pathId = $this->copyNationalCard->store('photos', 'public');

        //Check if exist
        $this->convertFirstName = Str::lower(trim($this->firstName));
        $this->convertMiddleName = Str::lower(trim($this->middleName));
        $this->convertLastName = Str::lower(trim($this->lastName));

        $existEmployee = Enrollment::whereRaw('LOWER(firstName) = ?', [$this->convertFirstName])
            ->whereRaw('LOWER(middleName) = ?', [$this->convertMiddleName])
            ->whereRaw('LOWER(lastName) = ?', [$this->convertLastName])
            ->where('birthDate', $this->birthDate)
            ->exists();

        if ($existEmployee) {
            session()->flash('danger', "agent ".$this->middleName." ".$this->lastName." ".$this->firstName." existe déjà!...");
            return;
        }

        // Logique d'enregistrement
        try {
            $userId = Auth::id();

            DB::beginTransaction();
            $employee = Enrollment::create([
                'firstName' => $this->firstName, 
                'middleName' => $this->middleName, 
                'lastName' => $this->lastName, 
                'birthDate' => $this->birthDate, 
                'birthPlace' => $this->birthPlace, 
                'gender' => $this->gender, 
                'civilState' => $this->civilState, 
                'nationality' => $this->nationality, 
                'address' => $this->address, 

                'studyLevel' => $this->studyLevel, 
                'obtainingDate' => $this->obtainingDate, 
                'nationalNumber' => $this->nationalNumber, 
                'phone' => $this->phone, 
                'faculty' => $this->faculty, 
                'otherProfession' => $this->otherProfession,
                'lastJob' => $this->lastJob,

                'startDate' => $this->startDate, 
                'function_type_id' => $this->function_type_id, 
                'desseaseHistory' => $this->desseaseHistory,
                'site_id' => $this->site_id, 
                'ownerPassport' => $pathPassport, 
                'copyNationalCard' => $pathId, 
                'user_id' => $userId,
            ]);
            $employee->update([
                'matricule' => $this->generateNextMatricule($employee->id)
            ]);

            DB::commit();

            session()->flash('success', 'Done/已完成 !');
            return redirect()->route('enrollment.index');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash("danger", "Une erreur est survenue lors de l'enregistrement.");
            dd([
                'Message' => $e->getMessage(),
                'Fichier' => $e->getFile(),
                'Ligne'   => $e->getLine(),
            ]);
        }
    }

    public function mount()
    {
        $this->allFunctionTypes = FunctionType::all();
        $this->allSite = Site::all();
    }

    //Enums
    private function gender(): array
    {
        return GenderEnum::cases();
    }

    //Enums
    private function currentLevel(): array
    {
        return StudyLevelEnum::cases();
    }

    //Enums
    private function civilState(): array
    {
        return CivilStateEnum::cases();
    }

    //Enums
    private function contractType(): array
    {
        return ContractTypeEnum::cases();
    }

    public function render()
    {
        return view('livewire.module.employee.employee-create');
    }
}
