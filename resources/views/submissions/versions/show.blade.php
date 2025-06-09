{{-- resources/views/submissions/versions/show.blade.php --}}
<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __("Submissão:") }} {{ $submission->title }} —
      {{ __("Versão #:n", ["n"=>$version->version_number]) }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

      {{-- Change log completo --}}
      @if($version->change_log)
        <div class="bg-white shadow px-6 py-4 sm:rounded-lg">
          <h3 class="font-medium">{{ __('Alterações') }}</h3>
          <p class="mt-2 text-gray-700 whitespace-pre-line">
            {{ $version->change_log }}
          </p>
        </div>
      @endif

      {{-- Anexos desta versão --}}
      <div class="bg-white shadow px-6 py-4 sm:rounded-lg">
        <h3 class="font-medium">{{ __('Anexos') }}</h3>
        @if($version->attachments->isEmpty())
          <p class="mt-2 text-gray-600">{{ __('Nenhum arquivo nesta versão.') }}</p>
        @else
          <ul class="list-disc list-inside mt-2">
            @foreach($version->attachments as $file)
              <li class="mb-1">
                <a href="{{ Storage::url($file->path) }}"
                   class="text-blue-600 hover:underline"
                   target="_blank">
                  {{ $file->original_name }}
                </a>
              </li>
            @endforeach
          </ul>
        @endif
      </div>

      {{-- Comentários da versão --}}
      <div class="bg-white shadow px-6 py-4 sm:rounded-lg">
        <h3 class="text-lg font-medium mb-4">{{ __('Comentários') }}</h3>

        @if($version->comments->isEmpty())
          <p class="text-gray-600">{{ __('Sem comentários ainda.') }}</p>
        @else
          <ul class="space-y-4">
            @foreach($version->comments as $comment)
              <li class="border border-gray-200 rounded-md p-4">
                <div class="flex justify-between items-center">
                  <span class="font-medium">{{ $comment->user->name }}</span>
                  <span class="text-sm text-gray-500">
                    {{ $comment->created_at->format('d/m/Y H:i') }}
                  </span>
                </div>
                <p class="mt-2 text-gray-700 whitespace-pre-line">{{ $comment->body }}</p>
              </li>
            @endforeach
          </ul>
        @endif

        {{-- Formulário de novo comentário --}}
        <form action="{{ route(
            'teams.submissions.versions.comments.store',
            [$team, $submission, $version]
          ) }}"
          method="POST"
          class="mt-6"
        >
          @csrf
          <textarea
            name="body"
            rows="3"
            required
            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('body') border-red-500 @enderror"
            placeholder="{{ __('Escreva seu comentário...') }}"
          >{{ old('body') }}</textarea>
          @error('body')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
          @enderror

          <div class="flex justify-end mt-2">
            <button
              type="submit"
              class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500"
            >
              {{ __('Comentar') }}
            </button>
          </div>
        </form>
      </div>

      {{-- Botão de voltar --}}
      <div class="flex justify-end space-x-3">
        <a href="{{ route('teams.submissions.show', [$team, $submission]) }}"
           class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-200">
          {{ __('Voltar') }}
        </a>
      </div>
    </div>
  </div>
</x-app-layout>
