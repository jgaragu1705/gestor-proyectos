<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'deadline',
        'status',
        'user_id',
    ];

    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function members(){
        return $this->belongsToMany(User::class)
            ->withPivot('role', 'contribution_hours')
            ->withTimestamps();
    }
    protected function casts(): array{
        return [
            'deadline' => 'date',
        ];
    }
}
