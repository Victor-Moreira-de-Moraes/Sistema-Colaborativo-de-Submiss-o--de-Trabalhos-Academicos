{{-- resources/views/submissions/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nova Submissão para:') }} {{ $team->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow px-6 py-4 sm:rounded-lg">
                <form action="{{ route('teams.submissions.store', $team) }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">
                            {{ __('Título') }}
                        </label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title') }}"
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
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="attachments" class="block text-sm font-medium text-gray-700">
                            {{ __('Anexos') }}
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
                        <a href="{{ route('teams.submissions.index', $team) }}"
                           class="mr-4 text-sm text-gray-600 hover:underline">
                            {{ __('Cancelar') }}
                        </a>
                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent 
                                   rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                                   hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 
                                   focus:ring-blue-500"
                        >
                            {{ __('Enviar') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
