<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-3xl font-bold text-green-600">{{ $totalPoints }}</div>
                    <div class="text-gray-500 dark:text-gray-400">Total Points</div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-3xl font-bold text-blue-600">{{ $totalLogs }}</div>
                    <div class="text-gray-500 dark:text-gray-400">Actions Logged</div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-3xl font-bold text-purple-600">{{ $activeGoals }}</div>
                    <div class="text-gray-500 dark:text-gray-400">Active Goals</div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <a href="{{ route('logs.create') }}" class="text-3xl font-bold text-green-600 hover:underline">+</a>
                    <div class="text-gray-500 dark:text-gray-400">Log Action</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Recent Actions</h3>
                    @if($recentLogs->isEmpty())
                        <p class="text-gray-500">No actions logged yet. Start tracking your sustainable habits!</p>
                    @else
                        <table class="w-full">
                            <thead>
                                <tr class="text-left border-b">
                                    <th class="pb-2">Category</th>
                                    <th class="pb-2">Description</th>
                                    <th class="pb-2">Points</th>
                                    <th class="pb-2">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentLogs as $log)
                                <tr class="border-b last:border-0">
                                    <td class="py-2">{{ $log->category->name }}</td>
                                    <td class="py-2">{{ $log->description ?? '-' }}</td>
                                    <td class="py-2 text-green-600">+{{ $log->points_earned }}</td>
                                    <td class="py-2 text-gray-500">{{ $log->logged_at->format('M d, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('logs.index') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg text-center">
                    View All Logs
                </a>
                <a href="{{ route('goals.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-center">
                    Manage Goals
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
