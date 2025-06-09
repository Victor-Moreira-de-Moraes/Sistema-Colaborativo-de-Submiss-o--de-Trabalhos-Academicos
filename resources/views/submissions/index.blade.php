{{-- resources/views/submissions/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Submissões da Equipe:') }} {{ $team->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('teams.submissions.create', $team) }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500">
                    + Nova Submissão
                </a>
            </div>

            @if($subs->isEmpty())
                <p class="text-gray-600">Nenhuma submissão ainda.</p>
            @else
                <ul class="bg-white shadow overflow-hidden sm:rounded-lg divide-y divide-gray-200">
                    @foreach($subs as $sub)
                        <li class="…">
                            <!-- Link para ver -->
                            <a href="{{ route('teams.submissions.show', [$team, $sub]) }}"
                                class="text-blue-600 hover:underline">
                                {{ $sub->title }}
                            </a>
                            <!-- Data… -->
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>
