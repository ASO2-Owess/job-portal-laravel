<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_post_id',
        'freelancer_id',
        'cover_letter',
        'status',
    ];

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }

    public function freelancer()
{
    return $this->belongsTo(Candidate::class, 'freelancer_id');
}
}
