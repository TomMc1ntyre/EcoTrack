<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Goal Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">{{ $goal->title }}</h3>
                        @if($goal->status === 'completed')
                            <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded">Completed</span>
                        @elseif($goal->status === 'cancelled')
                            <span class="bg-gray-100 text-gray-800 text-xs font-bold px-2 py-1 rounded">Cancelled</span>
                        @else
                            <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded">Active</span>
                        @endif
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('goals.edit', $goal->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Edit</a>
                        <form action="{{ route('goals.destroy', $goal->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </form>
                    </div>
                </div>

                <p class="text-gray-600 mb-6">{{ $goal->description ?? 'No description' }}</p>

                <div class="mb-6">
                    <div class="flex justify-between text-sm mb-1">
                        <span>Progress</span>
                        <span>{{ $goal->current_count }} / {{ $goal->target_count }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        @php $width = min(($goal->current_count / $goal->target_count) * 100, 100); @endphp
                        <div class="bg-green-600 h-4 rounded-full" style="width: {{ $width }}%"></div>
                    </div>
                </div>

                @if($goal->deadline)
                    <p class="text-gray-500">Deadline: {{ $goal->deadline->format('M d, Y') }}</p>
                @endif

                <div class="mt-6">
                    <a href="{{ route('goals.index') }}" class="text-blue-600 hover:text-blue-900">Back to Goals</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
