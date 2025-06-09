<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Tela principal (Dashboard) com visão das equipes e status das submissões.
     */
    public function dashboard(): View
    {
        $user = Auth::user();

        // Pega equipes onde é owner ou membro
        $teams = Team::where('owner_id', $user->id)
            ->orWhereHas('members', fn($q) => $q->where('user_id', $user->id))
            ->withCount('submissions')
            ->get()
            ->map(function($team) {
                $last = $team->submissions()->latest('created_at')->first();
                $team->last_submission_at = $last?->created_at;
                return $team;
            });

        return view('dashboard', compact('teams'));
    }

    /**
     * Exibe o formulário de edição de perfil.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Atualiza as informações de perfil.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Deleta a conta do usuário.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
