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

    // A versão “atual” (mais recente)
    public function currentVersion()
    {
        return $this->hasOne(SubmissionVersion::class)
                    ->latestOfMany('version_number');
    }

    public function versions()
    {
        return $this->hasMany(SubmissionVersion::class);
    }
}
