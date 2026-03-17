<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'project_id',
        'title',
        'description',
        'started_at',
        'ended_at',
        'duration_minutes',
        'github_link',
        'todoist_link',
        'other_links',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
            'duration_minutes' => 'integer',
            'other_links' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function getHumanizedDurationAttribute(): string
    {
        if (!$this->duration_minutes) {
            return '0 min';
        }

        return \Carbon\CarbonInterval::minutes($this->duration_minutes)
            ->cascade()
            ->forHumans(['short' => true]);
    }
}
