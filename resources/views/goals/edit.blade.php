<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Goal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('goals.update', $goal->id) }}" method="POST" class="p-6">
                    @csrf
                    @method('PATCH')

                    <div class="mb-6">
                        <x-input-label for="title" :value="__('Goal Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required value="{{ $goal->title }}" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3">{{ $goal->description }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <x-input-label for="target_count" :value="__('Target Count')" />
                            <x-text-input id="target_count" name="target_count" type="number" class="mt-1 block w-full" required min="1" value="{{ $goal->target_count }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('target_count')" />
                        </div>
                        <div>
                            <x-input-label for="current_count" :value="__('Current Progress')" />
                            <x-text-input id="current_count" name="current_count" type="number" class="mt-1 block w-full" required min="0" value="{{ $goal->current_count }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('current_count')" />
                        </div>
                    </div>

                    <div class="mb-6">
                        <x-input-label for="status" :value="__('Status')" />
                        <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="active" {{ $goal->status === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="completed" {{ $goal->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $goal->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="deadline" :value="__('Deadline')" />
                        <x-text-input id="deadline" name="deadline" type="date" class="mt-1 block w-full" value="{{ $goal->deadline?->format('Y-m-d') }}" />
                        <x-input-error class="mt-2" :messages="$errors->get('deadline')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button type="submit">Update Goal</x-primary-button>
                        <a href="{{ route('goals.index') }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
