<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;


// Add project_id to $fillable
protected $fillable = [
    'user_id',
    'project_id',
    'title',
    'description',
    'status',
    'priority',
    'due_date',
];


public function user()
{
    return $this->belongsTo(User::class);
}
public function project()
{
    return $this->belongsTo(Project::class);
}
public function comments()
{
    return $this->hasMany(Comment::class);
}

}
