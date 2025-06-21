<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $casts = [
        'completed' => 'boolean',
        'due_date' => 'datetime',
    ];

    protected $fillable = [
        'user_id',        // ✅ Allow mass-assignment of user_id
        'title',
        'description',
        'due_date',
    ];
}
