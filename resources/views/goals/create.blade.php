<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Goal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('goals.store') }}" method="POST" class="p-6">
                    @csrf

                    <div class="mb-6">
                        <x-input-label for="title" :value="__('Goal Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required placeholder="e.g., Recycle every day for a week" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="description" :value="__('Description (optional)')" />
                        <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3" placeholder="Describe your goal..."></textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="target_count" :value="__('Target Count')" />
                        <x-text-input id="target_count" name="target_count" type="number" class="mt-1 block w-full" required min="1" value="1" />
                        <x-input-error class="mt-2" :messages="$errors->get('target_count')" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="deadline" :value="__('Deadline (optional)')" />
                        <x-text-input id="deadline" name="deadline" type="date" class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('deadline')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button type="submit">Create Goal</x-primary-button>
                        <a href="{{ route('goals.index') }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
