{{-- resources/views/submissions/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Submissão:') }} {{ $submission->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow px-6 py-4 sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $submission->title }}</h3>
                <p class="text-gray-700">{{ $submission->description ?? __('(Sem descrição)') }}</p>
            </div>

            <div class="bg-white shadow px-6 py-4 sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('Anexos') }}</h3>
                @if($submission->attachments->isEmpty())
                    <p class="text-gray-600">{{ __('Nenhum arquivo anexado.') }}</p>
                @else
                    <ul class="list-disc list-inside">
                        @foreach($submission->attachments as $file)
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

            <div class="flex justify-end space-x-3">
                <!-- Editar passa pelo time também -->
                <a href="{{ route('teams.submissions.edit', [$team, $submission]) }}"
                    class="px-4 py-2 bg-yellow-500 …">
                    {{ __('Editar') }}
                </a>

                <!-- Voltar à lista de submissões da equipe -->
                <a href="{{ route('teams.submissions.index', $team) }}"
                    class="px-4 py-2 bg-gray-300 …">
                    {{ __('Voltar') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
