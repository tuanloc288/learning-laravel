@props(['job'])

<x-card>
    <div class="flex">
        <img class="hidden w-48 mr-6 md:block"
            {{-- 
                use php artisan storage:link
                then we can access image in app/public/logos through website
                /storage/logos/imgName
            --}}
            src="{{ $job->logo ? asset('storage/' . $job->logo) : asset('/images/no-image.png') }}" alt="logo" />
        <div>
            <h3 class="text-2xl">
                <a href="/jobs/{{ $job->id }}">{{ $job->title }}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{ $job->company }}</div>
            <x-job-tags :tagsCsv="$job->tags" />
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot">
                    {{ $job->location }}
                </i>
            </div>
        </div>
    </div>
</x-card>
