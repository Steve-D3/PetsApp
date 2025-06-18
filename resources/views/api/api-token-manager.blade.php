<div class="space-y-8">
    <!-- Generate API Token -->
    <div
        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
        <div class="p-6 sm:p-8">
            <div class="mb-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Create API Token') }}
                </h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('API tokens allow third-party services to authenticate with our application on your behalf.') }}
                </p>
            </div>

            <form wire:submit.prevent="createApiToken" class="space-y-6">
                <!-- Token Name -->
                <div class="space-y-2">
                    <x-label for="name" value="{{ __('Token Name') }}"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300" />
                    <div class="relative">
                        <x-input id="name" type="text"
                            class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700/50 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 dark:focus:ring-indigo-500/50 transition duration-150"
                            wire:model="createApiTokenForm.name" autofocus placeholder="e.g. Production Server" />
                        <x-input-error for="name" class="mt-1" />
                    </div>
                </div>

                <!-- Token Permissions -->
                @if (Laravel\Jetstream\Jetstream::hasPermissions())
                    <div class="space-y-3">
                        <x-label for="permissions" value="{{ __('Permissions') }}"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <div
                            class="grid grid-cols-1 md:grid-cols-2 gap-3 p-3 bg-gray-50 dark:bg-gray-700/30 rounded-lg border border-gray-200 dark:border-gray-700">
                            @foreach (Laravel\Jetstream\Jetstream::$permissions as $permission)
                                <label
                                    class="flex items-start space-x-3 p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors cursor-pointer">
                                    <x-checkbox wire:model="createApiTokenForm.permissions" :value="$permission"
                                        class="h-4 w-4 mt-0.5 text-indigo-600 dark:text-indigo-400 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-0" />
                                    <span class="text-sm text-gray-700 dark:text-gray-300">
                                        {{ $permission }}
                                        @if($permission === 'read')
                                            <span class="block text-xs text-gray-500 dark:text-gray-400 mt-0.5">View resources
                                                only</span>
                                        @elseif($permission === 'create')
                                            <span class="block text-xs text-gray-500 dark:text-gray-400 mt-0.5">Create and update
                                                resources</span>
                                        @elseif($permission === 'update')
                                            <span class="block text-xs text-gray-500 dark:text-gray-400 mt-0.5">Update
                                                resources</span>
                                        @elseif($permission === 'delete')
                                            <span class="block text-xs text-gray-500 dark:text-gray-400 mt-0.5">Remove
                                                resources</span>
                                        @endif
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2">
                    <x-action-message on="created" class="text-sm font-medium text-green-600 dark:text-green-400">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ __('Token created successfully!') }}
                        </div>
                    </x-action-message>
                    <x-button type="submit"
                        class="w-full sm:w-auto justify-center bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-600 dark:hover:bg-indigo-700 text-white focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 transition-colors">
                        {{ __('Create API Token') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>

    @if ($this->user->tokens->isNotEmpty())
        <!-- Manage API Tokens -->
        <div
            class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
            <div class="p-6 sm:p-8">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ __('Manage API Tokens') }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('You may delete any of your existing tokens if they are no longer needed.') }}
                    </p>
                </div>

                <!-- API Token List -->
                <div class="space-y-3">
                    @foreach ($this->user->tokens->sortBy('name') as $token)
                        <div
                            class="flex flex-col sm:flex-row sm:items-center justify-between p-4 bg-gray-50 dark:bg-gray-700/30 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-100/50 dark:hover:bg-gray-700/50 transition-colors">
                            <div class="mb-2 sm:mb-0">
                                <div class="font-medium text-gray-900 dark:text-gray-100 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                    </svg>
                                    {{ $token->name }}
                                </div>
                                @if ($token->last_used_at)
                                    <div class="mt-1 text-xs text-gray-500 dark:text-gray-400 flex items-center">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ __('Last used') }} {{ $token->last_used_at->diffForHumans() }}
                                    </div>
                                @else
                                    <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        {{ __('Never used') }}
                                    </div>
                                @endif
                            </div>

                            <div class="flex items-center space-x-3 sm:space-x-4">
                                @if (Laravel\Jetstream\Jetstream::hasPermissions())
                                    <button
                                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 dark:bg-indigo-900/30 dark:text-indigo-300 dark:hover:bg-indigo-800/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors"
                                        wire:click="manageApiTokenPermissions({{ $token->id }})">
                                        {{ __('Permissions') }}
                                    </button>
                                @endif

                                <button
                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-800/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors"
                                    wire:click="confirmApiTokenDeletion({{ $token->id }})">
                                    {{ __('Delete') }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Token Value Modal -->
    <!-- API Token Display Modal -->
    <x-dialog-modal wire:model.live="displayingToken">
        <x-slot name="title">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <span class="text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('API Token Created') }}
                </span>
            </div>
        </x-slot>

        <x-slot name="content">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ __('Please copy your new API token. For your security, it won\'t be shown again.') }}
            </p>

            <div class="mt-4">
                <div class="relative">
                    <input x-ref="plaintextToken" type="text" readonly :value="$plainTextToken"
                        class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm font-mono text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        autofocus autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                        @showing-token-modal.window="setTimeout(() => { $refs.plaintextToken.select(); document.execCommand('copy'); }, 250)" />
                    <button x-data="{ copied: false }"
                        @click="navigator.clipboard.writeText('{{ $plainTextToken }}'); copied = true; setTimeout(() => copied = false, 2000)"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                        <span x-show="!copied">Copy</span>
                        <span x-show="copied" class="text-green-600 dark:text-green-400">Copied!</span>
                    </button>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end">
                <button type="button" wire:click="$set('displayingToken', false)" wire:loading.attr="disabled"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    {{ __('Close') }}
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>

    <!-- API Token Permissions Modal -->
    <x-dialog-modal wire:model.live="managingApiTokenPermissions">
        <x-slot name="title">
            {{ __('API Token Permissions') }}
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach (Laravel\Jetstream\Jetstream::$permissions as $permission)
                    <label class="flex items-center">
                        <x-checkbox wire:model="updateApiTokenForm.permissions" :value="$permission" />
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ $permission }}</span>
                    </label>
                @endforeach
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('managingApiTokenPermissions', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="updateApiToken" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Delete Token Confirmation Modal -->
    <x-confirmation-modal wire:model.live="confirmingApiTokenDeletion">
        <x-slot name="title">
            {{ __('Delete API Token') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you would like to delete this API token?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingApiTokenDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="deleteApiToken" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
