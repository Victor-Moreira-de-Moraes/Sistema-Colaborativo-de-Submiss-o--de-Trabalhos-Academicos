<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Lista todas as submissões de uma equipe.
     * GET  /teams/{team}/submissions
     */
    public function index(Team $team)
    {
        // Apenas membros ou owner podem ver a lista
        $this->authorize('view', $team);

        $subs = $team->submissions()->latest()->get();

        return view('submissions.index', [
            'team' => $team,
            'subs' => $subs,
        ]);
    }

    /**
     * Exibe o formulário de criação de nova submissão.
     * GET  /teams/{team}/submissions/create
     */
    public function create(Team $team)
    {
        // Apenas owner pode criar nova submissão
        $this->authorize('update', $team);

        return view('submissions.create', [
            'team' => $team,
        ]);
    }

    /**
     * Armazena uma nova submissão com anexos.
     * POST /teams/{team}/submissions
     */
    public function store(Request $request, Team $team)
    {
        // Apenas owner pode submeter
        $this->authorize('update', $team);

        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'attachments.*'=> 'file|max:20480',
        ]);

        // Cria a submissão
        $submission = $team->submissions()->create([
            'title'       => $data['title'],
            'description' => $data['description'],
        ]);

        // Processa os arquivos enviados
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('submissions');
                $submission->attachments()->create([
                    'path'          => $path,
                    'original_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect()
            ->route('teams.submissions.index', $team)
            ->with('success', 'Submissão criada com sucesso.');
    }

    /**
     * Exibe os detalhes de uma submissão.
     * GET /teams/{team}/submissions/{submission}
     */
    public function show(Team $team, Submission $submission)
    {
        $this->authorize('view', $team);
        abort_if($submission->team_id !== $team->id, 403);
    
        // carrega a versão atual e seus attachments
        $submission->load('currentVersion.attachments');
    
        return view('submissions.show', compact('team','submission'));
    }

    
    /**
     * Exibe o formulário de edição de uma submissão.
     * GET /teams/{team}/submissions/{submission}/edit
     */
    public function edit(Team $team, Submission $submission)
    {
        // Só o owner (update) pode editar
        $this->authorize('update', $team);

        // Garante que a submissão pertença à equipe
        abort_if($submission->team_id !== $team->id, 403);

        return view('submissions.edit', compact('team','submission'));
    }

    /**
     * Atualiza os dados (e adiciona novos anexos, se houver).
     * PUT/PATCH /teams/{team}/submissions/{submission}
     */
    public function update(Request $request, Team $team, Submission $submission)
    {
        $this->authorize('update', $team);
        abort_if($submission->team_id !== $team->id, 403);

        $data = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'attachments.*' => 'file|max:20480',
        ]);

        // Atualiza título e descrição
        $submission->update([
            'title'       => $data['title'],
            'description' => $data['description'],
        ]);

        // Armazena novos anexos
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('submissions');
                $submission->attachments()->create([
                    'path'          => $path,
                    'original_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect()
            ->route('teams.submissions.show', [$team, $submission])
            ->with('success','Submissão atualizada com sucesso.');
    }

    /**
     * (Opcional) Remove uma submissão.
     * DELETE /teams/{team}/submissions/{submission}
     */
    public function destroy(Team $team, Submission $submission)
    {
        $this->authorize('delete', $team);
        abort_if($submission->team_id !== $team->id, 403);

        $submission->attachments()->delete();
        $submission->delete();

        return redirect()
            ->route('teams.submissions.index', $team)
            ->with('success','Submissão removida.');
    }
}
