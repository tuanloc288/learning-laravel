<x-layout>

    <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="mx-4">
        <x-card>
            <div class="flex flex-col items-center justify-center text-center">
                <img class="w-48 mr-6 mb-6"
                    src="{{ $job->logo ? asset('storage/' . $job->logo) : asset('/images/no-image.png') }}"
                    alt="logo" />

                <h3 class="text-2xl mb-2">{{ $job->title }}</h3>
                <div class="text-xl font-bold mb-4">{{ $job->company }}</div>
                <x-job-tags :tagsCsv="$job->tags" />
                <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i> {{ $job->location }}
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        Job Description
                    </h3>
                    <div class="text-lg space-y-6">
                        {{ $job->description }}

                        <a href="mailto:{{ $job->email }}"
                            class="block bg-laravel text-white mt-6 p-2 rounded-xl hover:opacity-80">
                            <i class="fa-solid fa-envelope">
                                Contact Employer
                            </i>
                        </a>

                        <a href="{{ $job->website }}" target="_blank"
                            class="block bg-black text-white py-2 rounded-xl hover:opacity-80">
                            <i class="fa-solid fa-globe">
                                Visit Website
                            </i>
                        </a>
                    </div>
                </div>
            </div>
        </x-card>

        @if ($job->user_id === auth()->id())
            <x-card class="mt-4 p-2 flex justify-around">
                <a href="/jobs/{{ $job->id }}/edit">
                    <i class="fa-solid fa-pencil">Edit</i>
                </a>

                <form method="POST" action="/jobs/{{ $job->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500">
                        <i class="fa-solid fa-trash">
                            Delete
                        </i>
                    </button>
                </form>
            </x-card>
        @endif
    </div>

</x-layout>
