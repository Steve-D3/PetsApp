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
    public $vetId;
    public $upcomingAppointments;
    public $recentMedicalRecords;
    public $clinicStats;
    public $vaccineStats;
    public $quickActions;
    public $appointmentStats;
    public $patientStats;
    public $pendingTasks;

    // Medical Records Filtering
    public $petFilter = '';
    public $dateFrom = '';
    public $dateTo = '';
    public $availablePets = [];
    public $showFilters = false;

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
        $this->appointmentStats = [
            'today' => 0,
            'this_week' => 0,
            'pending' => 0,
        ];
        $this->patientStats = [
            'new_this_month' => 0,
            'returning' => 0,
            'total' => 0,
        ];
        $this->pendingTasks = [];  // Initialize as empty array
        $this->quickActions = collect([]);
    }

    public function mount()
    {
        $user = auth()->user()->load('veterinarianProfiles');

        // Initialize all properties as empty collections
        $this->recentMedicalRecords = collect([]);
        $this->availablePets = [];
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
        if (!$user->veterinarianProfiles || $user->veterinarianProfiles->isEmpty()) {
            // If user doesn't have a vet profile, we'll use their user ID
            // and set a flag to show a warning
            $this->vetId = $user->id;
            session()->flash('warning', 'No veterinarian profile found. Please complete your profile to access all features.');
            
            // Initialize empty stats for users without a vet profile
            $this->appointmentStats = [
                'today' => 0,
                'this_week' => 0,
                'pending' => 0,
            ];
            $this->patientStats = [
                'new_this_month' => 0,
                'returning' => 0,
                'total' => 0,
            ];
            $this->vaccineStats = [
                'total_vaccinations' => 0,
                'unique_vaccines' => 0,
                'due_soon' => 0,
            ];
            $this->pendingTasks = [];  // Ensure pendingTasks is always an array
            return;
        }

        $vetProfile = $user->veterinarianProfiles->first();
        $this->vetId = $vetProfile->user_id;

        // Quick Actions
        $this->quickActions = collect([
            [
                'icon' => 'calendar',
                'title' => 'Schedule Appointment',
                'route' => route('vet.appointments.index'),
            ],
            [
                'icon' => 'medical-record',
                'title' => 'New Medical Record',
                'route' => "#",
            ],
            [
                'icon' => 'vaccine',
                'title' => 'Record Vaccination',
                'route' => "#",
            ],
            [
                'icon' => 'clinic',
                'title' => 'Manage Clinic',
                'route' => "#",
            ],
        ]);

        // Upcoming Appointments - Next 5 future appointments
        $this->upcomingAppointments = Appointment::where('veterinarian_id', $this->vetId)
            ->where('start_time', '>=', now())
            ->with('pet')
            ->orderBy('start_time', 'asc')
            ->take(5)
            ->get();

        // Load available pets for filtering
        $this->availablePets = \App\Models\Pet::whereHas('appointments', function ($query) {
            $query->where('veterinarian_id', $this->vetId);
        })->get(['id', 'name']);

        // Load recent medical records
        $this->loadMedicalRecords();

        // Clinic Stats
        $this->clinicStats = [
            'total_appointments' => Appointment::where('veterinarian_id', $this->vetId)->count(),
            'total_patients' => Appointment::where('veterinarian_id', $this->vetId)->distinct('pet_id')->count(),
            'today_appointments' => Appointment::where('veterinarian_id', $this->vetId)
                ->whereDate('start_time', today())
                ->count(),
        ];

        // Appointment Statistics
        $this->appointmentStats = [
            'today' => Appointment::where('veterinarian_id', $this->vetId)
                ->whereDate('start_time', today())
                ->count(),
            'this_week' => Appointment::where('veterinarian_id', $this->vetId)
                ->whereBetween('start_time', [now()->startOfWeek(), now()->endOfWeek()])
                ->count(),
            'pending' => Appointment::where('veterinarian_id', $this->vetId)
                ->where('status', 'pending')
                ->count(),
        ];

        // Patient Statistics
        $newPatientCutoff = now()->subMonth();
        $allPatientIds = Appointment::where('veterinarian_id', $this->vetId)
            ->pluck('pet_id')
            ->unique();

        $this->patientStats = [
            'new_this_month' => Appointment::where('veterinarian_id', $this->vetId)
                ->where('created_at', '>=', now()->startOfMonth())
                ->distinct('pet_id')
                ->count('pet_id'),
            'returning' => $allPatientIds->count() - Appointment::where('veterinarian_id', $this->vetId)
                ->where('created_at', '>=', $newPatientCutoff)
                ->distinct('pet_id')
                ->count('pet_id'),
            'total' => $allPatientIds->count(),
        ];

        // Vaccine Statistics
        $this->vaccineStats = [
            'total_vaccinations' => MedicalRecord::where('veterinarian_profile_id', $this->vetId)
                ->whereHas('vaccinations')
                ->count(),
            'unique_vaccines' => 0, // TODO: Implement unique vaccines count
            'due_soon' => 0, // TODO: Implement due soon count
        ];

        // Pending Tasks/Reminders
        $this->pendingTasks = [
            [
                'title' => 'Follow up with recent patients',
                'due' => now()->addDays(2),
                'priority' => 'high',
            ],
            [
                'title' => 'Review pending lab results',
                'due' => now()->addDays(1),
                'priority' => 'medium',
            ],
        ];
    }

    public function loadMedicalRecords()
    {
        $query = MedicalRecord::with(['pet', 'vet.user'])
            ->where('veterinarian_profile_id', $this->vetId)
            ->orderBy('record_date', 'desc');

        // Apply filters
        if ($this->petFilter) {
            $query->where('pet_id', $this->petFilter);
        }

        if ($this->dateFrom) {
            $query->whereDate('record_date', '>=', $this->dateFrom);
        }

        if ($this->dateTo) {
            $query->whereDate('record_date', '<=', $this->dateTo);
        }

        $this->recentMedicalRecords = $query->take(5)->get();
    }

    public function resetFilters()
    {
        $this->reset(['petFilter', 'dateFrom', 'dateTo']);
        $this->loadMedicalRecords();
    }

    public function applyFilters()
    {
        $this->loadMedicalRecords();
    }

    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }

    public function render()
    {
        return view('livewire.vet-dashboard', [
            'vetProfileId' => $this->vetId,
            'upcomingAppointments' => $this->upcomingAppointments,
            'recentMedicalRecords' => $this->recentMedicalRecords,
            'clinicStats' => $this->clinicStats,
            'vaccineStats' => $this->vaccineStats,
            'appointmentStats' => $this->appointmentStats,
            'patientStats' => $this->patientStats,
            'pendingTasks' => $this->pendingTasks,
            'quickActions' => $this->quickActions,
            'availablePets' => $this->availablePets,
        ]);
    }
}
