<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Pet;
use App\Models\VaccineType;
use App\Models\VetClinic;
use App\Models\VeterinarianProfile;
use Livewire\Component;

class VetDashboard extends Component
{
    public $upcomingAppointments;
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

        // Initialize all properties as empty collections

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

        // Check if user has a veterinarian profile
        if (!$user->veterinarianProfiles) {
            return;
        }

        $vetProfile = $user->veterinarianProfiles->first();
        $vetProfileId = $vetProfile->user_id;

        // Quick Actions
        $this->quickActions = collect([
            [
                'icon' => 'calendar',
                'title' => 'Schedule Appointment',
                'route' => route('vet.appointments.calendar', ['veterinarian_profile_id' => $vetProfileId]),
            ],
            [
                'icon' => 'medical-record',
                'title' => 'New Medical Record',
                // 'route' => route('medical-records.create', ['veterinarian_profile_id' => $vetProfileId]),
            ],
            [
                'icon' => 'vaccine',
                'title' => 'Record Vaccination',
                // 'route' => route('vaccinations.create', ['veterinarian_profile_id' => $vetProfileId]),
            ],
            [
                'icon' => 'clinic',
                'title' => 'Manage Clinic',
                // 'route' => route('vet-clinics.index'),
            ],
        ]);

        // Upcoming Appointments
        $this->upcomingAppointments = Appointment::where('veterinarian_id', $user->veterinarianProfiles->first()->user_id)
        ->with('pet')
        ->orderBy('start_time', 'asc')
        ->get();

        // Recent Medical Records
        $this->recentMedicalRecords = MedicalRecord::where('veterinarian_profile_id', $vetProfileId)
            ->orderBy('record_date', 'desc')
            ->take(3)
            ->get();

        // Clinic Stats
        $this->clinicStats = [
            'total_appointments' => Appointment::where('veterinarian_id', $vetProfileId)->count(),
            'total_patients' => Appointment::where('veterinarian_id', $vetProfileId)->distinct('pet_id')->count(),
            'today_appointments' => Appointment::where('veterinarian_id', $vetProfileId)
                ->whereDate('start_time', today())
                ->count(),
        ];

        // Vaccine Stats
        $this->vaccineStats = [
            'total_vaccinations' => MedicalRecord::where('veterinarian_profile_id', $vetProfileId)
                ->whereHas('vaccinations')
                ->count(),
            'unique_vaccines' => 0,
        ];
    }

    public function render()
    {
        return view('livewire.vet-dashboard', [
            'upcomingAppointments' => $this->upcomingAppointments,
            'recentMedicalRecords' => $this->recentMedicalRecords,
            'clinicStats' => $this->clinicStats,
            'vaccineStats' => $this->vaccineStats,
            'quickActions' => $this->quickActions,
        ]);
    }
}
