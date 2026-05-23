<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard stats and summary.
     */
    public function dashboard()
    {
        $projectCount = Project::count();
        $messageCount = Contact::count();
        $recentMessages = Contact::latest()->take(5)->get();
        $recentProjects = Project::latest()->take(5)->get();

        return view('admin.dashboard', compact('projectCount', 'messageCount', 'recentMessages', 'recentProjects'));
    }

    /**
     * Display a listing of all portfolio items.
     */
    public function projects()
    {
        Project::seedIfEmpty();
        $projects = Project::orderBy('id', 'desc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function createProject()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created project in the database.
     */
    public function storeProject(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:Web Dev,Design',
            'description' => 'required|string',
            'live_link' => 'required|url',
            'github_link' => 'nullable|url',
            'cover_image_file' => 'nullable|image|max:2048',
            'cover_image_url' => 'nullable|url',
        ]);

        $coverImage = 'image.png'; // default placeholder
        if ($request->hasFile('cover_image_file')) {
            $file = $request->file('cover_image_file');
            $coverImage = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
        } elseif ($request->filled('cover_image_url')) {
            $coverImage = $request->input('cover_image_url');
        }

        Project::create([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')) . '-' . time(),
            'category' => $request->input('category'),
            'description' => $request->input('description'),
            'live_link' => $request->input('live_link'),
            'github_link' => $request->input('github_link'),
            'cover_image' => $coverImage,
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully!');
    }

    /**
     * Show the form for editing an existing project.
     */
    public function editProject($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified project in the database.
     */
    public function updateProject(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:Web Dev,Design',
            'description' => 'required|string',
            'live_link' => 'required|url',
            'github_link' => 'nullable|url',
            'cover_image_file' => 'nullable|image|max:2048',
            'cover_image_url' => 'nullable|url',
        ]);

        $coverImage = $project->cover_image;
        if ($request->hasFile('cover_image_file')) {
            $file = $request->file('cover_image_file');
            $coverImage = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
        } elseif ($request->filled('cover_image_url')) {
            $coverImage = $request->input('cover_image_url');
        }

        $project->update([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')) . '-' . $project->id,
            'category' => $request->input('category'),
            'description' => $request->input('description'),
            'live_link' => $request->input('live_link'),
            'github_link' => $request->input('github_link'),
            'cover_image' => $coverImage,
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    /**
     * Delete the specified project from the database.
     */
    public function deleteProject($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully!');
    }

    /**
     * Display a listing of all contact messages.
     */
    public function messages()
    {
        $messages = Contact::latest()->get();
        return view('admin.messages', compact('messages'));
    }
}
