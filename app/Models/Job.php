<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'employment_type',
        'salary',
        'deadline',
        'created_by',
        'is_hidden',
    ];


    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
