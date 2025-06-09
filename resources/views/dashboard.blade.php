{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

      {{-- Card geral --}}
      <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{ __('Visão Geral das Equipes') }}
          </h3>
          <p class="mt-1 text-sm text-gray-500">
            {{ __('Veja aqui quantas submissões cada equipe já fez e quando foi a última.') }}
          </p>
        </div>

        <div class="border-t border-gray-200">
          @if($teams->isEmpty())
            <p class="p-4 text-gray-600">{{ __('Você ainda não faz parte de nenhuma equipe.') }}</p>
          @else
            <ul>
              @foreach($teams as $team)
                <li class="flex justify-between items-center bg-white px-4 py-4 sm:px-6 {{ $loop->last ? '' : 'border-b' }}">
                  <div>
                    <a href="{{ route('teams.show', $team) }}"
                       class="text-lg font-semibold text-blue-600 hover:underline">
                      {{ $team->name }}
                    </a>
                    <p class="text-sm text-gray-500">
                      {{ trans_choice(':count submissão|:count submissões', $team->submissions_count) }}
                    </p>
                  </div>
                  <div class="text-right">
                    <p class="text-sm text-gray-700">
                      {{ $team->last_submission_at
                          ? $team->last_submission_at->format('d/m/Y H:i')
                          : __('— Sem submissões') }}
                    </p>
                    <a href="{{ route('teams.submissions.index', $team) }}"
                       class="mt-1 inline-block text-sm text-indigo-600 hover:underline">
                      {{ __('Ver Submissões') }}
                    </a>
                  </div>
                </li>
              @endforeach
            </ul>
          @endif
        </div>
      </div>

    </div>
  </div>
</x-app-layout>
