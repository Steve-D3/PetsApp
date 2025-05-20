<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\VaccineType;
use App\Models\VetClinic;
use App\Models\VeterinarianProfile;
use Livewire\Component;

class VetDashboard extends Component
{
    public $upcomingAppointments = '';
    public $recentMedicalRecords;
    public $clinicStats;
    public $vaccineStats;
    public $quickActions;

    public function __construct()
    {
        $this->upcomingAppointments = collect([]);
        $this->recentMedicalRecords = collect([]);
        $this->clinicStats = [
            'total_appointments' => 0,
            'total_patients' => 0,
            'today_appointments' => 0,
        ];
        $this->vaccineStats = [
            'total_vaccinations' => 0,
            'unique_vaccines' => 0,
        ];
        $this->quickActions = collect([]);
    }

    public function mount()
    {
        $user = auth()->user()->load('veterinarianProfiles');
        dump($user);

        // Initialize all properties as empty collections
        $this->recentMedicalRecords = '';
        $this->clinicStats = [
            'total_appointments' => 0,
            'total_patients' => 0,
            'today_appointments' => 0,
        ];
        $this->vaccineStats = [
            'total_vaccinations' => 0,
            'unique_vaccines' => 0,
        ];
        $this->quickActions = collect([]);

        // Check if user has a veterinarian profile
        if (!$user->veterinarianProfile) {
            return;
        }

        $vetProfile = $user->veterinarianProfiles->user_id;
        $vetProfileId = $vetProfile->user_id;

        // Quick Actions
        $this->quickActions = collect([
            [
                'icon' => 'calendar',
                'title' => 'Schedule Appointment',
                'route' => route('appointments.create', ['veterinarianProfile' => $vetProfileId]),
            ],
            [
                'icon' => 'medical-record',
                'title' => 'New Medical Record',
                'route' => route('medical-records.create', ['veterinarianProfile' => $vetProfileId]),
            ],
            [
                'icon' => 'vaccine',
                'title' => 'Record Vaccination',
                'route' => route('vaccinations.create', ['veterinarianProfile' => $vetProfileId]),
            ],
            [
                'icon' => 'clinic',
                'title' => 'Manage Clinic',
                'route' => route('vet-clinics.index'),
            ],
        ]);

        // Upcoming Appointments
        $this->upcomingAppointments = Appointment::where('veterinarian_id', $vetProfileId)
            ->take(5)
            ->get()
            ->toJson();

        // Recent Medical Records
        $this->recentMedicalRecords = MedicalRecord::where('veterinarian_profile_id', $vetProfileId)
            ->orderBy('record_date', 'desc')
            ->take(3)
            ->get();

        // Clinic Stats
        $this->clinicStats = [
            'total_appointments' => Appointment::where('veterinarian_profile_id', $vetProfileId)->count(),
            'total_patients' => $vetProfile->pets()->distinct()->count(),
            'today_appointments' => Appointment::where('veterinarian_profile_id', $vetProfileId)
                ->whereDate('start_time', today())
                ->count(),
        ];

        // Vaccine Stats
        $this->vaccineStats = [
            'total_vaccinations' => MedicalRecord::where('veterinarian_profile_id', $vetProfileId)
                ->whereHas('vaccinations')
                ->count(),
            'unique_vaccines' => MedicalRecord::where('veterinarian_profile_id', $vetProfileId)
                ->whereHas('vaccinations')
                ->distinct('vaccine_type_id')
                ->count('vaccine_type_id'),
        ];
    }

    public function render()
    {
        return view('livewire.vet-dashboard');
    }
}
