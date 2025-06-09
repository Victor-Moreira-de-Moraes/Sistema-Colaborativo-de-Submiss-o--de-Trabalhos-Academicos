<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmissionAttachment extends Model
{
    protected $fillable = ['submission_id','path','original_name'];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
