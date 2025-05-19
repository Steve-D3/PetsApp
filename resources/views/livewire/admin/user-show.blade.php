<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">User Details</h2>
                    <div class="flex space-x-4">
                        <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Users
                        </a>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Information</h3>
                                <div class="space-y-6">
                                    <div class="flex items-center space-x-4">
                                        <span class="text-gray-500 dark:text-gray-400 w-24">Name:</span>
                                        <span class="font-medium text-gray-900 dark:text-white">{{ $user->name }}</span>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="text-gray-500 dark:text-gray-400 w-24">Email:</span>
                                        <span class="font-medium text-gray-900 dark:text-white">{{ $user->email }}</span>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="text-gray-500 dark:text-gray-400 w-24">Role:</span>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="text-gray-500 dark:text-gray-400 w-24">Last Login:</span>
                                        <span class="font-medium text-gray-900 dark:text-white">
                                            {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Pets</h3>
                                @if($user->pets->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($user->pets as $pet)
                                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200 cursor-pointer">
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex-1">
                                                        <div class="flex items-center space-x-2">
                                                            <span class="text-gray-900 dark:text-white font-medium">{{ $pet->name }}</span>
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300">
                                                                {{ $pet->species }}
                                                            </span>
                                                        </div>
                                                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                            {{ $pet->breed }}
                                                        </div>
                                                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                            <span class="font-medium">Weight:</span> {{ $pet->weight }} kg
                                                        </div>
                                                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                            <span class="font-medium">Gender:</span> {{ ucfirst($pet->gender) }}
                                                        </div>
                                                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                            <span class="font-medium">Birth Date:</span> {{ $pet->birth_date ? $pet->birth_date->format('M d, Y') : 'Unknown' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-12">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 11-1.732 2.899L15 21H9l-1.268-1.267A3 3 0 013 17V10z" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No pets registered</h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                            This user hasn't registered any pets yet.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
