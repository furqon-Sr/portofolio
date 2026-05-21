<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Project;
class ProjectController extends Controller
{
    public function index(){
        $projects = Project::latest()->get();
        return view('works', compact('projects'));
    }
    public function show($slug){
        $project = Project::where('slug', $slug)->firstOrFail();
        return view('project-detail', compact('project'));
    }
}
