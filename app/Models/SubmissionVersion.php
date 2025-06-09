<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmissionVersion extends Model
{
    protected $fillable = ['submission_id','version_number','change_log'];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }

    public function attachments()
    {
        return $this->hasMany(SubmissionAttachment::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'submission_version_id');
    }
}

