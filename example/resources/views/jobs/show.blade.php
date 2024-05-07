<x-layout>
    <x-slot:heading>
        Job
    </x-slot:heading>

    <h2 class="font-bold text-lg">{{ $job->title }}</h2>

    <p>
        This job pays {{ $job->salary }} per year.
    </p>

    @can('edit-job', $job)
        <p class="mt-6">
            <a href="/jobs/{{$job->id}}/edit">Edit</a>
        </p>
    @endcan
</x-layout>