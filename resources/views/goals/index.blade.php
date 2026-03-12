<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Goals') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between mb-6">
                <h3 class="text-lg font-semibold">All Goals</h3>
                <a href="{{ route('goals.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Create Goal
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($goals as $goal)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h4 class="font-semibold text-lg">{{ $goal->title }}</h4>
                        @if($goal->status === 'completed')
                            <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded">Completed</span>
                        @elseif($goal->status === 'cancelled')
                            <span class="bg-gray-100 text-gray-800 text-xs font-bold px-2 py-1 rounded">Cancelled</span>
                        @else
                            <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded">Active</span>
                        @endif
                    </div>
                    <p class="text-gray-500 text-sm mb-4">{{ $goal->description ?? 'No description' }}</p>
                    <div class="mb-4">
                        <div class="flex justify-between text-sm mb-1">
                            <span>Progress</span>
                            <span>{{ $goal->current_count }} / {{ $goal->target_count }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            @php $width = min(($goal->current_count / $goal->target_count) * 100, 100); @endphp
                            <div class="bg-green-600 h-2 rounded-full" style="width: {{ $width }}%"></div>
                        </div>
                    </div>
                    @if($goal->deadline)
                        <p class="text-gray-500 text-sm mb-4">Deadline: {{ $goal->deadline->format('M d, Y') }}</p>
                    @endif
                    <div class="flex gap-2">
                        <a href="{{ route('goals.show', $goal->id) }}" class="text-blue-600 hover:text-blue-900 text-sm">View</a>
                        @if($goal->status === 'active')
                            <form action="{{ route('goals.update', $goal->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="title" value="{{ $goal->title }}">
                                <input type="hidden" name="description" value="{{ $goal->description }}">
                                <input type="hidden" name="target_count" value="{{ $goal->target_count }}">
                                <input type="hidden" name="current_count" value="{{ $goal->current_count + 1 }}">
                                <input type="hidden" name="status" value="{{ $goal->current_count + 1 >= $goal->target_count ? 'completed' : 'active' }}">
                                <input type="hidden" name="deadline" value="{{ $goal->deadline }}">
                                <button type="submit" class="text-green-600 hover:text-green-900 text-sm ml-2">+1 Progress</button>
                            </form>
                        @endif
                        <form action="{{ route('goals.destroy', $goal->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm ml-2">Delete</button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    No goals yet. Create one to start tracking your progress!
                </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $goals->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
