<x-layout>
    <x-card class="p-10">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">
                Manage Gigs
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody class="border-gray-300 border-2">
                @unless ($jobs->isEmpty())
                    <tr class="">
                        <th class="px-4 py-8 text-lg">
                            Position
                        </th>
                        <th class="px-4 py-8 text-lg">
                            Company
                        </th>
                        <th class="px-4 py-8 text-lg">
                            Edit
                        </th>
                        <th class="px-4 py-8 text-lg">
                            Delete
                        </th>
                    </tr>
                    @foreach ($jobs as $job)
                        <tr class="text-center border-t border-gray-300">
                            <td class="px-4 py-8 text-lg">
                                <a href="/jobs/{{$job->id}}">
                                    {{ $job->title }}
                                </a>
                            </td>
                            <td class="px-4 py-8 text-lg">
                                <a href="/jobs/{{$job->id}}">
                                    {{ $job->company }}
                                </a>
                            </td>
                            <td class="px-4 py-8 text-lg">
                                <a href="/jobs/{{ $job->id }}/edit" class="text-blue-400 px-6 py-2 rounded-xl">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Edit
                                </a>
                            </td>
                            <td class="px-4 py-8 text-lg">
                                <form method="POST" action="/jobs/{{ $job->id }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500">
                                    <i class="fa-solid fa-trash">
                                        Delete
                                    </i>
                                </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="border-gray-300">
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <p class="text-center">
                                No jobs found
                            </p>
                        </td>
                    </tr>
                @endunless
            </tbody>
        </table>
    </x-card>
</x-layout>
