{{-- resources/views/teams/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Minhas Equipes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('teams.create') }}"
               class="mb-6 inline-block px-4 py-2 bg-blue-600 text-white rounded">
                Criar Nova Equipe
            </a>

            @if($teams->isEmpty())
                <p>Você ainda não faz parte de nenhuma equipe.</p>
            @else
                <ul class="bg-white shadow overflow-hidden sm:rounded-lg">
                    @foreach($teams as $team)
                        <li class="border-t last:border-b">
                            <a href="{{ route('teams.show', $team) }}"
                               class="block px-4 py-2 hover:bg-gray-50">
                                {{ $team->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>
