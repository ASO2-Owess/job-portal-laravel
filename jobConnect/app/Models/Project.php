<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'title',
        'description',
        'screenshot_path',
        'repo_url',
        'live_url',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
