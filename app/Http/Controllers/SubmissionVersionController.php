<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Submission;
use App\Models\SubmissionVersion;
use Illuminate\Http\Request;

class SubmissionVersionController extends Controller
{
    public function create(Team $team, Submission $submission)
    {
        $this->authorize('update', $team);
        return view('submissions.versions.create', compact('team','submission'));
    }

    public function store(Request $request, Team $team, Submission $submission)
    {
        $this->authorize('update', $team);

        // Determina o próximo número de versão
        $next = $submission->versions()->max('version_number') + 1;

        $data = $request->validate([
            'change_log'    => 'nullable|string',
            'attachments.*' => 'file|max:20480'
        ]);

        $version = $submission->versions()->create([
            'version_number' => $next,
            'change_log'     => $data['change_log'] ?? null,
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('submissions');
                $version->attachments()->create([
                    'path'          => $path,
                    'original_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect()
            ->route('teams.submissions.show', [$team, $submission])
            ->with('success',"Versão #{$next} adicionada.");
    }

    public function show(Team $team, Submission $submission, SubmissionVersion $version)
    {
        // 1) Autorização
        $this->authorize('view', $team);
    
        // 2) Garante que a versão pertença à submissão certa
        abort_if($version->submission_id !== $submission->id, 403);
    
        // 3) Carrega anexos e comentários com o usuário
        $version->load('attachments', 'comments.user');
    
        // 4) Retorna a view
        return view('submissions.versions.show', [
            'team'       => $team,
            'submission' => $submission,
            'version'    => $version,
        ]);
    }
}
