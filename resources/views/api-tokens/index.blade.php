<x-app-layout>

    <header class="mb-8 pt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="pb-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex flex-col space-y-2 sm:space-y-0 sm:flex-row sm:items-center sm:justify-between">
                    <div class="space-y-1">
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-3xl">
                            {{ __('API Tokens') }}
                        </h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400 max-w-2xl">
                            {{ __('Generate and manage API tokens for secure access to your account.') }}
                        </p>
                    </div>
                    <div class="flex items-center">
                        <a href="{{ route('profile.show') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-600 dark:hover:bg-indigo-500 dark:focus:ring-indigo-400 transition-colors duration-150">
                            <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            {{ __('Back to Profile') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <div class="pt-2 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-6">
                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <div
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
                        <div class="p-6 sm:p-8">
                            <div class="relative z-10">
                                @livewire('api.api-token-manager')
                            </div>
                        </div>
                    </div>
                @else
                    <div class="rounded-lg bg-yellow-50 dark:bg-yellow-900/20 p-4 border-l-4 border-yellow-400">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-100">
                                    {{ __('API Features Are Disabled') }}
                                </h3>
                                <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-200">
                                    <p>
                                        {{ __('To use API tokens, please enable the API features in your Jetstream configuration.') }}
                                    </p>
                                    <div class="mt-2">
                                        <a href="https://jetstream.laravel.com/2.x/features/api.html#enabling-api-support"
                                            target="_blank"
                                            class="inline-flex items-center text-yellow-700 dark:text-yellow-200 hover:text-yellow-900 dark:hover:text-yellow-100 font-medium">
                                            {{ __('Learn more') }}
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- API Documentation Link -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 pt-0.5">
                                <svg class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                    {{ __('API Documentation') }}
                                </h3>
                                <div class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                    <p>
                                        {{ __('Need help integrating with our API? Check out our comprehensive documentation for detailed guides and examples.') }}
                                    </p>
                                    <div class="mt-3">
                                        <a href="https://petdashboard-app-sdkgp.ondigitalocean.app/docs/api#"
                                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 dark:bg-indigo-900/30 dark:text-indigo-200 dark:hover:bg-indigo-800/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                            {{ __('View API Documentation') }}
                                            <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
