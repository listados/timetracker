<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
   public function allProjects()
   {
       $projects = Project::all();
       return view('dashboard', ['projects' => $projects]);

   }
}
