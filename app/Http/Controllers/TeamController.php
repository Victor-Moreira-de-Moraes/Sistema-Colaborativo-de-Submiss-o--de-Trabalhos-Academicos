<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function __construct()
    {
        // Garante que só usuários logados acessem estas rotas
        $this->middleware('auth');
    }

    /**
     * Lista todas as equipes do usuário autenticado.
     */
    public function index()
    {
        $teams = Auth::user()->teams;
        return view('teams.index', compact('teams'));
    }

    /**
     * Formulário para criar nova equipe.
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Salva a nova equipe: define owner_id e adiciona o próprio usuário como membro.
     */
    public function store(Request $request)
    {
        // store não exige authorize pois usamos create(), mas se quisesse:
        // $this->authorize('create', Team::class);
    
        $team = auth()->user()->ownedTeams()->create($request->validate([
            'name'=>'required|string|max:255'
        ]));
        $team->members()->attach(auth()->id());
        return redirect()->route('teams.show',$team);
    }
    
    /**
     * Exibe os detalhes de uma submissão.
     *
     * GET /submissions/{submission}
     */
    public function show(Team $team)
    {
        $this->authorize('view', $team);

        // se quiser já buscar as submissões para mostrar na blade:
        $submissions = $team->submissions()->latest()->get();

        return view('teams.show', compact('team','submissions'));
    }

    /**
     * Formulário para editar o nome da equipe.
     */
    public function edit(Team $team)
    {
        $this->authorize('update', $team);
        return view('teams.edit', compact('team'));
    }

    /**
     * Atualiza o nome da equipe.
     */
    public function update(Request $request, Team $team)
    {
        $this->authorize('update', $team);

        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $team->update($data);

        return redirect()
            ->route('teams.show', $team)
            ->with('success', 'Equipe atualizada com sucesso.');
    }

    /**
     * Remove a equipe (apenas owner).
     */
    public function destroy(Team $team)
    {
        $this->authorize('delete', $team);
        $team->delete();

        return redirect()
            ->route('teams.index')
            ->with('success', 'Equipe removida.');
    }

    /**
     * Convida um usuário (por e-mail) para a equipe.
     */
    public function invite(Request $request, Team $team)
    {
        $this->authorize('update', $team);

        $data = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $data['email'])->first();

        if ($team->members->contains($user)) {
            return back()->with('error', 'Usuário já é membro desta equipe.');
        }

        $team->members()->attach($user->id);

        return back()->with('success', 'Usuário adicionado à equipe.');
    }
}
