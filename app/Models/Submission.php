<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = ['team_id','title','description'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function attachments()
    {
        return $this->hasMany(SubmissionAttachment::class);
    }
}
