<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['submission_version_id','user_id','body'];

    public function version()
    {
        return $this->belongsTo(SubmissionVersion::class, 'submission_version_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
