<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'date_of_birth',
        'last_education',
        'previous_job',
        'skills',
        'about',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
