<?php

namespace App\Livewire\Module\Employee;

use App\Enums\CivilStateEnum;
use App\Enums\ContractTypeEnum;
use App\Enums\GenderEnum;
use App\Enums\StudyLevelEnum;
use App\Models\Enrollment;
use App\Models\FunctionType;
use App\Models\Site;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class EmployeeEdit extends Component
{
    use WithFileUploads;

    public $enrollmentId; 
    public $step = 1;
    public $totalSteps = 3;
    public $allFunctionTypes;
    public $allSite;

    // Propriétés du formulaire
    public $firstName, $middleName, $lastName, $gender, $address, $civilState, $nationality, $birthDate, $birthPlace;
    public $studyLevel, $obtainingDate, $faculty, $otherProfession, $lastJob, $phone, $nationalNumber;
    public $startDate, $matricule, $function_type_id, $site_id, $desseaseHistory, $ownerPassport, $copyNationalCard;

    // Propriétés pour conserver les anciens chemins de fichiers
    public $oldPassport, $oldNationalCard;

    public function mount(Enrollment $enrollment)
    {
        $this->enrollmentId = $enrollment->id;
        $this->allFunctionTypes = FunctionType::all();
        $this->allSite = Site::all();

        // Hydratation des propriétés
        $this->firstName = $enrollment->firstName;
        $this->middleName = $enrollment->middleName;
        $this->lastName = $enrollment->lastName;
        $this->gender = $enrollment->gender;
        $this->birthDate = $enrollment->birthDate; 
        $this->birthPlace = $enrollment->birthPlace;
        $this->address = $enrollment->address;
        $this->civilState = $enrollment->civilState;
        $this->nationality = $enrollment->nationality;
        $this->phone = $enrollment->phone;
        $this->nationalNumber = $enrollment->nationalNumber;
        
        $this->studyLevel = $enrollment->studyLevel;
        $this->obtainingDate = $enrollment->obtainingDate;
        $this->faculty = $enrollment->faculty;
        $this->otherProfession = $enrollment->otherProfession;
        $this->lastJob = $enrollment->lastJob;

        $this->startDate = $enrollment->startDate ? $enrollment->startDate->format('Y-m-d') : null;
        $this->function_type_id = $enrollment->function_type_id;
        $this->site_id = $enrollment->site_id;
        $this->desseaseHistory = $enrollment->desseaseHistory;
        $this->matricule = $enrollment->matricule;

        // Sauvegarde des anciens fichiers
        $this->oldPassport = $enrollment->ownerPassport;
        $this->oldNationalCard = $enrollment->copyNationalCard;
    }

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
                'gender' => 'required',
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
                'nationalNumber' => 'nullable',
            ]);
        }
    }

    public function updateEmployee()
    {
        $this->validate([
            'startDate' => 'nullable|date',
            'function_type_id' => 'required',
            'site_id' => 'required',
            'ownerPassport' => 'nullable|image|max:1024',
            'copyNationalCard' => 'nullable|image|max:1024',
        ]);

        $enrollment = Enrollment::findOrFail($this->enrollmentId);

        // Check doublon (exclure l'actuel)
        $exists = Enrollment::where('id', '!=', $this->enrollmentId)
            ->whereRaw('LOWER(firstName) = ?', [Str::lower($this->firstName)])
            ->whereRaw('LOWER(middleName) = ?', [Str::lower($this->middleName)])
            ->whereRaw('LOWER(lastName) = ?', [Str::lower($this->lastName)])
            ->where('birthDate', $this->birthDate)
            ->exists();

        if ($exists) {
            session()->flash('danger', "Cet agent existe déjà dans le système.");
            return;
        }

        try {
            DB::beginTransaction();

            // Gestion Passport
            if ($this->ownerPassport) {
                if ($this->oldPassport) Storage::disk('public')->delete($this->oldPassport);
                $pathPassport = $this->ownerPassport->store('photos', 'public');
            } else {
                $pathPassport = $this->oldPassport;
            }

            // Gestion Carte ID
            if ($this->copyNationalCard) {
                if ($this->oldNationalCard) Storage::disk('public')->delete($this->oldNationalCard);
                $pathId = $this->copyNationalCard->store('photos', 'public');
            } else {
                $pathId = $this->oldNationalCard;
            }

            $enrollment->update([
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
            ]);

            DB::commit();

            session()->flash('success', 'Mise à jour réussie / 已更新 !');
            return redirect()->route('enrollment.index');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash("danger", "Erreur lors de la mise à jour.");
        }
    }

    public function render()
    {
        return view('livewire.module.employee.employee-edit', [
            'genders' => GenderEnum::cases(),
            'levels' => StudyLevelEnum::cases(),
            'states' => CivilStateEnum::cases(),
            'contracts' => ContractTypeEnum::cases(),
        ]);
    }
}