<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Contact;
use App\Models\AboutSetting;
use App\Models\AboutBox;
use App\Models\Expertise;
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

    /**
     * Display the About Me and Expertise settings page.
     */
    public function about()
    {
        AboutSetting::seedIfEmpty();
        AboutBox::seedIfEmpty();
        Expertise::seedIfEmpty();

        $aboutSetting = AboutSetting::first();
        $aboutBoxes = AboutBox::orderBy('id', 'asc')->get();
        $expertises = Expertise::orderBy('id', 'asc')->get();

        return view('admin.about', compact('aboutSetting', 'aboutBoxes', 'expertises'));
    }

    /**
     * Update the main About Me description text.
     */
    public function updateAboutText(Request $request)
    {
        $request->validate([
            'about_text' => 'required|string',
        ]);

        $aboutSetting = AboutSetting::first();
        if (!$aboutSetting) {
            AboutSetting::create(['about_text' => $request->input('about_text')]);
        } else {
            $aboutSetting->update(['about_text' => $request->input('about_text')]);
        }

        return redirect()->route('admin.about')->with('success', 'About text updated successfully!');
    }

    /**
     * Update the Hero section texts.
     */
    public function updateHeroText(Request $request)
    {
        $request->validate([
            'hero_title' => 'required|string',
            'hero_subtitle' => 'required|string',
        ]);

        $aboutSetting = AboutSetting::first();
        if (!$aboutSetting) {
            AboutSetting::create([
                'hero_title' => $request->input('hero_title'),
                'hero_subtitle' => $request->input('hero_subtitle'),
                'about_text' => '',
            ]);
        } else {
            $aboutSetting->update([
                'hero_title' => $request->input('hero_title'),
                'hero_subtitle' => $request->input('hero_subtitle'),
            ]);
        }

        return redirect()->route('admin.about')->with('success', 'Hero text updated successfully!');
    }

    /**
     * Update brand logo and footer text settings.
     */
    public function updateSiteIdentity(Request $request)
    {
        $request->validate([
            'logo_type' => 'required|string|in:text,svg,file,url',
            'logo_text' => 'nullable|string|max:255',
            'logo_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo_url' => 'nullable|url',
            'footer_name' => 'required|string|max:255',
            'footer_copyright' => 'required|string|max:255',
            'favicon_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,ico|max:1024',
            'favicon_url' => 'nullable|url',
        ]);

        $aboutSetting = AboutSetting::first();
        if (!$aboutSetting) {
            AboutSetting::seedIfEmpty();
            $aboutSetting = AboutSetting::first();
        }

        $logoValue = $aboutSetting->logo_value;
        $logoType = $request->input('logo_type');

        if ($logoType === 'text') {
            $logoValue = $request->input('logo_text', 'HANAFI');
        } elseif ($logoType === 'file' || $logoType === 'svg') {
            if ($request->hasFile('logo_file')) {
                $file = $request->file('logo_file');
                $mimeType = $file->getMimeType();
                $extension = strtolower($file->getClientOriginalExtension());
                
                if ($mimeType === 'image/svg+xml' || $extension === 'svg') {
                    // It's an SVG file! Read content directly as text code
                    $logoValue = file_get_contents($file->getRealPath());
                    $logoType = 'svg'; // Automatically mark it as SVG type for inline rendering
                } else {
                    // Bitmap images: Encode to base64
                    $logoValue = 'data:' . $mimeType . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
                    $logoType = 'file';
                }
            }
        } elseif ($logoType === 'url') {
            if ($request->filled('logo_url')) {
                $logoValue = $request->input('logo_url');
            }
        }

        // Favicon handling
        $favicon = $aboutSetting->favicon;
        $faviconType = $aboutSetting->favicon_type ?? 'url';
        if ($request->hasFile('favicon_file')) {
            $faviconFile = $request->file('favicon_file');
            $favicon = 'data:' . $faviconFile->getMimeType() . ';base64,' . base64_encode(file_get_contents($faviconFile->getRealPath()));
            $faviconType = 'file';
        } elseif ($request->filled('favicon_url')) {
            $favicon = $request->input('favicon_url');
            $faviconType = 'url';
        }

        $aboutSetting->update([
            'logo_type' => $logoType,
            'logo_value' => $logoValue,
            'footer_name' => $request->input('footer_name'),
            'footer_copyright' => $request->input('footer_copyright'),
            'favicon' => $favicon,
            'favicon_type' => $faviconType,
        ]);

        return redirect()->route('admin.about')->with('success', 'Site identity updated successfully!');
    }

    /**
     * Show the form for editing an about box text.
     */
    public function editAboutBox($id)
    {
        $box = AboutBox::findOrFail($id);
        return view('admin.about.edit_box', compact('box'));
    }

    /**
     * Update the specified about box text and icon.
     */
    public function updateAboutBox(Request $request, $id)
    {
        $box = AboutBox::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'icon_url' => 'nullable|url',
            'icon_svg' => 'nullable|string',
            'upload_type' => 'required|string|in:svg,file,url',
        ]);

        $uploadType = $request->input('upload_type');
        $icon = $box->icon;

        if ($uploadType === 'file') {
            if ($request->hasFile('icon_file')) {
                $file = $request->file('icon_file');
                $icon = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
            }
        } elseif ($uploadType === 'url') {
            if ($request->filled('icon_url')) {
                $icon = $request->input('icon_url');
            }
        } elseif ($uploadType === 'svg') {
            if ($request->filled('icon_svg')) {
                $icon = $request->input('icon_svg');
            } else {
                $icon = null; // Clear to use fallback default svg
            }
        }

        $box->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'icon' => $icon,
        ]);

        return redirect()->route('admin.about')->with('success', 'Card updated successfully!');
    }

    /**
     * Show the form for creating a new expertise.
     */
    public function createExpertise()
    {
        return view('admin.about.expertise.create');
    }

    /**
     * Store a newly created expertise.
     */
    public function storeExpertise(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url',
            'logo_file' => 'nullable|image|max:2048',
            'logo_url' => 'nullable|url',
            'bg_class' => 'required|string|max:255',
            'hover_class' => 'required|string|max:255',
        ]);

        $logo = '';
        if ($request->hasFile('logo_file')) {
            $file = $request->file('logo_file');
            $logo = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
        } elseif ($request->filled('logo_url')) {
            $logo = $request->input('logo_url');
        } else {
            return back()->withErrors(['logo_file' => 'Please upload a logo image or provide an image URL.']);
        }

        Expertise::create([
            'name' => $request->input('name'),
            'url' => $request->input('url'),
            'logo' => $logo,
            'bg_class' => $request->input('bg_class'),
            'hover_class' => $request->input('hover_class'),
        ]);

        return redirect()->route('admin.about')->with('success', 'Expertise added successfully!');
    }

    /**
     * Show the form for editing an expertise.
     */
    public function editExpertise($id)
    {
        $expertise = Expertise::findOrFail($id);
        return view('admin.about.expertise.edit', compact('expertise'));
    }

    /**
     * Update the specified expertise.
     */
    public function updateExpertise(Request $request, $id)
    {
        $expertise = Expertise::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url',
            'logo_file' => 'nullable|image|max:2048',
            'logo_url' => 'nullable|url',
            'bg_class' => 'required|string|max:255',
            'hover_class' => 'required|string|max:255',
        ]);

        $logo = $expertise->logo;
        if ($request->hasFile('logo_file')) {
            $file = $request->file('logo_file');
            $logo = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
        } elseif ($request->filled('logo_url')) {
            $logo = $request->input('logo_url');
        }

        $expertise->update([
            'name' => $request->input('name'),
            'url' => $request->input('url'),
            'logo' => $logo,
            'bg_class' => $request->input('bg_class'),
            'hover_class' => $request->input('hover_class'),
        ]);

        return redirect()->route('admin.about')->with('success', 'Expertise updated successfully!');
    }

    /**
     * Delete the specified expertise.
     */
    public function deleteExpertise($id)
    {
        $expertise = Expertise::findOrFail($id);
        $expertise->delete();

        return redirect()->route('admin.about')->with('success', 'Expertise deleted successfully!');
    }
}
