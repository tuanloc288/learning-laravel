<x-layout>

    @include('partials._hero')
    @include('partials._search')

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @unless (count($jobs) === 0)
            @foreach ($jobs as $job)
                <x-job-card :job="$job" />
                {{-- need that : if u want to pass a variable --}}
            @endforeach
        @else
            <p> No jobs found</p>
        @endunless

    </div>

    {{-- 
        div for pagination
        use link() combine with paginate() in controller
    --}}
    <div class="mt-6 p-4">
        {{$jobs->links()}} 
    </div>
</x-layout>
