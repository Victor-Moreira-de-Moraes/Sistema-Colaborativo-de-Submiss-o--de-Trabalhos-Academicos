<x-app-layout>
  <x-slot name="header">
    <h2>Nova Versão para: {{ $submission->title }}</h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
      <form action="{{ route('teams.submissions.versions.store', [$team, $submission]) }}"
            method="POST" enctype="multipart/form-data"
            class="bg-white shadow px-6 py-4 sm:rounded-lg space-y-4">
        @csrf
        <div>
          <label class="block text-sm font-medium text-gray-700">Descrição das alterações</label>
          <textarea name="change_log" rows="3"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Anexos</label>
          <input type="file" name="attachments[]" multiple class="mt-1 block w-full"/>
        </div>
        <div class="flex justify-end">
          <a href="{{ route('teams.submissions.show', [$team,$submission]) }}"
             class="mr-4 text-gray-600 hover:underline">Cancelar</a>
          <button type="submit"
                  class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500">
            Salvar Versão
          </button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
