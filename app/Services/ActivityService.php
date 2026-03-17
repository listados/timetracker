<?php

namespace App\Services;

use App\Models\Activity;

class ActivityService
{
    public function allActivityByProject(int $projectId){
        return Activity::with('project')->where('project_id', $projectId)->get();
    }

    public function create(array $data): Activity
    {
        if (!empty($data['started_at']) && !empty($data['ended_at'])) {
            $start = new \DateTime($data['started_at']);
            $end = new \DateTime($data['ended_at']);
            $diff = $start->diff($end);

            $data['duration_minutes'] = ($diff->days * 24 * 60) + ($diff->h * 60) + $diff->i;
        }

        return Activity::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $activity = Activity::findOrFail($id);

        if (!empty($data['started_at']) && !empty($data['ended_at'])) {
            $start = new \DateTime($data['started_at']);
            $end = new \DateTime($data['ended_at']);
            $diff = $start->diff($end);

            $data['duration_minutes'] = ($diff->days * 24 * 60) + ($diff->h * 60) + $diff->i;
        }
        return $activity->update($data);
    }

    public function delete(int $id): bool
    {
        $activity = Activity::findOrFail($id);
        return $activity->delete();
    }
}
