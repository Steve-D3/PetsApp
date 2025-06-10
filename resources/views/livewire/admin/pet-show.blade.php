<div class="min-h-screen bg-gray-50/50 dark:bg-gray-900/50 py-8 px-4 sm:px-6 lg:px-8 transition-colors duration-200">
    <!-- Flash Messages -->
    <div class="max-w-7xl mx-auto mb-6 space-y-3">
        @if (session()->has('message'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="rounded-lg bg-green-50/80 dark:bg-green-900/80 backdrop-blur-sm p-4 border border-green-200 dark:border-green-800 shadow-sm">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-500 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800 dark:text-green-100">
                            {{ session('message') }}
                        </p>
                    </div>
                    <div class="ml-auto pl-3">
                        <button @click="show = false"
                            class="text-green-500 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300">
                            <span class="sr-only">Dismiss</span>
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="rounded-lg bg-red-50/80 dark:bg-red-900/80 backdrop-blur-sm p-4 border border-red-200 dark:border-red-800 shadow-sm">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-800 dark:text-red-100">
                            {{ session('error') }}
                        </p>
                    </div>
                    <div class="ml-auto pl-3">
                        <button @click="show = false"
                            class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                            <span class="sr-only">Dismiss</span>
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="max-w-7xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.pets.index') }}"
                class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors duration-200 group">
                <svg class="w-4 h-4 mr-1.5 transform group-hover:-translate-x-0.5 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to all pets
            </a>
        </div>

        <!-- Page Header -->
        <div
            class="md:flex md:items-center md:justify-between mb-8 bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700">
            <div class="flex-1 min-w-0">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:text-3xl sm:truncate">
                        {{ $pet->name }}
                        <span
                            class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                            {{ ucfirst($pet->status) }}
                        </span>
                    </h1>
                </div>

                <div class="mt-2 flex flex-col sm:flex-row sm:flex-wrap sm:space-x-6 space-y-2 sm:space-y-0">
                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Last updated <span
                                class="font-medium text-gray-700 dark:text-gray-300">{{ $pet->updated_at->diffForHumans() }}</span></span>
                    </div>
                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Created on <span
                                class="font-medium text-gray-700 dark:text-gray-300">{{ $pet->created_at->format('M d, Y') }}</span></span>
                    </div>
                    @if($pet->breed)
                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                            <span>{{ is_object($pet->breed) ? $pet->breed->name : $pet->breed }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-4 flex flex-wrap gap-3 md:mt-0 md:ml-4">
                <a href="{{ route('admin.pets.edit', $pet) }}"
                    class="group inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-150"
                    title="Edit pet details">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500 group-hover:text-indigo-500 dark:group-hover:text-indigo-400 transition-colors"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    Edit
                </a>

                <a href="{{ route('medical-records.create', ['pet' => $pet]) }}"
                    class="group inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-150"
                    title="Add medical record">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-indigo-200 group-hover:text-white transition-colors" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Add Record
                </a>

                <button type="button"
                    wire:click="$dispatch('confirm-delete', { id: {{ $pet->id }}, name: '{{ addslashes($pet->name) }}' })"
                    class="group inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-150"
                    title="Delete pet">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-red-200 group-hover:text-white transition-colors" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                    <span class="hidden sm:inline">Delete</span>
                </button>
            </div>
        </div>

        <div class="max-w-7xl mx-auto">
            <!-- Pet Information -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700/50 overflow-hidden mb-8">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Pet Information
                            </h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Detailed information about {{ $pet->name }}
                            </p>
                        </div>
                        <a href="{{ route('admin.pets.edit', $pet) }}"
                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full text-indigo-700 bg-indigo-100 hover:bg-indigo-200 dark:bg-indigo-900/30 dark:text-indigo-300 dark:hover:bg-indigo-900/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150"
                            title="Edit pet information">
                            <svg class="-ml-0.5 mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                </path>
                            </svg>
                            Edit
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Pet Photo -->
                        <div class="md:col-span-1">
                            <div class="relative group">
                                <div
                                    class="aspect-w-1 aspect-h-1 rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-700/50 border-2 border-gray-200 dark:border-gray-600">
                                    <img src="{{ $pet->photo_url ? asset('storage/' . $pet->photo_url) : asset('images/default-pet.jpg') }}"
                                        alt="{{ $pet->name }}"
                                        class="w-full h-full object-cover transition-opacity duration-300"
                                        onload="this.style.opacity = '1'" style="opacity: 0;" loading="lazy">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                        <button type="button"
                                            class="text-white text-sm bg-black/40 hover:bg-black/60 px-3 py-1.5 rounded-lg flex items-center transition-colors">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            Change Photo
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 space-y-3">
                                <div>
                                    <span
                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400">Status</span>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-1 {{ $pet->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300' }}">
                                        {{ ucfirst($pet->status) }}
                                    </span>
                                </div>
                                <div>
                                    <span class="block text-xs font-medium text-gray-500 dark:text-gray-400">Last
                                        Updated</span>
                                    <span
                                        class="text-sm text-gray-900 dark:text-white">{{ $pet->updated_at->diffForHumans() }}</span>
                                </div>
                                <div class="pt-2">
                                    <a href="{{ route('medical-records.index', $pet) }}"
                                        class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150">
                                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        View Medical Records
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Pet Details -->
                        <div class="md:col-span-2">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Basic Info -->
                                <div class="space-y-4">
                                    <h4
                                        class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Basic Information</h4>
                                    <dl class="space-y-4">
                                        <div>
                                            <dt class="text-xs font-medium text-gray-500 dark:text-gray-400">Name</dt>
                                            <dd class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $pet->name }}
                                            </dd>
                                        </div>
                                        <div>
                                            <dt class="text-xs font-medium text-gray-500 dark:text-gray-400">Species
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                                                {{ $pet->species->name ?? 'N/A' }}
                                            </dd>
                                        </div>
                                        <div>
                                            <dt class="text-xs font-medium text-gray-500 dark:text-gray-400">Breed</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                                                {{ $pet->breed->name ?? 'Unknown' }}
                                            </dd>
                                        </div>
                                    </dl>
                                </div>

                                <!-- Medical Info -->
                                <div class="space-y-4">
                                    <h4
                                        class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Medical Details</h4>
                                    <dl class="space-y-4">
                                        <div>
                                            <dt class="text-xs font-medium text-gray-500 dark:text-gray-400">Date of
                                                Birth</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                                                @if($pet->date_of_birth)
                                                    {{ $pet->date_of_birth->format('M d, Y') }}
                                                    <span
                                                        class="text-gray-500 dark:text-gray-400">({{ $pet->age ?? 'N/A' }})</span>
                                                @else
                                                    Not specified
                                                @endif
                                            </dd>
                                        </div>
                                        <div>
                                            <dt class="text-xs font-medium text-gray-500 dark:text-gray-400">Gender</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-white capitalize">
                                                {{ $pet->gender ?? 'N/A' }}
                                                @if($pet->is_sterilized)
                                                    <span
                                                        class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300">
                                                        Sterilized
                                                    </span>
                                                @endif
                                            </dd>
                                        </div>
                                        <div>
                                            <dt class="text-xs font-medium text-gray-500 dark:text-gray-400">Weight</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                                                {{ $pet->weight ? $pet->weight . ' kg' : 'Not specified' }}
                                            </dd>
                                        </div>
                                    </dl>
                                </div>

                                <!-- Additional Info -->
                                @if($pet->food_preferences || $pet->notes)
                                    <div class="md:col-span-2 space-y-4">
                                        <h4
                                            class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Additional Information</h4>
                                        <div class="space-y-4">
                                            @if($pet->food_preferences)
                                                <div>
                                                    <dt class="text-xs font-medium text-gray-500 dark:text-gray-400">Food
                                                        Preferences</dt>
                                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                                                        {{ $pet->food_preferences }}
                                                    </dd>
                                                </div>
                                            @endif
                                            @if($pet->notes)
                                                <div>
                                                    <dt class="text-xs font-medium text-gray-500 dark:text-gray-400">Notes</dt>
                                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white whitespace-pre-line">
                                                        {{ $pet->notes }}
                                                    </dd>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Owner Information -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700/50 overflow-hidden mt-8">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Owner Information
                    </h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center">
                        <div
                            class="flex-shrink-0 h-16 w-16 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center">
                            <span class="text-2xl text-indigo-600 dark:text-indigo-300 font-medium">
                                {{ substr($pet->owner->name, 0, 1) }}
                            </span>
                        </div>
                        <div class="ml-6">
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white">{{ $pet->owner->name }}</h4>
                            <div class="mt-1 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                                {{ $pet->owner->email }}
                            </div>
                            <div class="mt-1 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                {{ $pet->owner->phone ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="ml-auto">
                            <a href="{{ route('admin.users.show', $pet->owner) }}"
                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full text-indigo-700 bg-indigo-100 hover:bg-indigo-200 dark:bg-indigo-900/30 dark:text-indigo-300 dark:hover:bg-indigo-900/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Appointments Section -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700/50 overflow-hidden mt-8">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Appointments</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Scheduled visits and medical appointments for {{ $pet->name }}
                            </p>
                        </div>
                        <button wire:click="$set('showAddModal', true)"
                            class="inline-flex items-center px-3.5 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 01-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            New Appointment
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto no-scrollbar">
                    @if($pet->appointments->count() > 0)
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Date & Time</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Status</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Veterinarian</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Notes</th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($pet->appointments as $appointment)
                                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <div class="flex items-center">
                                                                    <div
                                                                        class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full bg-indigo-100 dark:bg-indigo-900/30">
                                                                        <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-400"
                                                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                                            stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                        </svg>
                                                                    </div>
                                                                    <div class="ml-4">
                                                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                                            {{ \Carbon\Carbon::parse($appointment->start_time)->format('M d, Y') }}
                                                                        </div>
                                                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                                                            {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }} -
                                                                            {{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                @php
                                                                    $statusColors = [
                                                                        'scheduled' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
                                                                        'confirmed' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                                                        'completed' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300',
                                                                        'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                                                        'no_show' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
                                                                        'pending' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300'
                                                                    ];
                                                                    $statusColor = $statusColors[strtolower($appointment->status)] ?? 'bg-gray-100 text-gray-800';
                                                                @endphp
                                                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                                                    {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                                                                </span>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <div class="flex items-center">
                                                                    @if($appointment->veterinarian && $appointment->veterinarian->user)
                                                                        <div
                                                                            class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center">
                                                                            <span class="text-indigo-600 dark:text-indigo-300 font-medium">
                                                                                {{ substr($appointment->veterinarian->user->name, 0, 1) }}
                                                                            </span>
                                                                        </div>
                                                                        <div class="ml-4">
                                                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                                                {{ $appointment->veterinarian->user->name }}
                                                                            </div>
                                                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                                                {{ $appointment->veterinarian->specialty ?? 'Veterinarian' }}
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <span class="text-sm text-gray-500 dark:text-gray-400">Not assigned</span>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <div class="flex items-center">
                                                                    <span
                                                                        class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full
                                                                                                                                            {{ $appointment->status === 'scheduled'
                                        ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300'
                                        : ($appointment->status === 'completed'
                                            ? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200'
                                            : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300') }}">
                                                                        {{ ucfirst($appointment->status) }}
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                                <div class="flex justify-end space-x-2">
                                                                    <button wire:click="$emit('showAppointmentModal', {{ $appointment->id }})"
                                                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 p-1.5 rounded-full hover:bg-indigo-50 dark:hover:bg-indigo-900/30 transition-colors duration-150"
                                                                        title="View details">
                                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                        </svg>
                                                                    </button>
                                                                    <button wire:click="$emit('editAppointment', {{ $appointment->id }})"
                                                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 p-1.5 rounded-full hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors duration-150"
                                                                        title="Edit appointment">
                                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                        </svg>
                                                                    </button>
                                                                    <button wire:click="$emit('confirmDeleteAppointment', {{ $appointment->id }})"
                                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 p-1.5 rounded-full hover:bg-red-50 dark:hover:bg-red-900/30 transition-colors duration-150"
                                                                        title="Delete appointment">
                                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div
                            class="px-6 py-3 bg-gray-50 dark:bg-gray-700/50 text-right border-t border-gray-200 dark:border-gray-700">
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Showing {{ $pet->appointments->count() }}
                                {{ Str::plural('appointment', $pet->appointments->count()) }}
                            </p>
                        </div>
                    @else
                    <div class="p-8 text-center">
                        <div
                            class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-indigo-50 dark:bg-indigo-900/20">
                            <svg class="h-12 w-12 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No appointments found</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 max-w-md mx-auto">
                            Get started by scheduling a new appointment for {{ $pet->name }}.
                        </p>
                        <div class="mt-6">
                            <button type="button" wire:click="$set('showAddModal', true)"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Schedule Appointment
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        /* Hide scrollbar for Chrome, Safari and Opera */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .no-scrollbar {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }
    </style>

    <!-- Edit Appointment Modal -->
    <x-dialog-modal wire:model.live="showEditModal">
        <x-slot name="title">
            {{ __('Edit Appointment') }}
        </x-slot>

        <x-slot name="content">
            <div class="space-y-4">
                <!-- Start Time -->
                <div>
                    <x-label for="startTimeToEdit" value="{{ __('Start Time') }}" />
                    <x-input id="startTimeToEdit" type="datetime-local" class="mt-1 block w-full"
                        wire:model="startTimeToEdit" required />
                    <x-input-error for="startTimeToEdit" class="mt-1" />
                </div>

                <!-- Status -->
                <div>
                    <x-label for="statusToEdit" value="{{ __('Status') }}" />
                    <select id="statusToEdit" wire:model="statusToEdit"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm">
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <x-input-error for="statusToEdit" class="mt-1" />
                </div>

                <!-- Notes -->
                <div>
                    <x-label for="notesToEdit" value="{{ __('Notes') }}" />
                    <x-input id="notesToEdit" type="text" class="mt-1 block w-full" wire:model="notesToEdit" />
                    <x-input-error for="notesToEdit" class="mt-1" />
                </div>

                <!-- Veterinarian -->
                <div>
                    <x-label for="veterinarianIdToEdit" value="{{ __('Veterinarian') }}" />
                    <select id="veterinarianIdToEdit" wire:model="veterinarianIdToEdit"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm">
                        @foreach($veterinarians as $vet)
                            <option value="{{ $vet->id }}">
                                {{ $vet->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error for="veterinarianIdToEdit" class="mt-1" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showEditModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3" wire:click="updateAppointment" wire:loading.attr="disabled">
                {{ __('Update Appointment') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Add Appointment Modal -->
    <x-dialog-modal wire:model.live="showAddModal">
        <x-slot name="title">
            {{ __('Add New Appointment') }}
        </x-slot>

        <x-slot name="content">
            <div class="space-y-4">
                <!-- Veterinarian -->
                <div>
                    <x-label for="veterinarianIdToAdd" value="{{ __('Veterinarian') }}" />
                    <select id="veterinarianIdToAdd"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                        wire:model="veterinarianIdToAdd" required>
                        <option value="">Select a veterinarian</option>
                        @foreach($veterinarians as $vet)
                            <option value="{{ $vet->id }}">{{ $vet->name }} {{ $vet->id }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="veterinarianIdToAdd" class="mt-1" />
                </div>

                <!-- Start Time -->
                <div>
                    <x-label for="startTimeToAdd" value="{{ __('Start Time') }}" />
                    <x-input id="startTimeToAdd" type="datetime-local" class="mt-1 block w-full"
                        wire:model="startTimeToAdd" required />
                    <x-input-error for="startTimeToAdd" class="mt-1" />
                </div>

                <!-- Notes -->
                <div>
                    <x-label for="notesToAdd" value="{{ __('Notes') }}" />
                    <textarea id="notesToAdd"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                        wire:model="notesToAdd" rows="3"></textarea>
                    <x-input-error for="notesToAdd" class="mt-1" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showAddModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3" wire:click="addAppointment" wire:loading.attr="disabled">
                {{ __('Add Appointment') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
