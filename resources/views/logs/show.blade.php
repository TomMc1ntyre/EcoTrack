<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Log Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-6">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">Category</span>
                    <p class="text-xl font-bold mt-1">{{ $log->category->name }}</p>
                </div>

                <div class="mb-6">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">Description</span>
                    <p class="mt-1">{{ $log->description ?? '-' }}</p>
                </div>

                <div class="mb-6">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">Points Earned</span>
                    <p class="text-2xl font-bold text-green-600 mt-1">+{{ $log->points_earned }}</p>
                </div>

                <div class="mb-6">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">Logged At</span>
                    <p class="mt-1">{{ $log->logged_at->format('M d, Y H:i') }}</p>
                </div>

                <div class="flex gap-4 mt-6">
                    <a href="{{ route('logs.index') }}" class="text-blue-600 hover:text-blue-900">Back to Actions</a>
                    <form action="{{ route('logs.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
