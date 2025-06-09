<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Equipe:') }} {{ $team->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow px-6 py-4 sm:rounded-lg">
                <form action="{{ route('teams.update', $team) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            {{ __('Nome da Equipe') }}
                        </label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name', $team->name) }}"
                            required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm 
                                   focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-red-500 @enderror"
                        >
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end">
                        <a href="{{ route('teams.show', $team) }}"
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
                            {{ __('Salvar') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
