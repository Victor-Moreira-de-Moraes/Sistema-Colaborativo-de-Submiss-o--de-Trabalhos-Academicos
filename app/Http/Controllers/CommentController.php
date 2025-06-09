<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Submission;
use App\Models\SubmissionVersion;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // POST /teams/{team}/submissions/{submission}/versions/{version}/comments
    public function store(
        Request $request,
        Team $team,
        Submission $submission,
        SubmissionVersion $version
    ) {
        // só membro/owner da equipe
        $this->authorize('view', $team);
        abort_if($version->submission_id !== $submission->id, 403);

        $data = $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        $version->comments()->create([
            'user_id' => $request->user()->id,
            'body'    => $data['body'],
        ]);

        return back()->with('success', __('Comentário adicionado.'));
    }
}
