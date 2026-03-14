<?php

namespace App\Services;

use App\Models\Activity;

class ActivityService
{
        public function allActivityByProject(int $projectId){
        return Activity::with('project')->where('project_id', $projectId)->get();
    }
}
