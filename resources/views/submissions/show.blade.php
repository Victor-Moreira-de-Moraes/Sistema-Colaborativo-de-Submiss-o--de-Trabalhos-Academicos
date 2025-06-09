{{-- resources/views/submissions/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Submissão:') }} {{ $submission->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Detalhes da submissão --}}
            <div class="bg-white shadow px-6 py-4 sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $submission->title }}</h3>
                <p class="text-gray-700">{{ $submission->description ?? __('(Sem descrição)') }}</p>
            </div>

            {{-- Anexos da versão atual --}}
            <div class="bg-white shadow px-6 py-4 sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('Anexos') }}</h3>

                @if( ! $submission->currentVersion || $submission->currentVersion->attachments->isEmpty() )
                    <p class="text-gray-600">{{ __('Nenhum arquivo anexado nesta versão.') }}</p>
                @else
                    <ul class="list-disc list-inside">
                        @foreach($submission->currentVersion->attachments as $file)
                            <li class="mb-1">
                                <a href="{{ Storage::url($file->path) }}"
                                class="text-blue-600 hover:underline" target="_blank">
                                    {{ $file->original_name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- Informações da submissão --}}  

            {{-- Histórico de versões --}}
            <div class="bg-white shadow px-6 py-4 sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('Histórico de Versões') }}</h3>
                @if($submission->versions->isEmpty())
                    <p class="text-gray-600">{{ __('Nenhuma versão anterior.') }}</p>
                @else
                    <ul class="divide-y divide-gray-200">
                        @foreach($submission->versions as $version)
                            <li class="py-2">
                                <a href="{{ route('teams.submissions.versions.show', [$team, $submission, $version]) }}"
                                    class="flex justify-between hover:bg-gray-50 px-4 py-2 rounded">
                                    <div>
                                        <strong>{{ __('Versão #:n', ['n'=>$version->version_number]) }}</strong>
                                        @if($version->change_log)
                                        — {{ Str::limit($version->change_log, 50) }}
                                        @endif
                                    </div>
                                    <span class="text-sm text-gray-500">{{ $version->created_at->format('d/m/Y') }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <div class="mt-4">
                    <a href="{{ route('teams.submissions.versions.create', [$team, $submission]) }}"
                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-500">
                        + {{ __('Nova Versão') }}
                    </a>
                </div>
            </div>

            {{-- Ações Editar/Voltar --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('teams.submissions.edit', [$team, $submission]) }}"
                   class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-400">
                    {{ __('Editar') }}
                </a>
                <a href="{{ route('teams.submissions.index', $team) }}"
                   class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-200">
                    {{ __('Voltar') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
