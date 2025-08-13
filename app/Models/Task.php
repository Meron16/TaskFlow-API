<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
public function project()
{
    return $this->belongsTo(Project::class);
}

// Add project_id to $fillable
protected $fillable = [
    'user_id',
    'project_id',
    'title',
    'description',
    'status',
];


public function user()
{
    return $this->belongsTo(User::class);
}

}
