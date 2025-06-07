<x-layout>
    <x-slot:heading>
        <div class="flex items-center justify-between mt-6">
            <h1 class="text-3xl font-bold">Job Listings</h1>
            <x-button href="/jobs/create">Create Job</x-button>
        </div>
    </x-slot:heading>

    <div class="space-y-4">
        @foreach ($jobs as $job)
            <a href="/jobs/{{ $job['id'] }}" class="block px-4 py-6 border border-gray-200 rounded-lg">
                <div class="font-bold text-blue-500 text-sm">{{ $job->employer->name }}</div>

                <div>
                    <strong>{{ $job['title'] }}:</strong> Pays {{ $job['salary'] }} per year.
                </div>
            </a>
        @endforeach
            {{$jobs->links('pagination::tailwind')}}
    </div>
    <div >
        <p class="mt-6">
            <x-button href="/jobs/create">Create Job</x-button>
        </p>
    </div>

</x-layout>
