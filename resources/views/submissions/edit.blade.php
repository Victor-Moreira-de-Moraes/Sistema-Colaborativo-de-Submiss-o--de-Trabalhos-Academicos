{{-- resources/views/submissions/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Submissão:') }} {{ $submission->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow px-6 py-4 sm:rounded-lg">
                <form action="{{ route('teams.submissions.update', [$team, $submission]) }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">
                            {{ __('Título') }}
                        </label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title', $submission->title) }}"
                            required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm 
                                   focus:border-indigo-500 focus:ring-indigo-500 @error('title') border-red-500 @enderror"
                        >
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">
                            {{ __('Descrição') }}
                        </label>
                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm 
                                   focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 @enderror"
                        >{{ old('description', $submission->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="attachments" class="block text-sm font-medium text-gray-700">
                            {{ __('Anexar Novos Arquivos') }}
                        </label>
                        <input
                            type="file"
                            name="attachments[]"
                            id="attachments"
                            multiple
                            class="mt-1 block w-full text-gray-700"
                        >
                        @error('attachments.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end">
                        <a href="{{ route('teams.submissions.show', [$team, $submission]) }}"
                           class="mr-4 text-sm text-gray-600 hover:underline">
                            {{ __('Cancelar') }}
                        </a>
                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent 
                                   rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                                   hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 
                                   focus:ring-green-500"
                        >
                            {{ __('Salvar Alterações') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
