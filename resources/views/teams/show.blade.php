<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Equipe:') }} {{ $team->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Membros --}}
            <div class="bg-white shadow px-6 py-4 sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-3">{{ __('Membros') }}</h3>
                <ul class="divide-y divide-gray-200">
                    @forelse($team->members as $member)
                        <li class="py-2">
                            {{ $member->name }} <span class="text-sm text-gray-500">({{ $member->email }})</span>
                        </li>
                    @empty
                        <li class="py-2 text-gray-500">{{ __('Nenhum membro ainda.') }}</li>
                    @endforelse
                </ul>
            </div>

            {{-- Form convidar --}}
            <div class="bg-white shadow px-6 py-4 sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-3">{{ __('Convidar Usuário') }}</h3>

                @if(session('error'))
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                        {{ session('error') }}
                    </div>
                @endif
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('teams.invite', $team) }}" method="POST" class="flex space-x-3">
                    @csrf
                    <div class="flex-1">
                        <input
                            type="email"
                            name="email"
                            placeholder="{{ __('E-mail do usuário') }}"
                            required
                            class="w-full border-gray-300 rounded-md shadow-sm 
                                   focus:border-indigo-500 focus:ring-indigo-500 @error('email') border-red-500 @enderror"
                        >
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md font-semibold 
                               hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 
                               focus:ring-blue-500"
                    >
                        {{ __('Convidar') }}
                    </button>
                </form>
            </div>

            {{-- Ações --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('teams.edit', $team) }}"
                   class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-400">
                    {{ __('Editar') }}
                </a>
                <form action="{{ route('teams.destroy', $team) }}" method="POST"
                      onsubmit="return confirm('{{ __('Tem certeza?') }}');">
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-500">
                        {{ __('Remover') }}
                    </button>
                </form>
                <a href="{{ route('teams.index') }}"
                   class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-200">
                    {{ __('Voltar') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
