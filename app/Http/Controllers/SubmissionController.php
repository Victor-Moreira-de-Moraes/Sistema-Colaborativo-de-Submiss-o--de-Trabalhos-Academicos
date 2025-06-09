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
        // Só owner ou membro vê
        $this->authorize('view', $team);

        // Assegura que a submissão pertence à equipe
        abort_if($submission->team_id !== $team->id, 403);

        return view('submissions.show', compact('team','submission'));
    }
}
