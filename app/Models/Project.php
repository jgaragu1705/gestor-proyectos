<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public const ROLES = [
        'Desarrollador',
        'Diseñador',
        'Tester',
    ];

    public const STATUSES = [
        'pendiente',
        'en progreso',
        'finalizado',
    ];

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'status',
        'user_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role', 'contribution_hours')
            ->withTimestamps();
    }

    public function isOverdue(): bool
    {
        return $this->deadline->lt(today()) && $this->status !== 'finalizado';
    }

    protected function casts(): array
    {
        return [
            'deadline' => 'date',
        ];
    }
}
