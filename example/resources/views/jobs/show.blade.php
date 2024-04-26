<x-layout>
    <x-slot:heading>
        Job
    </x-slot:heading>

    <h2 class="font-bold text-lg">{{ $job->title }}</h2>

    <p>
        This job pays {{ $job->salary }} per year.
    </p>

    <p class="mt-6">
        <a href="/jobs/{{$job->id}}/edit">Edit</a>
    </p>
</x-layout>